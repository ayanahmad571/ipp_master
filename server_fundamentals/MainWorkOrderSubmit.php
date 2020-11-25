<?php

require_once("SessionHandler.php");
require_once("PostDataHeadChecker.php");

if(isset($_POST['draftToMain'])){
	#                         POST NAME			 Prev ID, Send ID NAME
	$PAGE_ESSENTIALS= array('draftToMain',1,2);

}else if(isset($_POST['salesToAccounts'])){

	$PAGE_ESSENTIALS= array('salesToAccounts',2,4);

}else if(isset($_POST['returnSales'])){

	$PAGE_ESSENTIALS= array('returnSales',2,3);

}else if(isset($_POST['rePublishSales'])){

	$PAGE_ESSENTIALS= array('rePublishSales',3,2);
     
}else if(isset($_POST['AccountsToTechnical'])){

	$PAGE_ESSENTIALS= array('AccountsToTechnical',4,5);
    
}else if(isset($_POST['AccountsCondToTechnical'])){
    if(!isset($_POST['WorkOrderRelReasonID']) || !isset($_POST['WorkOrderRelReason'])){
		die("<p style='color:red'>Incomplete Form Submitted</p>");
    }
    if(!is_numeric($_POST['AccountsCondToTechnical'])){
		die("<p style='color:red'>Invalid Work Order ID</p>");
	}
	if(!is_numeric($_POST['WorkOrderRelReasonID'])){
		die("<p style='color:red'>Invalid Release Condition Selected</p>");
	}
	
	if(trim($_POST['WorkOrderRelReason']) == ''){
		die("<p style='color:red'>Invalid Release Reason Input</p>");
	}

	$getReasons = mysqlSelect("select * from conditional_release_reason where crr_show = 1 and crr_id =".$_POST['WorkOrderRelReasonID']);
	if(!is_array($getReasons)){
		die("<p style='color:red'>Invalid Release Condition </p>");
	}
	
	$getRecieved= mysqlSelect($UpdatedStatusQuery . "
	left join clients_main on master_wo_2_client_id = client_id
	left join master_work_order_main_identitiy on master_wo_status = mwoid_id
	
		where master_wo_status = 4 and master_wo_ref = ".$_POST['AccountsCondToTechnical']."
	" . $inColsWO . "
	order by master_wo_id desc
	");

	if(!is_array($getRecieved)){
		die("<p style='color:red'>Work Order Not Found</p>");
	}
	
	$insert = mysqlInsertData("INSERT INTO `conditional_release_wo`
	(crw_wo_ref, crw_crr_id, crw_reason, crw_lum_id, crw_dnt) 
	VALUES (
		".$_POST['AccountsCondToTechnical'].",
		".$_POST['WorkOrderRelReasonID'].",
		'".$_POST['WorkOrderRelReason']."',
		".$USER_ARRAY['lum_id'].",
		'".time()."'
	)",true);  

	if(!is_numeric($insert)){
		die("<p style='color:red'>Not Released Conditionally</p>");
    }
    
	$PAGE_ESSENTIALS= array('AccountsCondToTechnical',4,6);
    
}else if(isset($_POST['technicalToVerify'])){

	$PAGE_ESSENTIALS= array('technicalToVerify',5,7);
    
}else if(isset($_POST['technicalToVerifyCond'])){

	$PAGE_ESSENTIALS= array('technicalToVerifyCond',6,7);
    
}else if(isset($_POST['techRePub'])){

	$PAGE_ESSENTIALS= array('techRePub',8,7);
    
}else if(isset($_POST['technicalToVerifyRej'])){

	$PAGE_ESSENTIALS= array('technicalToVerifyRej',7,8);
    
}else if(isset($_POST['techVerPublish'])){

	$PAGE_ESSENTIALS= array('techVerPublish',7,9);
    
}else{
	die("Document Not Reachable");
}


//user type_check only sales and MD people can make this WO
if (!in_array($USER_ARRAY['user_type_id'], array(1, 2, 4, 10, 16))) {
    die('User Not Authorized');
}

if (isset($_POST[$PAGE_ESSENTIALS[0]])) {
    if (is_numeric($_POST[$PAGE_ESSENTIALS[0]])) {
        $getWO = mysqlSelect($UpdatedStatusQuery . "
       
        
		left join clients_main on master_wo_2_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id
		
        where master_wo_status = ".$PAGE_ESSENTIALS[1]." and master_wo_ref= " . $_POST[$PAGE_ESSENTIALS[0]] . " 
		" . $inColsWO . "
		order by master_wo_id desc
        ");

        if (!is_array($getWO)) {
            die("Error - Work Order Not Found.");
        }
        $getWO = $getWO[0];
    } else {
        die("Error - Work Order ID Invalid");
    }
} else {
    die("Error - Expected a Work Order ID, got nothing.");
}


$getWO['master_wo_gen_dnt'] = time();
$getWO['master_wo_gen_lum_id'] = $USER_ARRAY['lum_id'];
$getWO['master_wo_status'] = $PAGE_ESSENTIALS[2];

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
    die("ERROR - 503.1 - Fatal Internal Server Error, Work Order Could not be inserted, REFERENCE INSERTED");
}
die("Success- Work Order Successfully Published");

?>
