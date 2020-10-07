<?php
 
if(isset($_POST['qualityToFactoryManager'])){
	#                         POST NAME			 Prev ID, Send ID NAME
	$PAGE_ESSENTIALS= array('qualityToFactoryManager',1,3,'Quality');

}else if(isset($_POST['FactoryManagerToPreCosting'])){

	$PAGE_ESSENTIALS= array('FactoryManagerToPreCosting',3,5,'Factory Manager');

}else if(isset($_POST['PreCostingToAccounts'])){

	$PAGE_ESSENTIALS= array('PreCostingToAccounts',5,6,'Pre Costing');

}else if(isset($_POST['AccountsToPrePress'])){

	$PAGE_ESSENTIALS= array('AccountsToPrePress',6,7,'Accounts');

}else if(isset($_POST['PrePressToPlanning'])){

	$PAGE_ESSENTIALS= array('PrePressToPlanning',7,8,'PrePress');

}else if(isset($_POST['PlanningToComplete'])){

	$PAGE_ESSENTIALS= array('PlanningToComplete',8,9,'Planning');

}else if(isset($_POST['QReturn'])){

	$PAGE_ESSENTIALS= array('QReturn',1,2,'Quality');

}else if(isset($_POST['FMReturn'])){

	$PAGE_ESSENTIALS= array('FMReturn',3,4,'Factory');

}else if(isset($_POST['rePublishSales'])){

	$PAGE_ESSENTIALS= array('rePublishSales',2,1,'Sales');

}else if(isset($_POST['rePublishQuality'])){

	$PAGE_ESSENTIALS= array('rePublishQuality',4,3,'Quality');

}else{
	die("Document Not Reachable");
}


