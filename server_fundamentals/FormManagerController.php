<?php 

require_once("SessionHandler.php");


if(isset($_POST['application_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_applications`(`application_value`, `application_show`) VALUES (
    '".$_POST['application_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Work Order Applications Insert Error");
    }
}

if(isset($_POST['psu_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_pack_size_unit`(`psu_value`, `psu_show`) VALUES (
    '".$_POST['psu_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Work Order Pack Size Unit Insert Error");
    }
}

if(isset($_POST['ptp_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_product_type_printed`(`ptp_value`, `ptp_show`) VALUES (
    '".$_POST['ptp_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Work Order Product Type Printed Insert Error");
    }
}

if(isset($_POST['unit_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_qty_units`(`unit_value`, `unit_show`) VALUES (
    '".$_POST['unit_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Work Order Qty Units Insert Error");
    }
}

if(isset($_POST['bag_handle_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_bag_handle`(`bag_handle_value`, `bag_handle_show`) VALUES (
    '".$_POST['bag_handle_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Bag Handle Insert Error");
    }
}

if(isset($_POST['customer_location_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_customer_location`(`customer_location_value`, `customer_location_show`) VALUES (
    '".$_POST['customer_location_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Customer Location Insert Error");
    }
}

if(isset($_POST['cof_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_ext_cof`(`cof_value`, `cof_show`) VALUES (
    '".$_POST['cof_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Ext Cof Insert Error");
    }
}

if(isset($_POST['filling_temp_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_filling_temp`(`filling_temp_value`, `filling_temp_show`) VALUES (
    '".$_POST['filling_temp_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Filling Temp Insert Error");
    }
}

if(isset($_POST['foil_print_side_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_foil_print_side`(`foil_print_side_value`, `foil_print_side_show`) VALUES (
    '".$_POST['foil_print_side_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Foil Print Side Insert Error");
    }
}

if(isset($_POST['lamo_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_lam_options`(`lamo_value`, `lamo_show`) VALUES (
    '".$_POST['lamo_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Lam Options Insert Error");
    }
}

if(isset($_POST['pallet_size_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pallet_size`(`pallet_size_value`, `pallet_size_show`) VALUES (
    '".$_POST['pallet_size_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pallet Size Insert Error");
    }
}

if(isset($_POST['pe_film_feature_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pe_film_feature`(`pe_film_feature_value`, `pe_film_feature_show`) VALUES (
    '".$_POST['pe_film_feature_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pe Film Feature Insert Error");
    }
}

if(isset($_POST['pbfo_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_bag_fill_opts`(`pbfo_value`, `pbfo_show`) VALUES (
    '".$_POST['pbfo_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Bag Fill Opts Insert Error");
    }
}

if(isset($_POST['euro_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_euro_punch`(`euro_value`, `euro_show`) VALUES (
    '".$_POST['euro_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Euro Punch Insert Error");
    }
}

if(isset($_POST['lap_fin_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_lap_fin`(`lap_fin_value`, `lap_fin_show`) VALUES (
    '".$_POST['lap_fin_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Lap Fin Insert Error");
    }
}

if(isset($_POST['pouch_pack_ins_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_pack_ins`(`pouch_pack_ins_value`, `pouch_pack_ins_show`) VALUES (
    '".$_POST['pouch_pack_ins_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Pack Ins Insert Error");
    }
}

if(isset($_POST['pestrip_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_pe_strip`(`pestrip_value`, `pestrip_show`) VALUES (
    '".$_POST['pestrip_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Pe Strip Insert Error");
    }
}

if(isset($_POST['punch_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_punch_type`(`punch_value`, `punch_show`) VALUES (
    '".$_POST['punch_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Punch Type Insert Error");
    }
}

if(isset($_POST['round_corner_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_round_corner`(`round_corner_value`, `round_corner_show`) VALUES (
    '".$_POST['round_corner_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Round Corner Insert Error");
    }
}

if(isset($_POST['tear_notch_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_tear_notch`(`tear_notch_value`, `tear_notch_show`) VALUES (
    '".$_POST['tear_notch_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Tear Notch Insert Error");
    }
}

if(isset($_POST['tear_notch_qty_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_tear_notch_qty`(`tear_notch_qty_value`, `tear_notch_qty_show`) VALUES (
    '".$_POST['tear_notch_qty_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Tear Notch Qty Insert Error");
    }
}

if(isset($_POST['tear_notch_side_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_tear_notch_side`(`tear_notch_side_value`, `tear_notch_side_show`) VALUES (
    '".$_POST['tear_notch_side_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Tear Notch Side Insert Error");
    }
}

if(isset($_POST['zipper_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_zipper`(`zipper_value`, `zipper_show`) VALUES (
    '".$_POST['zipper_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Zipper Insert Error");
    }
}

if(isset($_POST['zipopc_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_pouch_zipper_opc`(`zipopc_value`, `zipopc_show`) VALUES (
    '".$_POST['zipopc_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Pouch Zipper Opc Insert Error");
    }
}

if(isset($_POST['print_end_opts_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_print_end_options`(`print_end_opts_value`, `print_end_opts_show`) VALUES (
    '".$_POST['print_end_opts_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Print End Options Insert Error");
    }
}

if(isset($_POST['print_options_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_print_options`(`print_options_value`, `print_options_show`) VALUES (
    '".$_POST['print_options_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Print Options Insert Error");
    }
}

if(isset($_POST['shadecard_ref_type_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_print_shadecard_ref_type`(`shadecard_ref_type_value`, `shadecard_ref_type_show`) VALUES (
    '".$_POST['shadecard_ref_type_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Print Shadecard Ref Type Insert Error");
    }
}

if(isset($_POST['shadecardreq_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_print_shadecardreq`(`shadecardreq_value`, `shadecardreq_show`) VALUES (
    '".$_POST['shadecardreq_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Print Shadecardreq Insert Error");
    }
}

if(isset($_POST['surfrev_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_print_surfrev`(`surfrev_value`, `surfrev_show`) VALUES (
    '".$_POST['surfrev_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Print Surfrev Insert Error");
    }
}

if(isset($_POST['rept_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_repeat_types`(`rept_value`, `rept_show`) VALUES (
    '".$_POST['rept_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Repeat Types Insert Error");
    }
}

if(isset($_POST['rollopts_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_roll_options`(`rollopts_value`, `rollopts_show`) VALUES (
    '".$_POST['rollopts_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Roll Options Insert Error");
    }
}

if(isset($_POST['shipment_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_shipment`(`shipment_value`, `shipment_show`) VALUES (
    '".$_POST['shipment_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Shipment Insert Error");
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
      die("Internal Server Error , 503 : Slitting Core Id Type Insert Error");
    }
}

if(isset($_POST['core_plugs_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_slitting_core_plugs`(`core_plugs_value`, `core_plugs_show`) VALUES (
    '".$_POST['core_plugs_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Slitting Core Plugs Insert Error");
    }
}

if(isset($_POST['freight_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_slitting_freight_ins`(`freight_value`, `freight_show`) VALUES (
    '".$_POST['freight_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Slitting Freight Ins Insert Error");
    }
}

if(isset($_POST['laser_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_slitting_laser_config`(`laser_value`, `laser_show`) VALUES (
    '".$_POST['laser_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Slitting Laser Config Insert Error");
    }
}

if(isset($_POST['pack_ins_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_slitting_pack_ins`(`pack_ins_value`, `pack_ins_show`) VALUES (
    '".$_POST['pack_ins_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Slitting Pack Ins Insert Error");
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

if(isset($_POST['pallet_instructions_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_slitting_pallet_instructions`(`pallet_instructions_value`, `pallet_instructions_show`) VALUES (
    '".$_POST['pallet_instructions_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Slitting Pallet Instructions Insert Error");
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

if(isset($_POST['shipping_dets_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_slitting_shipping_dets`(`shipping_dets_value`, `shipping_dets_show`) VALUES (
    '".$_POST['shipping_dets_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Slitting Shipping Dets Insert Error");
    }
}

if(isset($_POST['structure_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_ui_structure`(`structure_value`, `structure_show`) VALUES (
    '".$_POST['structure_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Structure Insert Error");
    }
}

if(isset($_POST['wind_value'])){
    $insSQL = mysqlInsertData("INSERT INTO `work_order_wind_dir`(`wind_value`, `wind_show`) VALUES (
    '".$_POST['wind_value']."',
    '1')",true);
    if(is_numeric($insSQL)){
      die("ok");
    }else{
      die("Internal Server Error , 503 : Work Order Wind Dir Insert Error");
    }
}





/*
	Show Hide		
 */

if(isset($_POST['application_toggle'])){
    $hash = $_POST['application_toggle'];
    
    if(!is_numeric($hash)){
        die("Work Order Applications , Invalid Parameter Passed");
    }
    $t = 'work_order_applications';
    $pr = 'application';
    $h = 'Work Order Applications';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['psu_toggle'])){
    $hash = $_POST['psu_toggle'];
    
    if(!is_numeric($hash)){
        die("Work Order Pack Size Unit , Invalid Parameter Passed");
    }
    $t = 'work_order_pack_size_unit';
    $pr = 'psu';
    $h = 'Work Order Pack Size Unit';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['ptp_toggle'])){
    $hash = $_POST['ptp_toggle'];
    
    if(!is_numeric($hash)){
        die("Work Order Product Type Printed , Invalid Parameter Passed");
    }
    $t = 'work_order_product_type_printed';
    $pr = 'ptp';
    $h = 'Work Order Product Type Printed';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['unit_toggle'])){
    $hash = $_POST['unit_toggle'];
    
    if(!is_numeric($hash)){
        die("Work Order Qty Units , Invalid Parameter Passed");
    }
    $t = 'work_order_qty_units';
    $pr = 'unit';
    $h = 'Work Order Qty Units';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['bag_handle_toggle'])){
    $hash = $_POST['bag_handle_toggle'];
    
    if(!is_numeric($hash)){
        die("Bag Handle , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_bag_handle';
    $pr = 'bag_handle';
    $h = 'Bag Handle';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['customer_location_toggle'])){
    $hash = $_POST['customer_location_toggle'];
    
    if(!is_numeric($hash)){
        die("Customer Location , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_customer_location';
    $pr = 'customer_location';
    $h = 'Customer Location';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['cof_toggle'])){
    $hash = $_POST['cof_toggle'];
    
    if(!is_numeric($hash)){
        die("Ext Cof , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_ext_cof';
    $pr = 'cof';
    $h = 'Ext Cof';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['filling_temp_toggle'])){
    $hash = $_POST['filling_temp_toggle'];
    
    if(!is_numeric($hash)){
        die("Filling Temp , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_filling_temp';
    $pr = 'filling_temp';
    $h = 'Filling Temp';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['foil_print_side_toggle'])){
    $hash = $_POST['foil_print_side_toggle'];
    
    if(!is_numeric($hash)){
        die("Foil Print Side , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_foil_print_side';
    $pr = 'foil_print_side';
    $h = 'Foil Print Side';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['lamo_toggle'])){
    $hash = $_POST['lamo_toggle'];
    
    if(!is_numeric($hash)){
        die("Lam Options , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_lam_options';
    $pr = 'lamo';
    $h = 'Lam Options';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['pallet_size_toggle'])){
    $hash = $_POST['pallet_size_toggle'];
    
    if(!is_numeric($hash)){
        die("Pallet Size , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pallet_size';
    $pr = 'pallet_size';
    $h = 'Pallet Size';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['pe_film_feature_toggle'])){
    $hash = $_POST['pe_film_feature_toggle'];
    
    if(!is_numeric($hash)){
        die("Pe Film Feature , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pe_film_feature';
    $pr = 'pe_film_feature';
    $h = 'Pe Film Feature';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['pbfo_toggle'])){
    $hash = $_POST['pbfo_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Bag Fill Opts , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_bag_fill_opts';
    $pr = 'pbfo';
    $h = 'Pouch Bag Fill Opts';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['euro_toggle'])){
    $hash = $_POST['euro_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Euro Punch , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_euro_punch';
    $pr = 'euro';
    $h = 'Pouch Euro Punch';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['lap_fin_toggle'])){
    $hash = $_POST['lap_fin_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Lap Fin , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_lap_fin';
    $pr = 'lap_fin';
    $h = 'Pouch Lap Fin';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['pouch_pack_ins_toggle'])){
    $hash = $_POST['pouch_pack_ins_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Pack Ins , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_pack_ins';
    $pr = 'pouch_pack_ins';
    $h = 'Pouch Pack Ins';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['pestrip_toggle'])){
    $hash = $_POST['pestrip_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Pe Strip , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_pe_strip';
    $pr = 'pestrip';
    $h = 'Pouch Pe Strip';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['punch_toggle'])){
    $hash = $_POST['punch_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Punch Type , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_punch_type';
    $pr = 'punch';
    $h = 'Pouch Punch Type';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['round_corner_toggle'])){
    $hash = $_POST['round_corner_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Round Corner , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_round_corner';
    $pr = 'round_corner';
    $h = 'Pouch Round Corner';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['tear_notch_toggle'])){
    $hash = $_POST['tear_notch_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Tear Notch , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_tear_notch';
    $pr = 'tear_notch';
    $h = 'Pouch Tear Notch';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['tear_notch_qty_toggle'])){
    $hash = $_POST['tear_notch_qty_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Tear Notch Qty , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_tear_notch_qty';
    $pr = 'tear_notch_qty';
    $h = 'Pouch Tear Notch Qty';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['tear_notch_side_toggle'])){
    $hash = $_POST['tear_notch_side_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Tear Notch Side , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_tear_notch_side';
    $pr = 'tear_notch_side';
    $h = 'Pouch Tear Notch Side';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['zipper_toggle'])){
    $hash = $_POST['zipper_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Zipper , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_zipper';
    $pr = 'zipper';
    $h = 'Pouch Zipper';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['zipopc_toggle'])){
    $hash = $_POST['zipopc_toggle'];
    
    if(!is_numeric($hash)){
        die("Pouch Zipper Opc , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_pouch_zipper_opc';
    $pr = 'zipopc';
    $h = 'Pouch Zipper Opc';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['print_end_opts_toggle'])){
    $hash = $_POST['print_end_opts_toggle'];
    
    if(!is_numeric($hash)){
        die("Print End Options , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_print_end_options';
    $pr = 'print_end_opts';
    $h = 'Print End Options';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['print_options_toggle'])){
    $hash = $_POST['print_options_toggle'];
    
    if(!is_numeric($hash)){
        die("Print Options , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_print_options';
    $pr = 'print_options';
    $h = 'Print Options';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['shadecard_ref_type_toggle'])){
    $hash = $_POST['shadecard_ref_type_toggle'];
    
    if(!is_numeric($hash)){
        die("Print Shadecard Ref Type , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_print_shadecard_ref_type';
    $pr = 'shadecard_ref_type';
    $h = 'Print Shadecard Ref Type';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['shadecardreq_toggle'])){
    $hash = $_POST['shadecardreq_toggle'];
    
    if(!is_numeric($hash)){
        die("Print Shadecardreq , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_print_shadecardreq';
    $pr = 'shadecardreq';
    $h = 'Print Shadecardreq';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['surfrev_toggle'])){
    $hash = $_POST['surfrev_toggle'];
    
    if(!is_numeric($hash)){
        die("Print Surfrev , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_print_surfrev';
    $pr = 'surfrev';
    $h = 'Print Surfrev';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['rept_toggle'])){
    $hash = $_POST['rept_toggle'];
    
    if(!is_numeric($hash)){
        die("Repeat Types , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_repeat_types';
    $pr = 'rept';
    $h = 'Repeat Types';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['rollopts_toggle'])){
    $hash = $_POST['rollopts_toggle'];
    
    if(!is_numeric($hash)){
        die("Roll Options , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_roll_options';
    $pr = 'rollopts';
    $h = 'Roll Options';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['shipment_toggle'])){
    $hash = $_POST['shipment_toggle'];
    
    if(!is_numeric($hash)){
        die("Shipment , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_shipment';
    $pr = 'shipment';
    $h = 'Shipment';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
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
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['slitting_core_id_type_toggle'])){
    $hash = $_POST['slitting_core_id_type_toggle'];
    
    if(!is_numeric($hash)){
        die("Slitting Core Id Type , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_slitting_core_id_type';
    $pr = 'slitting_core_id_type';
    $h = 'Slitting Core Id Type';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['core_plugs_toggle'])){
    $hash = $_POST['core_plugs_toggle'];
    
    if(!is_numeric($hash)){
        die("Slitting Core Plugs , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_slitting_core_plugs';
    $pr = 'core_plugs';
    $h = 'Slitting Core Plugs';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['freight_toggle'])){
    $hash = $_POST['freight_toggle'];
    
    if(!is_numeric($hash)){
        die("Slitting Freight Ins , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_slitting_freight_ins';
    $pr = 'freight';
    $h = 'Slitting Freight Ins';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['laser_toggle'])){
    $hash = $_POST['laser_toggle'];
    
    if(!is_numeric($hash)){
        die("Slitting Laser Config , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_slitting_laser_config';
    $pr = 'laser';
    $h = 'Slitting Laser Config';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['pack_ins_toggle'])){
    $hash = $_POST['pack_ins_toggle'];
    
    if(!is_numeric($hash)){
        die("Slitting Pack Ins , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_slitting_pack_ins';
    $pr = 'pack_ins';
    $h = 'Slitting Pack Ins';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
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
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['pallet_instructions_toggle'])){
    $hash = $_POST['pallet_instructions_toggle'];
    
    if(!is_numeric($hash)){
        die("Slitting Pallet Instructions , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_slitting_pallet_instructions';
    $pr = 'pallet_instructions';
    $h = 'Slitting Pallet Instructions';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
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
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['shipping_dets_toggle'])){
    $hash = $_POST['shipping_dets_toggle'];
    
    if(!is_numeric($hash)){
        die("Slitting Shipping Dets , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_slitting_shipping_dets';
    $pr = 'shipping_dets';
    $h = 'Slitting Shipping Dets';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['structure_toggle'])){
    $hash = $_POST['structure_toggle'];
    
    if(!is_numeric($hash)){
        die("Structure , Invalid Parameter Passed");
    }
    $t = 'work_order_ui_structure';
    $pr = 'structure';
    $h = 'Structure';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
            echo 'ok';
        }
        
    }else{
        die($h." , Value not found");
    }
    
}

if(isset($_POST['wind_toggle'])){
    $hash = $_POST['wind_toggle'];
    
    if(!is_numeric($hash)){
        die("Work Order Wind Dir , Invalid Parameter Passed");
    }
    $t = 'work_order_wind_dir';
    $pr = 'wind';
    $h = 'Work Order Wind Dir';
    
    $checker = mysqlSelect("select * from ".$t." where ".$pr."_id = ".$hash);
    
    if(is_array($checker)){
        
        $updtSql = mysqlUpdateData("update ".$t." set ".$pr."_show = ".($checker[0][$pr.'_show'] == 1? 0:1)." where ".$pr."_id = ".$hash,true );
        
        if(!is_numeric($updtSql)){
            die("503, Could not Not Update ".$h);
        }else{
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
    if(isset($_POST['<?php echo $infopiece[2] ?>_value'])){<br>
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