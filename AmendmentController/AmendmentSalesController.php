<?php
require_once("../server_fundamentals/SessionHandler.php");

if (isset($_POST['amend_work_order_id']) || isset($_POST['amend_reason']) || isset($_POST['amend_mod_1']) || isset($_POST['amend_mod_2']) || isset($_POST['amend_mod_3']) || isset($_POST['amend_notes'])) {

    $WorkOrderMain = array();
    if (!isset($_POST['amend_work_order_id'])) {
        die("Work Order ID Not Provided");
    }
    if (!is_numeric($_POST['amend_work_order_id'])) {
        die("Invalid Work Order ID Provided");
    }


    # PRE FORM CREATION CHECKS

    ## Check if work orders exists

    $WorkOrderMain = mysqlSelect($UpdatedStatusQuery . "

    left join clients_main on master_wo_2_client_id = client_id
    left join master_work_order_main_identitiy on master_wo_status = mwoid_id
    
        where master_wo_status not in (1,2,3,10) and master_wo_ref= " . $_POST['amend_work_order_id'] . " 
    " . $inColsWO . "
    order by master_wo_id desc
    ");


    if (is_array($WorkOrderMain)) {
        $WorkOrderMain = $WorkOrderMain[0];
    } else {
        die('Invalid Work Order Supplied');
    }

    ## If there is a current Amendment form that is being verified or has been rejected

    $checkNotIn = mysqlSelect("select * from (
    select * from amendment_form_main a where a.afm_id = 
    (SELECT c.afm_id FROM `amendment_form_main` c 
    where c.afm_rel_wo_ref = a.afm_rel_wo_ref
    order by c.afm_id desc 
    limit 1) ) ap where 
    ap.afm_status not in (10,99) and ap.afm_rel_wo_ref = " . $_POST['amend_work_order_id']);

    if (is_array($checkNotIn)) {
        die("You have already requested an amendment, please close that to proceed further");
    }

    # PRE FORM CREATION CHECKS END


    # VALIDATION

    checkPost(array("amend_reason", "amend_mod_1"), true);
    checkPost(array("amend_mod_2", "amend_mod_3", "amend_notes"));
    # END VALIDATION

    $insertSQL = mysqlInsertData("INSERT INTO `amendment_form_main`(`afm_rel_wo_ref`, `afm_reason`, `afm_mod_1`, `afm_mod_2`, `afm_mod_3`, 
    `afm_notes`, `afm_gen_lum_id`, `afm_gen_dnt`, `afm_status`)
     VALUES (
         " . $_POST['amend_work_order_id'] . ",
         '" . $_POST['amend_reason'] . "',
         '" . $_POST['amend_mod_1'] . "',
         '" . $_POST['amend_mod_2'] . "',
         '" . $_POST['amend_mod_3'] . "',
         '" . $_POST['amend_notes'] . "',
         '" . $USER_ARRAY['lum_id'] . "',
         '" . time() . "',
         1

     )", true);

    if (!is_numeric($insertSQL)) {
        die("Could not add this amendment form, contact Admin");
    }
}

if (isset($_POST['edit_amend_work_order_id']) || isset($_POST['edit_amend_reason']) || isset($_POST['edit_amend_mod_1']) || isset($_POST['edit_amend_mod_2']) || isset($_POST['edit_amend_mod_3']) || isset($_POST['edit_amend_notes'])) {

    $WorkOrderMain = array();
    if (!isset($_POST['edit_amend_work_order_id'])) {
        die("Work Order ID Not Provided");
    }
    if (!is_numeric($_POST['edit_amend_work_order_id'])) {
        die("Invalid Work Order ID Provided");
    }


    # PRE FORM CREATION CHECKS

    ## Check if work orders exists

    $WorkOrderMain = mysqlSelect($UpdatedStatusQuery . "

    left join clients_main on master_wo_2_client_id = client_id
    left join master_work_order_main_identitiy on master_wo_status = mwoid_id
    
        where master_wo_status not in (1,2,3,10) and master_wo_ref= " . $_POST['edit_amend_work_order_id'] . " 
    " . $inColsWO . "
    order by master_wo_id desc
    ");


    if (is_array($WorkOrderMain)) {
        $WorkOrderMain = $WorkOrderMain[0];
    } else {
        die('Invalid Work Order Supplied');
    }

    ## If there is a current Amendment form that is saved as draft

    $checkIn = mysqlSelect("select * from (
    select * from amendment_form_main a where a.afm_id = 
    (SELECT c.afm_id FROM `amendment_form_main` c 
    where c.afm_rel_wo_ref = a.afm_rel_wo_ref
    order by c.afm_id desc 
    limit 1) ) ap where 
    ap.afm_status in (1,3,5,7,9) and ap.afm_rel_wo_ref = " . $_POST['edit_amend_work_order_id']);

    if (!is_array($checkIn)) {
        die("Amendment Form not found");
    }

    # PRE FORM CREATION CHECKS END


    # VALIDATION

    checkPost(array("edit_amend_reason", "edit_amend_mod_1"), true);
    checkPost(array("edit_amend_mod_2", "edit_amend_mod_3", "edit_amend_notes"));
    # END VALIDATION

    $updateSQL = mysqlUpdateData("UPDATE `amendment_form_main` SET 
    
    `afm_reason`= '" . $_POST['edit_amend_reason'] . "',
    `afm_mod_1`= '" . $_POST['edit_amend_mod_1'] . "',
    `afm_mod_2`= '" . $_POST['edit_amend_mod_2'] . "',
    `afm_mod_3`= '" . $_POST['edit_amend_mod_3'] . "',
    `afm_notes`= '" . $_POST['edit_amend_notes'] . "'
    WHERE afm_id = " . $checkIn[0]['afm_id'], true);

    if (!is_numeric($updateSQL)) {
        die("Could not edit this amendment form draft, contact Admin");
    }
}
