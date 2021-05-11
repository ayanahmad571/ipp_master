<?php
require_once("../server_fundamentals/SessionHandler.php");

/*
1 	Generated Amendment Form
2 	Requesting Sale Verification
3 	Sales Verifier Rejected Amendment
4 	Requesting Accounts Approval
5 	Accounts Rejected Amendment
6 	Requesting Technical Verification
7 	Technical Rejected Verification
8 	Requesting Planning Verification
9 	Planning Rejected Verification
10 	Amendment Accepted
99 	Discarded
*/

if (!isset($_POST['afm_ref'])) {
    die("Invalid Amendment Form Submitted");
}

if (!isset($_POST['from'])) {
    die("Invalid From Status");
}

if (!isset($_POST['to'])) {
    die("Invalid To Status");
}
# VERIFICATION CHECKS

## Check if work orders exists

$WorkOrderMain = mysqlSelect($UpdatedStatusQuery . "
       
        
  left join clients_main on master_wo_2_client_id = client_id
  left join master_work_order_main_identitiy on master_wo_status = mwoid_id
  
      where master_wo_status not in (1,2,3,10) and master_wo_ref= " . $_POST['afm_ref'] . " 
  " . $inColsWO . "
  order by master_wo_id desc
  ");


if (is_array($WorkOrderMain)) {
    $WorkOrderMain = $WorkOrderMain[0];
} else {
    die('Invalid Work Order Supplied');
}

## If this amendment is currently being verified or open

$checkIn = mysqlSelect("select * from (
    select * from amendment_form_main a where a.afm_id = 
    (SELECT c.afm_id FROM `amendment_form_main` c 
    where c.afm_rel_wo_ref = a.afm_rel_wo_ref
    order by c.afm_id desc 
    limit 1) ) ap 
    left join amendment_form_identity ai on ap.afm_status = ai.afi_id
    where 
    ap.afm_status in (" . $_POST['from'] . ") and ap.afm_rel_wo_ref = " . $_POST['afm_ref']);

if (!is_array($checkIn)) {
    die("This amendment form doesn't exist for this status");
}


# PRE FORM CREATION CHECKS END

# TODO add user account checks


if ($_POST['to'] < 1 || ($_POST['to'] > 10 && $_POST['to'] != 99)) {
    die("Invalid Landing Status Selected");
}
$extraCol = "";
$extraRow = "";

if ($_POST['to'] == 3 || $_POST['to'] == 5 || $_POST['to'] == 7 || $_POST['to'] == 9) {
    echo "<p style='color:red;'>";
    checkPost("reason", true);
    echo "</p>";

    $extraCol = "`afm_reject_lum_id`, `afm_reject_text`, ";
    $extraRow = " '" . $USER_ARRAY['lum_id'] . "','" . $_POST['reason'] . "', ";
}
$insertSQL = mysqlInsertData("INSERT INTO `amendment_form_main`(`afm_rel_wo_ref`, `afm_reason`, `afm_mod_1`, `afm_mod_2`, `afm_mod_3`, 
    `afm_notes`, `afm_gen_lum_id`, `afm_gen_dnt`, " . $extraCol . " `afm_status`)
     VALUES (
         " . $_POST['afm_ref'] . ",
         '" . $checkIn[0]['afm_reason'] . "',
         '" . $checkIn[0]['afm_mod_1'] . "',
         '" . $checkIn[0]['afm_mod_2'] . "',
         '" . $checkIn[0]['afm_mod_3'] . "',
         '" . $checkIn[0]['afm_notes'] . "',
         '" . $USER_ARRAY['lum_id'] . "',
         '" . time() . "',
         " . $extraRow . "
         '" . $_POST['to'] . "'

     )", true);

if (!is_numeric($insertSQL)) {
    die("Could not publish this amendment form, contact Admin");
}

die("This action has been successfully completed.");
