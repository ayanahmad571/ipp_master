<?php 

require_once("SessionHandler.php");

if(isset($_POST['client_code']) && isset($_POST['client_name'])){
	$CC = $_POST['client_code']; 
	$CN = $_POST['client_name'];
	
	$checkExists = mysqlSelect("select * from clients_main where client_code = '".$CC."' ");
	
	if(!is_array($checkExists)){
		$insSQL = mysqlInsertData("INSERT INTO `clients_main`(`client_code`, `client_name`, `client_dnt`, `client_lum_id`) VALUES (
		'".$CC."',
		'".$CN."',
		'".time()."',
		'".$USER_ARRAY['lum_id']."')",true);
		if(is_numeric($insSQL)){
			
logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." added a new Client with CODE: ".$_POST['client_code'], 
		"mysqlInsertData");


			die("ok");
		}else{
			die("Internal Server Error , 503 : Client Insert Error");
		}
	}else{
		die("Client Code Already Exists");
	}
}

if(isset($_POST['unit_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_qty_units`(`unit_value`, `unit_show`) VALUES (
    '".$_POST['unit_value']."',
    '1')",true);
    if(is_numeric($insSQL)){

      die("ok");
    }else{
      die("Internal Server Error , 503 : Qty Units Insert Error");
    }
}

if(isset($_POST['application_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_applications`(`application_value`, `application_show`) VALUES (
    '".$_POST['application_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Application Insert Error");
    }
}

if(isset($_POST['material_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `materials_main`(`material_value`, `material_show`) VALUES (
    '".$_POST['material_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Material Insert Error");
    }
}

if(isset($_POST['wind_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_wind_dir`(`wind_value`, `wind_show`) VALUES (
    '".$_POST['wind_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Winding Direction Insert Error");
    }
}

if(isset($_POST['structure_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_structure`(`structure_value`, `structure_show`) VALUES (
    '".$_POST['structure_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Product Type Insert Error");
    }
}

if(isset($_POST['bag_handle_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_bag_handle`(`bag_handle_value`, `bag_handle_show`) VALUES (
    '".$_POST['bag_handle_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Bag Handle Type Insert Error");
    }
}

if(isset($_POST['bag_punch_opts_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_bag_punch_opts`(`bag_punch_opts_value`, `bag_punch_opts_show`) VALUES (
    '".$_POST['bag_punch_opts_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Bag Punch Options Insert Error");
    }
}

if(isset($_POST['bag_sealing_opts_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_bag_sealing_opts`(`bag_sealing_opts_value`, `bag_sealing_opts_show`) VALUES (
    '".$_POST['bag_sealing_opts_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Bag Sealing Options Insert Error");
    }
}

if(isset($_POST['bag_vest_handle_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_bag_vest_handle`(`bag_vest_handle_value`, `bag_vest_handle_show`) VALUES (
    '".$_POST['bag_vest_handle_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Bag Vest Handle Type Insert Error");
    }
}

if(isset($_POST['anti_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_ext_antistatic`(`anti_value`, `anti_show`) VALUES (
    '".$_POST['anti_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Extrusion Antistatic Insert Error");
    }
}

if(isset($_POST['cof_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_ext_cof`(`cof_value`, `cof_show`) VALUES (
    '".$_POST['cof_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Extrusion COF Insert Error");
    }
}

if(isset($_POST['extrude_in_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_ext_extrude_in`(`extrude_in_value`, `extrude_in_show`) VALUES (

    '".$_POST['extrude_in_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Extrusion Extrude In Insert Error");
    }
}

if(isset($_POST['layer_type_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_ext_layer_type`(`layer_type_value`, `layer_type_show`) VALUES (
    '".$_POST['layer_type_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Extrusion Layer Type Insert Error");
    }
}

if(isset($_POST['ext_options_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_ext_options`(`ext_options_value`, `ext_options_show`) VALUES (
    '".$_POST['ext_options_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Extrusion Options Insert Error");
    }
}

if(isset($_POST['treat_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_ext_treatment`(`treat_value`, `treat_show`) VALUES (
    '".$_POST['treat_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Extrusion Treatment Insert Error");
    }
}

if(isset($_POST['lam_end_options_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_lam_end_options`(`lam_end_options_value`, `lam_end_options_show`) VALUES (
    '".$_POST['lam_end_options_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Lamination End Options Insert Error");
    }
}

if(isset($_POST['pouch_closure_type_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_closure_type`(`pouch_closure_type_value`, `pouch_closure_type_show`) VALUES (
    '".$_POST['pouch_closure_type_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Closure Type Insert Error");
    }
}

if(isset($_POST['pouch_euro_punch_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_euro_punch`(`pouch_euro_punch_value`, `pouch_euro_punch_show`) VALUES (
    '".$_POST['pouch_euro_punch_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Euro Punch Insert Error");
    }
}

if(isset($_POST['pouch_open_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_pouch_open`(`pouch_open_value`, `pouch_open_show`) VALUES (
    '".$_POST['pouch_open_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Opening Insert Error");
    }
}

if(isset($_POST['pouch_pouch_type_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_pouch_type`(`pouch_pouch_type_value`, `pouch_pouch_type_show`) VALUES (
    '".$_POST['pouch_pouch_type_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Type Insert Error");
    }
}

if(isset($_POST['pouch_seal_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_seal`(`pouch_seal_value`, `pouch_seal_show`) VALUES (
    '".$_POST['pouch_seal_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Seal Insert Error");
    }
}

if(isset($_POST['pouch_sealing_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_sealing`(`pouch_sealing_value`, `pouch_sealing_show`) VALUES (
    '".$_POST['pouch_sealing_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Sealing Insert Error");
    }
}

if(isset($_POST['pouch_seal_type_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_seal_type`(`pouch_seal_type_value`, `pouch_seal_type_show`) VALUES (
    '".$_POST['pouch_seal_type_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Seal Type Insert Error");
    }
}

if(isset($_POST['pouch_type_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_type`(`pouch_type_value`, `pouch_type_show`) VALUES (
    '".$_POST['pouch_type_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Type2 Insert Error");
    }
}

if(isset($_POST['print_end_options_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_print_end_options`(`print_end_options_value`, `print_end_options_show`) VALUES (
    '".$_POST['print_end_options_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Printing End Options Insert Error");
    }
}

if(isset($_POST['eyemark_da_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_print_eyemark_da`(`eyemark_da_value`, `eyemark_da_show`) VALUES (
    '".$_POST['eyemark_da_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Printing Eyemark Da Insert Error");
    }
}

if(isset($_POST['print_options_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_print_options`(`print_options_value`, `print_options_show`) VALUES (
    '".$_POST['print_options_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Printing Options Insert Error");
    }
}

if(isset($_POST['shadecardreq_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_print_shadecardreq`(`shadecardreq_value`, `shadecardreq_show`) VALUES (
    '".$_POST['shadecardreq_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Printing Shadecard Insert Error");
    }
}

if(isset($_POST['shadecard_ref_type_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_print_shadecard_ref_type`(`shadecard_ref_type_value`, `shadecard_ref_type_show`) VALUES (
    '".$_POST['shadecard_ref_type_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Printing Shadecard Ref Insert Error");
    }
}

if(isset($_POST['surfrev_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_print_surfrev`(`surfrev_value`, `surfrev_show`) VALUES (
    '".$_POST['surfrev_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Printing SurfRev Insert Error");
    }
}

if(isset($_POST['tubesheet_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_print_tubesheet`(`tubesheet_value`, `tubesheet_show`) VALUES (
    '".$_POST['tubesheet_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Printing TubeSheet Insert Error");
    }
}

if(isset($_POST['print_type_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_print_type`(`print_type_value`, `print_type_show`) VALUES (
    '".$_POST['print_type_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Printing Type Insert Error");
    }
}

if(isset($_POST['slitting_customer_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_slitting_customer`(`slitting_customer_value`, `slitting_customer_show`) VALUES (
    '".$_POST['slitting_customer_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Slitting Customer Insert Error");
    }
}

if(isset($_POST['slitting_packing_opts_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_slitting_packing_opts`(`slitting_packing_opts_value`, `slitting_packing_opts_show`) VALUES (
    '".$_POST['slitting_packing_opts_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Slitting Packing Opts Insert Error");
    }
}

if(isset($_POST['slitting_pallet_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_slitting_pallet`(`slitting_pallet_value`, `slitting_pallet_show`) VALUES (
    '".$_POST['slitting_pallet_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Slitting Pallet Insert Error");
    }
}

if(isset($_POST['slitting_qc_ins_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_slitting_qc_ins`(`slitting_qc_ins_value`, `slitting_qc_ins_show`) VALUES (
    '".$_POST['slitting_qc_ins_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Slitting Qc Ins Insert Error");
    }
}

if(isset($_POST['slitting_sticker_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_slitting_sticker`(`slitting_sticker_value`, `slitting_sticker_show`) VALUES (
    '".$_POST['slitting_sticker_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Slitting Sticker Insert Error");
    }
}

if(isset($_POST['slitting_sticker_opts_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_slitting_sticker_opts`(`slitting_sticker_opts_value`, `slitting_sticker_opts_show`) VALUES (
    '".$_POST['slitting_sticker_opts_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Slitting Sticker Opts Insert Error");
    }
}

if(isset($_POST['slitting_5ply_packing_options_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_slitting_5ply_packing_options`(`slitting_5ply_packing_options_value`, `slitting_5ply_packing_options_show`) VALUES (
    '".$_POST['slitting_5ply_packing_options_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Slitting 5ply Packing Options Insert Error");
    }
}

if(isset($_POST['slitting_core_id_length_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_slitting_core_id_length`(`slitting_core_id_length_value`, `slitting_core_id_length_show`) VALUES (
    '".$_POST['slitting_core_id_length_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Slitting Core Id Length Insert Error");
    }
}

if(isset($_POST['slitting_core_id_type_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_slitting_core_id_type`(`slitting_core_id_type_value`, `slitting_core_id_type_show`) VALUES (
    '".$_POST['slitting_core_id_type_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Slitting Code Id Type Insert Error");
    }
}
/*
	Show Hide		
 */


if(isset($_POST['unit_toggle'])){
    $hash = $_POST['unit_toggle'];
    
    if(!is_numeric($hash)){
        die("Qty Units , Invalid Parameter Passed");
    }
    $t = 'work_order_qty_units';
    $pr = 'unit';
    $h = 'Qty Units';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
			
logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['application_toggle'])){
    $hash = $_POST['application_toggle'];
    
    if(!is_numeric($hash)){
        die("Application , Invalid Parameter Passed");
    }
    $t = 'work_order_applications';
    $pr = 'application';
    $h = 'Application';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['material_toggle'])){
    $hash = $_POST['material_toggle'];
    
    if(!is_numeric($hash)){
        die("Material , Invalid Parameter Passed");
    }
    $t = 'materials_main';
    $pr = 'material';
    $h = 'Material';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['wind_toggle'])){
    $hash = $_POST['wind_toggle'];
    
    if(!is_numeric($hash)){
        die("Winding Direction , Invalid Parameter Passed");
    }
    $t = 'work_order_wind_dir';
    $pr = 'wind';
    $h = 'Winding Direction';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['structure_toggle'])){
    $hash = $_POST['structure_toggle'];
    
    if(!is_numeric($hash)){
        die("Product Type , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_structure';
    $pr = 'structure';
    $h = 'Product Type';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['bag_handle_toggle'])){
    $hash = $_POST['bag_handle_toggle'];
    
    if(!is_numeric($hash)){
        die("Bag Handle Type , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_bag_handle';
    $pr = 'bag_handle';
    $h = 'Bag Handle Type';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['bag_punch_opts_toggle'])){
    $hash = $_POST['bag_punch_opts_toggle'];
    
    if(!is_numeric($hash)){
        die("Bag Punch Options , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_bag_punch_opts';
    $pr = 'bag_punch_opts';
    $h = 'Bag Punch Options';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['bag_sealing_opts_toggle'])){
    $hash = $_POST['bag_sealing_opts_toggle'];
    
    if(!is_numeric($hash)){
        die("Bag Sealing Options , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_bag_sealing_opts';
    $pr = 'bag_sealing_opts';
    $h = 'Bag Sealing Options';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['bag_vest_handle_toggle'])){
    $hash = $_POST['bag_vest_handle_toggle'];
    
    if(!is_numeric($hash)){
        die("Bag Vest Handle Type , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_bag_vest_handle';
    $pr = 'bag_vest_handle';
    $h = 'Bag Vest Handle Type';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['anti_toggle'])){
    $hash = $_POST['anti_toggle'];
    
    if(!is_numeric($hash)){
        die("Extrusion Antistatic , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_ext_antistatic';
    $pr = 'anti';
    $h = 'Extrusion Antistatic';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['cof_toggle'])){
    $hash = $_POST['cof_toggle'];
    
    if(!is_numeric($hash)){
        die("Extrusion COF , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_ext_cof';
    $pr = 'cof';
    $h = 'Extrusion COF';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['extrude_in_toggle'])){
    $hash = $_POST['extrude_in_toggle'];
    
    if(!is_numeric($hash)){
        die("Extrusion Extrude In , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_ext_extrude_in';
    $pr = 'extrude_in';
    $h = 'Extrusion Extrude In';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['layer_type_toggle'])){
    $hash = $_POST['layer_type_toggle'];
    
    if(!is_numeric($hash)){
        die("Extrusion Layer Type , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_ext_layer_type';
    $pr = 'layer_type';
    $h = 'Extrusion Layer Type';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['ext_options_toggle'])){
    $hash = $_POST['ext_options_toggle'];
    
    if(!is_numeric($hash)){
        die("Extrusion Options , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_ext_options';
    $pr = 'ext_options';
    $h = 'Extrusion Options';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['treat_toggle'])){
    $hash = $_POST['treat_toggle'];
    
    if(!is_numeric($hash)){
        die("Extrusion Treatment , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_ext_treatment';
    $pr = 'treat';
    $h = 'Extrusion Treatment';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['lam_end_options_toggle'])){
    $hash = $_POST['lam_end_options_toggle'];
    
    if(!is_numeric($hash)){
        die("Lamination End Options , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_lam_end_options';
    $pr = 'lam_end_options';
    $h = 'Lamination End Options';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['pouch_closure_type_toggle'])){
    $hash = $_POST['pouch_closure_type_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Closure Type , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_closure_type';
    $pr = 'pouch_closure_type';
    $h = 'Pouch Closure Type';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['pouch_euro_punch_toggle'])){
    $hash = $_POST['pouch_euro_punch_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Euro Punch , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_euro_punch';
    $pr = 'pouch_euro_punch';
    $h = 'Pouch Euro Punch';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['pouch_open_toggle'])){
    $hash = $_POST['pouch_open_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Opening , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_pouch_open';
    $pr = 'pouch_open';
    $h = 'Pouch Opening';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['pouch_pouch_type_toggle'])){
    $hash = $_POST['pouch_pouch_type_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Type , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_pouch_type';
    $pr = 'pouch_pouch_type';
    $h = 'Pouch Type';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['pouch_seal_toggle'])){
    $hash = $_POST['pouch_seal_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Seal , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_seal';
    $pr = 'pouch_seal';
    $h = 'Pouch Seal';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['pouch_sealing_toggle'])){
    $hash = $_POST['pouch_sealing_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Sealing , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_sealing';
    $pr = 'pouch_sealing';
    $h = 'Pouch Sealing';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['pouch_seal_type_toggle'])){
    $hash = $_POST['pouch_seal_type_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Seal Type , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_seal_type';
    $pr = 'pouch_seal_type';
    $h = 'Pouch Seal Type';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['pouch_type_toggle'])){
    $hash = $_POST['pouch_type_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Type2 , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_type';
    $pr = 'pouch_type';
    $h = 'Pouch Type2';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['print_end_options_toggle'])){
    $hash = $_POST['print_end_options_toggle'];
    
    if(!is_numeric($hash)){
        die("Printing End Options , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_print_end_options';
    $pr = 'print_end_options';
    $h = 'Printing End Options';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['eyemark_da_toggle'])){
    $hash = $_POST['eyemark_da_toggle'];
    
    if(!is_numeric($hash)){
        die("Printing Eyemark Da , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_print_eyemark_da';
    $pr = 'eyemark_da';
    $h = 'Printing Eyemark Da';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['print_options_toggle'])){
    $hash = $_POST['print_options_toggle'];
    
    if(!is_numeric($hash)){
        die("Printing Options , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_print_options';
    $pr = 'print_options';
    $h = 'Printing Options';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['shadecardreq_toggle'])){
    $hash = $_POST['shadecardreq_toggle'];
    
    if(!is_numeric($hash)){
        die("Printing Shadecard , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_print_shadecardreq';
    $pr = 'shadecardreq';
    $h = 'Printing Shadecard';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['shadecard_ref_type_toggle'])){
    $hash = $_POST['shadecard_ref_type_toggle'];
    
    if(!is_numeric($hash)){
        die("Printing Shadecard Ref , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_print_shadecard_ref_type';
    $pr = 'shadecard_ref_type';
    $h = 'Printing Shadecard Ref';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['surfrev_toggle'])){
    $hash = $_POST['surfrev_toggle'];
    
    if(!is_numeric($hash)){
        die("Printing SurfRev , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_print_surfrev';
    $pr = 'surfrev';
    $h = 'Printing SurfRev';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['tubesheet_toggle'])){
    $hash = $_POST['tubesheet_toggle'];
    
    if(!is_numeric($hash)){
        die("Printing TubeSheet , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_print_tubesheet';
    $pr = 'tubesheet';
    $h = 'Printing TubeSheet';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['print_type_toggle'])){
    $hash = $_POST['print_type_toggle'];
    
    if(!is_numeric($hash)){
        die("Printing Type , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_print_type';
    $pr = 'print_type';
    $h = 'Printing Type';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['slitting_customer_toggle'])){
    $hash = $_POST['slitting_customer_toggle'];
    
    if(!is_numeric($hash)){
        die("Slitting Customer , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_slitting_customer';
    $pr = 'slitting_customer';
    $h = 'Slitting Customer';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['slitting_packing_opts_toggle'])){
    $hash = $_POST['slitting_packing_opts_toggle'];
    
    if(!is_numeric($hash)){
        die("Slitting Packing Opts , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_slitting_packing_opts';
    $pr = 'slitting_packing_opts';
    $h = 'Slitting Packing Opts';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['slitting_pallet_toggle'])){
    $hash = $_POST['slitting_pallet_toggle'];
    
    if(!is_numeric($hash)){
        die("Slitting Pallet , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_slitting_pallet';
    $pr = 'slitting_pallet';
    $h = 'Slitting Pallet';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['slitting_qc_ins_toggle'])){
    $hash = $_POST['slitting_qc_ins_toggle'];
    
    if(!is_numeric($hash)){
        die("Slitting Qc Ins , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_slitting_qc_ins';
    $pr = 'slitting_qc_ins';
    $h = 'Slitting Qc Ins';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['slitting_sticker_toggle'])){
    $hash = $_POST['slitting_sticker_toggle'];
    
    if(!is_numeric($hash)){
        die("Slitting Sticker , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_slitting_sticker';
    $pr = 'slitting_sticker';
    $h = 'Slitting Sticker';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['slitting_sticker_opts_toggle'])){
    $hash = $_POST['slitting_sticker_opts_toggle'];
    
    if(!is_numeric($hash)){
        die("Slitting Sticker Opts , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_slitting_sticker_opts';
    $pr = 'slitting_sticker_opts';
    $h = 'Slitting Sticker Opts';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['slitting_5ply_packing_options_toggle'])){
    $hash = $_POST['slitting_5ply_packing_options_toggle'];
    
    if(!is_numeric($hash)){
        die("Slitting 5ply Packing Options , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_slitting_5ply_packing_options';
    $pr = 'slitting_5ply_packing_options';
    $h = 'Slitting 5ply Packing Options';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['slitting_core_id_length_toggle'])){
    $hash = $_POST['slitting_core_id_length_toggle'];
    
    if(!is_numeric($hash)){
        die("Slitting Core Id Length , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_slitting_core_id_length';
    $pr = 'slitting_core_id_length';
    $h = 'Slitting Core Id Length';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['slitting_core_id_type_toggle'])){
    $hash = $_POST['slitting_core_id_type_toggle'];
    
    if(!is_numeric($hash)){
        die("Slitting Code Id Type , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_slitting_core_id_type';
    $pr = 'slitting_core_id_type';
    $h = 'Slitting Code Id Type';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." trigged toggle on table ".$t." for ID : ".$updtSql, 
		"mysqlInsertData");


            echo 'ok';

        }
        
    }else{
        die($h." , Value not found");
    }
    
}





#40
?>
<?php
/*

foreach($arrayHolder as $infopiece){
	?>
    
if(isset($_POST['<?php echo $infopiece[2] ?>_toggle'])){<br>
&nbsp;&nbsp;&nbsp;&nbsp;$hash = $_POST['<?php echo $infopiece[2] ?>_toggle'];<br>
&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;if(!is_numeric($hash)){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;die("<?php echo $infopiece[0] ?> , Invalid Parameter Passed");<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;&nbsp;&nbsp;$t = '<?php echo $infopiece[1] ?>';<br>
&nbsp;&nbsp;&nbsp;&nbsp;$pr = '<?php echo $infopiece[2] ?>';<br>
&nbsp;&nbsp;&nbsp;&nbsp;$h = '<?php echo $infopiece[0] ?>';<br>
&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;$checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);<br>
&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;if(is_array($checker)){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(!is_numeric($updtSql)){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;die("503, Could not Not Update ".$h);<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}else{<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo 'ok';<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;}else{<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;die($h." , Value not found");<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;&nbsp;&nbsp;<br>
}<br><br>
    <?php
}
*/
/*
foreach($arrayHolder as $infopiece){
	?>
    if(isset($_POST['<?php echo $infopiece[2] ?>_toggle'])){<br>
        &nbsp;&nbsp;&nbsp;&nbsp;$insSQL = mysqlInsertData("INSERT INTO `<?php echo $infopiece[1] ?>`(`<?php echo $infopiece[2] ?>_value`, `<?php echo $infopiece[2] ?>_show`) VALUES (<br>
		&nbsp;&nbsp;&nbsp;&nbsp;'".$_POST['<?php echo $infopiece[2] ?>_value']."',<br>
		&nbsp;&nbsp;&nbsp;&nbsp;'1')",true);<br>
		&nbsp;&nbsp;&nbsp;&nbsp;if(is_numeric($insSQL)){<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;die("ok");<br>
		&nbsp;&nbsp;&nbsp;&nbsp;}else{<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;die("Internal Server Error , 503 : <?php echo $infopiece[0] ?> Insert Error");<br>
		&nbsp;&nbsp;&nbsp;&nbsp;}<br>
    }<br><br>
    <?php
}
*/

?>