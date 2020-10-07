<?php
require_once("SessionHandler.php");
	 if(isset($_POST['user_add_name']) && isset($_POST['user_add_email']) && isset($_POST['user_add_type']) && isset($_POST['user_add_code']) && isset($_POST['user_add_pw'])){
		 if(!is_numeric($_POST['user_add_type'])){
			 die("User Type Format Invalid");
		 }
		 
		$checkUserType = mysqlSelect("SELECT * FROM `user_types` 
		where user_type_id not in (1,2,3)
		and user_type_id = ".$_POST['user_add_type']."
		order by user_type_name");
		
		if(!is_array($checkUserType)){
			die("User Type INVALID");
		}
		
		$checkEmail = mysqlSelect("select * from user_main where lum_email = '".$_POST['user_add_email']."'");
		if(is_array($checkEmail)){
			die("Email already Exists");
		}
		
		$makeHash = genHash($_POST['user_add_email'], $_POST['user_add_pw']);
		
		$insertADD = mysqlInsertData("INSERT INTO `user_main`(`lum_user_type`, `lum_code`, `lum_email`, `lum_hash`, `lum_name`, `lum_dnt`) VALUES (
		".$_POST['user_add_type'].",
		'".$_POST['user_add_code']."',
		'".$_POST['user_add_email']."',
		'".$makeHash."',
		'".$_POST['user_add_name']."',
		'".time()."'
		)",true);
		if(!is_numeric($insertADD)){
			die("INTERNAL SERVER ERROR FAILED TO ADD");
		}
		
logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		"User : ".$_POST['user_add_code']." has been added by ".$USER_ARRAY['lum_code'], 
		"mysqlInsertData");


		die("ok");
	 }
###
	if(isset($_POST['admin_deactivate_user']) && isset($_POST['admin_deactivate_reason'])){
		if(!is_numeric($_POST['admin_deactivate_user'])){
			die("Invalid User Format");
		}
		
		$checkUser = mysqlSelect("
		SELECT * FROM `user_main` 
		left join user_types on lum_user_type = user_type_id 
		where lum_user_type not in(1,2,3)
		and lum_id = ".$_POST['admin_deactivate_user']."
		order by lum_name asc
		");
		
		if(!is_array($checkUser)){
			die("Invalid User Format");
		}
		
		$insertADD = mysqlUpdateData("UPDATE `user_main` SET `lum_deact`='".$_POST['admin_deactivate_reason']."',`lum_valid`=0 WHERE `lum_id`=".$checkUser[0]['lum_id'],true);
		if(!is_numeric($insertADD)){
			die("INTERNAL SERVER ERROR FAILED TO Deactivate");
		}

logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		"User : ".$checkUser[0]['lum_code']." has been de-activated by ".$USER_ARRAY['lum_code'], 
		"mysqlInsertData");

		
		die("ok");
	}
###
	if(isset($_POST['admin_new_password_user']) && isset($_POST['admin_new_password_text'])){
		if(!is_numeric($_POST['admin_new_password_user'])){
			die("Invalid User Format");
		}
		
		if($_POST['admin_new_password_text'] == ""){
			die("Invalid Password (Blank)");
		}
		
		$checkUser = mysqlSelect("
		SELECT * FROM `user_main` 
		left join user_types on lum_user_type = user_type_id 
		where lum_user_type not in(1,2,3)
		and lum_id = ".$_POST['admin_new_password_user']."
		order by lum_name asc
		");
		
		if(!is_array($checkUser)){
			die("Invalid User Format");
		}
		$makeHash = genHash($checkUser[0]['lum_email'], $_POST['admin_new_password_text']);
		
		
		$insertADD = mysqlUpdateData("UPDATE `user_main` SET `lum_hash`='".$makeHash."' WHERE `lum_id`=".$checkUser[0]['lum_id'],true);
		if(!is_numeric($insertADD)){
			die("INTERNAL SERVER ERROR FAILED TO Change Password");
		}
logInsert(basename($_SERVER['PHP_SELF']), $_SESSION[SESSION_HASH_NAME], $USER_ARRAY['lum_id'], $_SERVER['REMOTE_ADDR'], "Password for User : ".$checkUser[0]['lum_code']." has been reset by ".$USER_ARRAY['lum_code'], "mysqlInsertData");
		die("ok");
	}

 ?>
