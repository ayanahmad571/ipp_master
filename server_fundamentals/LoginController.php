<?php

require_once("Settings.php");
require_once("CookieController.php");
require_once("DatabaseConnection.php");
require_once("FunctionsController.php");

sec_session_start();
session_destroy();

$checkerNames = array("email","password");
# 0 = email
# 1 = password
checkPost($checkerNames);
checkEmail($_POST[$checkerNames[0]]);

$userHash = genHash($_POST[$checkerNames[0]],$_POST[$checkerNames[1]]);
$makeSess = mysqlSelect("select * from user_main
left join `user_types` on lum_user_type = user_type_id 
where lum_email = '".$_POST[$checkerNames[0]]."' and lum_hash =  '".$userHash."' and lum_valid = 1 
limit 1  ");
if(is_array($makeSess)){
	$uniqid = uniqid("IPPSESSID");
	loginMakeSession($makeSess[0]["lum_id"], $uniqid);
	
	$removeSess = mysqlInsertData("UPDATE `session_tracker` SET `sess_valid`=0 WHERE 
	sess_lum_id = ".$makeSess[0]["lum_id"], true);
	if(!is_numeric($removeSess)){
		die('-');
	}


	#disable previous sessions
	$insertSess = mysqlInsertData("INSERT INTO `session_tracker`(`sess_lum_id`, `sess_hash`, `sess_dnt`, `sess_ip`) VALUES (
	'".$makeSess[0]["lum_id"]."',
	'".$uniqid."',
	'".time()."',
	'".$_SERVER['REMOTE_ADDR']."'
	)", true);
	if(!is_numeric($insertSess)){
		die('-');
	}
	
	
	
	die($makeSess[0]["user_type_landing"]);
}else{
	die("-");
}



?>	