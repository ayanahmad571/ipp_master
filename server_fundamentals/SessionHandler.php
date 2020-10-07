<?php
require_once("Settings.php");
require_once("CookieController.php");
require_once("DatabaseConnection.php");
require_once("FunctionsController.php");

sec_session_start();
/* 
	1. check if logged in , then make the user array
	2. check if the session is valid with the database
	3. check if user is allowed to see this page.
	
*/
#Check is the user has logged in or no.

		if(isset($_SESSION[SESSION_CONTROLLER_NAME]) && isset($_SESSION[SESSION_HASH_NAME])){
			if(is_numeric($_SESSION[SESSION_CONTROLLER_NAME]) and ctype_alnum($_SESSION[SESSION_HASH_NAME])){
				$resp = mysqlSelect("SELECT * FROM `user_main` l
				left join user_types g on l.lum_user_type = g.user_type_id
				where 
				g.user_type_id is not null and l.lum_valid =1 and l.lum_id = ".$_SESSION[SESSION_CONTROLLER_NAME]);
				if(!is_array($resp)){
					die("(Account Not Found <a href='logout.php'><button>Re-login</button></a>)");
				}
				$USER_ARRAY = $resp[0];
			}
		}else{
			header("Location: logout");
			die();
		}

	#Check if the users session is valid
	$getUserSession = mysqlSelect('SELECT * FROM `session_tracker` where sess_valid =1 and sess_lum_id = "'.$_SESSION[SESSION_CONTROLLER_NAME].'" and sess_hash = "'.$_SESSION[SESSION_HASH_NAME].'"');
	if(!is_array($getUserSession)){
		header('Location: logout');
		die("(Account has been logged out, please re-login )");
	}



/*
	Here after can only be accessed if logged in.
*/

#Check if the user is allowed to see this page.

$ids_header = $USER_ARRAY['user_type_mod_id'];
	$si_header = "in (".$ids_header.")";
	if(trim($ids_header) == "*"){
	$si_header = "not in (0)";
	}

$pageViewChecker = mysqlSelect("SELECT * FROM `modules_main` m 
left join modules_groups g on m.mod_mg_id = g.mg_id 
WHERE mod_id ".$si_header."
and mod_valid =1 
and mod_href = '".trim(pathinfo(basename($_SERVER['PHP_SELF']), PATHINFO_FILENAME))."'");
if(!is_array($pageViewChecker)){
	header('Location: home');
	die("Access Denied");
}

$getAttachedTreeSql = "select * from user_main where lum_user_type in (2,4,10,16)";
/*
$getAttachedTreeSql = "SELECT * FROM `user_sales_attach` 
		left join user_main on attach_child_lum = lum_id
		where attach_valid =1 and attach_parent_lum= ".$USER_ARRAY['lum_id']."
		
		union
		
		SELECT * FROM `user_sales_attach` 
		left join user_main on attach_child_lum = lum_id
		where attach_valid =1 and attach_parent_lum in(
			SELECT lum_id FROM `user_sales_attach` 
			left join user_main on attach_child_lum = lum_id
			where attach_valid =1 and attach_parent_lum= ".$USER_ARRAY['lum_id'].") ";

				if($USER_ARRAY['lum_user_type'] == 16){
					//Assistant , middle
					$inColsWO = "and (mwo_gen_lum_id = ".$USER_ARRAY['lum_id']."  or mwo_gen_on_behalf_lum_id = ".$USER_ARRAY['lum_id'].")";
					$inColsDRAFT = "and (s_wo_gen_lum_id = ".$USER_ARRAY['lum_id']."  or s_wo_lum_id = ".$USER_ARRAY['lum_id'].")";					
				}else if($USER_ARRAY['lum_user_type'] == 10){
					//Sales Coord 
					$inColsWO = "and mwo_gen_lum_id = ".$USER_ARRAY['lum_id'];
					$inColsDRAFT = "and s_wo_gen_lum_id = ".$USER_ARRAY['lum_id'];					
				}else{
					//Anyone Else ()
					$inColsWO = "";
					$inColsDRAFT = "";					
				}
*/
					$inColsWO = "";
					$inColsDRAFT = "";					

logInsert(basename($_SERVER['PHP_SELF']), $_SESSION[SESSION_HASH_NAME], $USER_ARRAY['lum_id'], $_SERVER['REMOTE_ADDR'], "This login protected page has been accessed", "mysqlInsertData");
?>