require_once("SessionHandler.php");

	if(!isset($_POST[$PAGE_ESSENTIALS[0]])){
		die("Error: Please Provide a Draft ID");
	}
	
	if(!is_numeric($_POST[$PAGE_ESSENTIALS[0]])){
		die("Error: Work Order ID Format Invalid");
	}


	$getWorkOrder = mysqlSelect($UpdatedStatusQuery."
		 
		left join clients_main on master_wo_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id
	where master_wo_status = ".$PAGE_ESSENTIALS[1]." 
	".$inColsWO."
	and master_wo_ref = ".$_POST[$PAGE_ESSENTIALS[0]]);
	
	if(!is_array($getWorkOrder)){
		die("Error: Work Order not Found");
	}
	
	$WorkOrder = $getWorkOrder[0];
	
		//Check if extrusion is needed in this 
		$ext = false;
		
		for($counter1 = 1; $counter1 <= 5; $counter1++){
			//checkLayerStructure
			$valFilmID = $WorkOrder["master_wo_layer_".$counter1."_structure"];
			
			if($valFilmID ==4 || $valFilmID ==5 || $valFilmID ==36 ){
				$ext = true;
			}		
			
		}
  		$doEssentailsModule = true;
		$doExtrusionModule = $ext;
		$doPrintingModule = ($WorkOrder['master_wo_printed_question'] == 1);
		$doLaminationModule = ($WorkOrder['master_wo_ply'] > 1 );
		$doBagsModule = ($WorkOrder['master_wo_structure'] == 1);
		$doPouchModule = ($WorkOrder['master_wo_structure'] == 2);
		$doSlittingModule = true;

		$WorkOrderBags =array();
		$WorkOrderExtrusion = array();
		$WorkOrderLamination = array();
		$WorkOrderMaster  = array();
		$WorkOrderPrinting = array();
		$WorkOrderSlitting = array();
		$WorkOrderPouch = array();


					$WorkOrderMaster = array(
"master_wo_lum_id"=>$WorkOrder["master_wo_lum_id"],
"master_wo_design_id"=>$WorkOrder["master_wo_design_id"],
"master_wo_po"=>$WorkOrder["master_wo_po"],
"master_wo_client_id"=>$WorkOrder["master_wo_client_id"],
"master_wo_customer_item_code"=>$WorkOrder["master_wo_customer_item_code"],
"master_wo_delivery_date"=>$WorkOrder["master_wo_delivery_date"],
"master_wo_lwo"=>$WorkOrder["master_wo_lwo"],
"master_wo_structure"=>$WorkOrder["master_wo_structure"],
"master_wo_final_qty"=>$WorkOrder["master_wo_final_qty"],
"master_wo_qty_unit"=>$WorkOrder["master_wo_qty_unit"],
"master_wo_tolerance_1"=>$WorkOrder["master_wo_tolerance_1"],
"master_wo_tolerance_2"=>$WorkOrder["master_wo_tolerance_2"],
"master_wo_ply"=>$WorkOrder["master_wo_ply"],
"master_wo_customer_location"=>$WorkOrder["master_wo_customer_location"],
"master_wo_application_id"=>$WorkOrder["master_wo_application_id"],
"master_wo_ncr_no"=>$WorkOrder["master_wo_ncr_no"],
"master_wo_ccr_no"=>$WorkOrder["master_wo_ccr_no"],
"master_wo_printed_question"=>$WorkOrder["master_wo_printed_question"],
"master_wo_inhouse_pe_question"=>$WorkOrder["master_wo_inhouse_pe_question"],
"master_wo_layer_1_micron"=>$WorkOrder["master_wo_layer_1_micron"],
"master_wo_layer_1_structure"=>$WorkOrder["master_wo_layer_1_structure"],
"master_wo_layer_2_micron"=>$WorkOrder["master_wo_layer_2_micron"],
"master_wo_layer_2_structure"=>$WorkOrder["master_wo_layer_2_structure"],
"master_wo_layer_3_micron"=>$WorkOrder["master_wo_layer_3_micron"],
"master_wo_layer_3_structure"=>$WorkOrder["master_wo_layer_3_structure"],
"master_wo_layer_4_micron"=>$WorkOrder["master_wo_layer_4_micron"],
"master_wo_layer_4_structure"=>$WorkOrder["master_wo_layer_4_structure"],
"master_wo_layer_5_micron"=>$WorkOrder["master_wo_layer_5_micron"],
"master_wo_layer_5_structure"=>$WorkOrder["master_wo_layer_5_structure"],
"master_wo_gen_dnt"=>time(),
"master_wo_status"=>$PAGE_ESSENTIALS[2],
"master_wo_ref"=>$WorkOrder['master_wo_ref'],
"master_wo_gen_lum_id"=>$WorkOrder["master_wo_gen_lum_id"]
		);


		
		if($doExtrusionModule){
			
			
					$WorkOrderExtrusion = array(
			"master_wo_ex_pe_re"=>$WorkOrder["master_wo_ex_pe_re"],
			"master_wo_ex_antistatic"=>$WorkOrder["master_wo_ex_antistatic"],
			"master_wo_ex_layer"=>$WorkOrder["master_wo_ex_layer"],
			"master_wo_ex_pack_weight"=>$WorkOrder["master_wo_ex_pack_weight"],
			"master_wo_ex_pkg_size"=>$WorkOrder["master_wo_ex_pkg_size"],
			"master_wo_ex_qty_units"=>$WorkOrder["master_wo_ex_qty_units"],
			"master_wo_ex_thickness"=>$WorkOrder["master_wo_ex_thickness"],
			"master_wo_ex_treatment"=>$WorkOrder["master_wo_ex_treatment"],
			"master_wo_ex_roll_od"=>$WorkOrder["master_wo_ex_roll_od"],
			"master_wo_ex_extrude_in"=>$WorkOrder["master_wo_ex_extrude_in"],
			"master_wo_ex_film_color"=>$WorkOrder["master_wo_ex_film_color"],
			"master_wo_ex_cof"=>$WorkOrder["master_wo_ex_cof"],
			"master_wo_ext_cof_i2i"=>$WorkOrder["master_wo_ext_cof_i2i"],
			"master_wo_ext_cof_o2o"=>$WorkOrder["master_wo_ext_cof_o2o"],
			"master_wo_ext_cof_o2m"=>$WorkOrder["master_wo_ext_cof_o2m"],
			"master_wo_ext_cof_i2m"=>$WorkOrder["master_wo_ext_cof_i2m"],
			"master_wo_ext_pe_film_feature"=>$WorkOrder["master_wo_ext_pe_film_feature"],
			"master_wo_ext_dyne"=>$WorkOrder["master_wo_ext_dyne"],
			"master_wo_ext_single_coil_w"=>$WorkOrder["master_wo_ext_single_coil_w"],
			"master_wo_ext_no_ups"=>$WorkOrder["master_wo_ext_no_ups"],
			"master_wo_ext_jumbo_f_w"=>$WorkOrder["master_wo_ext_jumbo_f_w"],
			"master_wo_ext_recycle_p"=>$WorkOrder["master_wo_ext_recycle_p"],
			"master_wo_ex_options"=>$WorkOrder["master_wo_ex_options"]
		);


		}
		
		if($doPrintingModule){
			
					

		$WorkOrderPrinting = array(
"master_wo_print_design"=>$WorkOrder["master_wo_print_design"],
"master_wo_print_cylinder_supplier"=>$WorkOrder["master_wo_print_cylinder_supplier"],
"master_wo_print_surface_reverse"=>$WorkOrder["master_wo_print_surface_reverse"],
"master_wo_print_qty"=>$WorkOrder["master_wo_print_qty"],
"master_wo_print_units"=>$WorkOrder["master_wo_print_units"],

"master_wo_print_substrate"=>$WorkOrder["master_wo_print_substrate"],
"master_wo_print_single_coil_width"=>$WorkOrder["master_wo_print_single_coil_width"],
"master_wo_print_ups_val"=>$WorkOrder["master_wo_print_ups_val"],
"master_wo_print_trim_val"=>$WorkOrder["master_wo_print_trim_val"],
"master_wo_print_single_coil_circ"=>$WorkOrder["master_wo_print_single_coil_circ"],
"master_wo_print_accross_val"=>$WorkOrder["master_wo_print_accross_val"],
"master_wo_print_bleed_val"=>$WorkOrder["master_wo_print_bleed_val"],
"master_wo_print_shade_card_needed"=>$WorkOrder["master_wo_print_shade_card_needed"],
"master_wo_print_color_ref_type"=>$WorkOrder["master_wo_print_color_ref_type"],
"master_wo_print_eyemark_color"=>$WorkOrder["master_wo_print_eyemark_color"],
"master_wo_print_size"=>$WorkOrder["master_wo_print_size"],
"master_wo_print_eyemark_path"=>$WorkOrder["master_wo_print_eyemark_path"],
"master_wo_print_approvalby"=>$WorkOrder["master_wo_print_approvalby"],
"master_wo_print_plate_cyl_pr"=>$WorkOrder["master_wo_print_plate_cyl_pr"],
"master_wo_print_ink_system"=>$WorkOrder["master_wo_print_ink_system"],
"master_wo_print_baseshel"=>$WorkOrder["master_wo_print_baseshel"],
"master_wo_print_ink_gsm"=>$WorkOrder["master_wo_print_ink_gsm"],
"master_wo_print_pantone_1"=>$WorkOrder["master_wo_print_pantone_1"],
"master_wo_print_pantone_2"=>$WorkOrder["master_wo_print_pantone_2"],
"master_wo_print_pantone_3"=>$WorkOrder["master_wo_print_pantone_3"],
"master_wo_print_pantone_4"=>$WorkOrder["master_wo_print_pantone_4"],
"master_wo_print_pantone_5"=>$WorkOrder["master_wo_print_pantone_5"],
"master_wo_print_pantone_6"=>$WorkOrder["master_wo_print_pantone_6"],
"master_wo_print_pantone_7"=>$WorkOrder["master_wo_print_pantone_7"],
"master_wo_print_pantone_8"=>$WorkOrder["master_wo_print_pantone_8"],
"master_wo_print_eyemark_side"=>$WorkOrder["master_wo_print_eyemark_side"],
"master_wo_print_end_options"=>$WorkOrder["master_wo_print_end_options"]
		);
		

			
		}
		
		if($doLaminationModule){
					
		
		
		
		$WorkOrderLamination = array(
  "master_wo_lam_lam_sleeve"=>$WorkOrder["master_wo_lam_lam_sleeve"],
  "master_wo_lam_f1_width"=>$WorkOrder["master_wo_lam_f1_width"],
  "master_wo_lam_f1_kgs"=>$WorkOrder["master_wo_lam_f1_kgs"],
  "master_wo_lam_f1_mtr"=>$WorkOrder["master_wo_lam_f1_mtr"],
  "master_wo_lam_p1_desc_1"=>$WorkOrder["master_wo_lam_p1_desc_1"],
  "master_wo_lam_p1_desc_2"=>$WorkOrder["master_wo_lam_p1_desc_2"],
  "master_wo_lam_f2_width"=>$WorkOrder["master_wo_lam_f2_width"],
  "master_wo_lam_f2_kgs"=>$WorkOrder["master_wo_lam_f2_kgs"],
  "master_wo_lam_f2_mtr"=>$WorkOrder["master_wo_lam_f2_mtr"],
  "master_wo_lam_p2_desc_1"=>$WorkOrder["master_wo_lam_p2_desc_1"],
  "master_wo_lam_p2_desc_2"=>$WorkOrder["master_wo_lam_p2_desc_2"],
  "master_wo_lam_f3_width"=>$WorkOrder["master_wo_lam_f3_width"],
  "master_wo_lam_f3_kgs"=>$WorkOrder["master_wo_lam_f3_kgs"],
  "master_wo_lam_f3_mtr"=>$WorkOrder["master_wo_lam_f3_mtr"],
  "master_wo_lam_p3_desc_1"=>$WorkOrder["master_wo_lam_p3_desc_1"],
  "master_wo_lam_p3_desc_2"=>$WorkOrder["master_wo_lam_p3_desc_2"],
  "master_wo_lam_f4_width"=>$WorkOrder["master_wo_lam_f4_width"],
  "master_wo_lam_f4_kgs"=>$WorkOrder["master_wo_lam_f4_kgs"],
  "master_wo_lam_f4_mtr"=>$WorkOrder["master_wo_lam_f4_mtr"],
  "master_wo_lam_p4_desc_1"=>$WorkOrder["master_wo_lam_p4_desc_1"],
  "master_wo_lam_p4_desc_2"=>$WorkOrder["master_wo_lam_p4_desc_2"],
  "master_wo_lam_f5_width"=>$WorkOrder["master_wo_lam_f5_width"],
  "master_wo_lam_f5_kgs"=>$WorkOrder["master_wo_lam_f5_kgs"],
  "master_wo_lam_f5_mtr"=>$WorkOrder["master_wo_lam_f5_mtr"],
  "master_wo_lam_options"=>$WorkOrder["master_wo_lam_options"]);
		


		}
		
		if($doPouchModule){
			
					
		$WorkOrderPouch = array(
"master_wo_pouch_qty"=>$WorkOrder["master_wo_pouch_qty"],
"master_wo_pouch_unit"=>$WorkOrder["master_wo_pouch_unit"],
"master_wo_pouch_width"=>$WorkOrder["master_wo_pouch_width"],
"master_wo_pouch_length"=>$WorkOrder["master_wo_pouch_length"],
"master_wo_pouch_gus_side"=>$WorkOrder["master_wo_pouch_gus_side"],
"master_wo_pouch_gus_bot"=>$WorkOrder["master_wo_pouch_gus_bot"],
"master_wo_pouch_seal_width"=>$WorkOrder["master_wo_pouch_seal_width"],
"master_wo_pouch_side_gus_w"=>$WorkOrder["master_wo_pouch_side_gus_w"],
"master_wo_pouch_side_gus_l"=>$WorkOrder["master_wo_pouch_side_gus_l"],
"master_wo_pouch_bot_gus_w"=>$WorkOrder["master_wo_pouch_bot_gus_w"],
"master_wo_pouch_bot_gus_l"=>$WorkOrder["master_wo_pouch_bot_gus_l"],
"master_wo_pouch_euro_punch"=>$WorkOrder["master_wo_pouch_euro_punch"],
"master_wo_pouch_open"=>$WorkOrder["master_wo_pouch_open"],
"master_wo_pouch_corner_type"=>$WorkOrder["master_wo_pouch_corner_type"],
"master_wo_pouch_seal_type"=>$WorkOrder["master_wo_pouch_seal_type"],
"master_wo_pouch_zip_dist_top"=>$WorkOrder["master_wo_pouch_zip_dist_top"],
"master_wo_pouch_notch_side"=>$WorkOrder["master_wo_pouch_notch_side"],
"master_wo_pouch_notch_dist_top"=>$WorkOrder["master_wo_pouch_notch_dist_top"],
"master_wo_pouch_notch_dist_side"=>$WorkOrder["master_wo_pouch_notch_dist_side"],
"master_wo_pouch_hole_punch"=>$WorkOrder["master_wo_pouch_hole_punch"],
"master_wo_pouch_hole_punch_dia"=>$WorkOrder["master_wo_pouch_hole_punch_dia"],
"master_wo_pouch_special_tooling"=>$WorkOrder["master_wo_pouch_special_tooling"],
"master_wo_pouch_type"=>$WorkOrder["master_wo_pouch_type"],
"master_wo_pouch_zip_closure_type"=>$WorkOrder["master_wo_pouch_zip_closure_type"]
		);
		

	}
		
		if($doBagsModule){
			
					
		$WorkOrderBags = array(
"master_wo_bag_qty"=>$WorkOrder["master_wo_bag_qty"],
"master_wo_bag_units"=>$WorkOrder["master_wo_bag_units"],
"master_wo_bag_width"=>$WorkOrder["master_wo_bag_width"],
"master_wo_bag_length"=>$WorkOrder["master_wo_bag_length"],
"master_wo_bag_gus_s_w"=>$WorkOrder["master_wo_bag_gus_s_w"],
"master_wo_bag_gus_s_l"=>$WorkOrder["master_wo_bag_gus_s_l"],
"master_wo_bag_gus_b_w"=>$WorkOrder["master_wo_bag_gus_b_w"],
"master_wo_bag_gus_b_l"=>$WorkOrder["master_wo_bag_gus_b_l"],
"master_wo_bag_handle_dist_top"=>$WorkOrder["master_wo_bag_handle_dist_top"],
"master_wo_bag_handle_w"=>$WorkOrder["master_wo_bag_handle_w"],
"master_wo_bag_handle_l"=>$WorkOrder["master_wo_bag_handle_l"],
"master_wo_bag_thick"=>$WorkOrder["master_wo_bag_thick"],
"master_wo_bag_gusset_side_type"=>$WorkOrder["master_wo_bag_gusset_side_type"],
"master_wo_bag_gusset_bottom_type"=>$WorkOrder["master_wo_bag_gusset_bottom_type"],
"master_wo_bag_top_fold"=>$WorkOrder["master_wo_bag_top_fold"],
"master_wo_bag_flap"=>$WorkOrder["master_wo_bag_flap"],
"master_wo_bag_lip"=>$WorkOrder["master_wo_bag_lip"],
"master_wo_bag_handle_type"=>$WorkOrder["master_wo_bag_handle_type"],
"master_wo_bag_vest_hande_type"=>$WorkOrder["master_wo_bag_vest_hande_type"],
"master_wo_bag_spl_dia"=>$WorkOrder["master_wo_bag_spl_dia"],
"master_wo_bag_sealing"=>$WorkOrder["master_wo_bag_sealing"],
"master_wo_bag_spl_dia"=>$WorkOrder["master_wo_bag_spl_dia"],
"master_wo_bag_handle_punch"=>$WorkOrder["master_wo_bag_handle_punch"]
		);

		}
		
		if($doSlittingModule){
			
			
					
		$WorkOrderSlitting = array(
"master_wo_slit_s_width"=>$WorkOrder["master_wo_slit_s_width"],
"master_wo_slit_wind_dir"=>$WorkOrder["master_wo_slit_wind_dir"],
"master_wo_slit_roll_od"=>$WorkOrder["master_wo_slit_roll_od"],
"master_wo_slit_wt"=>$WorkOrder["master_wo_slit_wt"],
"master_wo_slit_mtr"=>$WorkOrder["master_wo_slit_mtr"],
"master_wo_slit_pallet"=>$WorkOrder["master_wo_slit_pallet"],
"master_wo_slit_sticker"=>$WorkOrder["master_wo_slit_sticker"],
"master_wo_slit_pallet_length"=>$WorkOrder["master_wo_slit_pallet_length"],
"master_wo_slit_pallet_width"=>$WorkOrder["master_wo_slit_pallet_width"],
"master_wo_slit_pallet_height"=>$WorkOrder["master_wo_slit_pallet_height"],
"master_wo_slit_core_id"=>$WorkOrder["master_wo_slit_core_id"],
"master_wo_slit_core_type"=>$WorkOrder["master_wo_slit_core_type"],
"master_wo_slit_core_plugs"=>$WorkOrder["master_wo_slit_core_plugs"],
"master_wo_slit_reel_flag_col"=>$WorkOrder["master_wo_slit_reel_flag_col"],
"master_wo_slit_qc_max_jointrolls"=>$WorkOrder["master_wo_slit_qc_max_jointrolls"],
"master_wo_remarks_slit"=>$WorkOrder["master_wo_remarks_slit"],
"master_wo_slit_packing"=>$WorkOrder["master_wo_slit_packing"],
"master_wo_slit_pallet_pack_ins"=>$WorkOrder["master_wo_slit_pallet_pack_ins"],
"master_wo_slit_qc_ins"=>$WorkOrder["master_wo_slit_qc_ins"]
		);
		

		}
		
		
	$ArrayHolder = (array_merge($WorkOrderMaster,$WorkOrderExtrusion,$WorkOrderPrinting,
	$WorkOrderLamination,$WorkOrderPouch,$WorkOrderBags,$WorkOrderSlitting));		

	foreach($ArrayHolder as $a=>$b){
		$QueryCols[] = '`'.$a.'`'; 
		$QueryVals[] = (is_null($b)? "NULL":"'".$b."'");
	}

	$insertWO = 'INSERT INTO `master_work_order_main` ('.implode(', 
	',$QueryCols).') VALUES ('.implode(',
	',$QueryVals).')';

	
	$insertWorkOrderMain = mysqlInsertData($insertWO,true);
	if(!is_numeric($insertWorkOrderMain)){
		die("503.1 - Fatal Internal Server Error, Work Order ".$PAGE_ESSENTIALS[3]." Could not be Published");
	}else{
		
logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." published WORK ORDER: ".$WorkOrder['master_wo_ref']." to bring to ID: ".$insertWorkOrderMain, 
		"mysqlInsertData");


		die("Success- Work Order Transaction Successful");
	}
?>
