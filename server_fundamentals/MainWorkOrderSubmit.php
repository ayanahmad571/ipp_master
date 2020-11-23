<?php
require_once("SessionHandler.php");

	if(!isset($_POST['draftToMain'])){
		die("Error: Please Provide a Draft ID");
	}
	
	if(!is_numeric($_POST['draftToMain'])){
		die("Error: Draft ID Format Invalid");
	}

	//Check for the draft and load it onto an array
	$getDrafts = mysqlSelect("SELECT * FROM `sales_work_order_main` 
	where s_wo_status = 1  
	".$inColsDRAFT."
	and s_wo_id = ".$_POST['draftToMain']);
	
	if(!is_array($getDrafts)){
		die("Error: Draft not Found");
	}
	
	$Draft = $getDrafts[0];

		//make the master Reference entry in the Table and get the New Work Order ID
		$insertReference = mysqlInsertData("INSERT INTO `master_work_order_reference_number`(`mwo_dnt`,`mwo_sales_wo_id`,`mwo_gen_on_behalf_lum_id`,`mwo_gen_lum_id`) VALUES (
		'".time()."',
		'".$Draft['s_wo_id']."',
		'".$Draft['s_wo_lum_id']."',
		'".$Draft['s_wo_gen_lum_id']."')", true);
	
		if(!is_numeric($insertReference)){
			die("503: Internal Error, Could not insert WORK ORDER REFERENCE");
		}
		
		//Check if extrusion is needed in this 
		$ext = false;
		
		for($counter1 = 1; $counter1 <= 5; $counter1++){
			//checkLayerStructure
			$valFilmID = $Draft["s_wo_layer_".$counter1."_structure"];
			
			if($valFilmID ==4 || $valFilmID ==5 || $valFilmID ==36 ){
				$ext = true;
			}		
			
		}
		
		//Setup What section needs to be done
  		$doEssentailsModule = true;
		$doExtrusionModule = $ext;
		$doPrintingModule = ($Draft['s_wo_printed_question'] == 1);
		$doLaminationModule = ($Draft['s_wo_ply'] > 1 );
		$doBagsModule = ($Draft['s_wo_structure'] == 1);
		$doPouchModule = ($Draft['s_wo_structure'] == 2);
		$doSlittingModule = true;

		//set up arrays that are to be filled
		$RemarksMain = array();	
		$WorkOrderBags =array();
		$WorkOrderExtrusion = array();
		$WorkOrderLamination = array();
		$WorkOrderMaster  = array();
		$WorkOrderPrinting = array();
		$WorkOrderSlitting = array();
		$WorkOrderPouch = array();

//Perform all the necessary sections and fill respective arrays
		if($doEssentailsModule){
			$WorkOrderMaster = array(
			"master_wo_lum_id"=>$Draft["s_wo_lum_id"],
			"master_wo_design_id"=>$Draft["s_wo_design_id"],
			"master_wo_po"=>$Draft["s_wo_po"],
			"master_wo_client_id"=>$Draft["s_wo_client_id"],
			"master_wo_customer_item_code"=>$Draft["s_wo_customer_item_code"],
			"master_wo_delivery_date"=>$Draft["s_wo_delivery_date"],
			"master_wo_lwo"=>$Draft["s_wo_lwo"],
			"master_wo_structure"=>$Draft["s_wo_structure"],
			"master_wo_final_qty"=>$Draft["s_wo_final_qty"],
			"master_wo_qty_unit"=>$Draft["s_wo_qty_unit"],
			"master_wo_tolerance_1"=>$Draft["s_wo_tolerance_1"],
			"master_wo_tolerance_2"=>$Draft["s_wo_tolerance_2"],
			"master_wo_ply"=>$Draft["s_wo_ply"],
			"master_wo_customer_location"=>$Draft["s_wo_customer_location"],
			"master_wo_application_id"=>$Draft["s_wo_application_id"],
			"master_wo_ncr_no"=>$Draft["s_wo_ncr_no"],
			"master_wo_ccr_no"=>$Draft["s_wo_ccr_no"],
			"master_wo_printed_question"=>$Draft["s_wo_printed_question"],
			"master_wo_inhouse_pe_question"=>$Draft["s_wo_inhouse_pe_question"],
			"master_wo_layer_1_micron"=>$Draft["s_wo_layer_1_micron"],
			"master_wo_layer_1_structure"=>$Draft["s_wo_layer_1_structure"],
			"master_wo_layer_2_micron"=>$Draft["s_wo_layer_2_micron"],
			"master_wo_layer_2_structure"=>$Draft["s_wo_layer_2_structure"],
			"master_wo_layer_3_micron"=>$Draft["s_wo_layer_3_micron"],
			"master_wo_layer_3_structure"=>$Draft["s_wo_layer_3_structure"],
			"master_wo_layer_4_micron"=>$Draft["s_wo_layer_4_micron"],
			"master_wo_layer_4_structure"=>$Draft["s_wo_layer_4_structure"],
			"master_wo_layer_5_micron"=>$Draft["s_wo_layer_5_micron"],
			"master_wo_layer_5_structure"=>$Draft["s_wo_layer_5_structure"],
			"master_wo_gen_dnt"=>time(),
			"master_wo_gen_lum_id"=>$Draft["s_wo_gen_lum_id"]
			);

			if(($Draft["s_wo_remarks_overall"] != '')){
				$RemarksMain[] = "(
				'".$USER_ARRAY['lum_id']."',
				'".$Draft["s_wo_remarks_overall"]."',
				'".$insertReference."',
				'".time()."',
				'1')";

			}
			
		}
		
		if($doExtrusionModule){
			
			
			$WorkOrderExtrusion = array(
			"master_wo_ex_pe_re"=>$Draft["s_wo_ex_pe_re"],
			"master_wo_ex_antistatic"=>$Draft["s_wo_ex_antistatic"],
			"master_wo_ex_layer"=>$Draft["s_wo_ex_layer"],
			"master_wo_ex_pack_weight"=>$Draft["s_wo_ex_pack_weight"],
			"master_wo_ex_pkg_size"=>$Draft["s_wo_ex_pkg_size"],
			"master_wo_ex_qty_units"=>$Draft["s_wo_ex_qty_units"],
			"master_wo_ex_thickness"=>$Draft["s_wo_ex_thickness"],
			"master_wo_ex_treatment"=>$Draft["s_wo_ex_treatment"],
			"master_wo_ex_roll_od"=>$Draft["s_wo_ex_roll_od"],
			"master_wo_ex_extrude_in"=>$Draft["s_wo_ex_extrude_in"],
			"master_wo_ex_film_color"=>$Draft["s_wo_ex_film_color"],
			"master_wo_ex_cof"=>$Draft["s_wo_ex_cof"],
			"master_wo_ext_cof_i2i"=>$Draft["s_wo_ext_cof_i2i"],
			"master_wo_ext_cof_o2o"=>$Draft["s_wo_ext_cof_o2o"],
			"master_wo_ext_cof_o2m"=>$Draft["s_wo_ext_cof_o2m"],
			"master_wo_ext_cof_i2m"=>$Draft["s_wo_ext_cof_i2m"],
			"master_wo_ext_pe_film_feature"=>$Draft["s_wo_ext_pe_film_feature"],
			"master_wo_ext_dyne"=>$Draft["s_wo_ext_dyne"],
			"master_wo_ext_single_coil_w"=>$Draft["s_wo_ext_single_coil_w"],
			"master_wo_ext_no_ups"=>$Draft["s_wo_ext_no_ups"],
			"master_wo_ext_jumbo_f_w"=>$Draft["s_wo_ext_jumbo_f_w"],
			"master_wo_ext_recycle_p"=>$Draft["s_wo_ext_recycle_p"],
			"master_wo_ex_options"=>$Draft["s_wo_ex_options"]
			);


			if(($Draft["s_wo_remarks_ext"] != '')){
					$RemarksMain[] = "(
				'".$USER_ARRAY['lum_id']."',
				'".$Draft["s_wo_remarks_ext"]."',
				'".$insertReference."',
				'".time()."',
				'2')";
			}
		}
		
		if($doPrintingModule){


		$WorkOrderPrinting = array(
"master_wo_print_design"=>$Draft["s_wo_print_design"],
"master_wo_print_cylinder_supplier"=>$Draft["s_wo_print_cylinder_supplier"],
"master_wo_print_surface_reverse"=>$Draft["s_wo_print_surface_reverse"],
"master_wo_print_qty"=>$Draft["s_wo_print_qty"],
"master_wo_print_units"=>$Draft["s_wo_print_units"],
"master_wo_print_substrate"=>$Draft["s_wo_print_substrate"],
"master_wo_print_single_coil_width"=>$Draft["s_wo_print_single_coil_width"],
"master_wo_print_ups_val"=>$Draft["s_wo_print_ups_val"],
"master_wo_print_trim_val"=>$Draft["s_wo_print_trim_val"],
"master_wo_print_single_coil_circ"=>$Draft["s_wo_print_single_coil_circ"],
"master_wo_print_accross_val"=>$Draft["s_wo_print_accross_val"],
"master_wo_print_bleed_val"=>$Draft["s_wo_print_bleed_val"],
"master_wo_print_shade_card_needed"=>$Draft["s_wo_print_shade_card_needed"],
"master_wo_print_color_ref_type"=>$Draft["s_wo_print_color_ref_type"],
"master_wo_print_eyemark_color"=>$Draft["s_wo_print_eyemark_color"],
"master_wo_print_size"=>$Draft["s_wo_print_size"],
"master_wo_print_eyemark_path"=>$Draft["s_wo_print_eyemark_path"],
"master_wo_print_approvalby"=>$Draft["s_wo_print_approvalby"],
"master_wo_print_plate_cyl_pr"=>$Draft["s_wo_print_plate_cyl_pr"],
"master_wo_print_ink_system"=>$Draft["s_wo_print_ink_system"],
"master_wo_print_baseshel"=>$Draft["s_wo_print_baseshel"],
"master_wo_print_ink_gsm"=>$Draft["s_wo_print_ink_gsm"],
"master_wo_print_pantone_1"=>$Draft["s_wo_print_pantone_1"],
"master_wo_print_pantone_2"=>$Draft["s_wo_print_pantone_2"],
"master_wo_print_pantone_3"=>$Draft["s_wo_print_pantone_3"],
"master_wo_print_pantone_4"=>$Draft["s_wo_print_pantone_4"],
"master_wo_print_pantone_5"=>$Draft["s_wo_print_pantone_5"],
"master_wo_print_pantone_6"=>$Draft["s_wo_print_pantone_6"],
"master_wo_print_pantone_7"=>$Draft["s_wo_print_pantone_7"],
"master_wo_print_pantone_8"=>$Draft["s_wo_print_pantone_8"],
"master_wo_print_eyemark_side"=>$Draft["s_wo_print_eyemark_side"],
"master_wo_print_end_options"=>$Draft["s_wo_print_end_options"]
		);
		
		

			
			if(($Draft["s_wo_remarks_print"] != '')){
				$RemarksMain[] = "(
			'".$USER_ARRAY['lum_id']."',
			'".$Draft["s_wo_remarks_print"]."',
			'".$insertReference."',
			'".time()."',
			'3')";
			}
			
			
		}
		
		if($doLaminationModule){
					
		
		
		
		$WorkOrderLamination = array(
  "master_wo_lam_lam_sleeve"=>$Draft["s_wo_lam_lam_sleeve"],
  "master_wo_lam_f1_width"=>$Draft["s_wo_lam_f1_width"],
  "master_wo_lam_f1_kgs"=>$Draft["s_wo_lam_f1_kgs"],
  "master_wo_lam_f1_mtr"=>$Draft["s_wo_lam_f1_mtr"],
  "master_wo_lam_p1_desc_1"=>$Draft["s_wo_lam_p1_desc_1"],
  "master_wo_lam_p1_desc_2"=>$Draft["s_wo_lam_p1_desc_2"],
  "master_wo_lam_f2_width"=>$Draft["s_wo_lam_f2_width"],
  "master_wo_lam_f2_kgs"=>$Draft["s_wo_lam_f2_kgs"],
  "master_wo_lam_f2_mtr"=>$Draft["s_wo_lam_f2_mtr"],
  "master_wo_lam_p2_desc_1"=>$Draft["s_wo_lam_p2_desc_1"],
  "master_wo_lam_p2_desc_2"=>$Draft["s_wo_lam_p2_desc_2"],
  "master_wo_lam_f3_width"=>$Draft["s_wo_lam_f3_width"],
  "master_wo_lam_f3_kgs"=>$Draft["s_wo_lam_f3_kgs"],
  "master_wo_lam_f3_mtr"=>$Draft["s_wo_lam_f3_mtr"],
  "master_wo_lam_p3_desc_1"=>$Draft["s_wo_lam_p3_desc_1"],
  "master_wo_lam_p3_desc_2"=>$Draft["s_wo_lam_p3_desc_2"],
  "master_wo_lam_f4_width"=>$Draft["s_wo_lam_f4_width"],
  "master_wo_lam_f4_kgs"=>$Draft["s_wo_lam_f4_kgs"],
  "master_wo_lam_f4_mtr"=>$Draft["s_wo_lam_f4_mtr"],
  "master_wo_lam_p4_desc_1"=>$Draft["s_wo_lam_p4_desc_1"],
  "master_wo_lam_p4_desc_2"=>$Draft["s_wo_lam_p4_desc_2"],
  "master_wo_lam_f5_width"=>$Draft["s_wo_lam_f5_width"],
  "master_wo_lam_f5_kgs"=>$Draft["s_wo_lam_f5_kgs"],
  "master_wo_lam_f5_mtr"=>$Draft["s_wo_lam_f5_mtr"],
  "master_wo_lam_options"=>$Draft["s_wo_lam_options"]);
		

			if(($Draft["s_wo_remarks_lam"] != '')){
				$RemarksMain[] = "(
			'".$USER_ARRAY['lum_id']."',
			'".$Draft["s_wo_remarks_lam"]."',
			'".$insertReference."',
			'".time()."',
			'4')";
			}
		}
		
		if($doPouchModule){
			
					
		$WorkOrderPouch = array(
"master_wo_pouch_qty"=>$Draft["s_wo_pouch_qty"],
"master_wo_pouch_unit"=>$Draft["s_wo_pouch_unit"],
"master_wo_pouch_width"=>$Draft["s_wo_pouch_width"],
"master_wo_pouch_length"=>$Draft["s_wo_pouch_length"],
"master_wo_pouch_gus_side"=>$Draft["s_wo_pouch_gus_side"],
"master_wo_pouch_gus_bot"=>$Draft["s_wo_pouch_gus_bot"],
"master_wo_pouch_seal_width"=>$Draft["s_wo_pouch_seal_width"],
"master_wo_pouch_side_gus_w"=>$Draft["s_wo_pouch_side_gus_w"],
"master_wo_pouch_side_gus_l"=>$Draft["s_wo_pouch_side_gus_l"],
"master_wo_pouch_bot_gus_w"=>$Draft["s_wo_pouch_bot_gus_w"],
"master_wo_pouch_bot_gus_l"=>$Draft["s_wo_pouch_bot_gus_l"],
"master_wo_pouch_euro_punch"=>$Draft["s_wo_pouch_euro_punch"],
"master_wo_pouch_open"=>$Draft["s_wo_pouch_open"],
"master_wo_pouch_corner_type"=>$Draft["s_wo_pouch_corner_type"],
"master_wo_pouch_seal_type"=>$Draft["s_wo_pouch_seal_type"],
"master_wo_pouch_zip_dist_top"=>$Draft["s_wo_pouch_zip_dist_top"],
"master_wo_pouch_notch_side"=>$Draft["s_wo_pouch_notch_side"],
"master_wo_pouch_notch_dist_top"=>$Draft["s_wo_pouch_notch_dist_top"],
"master_wo_pouch_notch_dist_side"=>$Draft["s_wo_pouch_notch_dist_side"],
"master_wo_pouch_hole_punch"=>$Draft["s_wo_pouch_hole_punch"],
"master_wo_pouch_hole_punch_dia"=>$Draft["s_wo_pouch_hole_punch_dia"],
"master_wo_pouch_special_tooling"=>$Draft["s_wo_pouch_special_tooling"],
"master_wo_pouch_type"=>$Draft["s_wo_pouch_type"],
"master_wo_pouch_zip_closure_type"=>$Draft["s_wo_pouch_zip_closure_type"]
		);
		
		
			if(($Draft["s_wo_remarks_pouch"] != '')){
				$RemarksMain[] = "(
			'".$USER_ARRAY['lum_id']."',
			'".$Draft["s_wo_remarks_pouch"]."',
			'".$insertReference."',
			'".time()."',
			'5')";
				}
	}
		
		if($doBagsModule){
			
					
		$WorkOrderBags = array(
"master_wo_bag_qty"=>$Draft["s_wo_bag_qty"],
"master_wo_bag_units"=>$Draft["s_wo_bag_units"],
"master_wo_bag_width"=>$Draft["s_wo_bag_width"],
"master_wo_bag_length"=>$Draft["s_wo_bag_length"],
"master_wo_bag_gus_s_w"=>$Draft["s_wo_bag_gus_s_w"],
"master_wo_bag_gus_s_l"=>$Draft["s_wo_bag_gus_s_l"],
"master_wo_bag_gus_b_w"=>$Draft["s_wo_bag_gus_b_w"],
"master_wo_bag_gus_b_l"=>$Draft["s_wo_bag_gus_b_l"],
"master_wo_bag_handle_dist_top"=>$Draft["s_wo_bag_handle_dist_top"],
"master_wo_bag_handle_w"=>$Draft["s_wo_bag_handle_w"],
"master_wo_bag_handle_l"=>$Draft["s_wo_bag_handle_l"],
"master_wo_bag_thick"=>$Draft["s_wo_bag_thick"],
"master_wo_bag_gusset_side_type"=>$Draft["s_wo_bag_gusset_side_type"],
"master_wo_bag_gusset_bottom_type"=>$Draft["s_wo_bag_gusset_bottom_type"],
"master_wo_bag_top_fold"=>$Draft["s_wo_bag_top_fold"],
"master_wo_bag_flap"=>$Draft["s_wo_bag_flap"],
"master_wo_bag_lip"=>$Draft["s_wo_bag_lip"],
"master_wo_bag_handle_type"=>$Draft["s_wo_bag_handle_type"],
"master_wo_bag_vest_hande_type"=>$Draft["s_wo_bag_vest_hande_type"],
"master_wo_bag_spl_dia"=>$Draft["s_wo_bag_spl_dia"],
"master_wo_bag_sealing"=>$Draft["s_wo_bag_sealing"],
"master_wo_bag_spl_dia"=>$Draft["s_wo_bag_spl_dia"],
"master_wo_bag_handle_punch"=>$Draft["s_wo_bag_handle_punch"]
		);
		

			if(($Draft["s_wo_remarks_bag"] != '')){
				$RemarksMain[] = "(
			'".$USER_ARRAY['lum_id']."',
			'".$Draft["s_wo_remarks_bag"]."',
			'".$insertReference."',
			'".time()."',
			'6')";
			}
		}
		
		if($doSlittingModule){
			
			
					
		$WorkOrderSlitting = array(
"master_wo_slit_s_width"=>$Draft["s_wo_slit_s_width"],
"master_wo_slit_wind_dir"=>$Draft["s_wo_slit_wind_dir"],
"master_wo_slit_roll_od"=>$Draft["s_wo_slit_roll_od"],
"master_wo_slit_wt"=>$Draft["s_wo_slit_wt"],
"master_wo_slit_mtr"=>$Draft["s_wo_slit_mtr"],
"master_wo_slit_pallet"=>$Draft["s_wo_slit_pallet"],
"master_wo_slit_sticker"=>$Draft["s_wo_slit_sticker"],
"master_wo_slit_pallet_length"=>$Draft["s_wo_slit_pallet_length"],
"master_wo_slit_pallet_width"=>$Draft["s_wo_slit_pallet_width"],
"master_wo_slit_pallet_height"=>$Draft["s_wo_slit_pallet_height"],
"master_wo_slit_core_id"=>$Draft["s_wo_slit_core_id"],
"master_wo_slit_core_type"=>$Draft["s_wo_slit_core_type"],
"master_wo_slit_core_plugs"=>$Draft["s_wo_slit_core_plugs"],
"master_wo_slit_reel_flag_col"=>$Draft["s_wo_slit_reel_flag_col"],
"master_wo_slit_qc_max_jointrolls"=>$Draft["s_wo_slit_qc_max_jointrolls"],
"master_wo_remarks_slit"=>$Draft["s_wo_remarks_slit"],
"master_wo_slit_packing"=>$Draft["s_wo_slit_packing"],
"master_wo_slit_pallet_pack_ins"=>$Draft["s_wo_slit_pallet_pack_ins"],
"master_wo_slit_qc_ins"=>$Draft["s_wo_slit_qc_ins"]
		);
		
		


			
			if(($Draft["s_wo_remarks_slit"] != '')){
				$RemarksMain[] = "(
			'".$USER_ARRAY['lum_id']."',
			'".$Draft["s_wo_remarks_slit"]."',
			'".$insertReference."',
			'".time()."',
			'7')";
			}
		}
		
		//Merge the aforementioned arrays into a concatinated Time Out Excetion Controller
		$ArrayHolder = (array_merge($WorkOrderMaster,$WorkOrderExtrusion,$WorkOrderPrinting,
		$WorkOrderLamination,$WorkOrderPouch,$WorkOrderBags,$WorkOrderSlitting));		
		
		//Append value of MASTER REFERENCE KEY onto TEMP Holder Array
		$ArrayHolder['master_wo_ref'] = $insertReference;

		//Insert  Query Content Builder
		foreach($ArrayHolder as $a=>$b){
			$QueryCols[] = '`'.$a.'`'; 
			$QueryVals[] = ((is_null($b))? "NULL":"'".$b."'");
		}

	//Append Data from Content Builder onto Main Query
	$insertWO = 'INSERT INTO `master_work_order_main` ('.implode(', 
	',$QueryCols).') VALUES ('.implode(',
	',$QueryVals).')';
	
	//Insert the Work Order into the Main Conainter TAble
	$insertWorkOrderMain = mysqlInsertData($insertWO,true);
	if(!is_numeric($insertWorkOrderMain)){
		die("503.1 - Fatal Internal Server Error, Work Order Could not be inserted, REFERENCE INSERTED");
	}
	
	//If previous insert is sucessful then take the ID and insert the remarks associated to it
	if(is_array($RemarksMain)){
		if(count($RemarksMain)>0){
			$q = mysqlInsertData("INSERT INTO `remarks_wo`(
			`remark_lum_id`, `remark_text`, `remark_master_wo_id`, `remark_dnt`, `remark_type`) VALUES ".implode(', ',$RemarksMain),true);
			
			if(!is_numeric($q)){
				die("Internal Server Error. <br> Work Order Added, Remark Not Added  <br>ERR: ".$q);
			}
		}
	}
	
	//Update the Status of the Current Work Order
	$updateCurrentDraft = mysqlUpdateData("UPDATE `sales_work_order_main` SET `s_wo_status`=3 WHERE s_wo_id = ".$_POST['draftToMain'],true);
	if(is_numeric($updateCurrentDraft)){
		
		logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." has published draft ID ".$_POST['draftToMain']."  to WO ID ".$insertReference, 
		"mysqlInsertData");


		die("Success- Work Order Successfully Published");
	}else{
		die("Error - Update Current Draft State failed");
	}
	
?>
