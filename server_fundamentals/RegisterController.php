<?php
require_once("Settings.php");
require_once("CookieController.php");
require_once("DatabaseConnection.php");
require_once("FunctionsController.php");

sec_session_start();
session_destroy();

$checkerNames = array("user_name","user_code","email","password","password2","user_type","agree");
//                        0           1          2         3         4           5          6
# 0 = email
# 1 = password
checkPost($checkerNames);
checkEmail($_POST[$checkerNames[2]]);


$err= "";
if($_POST[$checkerNames[3]] != $_POST[$checkerNames[4]]){
	$err .= "<br>Passwords Do not Match";
}


if($_POST[$checkerNames[6]] != 1){
	$err .= "<br>Please Accept Terms and Conditions";
}

if(!is_numeric($_POST[$checkerNames[5]])){
	$err .="<br> Please select a valid User Type";
}else{
	if(!is_array(mysqlSelect("SELECT * FROM `user_types` where user_type_id = '".$_POST[$checkerNames[5]]."'"))){
		//active or temp inactive 
		$err .= ('<br>Invalid User Type Selected.');
	}
}


if(is_array(mysqlSelect("select * from user_main where lum_email = '".$_POST[$checkerNames[2]]."' and ((lum_valid = 1) or (lum_valid = 0))"))){
	//active or temp inactive 
	$err .= ('<br>An Account with the same email already exists.');
}
if(!empty($err)){
	die($err);
}


$userHash = genHash($_POST[$checkerNames[2]],$_POST[$checkerNames[3]]);

	// Separate string by @ characters (there should be only one)
#    $parts = explode('@', $_POST[$checkerNames[2]]);

    // Remove and return the last part, which should be the domain
#    $domain = array_pop($parts);

	//EMAIL VERIFICATION LINK

#	$toSendHash = uniqid().md5(sha1("2ijoqfwee09u8h2bifwdeijvoiug2nqea-****/..,").time().microtime()).rand(1,5000);

$inssql = "
insert into `users_pending` ( `pending_name`, `pending_code`, `pending_email`,
 `pending_hash`, `pending_type`, `pending_dnt`)
 VALUES 
	(
	'".$_POST[$checkerNames[0]]."',
	'".$_POST[$checkerNames[1]]."',
	'".$_POST[$checkerNames[2]]."',
	'".$userHash."', 
	'".$_POST[$checkerNames[5]]."',
	'".time()."'

	 )";
$insertData = mysqlInsertData($inssql,true);
if(!is_numeric($insertData)){
	die($insertData);
}

	die("ok");

	//EMAIL VERIFICATION LINK
	
	//email
/*
$url = SESSION_BASE_URL."verify?id=".$toSendHash;

if(emailSend($_POST[$checkerNames[2]], $_POST[$checkerNames[2]], "Email Verification for Qista", "Verify ur email for ".$_POST[$checkerNames[5]]." at <a href='".$url."'>Click Here...</a>",$url)){
	die("ok");
}else{
	die("Email Not Sent");
}
*/	
	//email




?>