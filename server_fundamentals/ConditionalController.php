<?php
require_once("SessionHandler.php");

if(isset($_POST['complaint_ref']) && isset($_POST['complaint_text'])){
	if(!is_numeric($_POST['complaint_ref'])){
		die("Reference Not Valid");
	}
	if(empty($_POST['complaint_text'])){
		die("Invalid Complaint");
	}

		$getDrafts = mysqlSelect($UpdatedStatusQuery."
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id
		where master_wo_status = 9
		and master_wo_ref= ".$_POST['complaint_ref']."
        order by master_wo_id desc
		");
		
		if(!is_array($getDrafts)){
			die("Work Order Not Found");
		}
		
		
		$ins = mysqlInsertData("INSERT INTO `complaints_main`( `complaint_wo_ref`, `complaint_text`, `complaint_lum_id`, `complaint_dnt`) VALUES 
		(
		".$getDrafts[0]['master_wo_ref'].",
		'".$_POST['complaint_text']."',
		".$USER_ARRAY['lum_id'].",
		".time()."
		
		)",true);
		
		if(!is_numeric($ins)){
			die("Error - Complaint Adding error");
		}else{
			
logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." added complaint with ID :".$ins, 
		"mysqlInsertData");


			die("Success - Complaint Successfully Registered (Refresh Page)");
		}

}

die("BLANK RESPONSE");
