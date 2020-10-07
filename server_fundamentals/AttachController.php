<?php
require_once("SessionHandler.php");


if(isset($_POST['remove_attach'])){
	if(!is_numeric($_POST['remove_attach'])){
		die("Invalid Attach Id");
	}
	
	
			$getDrafts = mysqlSelect("SELECT * FROM `user_sales_attach` 
		left join user_main on  attach_parent_lum= lum_id
		where attach_id = ".$_POST['remove_attach']." and attach_valid =1 and attach_child_lum= ".$USER_ARRAY['lum_id']);
		
		if(!is_array($getDrafts)){
			die("No Authorizations found");
		}
		
		$updt= mysqlUpdateData("UPDATE `user_sales_attach` SET `attach_valid`= 0  WHERE `attach_id`=".$_POST['remove_attach'],true);
		if(is_numeric($updt)){
			
logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." de-authrozied ".$getDrafts[0]['lum_code']." for using their sales Code", 
		"mysqlInsertData");


			die("ok");
		}
}
if(isset($_POST['sales_attach'])){
	$sa = $_POST['sales_attach'];
	if(!is_numeric($sa)){
		die("Invalid User ID");
	}
	
		$checkCurrentAttachs = mysqlSelect("SELECT * FROM `user_sales_attach` 
		left join user_main on  attach_parent_lum= lum_id
		where attach_valid =1 and attach_child_lum= ".$USER_ARRAY['lum_id']);
		
		if(is_array($checkCurrentAttachs)){
			die("You have already Authorized sales code permissions to ".$checkCurrentAttachs[0]['lum_code']);
		}

					if($USER_ARRAY['lum_user_type'] ==4){
					//Sales Manager -TOP
					$inCols = "16,10";
				}else if($USER_ARRAY['lum_user_type'] == 16){
					//Assistant , middle
					$inCols = "10";
				}else if($USER_ARRAY['lum_user_type'] == 2){
					//Assistant , middle
					$inCols = "4,10,16";
				}else{
					//Anyone Else (Coord)
					$inCols = "NULL";
				}
				
                 $getAttachees= mysqlSelect("SELECT * FROM `user_main`
				 where lum_valid=1 and lum_user_type in(".$inCols.")
				 and lum_id = ".$sa."
                 order by lum_name asc");
                 if(!is_array($getAttachees)){
					 die("Invalid User");
				 }
				 
				 $inssql = mysqlInsertData("INSERT INTO `user_sales_attach`
				 (`attach_parent_lum`, `attach_child_lum`, `attach_dnt`) VALUES (
				 ".$sa.",
				 ".$USER_ARRAY['lum_id'].",
				 ".time()."
				 )",true);
				 if(is_numeric($inssql)){
					 
logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		"User: ".$USER_ARRAY['lum_code']." has authorized USER_ID : ".$sa." to use their code ", 
		"mysqlInsertData");


					die("ok"); 
				 }else{
					 die("Internal Server Error");
				 }
				 
				 
}
?>