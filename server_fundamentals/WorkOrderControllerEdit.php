<?php
require_once("SessionHandler.php");
require_once("PostDataHeadChecker.php");
//user type_check only sales and MD people can make this WO
if (!in_array($USER_ARRAY['user_type_id'], array(1, 2, 4, 10, 16))) {
	die('User Not Authorized');
}
$WorkOrderMaster = [];
if (isset($_POST['work_order_repeat_publish_id'])) {
	if (is_numeric($_POST['work_order_repeat_publish_id'])) {
		$WorkOrderMaster = mysqlSelect($UpdatedStatusQuery . "
       
        
		left join clients_main on master_wo_2_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id
		
        where master_wo_status in (6,5,8) and master_wo_ref= " . $_POST['work_order_repeat_publish_id'] . " 
		" . $inColsWO . "
		order by master_wo_id desc
    ");

		if (!is_array($WorkOrderMaster)) {
			die("Editing Work Order Not Found.");
		}
		$WorkOrderMaster = $WorkOrderMaster[0];
	} else {
		die("Editing Work Order Invalid ID.");
	}
}else{
	die("Work Order ID Incomplete");
}
//NOT COMPLETE DONT USER
$toCheck = array(
	"work_order_ccr_no","work_order_ncr_no", "work_order_remarks_bags", "work_order_remarks_pouch","work_order_remarks_roll","work_order_remarks_overall","work_order_3_pr_end_ops"
);





$RemarksMain = array();
$QueryCols = array();
$QueryVals = array();


// selectChecker("SELECT * FROM `work_order_ui_structure` where structure_id = " . $_POST['work_order_2_structure'], 'Structure Not Found', 'mysqlSelect');


//Check if the posted options are valid work_order_3_customer_loc
if (isset($_POST['work_order_3_pr_end_ops'])) {
	foreach ($_POST['work_order_3_pr_end_ops'] as $exP) {
		//check Antistatic
		selectChecker(
			"SELECT * FROM `work_order_ui_print_end_options` where print_end_opts_show = 1  and print_end_opts_id = " . $exP,
			'Pritning End Options Invalid at ID= ' . $exP . ' @Not Found',
			'mysqlSelect'
		);
	}
	$WorkOrderMaster['master_wo_extra_print_end_ops'] = implode(',', $_POST['work_order_3_pr_end_ops']);
}else{
	$WorkOrderMaster['master_wo_extra_print_end_ops'] = null;	
}



if (($_POST["work_order_remarks_overall"] != '')) {
	$RemarksMain[] = "(
				'" . $USER_ARRAY['lum_id'] . "',
				'" . $_POST["work_order_remarks_overall"] . "',
				'" . $insertReference . "',
				'" . time() . "',
				'1')";
}
if (($_POST["work_order_remarks_pouch"] != '')) {
	$RemarksMain[] = "(
				'" . $USER_ARRAY['lum_id'] . "',
				'" . $_POST["work_order_remarks_pouch"] . "',
				'" . $insertReference . "',
				'" . time() . "',
				'2')";
}
if (($_POST["work_order_remarks_bags"] != '')) {
	$RemarksMain[] = "(
				'" . $USER_ARRAY['lum_id'] . "',
				'" . $_POST["work_order_remarks_bags"] . "',
				'" . $insertReference . "',
				'" . time() . "',
				'4')";
}
if (($_POST["work_order_remarks_roll"] != '')) {
	$RemarksMain[] = "(
				'" . $USER_ARRAY['lum_id'] . "',
				'" . $_POST["work_order_remarks_roll"] . "',
				'" . $insertReference . "',
				'" . time() . "',
				'3')";
}

$WorkOrderMaster['master_wo_gen_dnt'] = time();
$WorkOrderMaster['master_wo_gen_lum_id'] = $USER_ARRAY['lum_id'];

if ($WorkOrderMaster['mwo_type'] != 1) {
	$WorkOrderMaster['master_wo_extra_ccr'] = $_POST["work_order_ccr_no"];
	$WorkOrderMaster['master_wo_extra_ncr'] = $_POST["work_order_ncr_no"];
}

//Insert  Query Content Builder
//Insert  Query Content Builder
$WorkOrderInsert = array();
foreach ($WorkOrderMaster as $a => $b) {
    $goahead = true;
    if(substr( $a, 0, 10) != "master_wo_"){
        $goahead =false;
    }
    if($a == 'master_wo_id'){
        $goahead = false;
    }
    if ($goahead) {
		$WorkOrderInsert[$a] = $b;
    }
}


// if(isset($extraInput) && is_array($extraInput)){
// 	foreach ($extraInput as $key => $value) {
// 		$WorkOrderInsert[$key] = $value;
// 		# code...
// 	}
// }

foreach ($WorkOrderInsert as $a => $b) {
	$QueryCols[] = '`' . $a . '`';
	$QueryVals[] = ((is_null($b)) ? "NULL" : "'" . $b . "'");
}

//Append Data from Content Builder onto Main Query
$insertWO = 'INSERT INTO `master_work_order_main` (' . implode(', 
	', $QueryCols) . ') VALUES (' . implode(',
	', $QueryVals) . ')';

//Insert the Work Order into the Main Conainter TAble
$insertWorkOrderMain = mysqlInsertData($insertWO, true);
if (!is_numeric($insertWorkOrderMain)) {
	die("503.1 - Fatal Internal Server Error, Work Order Could not be inserted");
}

//If previous insert is sucessful then take the ID and insert the remarks associated to it
if (is_array($RemarksMain)) {
	if (count($RemarksMain) > 0) {
		$q = mysqlInsertData("INSERT INTO `remarks_wo`(
			`remark_lum_id`, `remark_text`, `remark_master_wo_id`, `remark_dnt`, `remark_type`) VALUES " . implode(', ', $RemarksMain), true);

		if (!is_numeric($q)) {
			die("Internal Server Error. <br> Work Order Added, Remark Not Added  <br>ERR: " . $q);
		}
	}
}

?>