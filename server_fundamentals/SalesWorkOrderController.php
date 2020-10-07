<?php
require_once("SessionHandler.php");

if(isset($_POST['draftDiscard'])){
	if(!is_numeric($_POST['draftDiscard'])){
		die("Error: Draft ID Format Invalid");
	}


	$getDrafts = mysqlSelect("SELECT * FROM `sales_work_order_main` 
	where s_wo_status = 1 
	".$inColsWO."
	and s_wo_id = ".$_POST['draftDiscard']);
	
	if(!is_array($getDrafts)){
		die("Error: Draft not Found");
	}
	
	$Draft = $getDrafts[0];

	$updateSql = mysqlUpdateData("update sales_work_order_main set s_wo_status = 2 where s_wo_id = ".$Draft['s_wo_id'],true);
	if(is_numeric($updateSql)){
		
logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." MARKED DRAFT ID: ".$Draft['s_wo_id']." AS A DISCARD", 
		"mysqlInsertData");


		die("Success - Draft ".$Draft['s_wo_id']." discarded");
	}else{
		die("<p style='color:red'>Error - Draft could not be Discarded</p>");
	}
}
?>