<?php
require_once("SessionHandler.php");
require_once("PostDataHeadChecker.php");
//user type_check only sales and MD people can make this WO
if (!in_array($USER_ARRAY['user_type_id'], array(1, 2, 4, 10, 16))) {
    die('User Not Authorized');
}

if (isset($_POST['work_order_repeat_publish_id'])) {
    if (is_numeric($_POST['work_order_repeat_publish_id'])) {
        $getWO = mysqlSelect($UpdatedStatusQuery . "
       
        
		left join clients_main on master_wo_2_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id
		
        where master_wo_status = 9 and master_wo_ref= " . $_POST['work_order_repeat_publish_id'] . " 
		" . $inColsWO . "
		order by master_wo_id desc
        ");

        if (!is_array($getWO)) {
            die("Editing Sales Order Not Found.");
        }
        $getWO = $getWO[0];
    } else {
        die("Work Order ID Invalid");
    }
} else {
    die("Expected a Last Work Order ID, got nothing.");
}

$toCheck = array(
    "work_order_repeat_publish_id", "work_order_po_date", "work_order_delivery_date", "work_order_add_po", "work_order_ncr_no", "work_order_ccr_no",
    "work_order_2_sales_id", "work_order_repeat_quantity", "work_order_repeat_2_units", "work_order_repeat_quantity_tolerance", "work_order_remarks_overall"
);

//check dates x2
$date_created = date_create_from_format("d-m-Y @ H:i:s", $_POST['work_order_po_date'] . ' @ 12:10:00');
if (!empty($date_created)) {
	$obj = get_object_vars($date_created);
} else {
	die("Invalid Customer PO Date Format");
}

$checkCustPoDate = strtotime($obj['date']);
if ($checkCustPoDate < time()) {
	die("Invalid Customer PO Date, Date Must be in the Future");
}

$date_created2 = date_create_from_format("d-m-Y @ H:i:s", $_POST['work_order_delivery_date'] . ' @ 12:10:00');
if (!empty($date_created2)) {
	$obj2 = get_object_vars($date_created2);
} else {
	die("Invalid Delivery Date Format");
}

$checkDeliveryDate = strtotime($obj2['date']);
if ($checkDeliveryDate < time()) {
	die("Invalid Delivery Date, Date Must be in the Future");
}




checkPost($toCheck);

selectChecker($getAttachedTreeSql . " and lum_id = " . $_POST['work_order_2_sales_id'], 'Sales ID Not Found', 'mysqlSelect');
$getWO["master_wo_2_sales_id"] = $_POST["work_order_2_sales_id"];

selectChecker("SELECT * FROM `work_order_qty_units` where unit_show =1 and unit_id = " . $_POST['work_order_repeat_2_units'], 'Order Qty Units Not Found', 'mysqlSelect');
$getWO["master_wo_2_units"] = $_POST["work_order_repeat_2_units"];


$getWO["master_wo_po_date"] = $checkCustPoDate;
$getWO["master_wo_delivery_date"] = $checkDeliveryDate;
$getWO["master_wo_customer_po"] = $_POST["work_order_add_po"];
$getWO["master_wo_extra_ncr"] = $_POST["work_order_ncr_no"];
$getWO["master_wo_extra_ccr"] = $_POST["work_order_ccr_no"];
$getWO["master_wo_2_sales_id"] = $_POST["work_order_2_sales_id"];
$getWO["master_wo_quantity"] = $_POST["work_order_repeat_quantity"];
$getWO["master_wo_2_units"] = $_POST["work_order_repeat_2_units"];
$getWO["master_wo_quantity_tolerance"] = $_POST["work_order_repeat_quantity_tolerance"];

//make the master Reference entry in the Table and get the New Work Order ID
$insertReference = mysqlInsertData("INSERT INTO `master_work_order_reference_number` 
(`mwo_dnt`, `mwo_gen_on_behalf_lum_id`, `mwo_gen_lum_id`, `mwo_type`, `mwo_repeat_wo_id`) VALUES (
        '" . time() . "',
        '" . $getWO['master_wo_2_sales_id'] . "',
        '" . $USER_ARRAY['lum_id'] . "',
        '2' , 
        '" . $_POST["work_order_repeat_publish_id"] . "')", true);


if (!is_numeric($insertReference)) {
    die("503: Internal Error, Could not insert WORK ORDER REFERENCE");
}
$getWO['master_wo_ref'] = $insertReference;
$getWO['master_wo_gen_dnt'] = time();
$getWO['master_wo_gen_lum_id'] = $USER_ARRAY['lum_id'];
$getWO['master_wo_status'] = 1;

$RemarksMain = array();


if (($_POST["work_order_remarks_overall"] != '')) {
    $RemarksMain[] = "(
				'" . $USER_ARRAY['lum_id'] . "',
				'" . $_POST["work_order_remarks_overall"] . "',
				'" . $insertReference . "',
				'" . time() . "',
				'1')";
}

$QueryCols = array();
$QueryVals = array();
//Insert  Query Content Builder
foreach ($getWO as $a => $b) {
    $goahead = true;
    if(substr( $a, 0, 10) != "master_wo_"){
        $goahead =false;
    }
    if($a == 'master_wo_id'){
        $goahead = false;
    }
    if ($goahead) {
        $QueryCols[] = '`' . $a . '`';
        $QueryVals[] = ((is_null($b)) ? "NULL" : "'" . $b . "'");
    }
}

//Append Data from Content Builder onto Main Query
$insertWO = 'INSERT INTO `master_work_order_main` (' . implode(', 
	', $QueryCols) . ') VALUES (' . implode(',
	', $QueryVals) . ')';

//Insert the Work Order into the Main Conainter TAble
$insertWorkOrderMain = mysqlInsertData($insertWO, true);
if (!is_numeric($insertWorkOrderMain)) {
    die("503.1 - Fatal Internal Server Error, Work Order Could not be inserted, REFERENCE INSERTED");
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

// if (isset($_POST['work_order_edit_draft_id'])) {

// 	$updateCols = array();

// 	foreach ($finalMaster as $a => $b) {
// 		$updateCols[] = '`' . $a . '`' . " = '" . $b . "' ";
// 	}

// 	$insertSql = 'update `sales_work_order_main` 
// 			set
// 			' . implode(', ', $updateCols) . ' 
			
// 			where
// 			s_wo_id = ' . $_POST['work_order_edit_draft_id'];

// 	$check = mysqlUpdateData($insertSql, true);
// 	if (!is_numeric($check)) {
// 		die("503 - Internal Server Error, Update Failed");
// 	}

// 	logInsert(
// 		basename($_SERVER['PHP_SELF']),
// 		$_SESSION[SESSION_HASH_NAME],
// 		$USER_ARRAY['lum_id'],
// 		$_SERVER['REMOTE_ADDR'],
// 		$USER_ARRAY['lum_code'] . " edited draft with ID: " . $_POST['work_order_edit_draft_id'],
// 		"mysqlInsertData"
// 	);
// } else {
// 	//Time and GEN LUM ID only added when a new WO is generated
// 	$finalMaster['s_wo_gen_dnt'] = time();
// 	$finalMaster['s_wo_gen_lum_id'] = $USER_ARRAY['lum_id'];

// 	$QueryCols = array();
// 	$QueryVals = array();

// 	foreach ($finalMaster as $a => $b) {
// 		$QueryCols[] = '`' . $a . '`';
// 		$QueryVals[] = "'" . $b . "'";
// 	}

// 	$insertSql = 'INSERT INTO `sales_work_order_main` (' . implode(', 
// 			', $QueryCols) . ') VALUES (' . implode(',
// 			', $QueryVals) . ')';


// 	$check = mysqlInsertData($insertSql, true);
// 	if (!is_numeric($check)) {
// 		die("503 - Internal Server Error, Insert Failed");
// 	}

// 	logInsert(
// 		basename($_SERVER['PHP_SELF']),
// 		$_SESSION[SESSION_HASH_NAME],
// 		$USER_ARRAY['lum_id'],
// 		$_SERVER['REMOTE_ADDR'],
// 		$USER_ARRAY['lum_code'] . " added a new draft with ID: " . $check,
// 		"mysqlInsertData"
// 	);
// }
