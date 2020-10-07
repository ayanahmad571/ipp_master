<?php
die();
include("server_fundamentals/DatabaseConnection.php");
$sql = "show tables from ipp where Tables_in_ipp like 'work_order_ui_%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$sql2 = "SHOW COLUMNS FROM ".$row['Tables_in_ipp']." ";
		$sql2 = $conn->query($sql2);
		
		if ($sql2->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row2 = $sql2->fetch_assoc()) {
				if($i <1 ){
				echo('array("'.$row['Tables_in_ipp'].'","'.$row['Tables_in_ipp'].'","'.str_replace('_id',"",$row2['Field']).'"), <br>');	
				$i++;
					
				}
			}
		} else {
			echo "0 results";
		};


    }
} else {
    echo "0 results";
}

die();
/*
left join clients_main on master_wo_client_id = client_id
left join master_work_order_main_identitiy on master_wo_status = mwoid_id
left join user_main on master_wo_lum_id = lum_id
left join work_order_wind_dir on wind_id = master_wo_slit_wind_dir
left join work_order_qty_units on unit_id = master_wo_qty_unit
left join work_order_applications on application_id = master_wo_application_id
left join work_order_ui_structure on master_wo_aaaaaaaaa = structure_id 
left join work_order_ui_customer_location on master_wo_aaaaaaaaa = customer_location_id
left join work_order_ui_lam_end_options on master_wo_aaaaaaaaa = lam_end_options_id
left join work_order_ui_pe_film_feature on master_wo_aaaaaaaaa = pe_film_feature_id

left join work_order_ui_bag_gusset_bottom on master_wo_aaaaaaaaa = gusset_bottom_id
left join work_order_ui_bag_gusset_side on master_wo_aaaaaaaaa = gusset_side_id
left join work_order_ui_bag_handle on master_wo_aaaaaaaaa = bag_handle_id
left join work_order_ui_bag_punch_opts on master_wo_aaaaaaaaa = bag_punch_opts_id
left join work_order_ui_bag_sealing_opts on master_wo_aaaaaaaaa = bag_sealing_opts_id
left join work_order_ui_bag_vest_handle on master_wo_aaaaaaaaa = bag_vest_handle_id

left join work_order_ui_ext_antistatic on master_wo_aaaaaaaaa = anti_id
left join work_order_ui_ext_cof on master_wo_aaaaaaaaa = cof_id
left join work_order_ui_ext_extrude_in on master_wo_aaaaaaaaa = extrude_in_id
left join work_order_ui_ext_layer_type on master_wo_aaaaaaaaa = layer_type_id
left join work_order_ui_ext_options on master_wo_aaaaaaaaa = ext_options_id
left join work_order_ui_ext_treatment on master_wo_aaaaaaaaa = treat_id

left join work_order_ui_pouch_closure_type on master_wo_aaaaaaaaa = pouch_closure_type_id
left join work_order_ui_pouch_corner_type on master_wo_aaaaaaaaa = pouch_corner_type_id
left join work_order_ui_pouch_euro_punch on master_wo_aaaaaaaaa = pouch_euro_punch_id
left join work_order_ui_pouch_gusset_bottom on master_wo_aaaaaaaaa = pouch_gusset_bottom_id
left join work_order_ui_pouch_gusset_side on master_wo_aaaaaaaaa = pouch_gusset_side_id
left join work_order_ui_pouch_hole_punch on master_wo_aaaaaaaaa = pouch_hole_punch_id
left join work_order_ui_pouch_notch_side on master_wo_aaaaaaaaa = pouch_notch_side_id
left join work_order_ui_pouch_pouch_open on master_wo_aaaaaaaaa = pouch_open_id
left join work_order_ui_pouch_seal on master_wo_aaaaaaaaa = pouch_seal_id
left join work_order_ui_pouch_sealing on master_wo_aaaaaaaaa = pouch_sealing_id
left join work_order_ui_pouch_special_tooling on master_wo_aaaaaaaaa = pouch_special_tooling_id
left join work_order_ui_pouch_type on master_wo_aaaaaaaaa = pouch_type_id

left join work_order_ui_print_baseshel on master_wo_aaaaaaaaa = print_baseshel_id
left join work_order_ui_print_cylinder_supplier on master_wo_aaaaaaaaa = cylinder_supplier_id
left join work_order_ui_print_end_options on master_wo_aaaaaaaaa = print_end_options_id
left join work_order_ui_print_eyemark_da on master_wo_aaaaaaaaa = eyemark_da_id
left join work_order_ui_print_eyemark_path on master_wo_aaaaaaaaa = eyemark_path_id
left join work_order_ui_print_ink_sys on master_wo_aaaaaaaaa = ink_sys_id
left join work_order_ui_print_options on master_wo_aaaaaaaaa = print_options_id
left join work_order_ui_print_shadecard_ref_type on master_wo_aaaaaaaaa = shadecard_ref_type_id
left join work_order_ui_print_shadecardreq on master_wo_aaaaaaaaa = shadecardreq_id
left join work_order_ui_print_surfrev on master_wo_aaaaaaaaa = surfrev_id

left join work_order_ui_slitting_core_id_length on master_wo_aaaaaaaaa = slitting_core_id_length_id
left join work_order_ui_slitting_core_id_type on master_wo_aaaaaaaaa = slitting_core_id_type_id
left join work_order_ui_slitting_core_plugs on master_wo_aaaaaaaaa = core_plugs_id
left join work_order_ui_slitting_packing_opts on master_wo_aaaaaaaaa = slitting_packing_opts_id
left join work_order_ui_slitting_pallet on master_wo_aaaaaaaaa = slitting_pallet_id
left join work_order_ui_slitting_pallet_instructions on master_wo_aaaaaaaaa = pallet_instructions_id
left join work_order_ui_slitting_qc_ins on master_wo_aaaaaaaaa = slitting_qc_ins_id
left join work_order_ui_slitting_sticker on master_wo_aaaaaaaaa = slitting_sticker_id
*/
require_once("server_fundamentals/PostDataHeadChecker.php");


$CheckArray = array();
$CheckArray['s_wo_customer_location'] = $essentialOptions[0];	
$CheckArray['s_wo_ex_options'] = $extrusionOptions[0];	
$CheckArray['s_wo_slit_packing'] = $slittingOptions[0];	
$CheckArray['s_wo_print_eyemark_side'] = $printingOptions[0];	
$CheckArray['s_wo_print_end_options'] = $printingOptions[1];	
$CheckArray['s_wo_pouch_type'] = $pouchOptions[0];	
$CheckArray['s_wo_pouch_zip_closure_type'] = $pouchOptions[1];	
$CheckArray['s_wo_bag_sealing'] = $bagsOptions[0];
$CheckArray['s_wo_bag_handle_punch'] = $bagsOptions[1];	
$CheckArray['s_wo_slit_pallet_pack_ins'] = $slittingOptions[1];	
$CheckArray['s_wo_slit_qc_ins'] = $slittingOptions[2];	


$WorkOrderMaster = array(
"s_wo_lum_id"=>$essentialNames[2],
"s_wo_design_id"=>$essentialNames[0],
"s_wo_po"=>$essentialNames[1],
"s_wo_client_id"=>$essentialNames[3],
"s_wo_customer_item_code"=>$essentialNames[5],
"s_wo_delivery_date"=>"work_order_delivery_date",
"s_wo_lwo"=>$essentialNames[6],
"s_wo_structure"=>$essentialNames[7],
"s_wo_final_qty"=>$essentialNames[8],
"s_wo_qty_unit"=>$essentialNames[9],
"s_wo_tolerance_1"=>$essentialNames[10],
"s_wo_tolerance_2"=>$essentialNames[11],
"s_wo_ply"=>"work_order_ply",
"s_wo_application_id"=>$essentialNames[13],
"s_wo_ncr_no"=>$essentialNames[14],
"s_wo_ccr_no"=>$essentialNames[15],
"s_wo_printed_question"=>$essentialNames[17],
"s_wo_inhouse_pe_question"=>$essentialNames[18],
"s_wo_remarks_overall"=>$essentialNames[16],
"s_wo_ex_pe_re"=>$extrusionNames[0],
"s_wo_ex_antistatic"=>$extrusionNames[1],
"s_wo_ex_layer"=>$extrusionNames[2],
"s_wo_ex_pack_weight"=>$extrusionNames[3],
"s_wo_ex_pkg_size"=>$extrusionNames[4],
"s_wo_ex_qty_units"=>$extrusionNames[5],
"s_wo_ex_thickness"=>$extrusionNames[6],
"s_wo_ex_treatment"=>$extrusionNames[7],
"s_wo_ex_roll_od"=>$extrusionNames[8],
"s_wo_ex_extrude_in"=>$extrusionNames[9],
"s_wo_ex_film_color"=>$extrusionNames[10],
"s_wo_ex_cof"=>$extrusionNames[11],
"s_wo_ext_cof_i2i"=>$extrusionNames[12],
"s_wo_ext_cof_o2o"=>$extrusionNames[13],
"s_wo_ext_cof_o2m"=>$extrusionNames[14],
"s_wo_ext_cof_i2m"=>$extrusionNames[15],
"s_wo_ext_pe_film_feature"=>$extrusionNames[16],
"s_wo_ext_dyne"=>$extrusionNames[17],
"s_wo_ext_single_coil_w"=>$extrusionNames[18],
"s_wo_ext_no_ups"=>$extrusionNames[19],
"s_wo_ext_jumbo_f_w"=>$extrusionNames[20],
"s_wo_ext_recycle_p"=>$extrusionNames[21],
"s_wo_remarks_ext"=>$extrusionNames[22],
"s_wo_print_design"=>$printingNames[0],
"s_wo_print_cylinder_supplier"=>$printingNames[1],
"s_wo_print_surface_reverse"=>$printingNames[2],
"s_wo_print_qty"=>$printingNames[3],
"s_wo_print_units"=>$printingNames[4],
"s_wo_print_substrate"=>$printingNames[5],
"s_wo_print_single_coil_width"=>$printingNames[6],
"s_wo_print_ups_val"=>$printingNames[7],
"s_wo_print_trim_val"=>$printingNames[8],
"s_wo_print_single_coil_circ"=>$printingNames[9],
"s_wo_print_accross_val"=>$printingNames[10],
"s_wo_print_bleed_val"=>$printingNames[11],
"s_wo_print_shade_card_needed"=>$printingNames[12],
"s_wo_print_color_ref_type"=>$printingNames[13],
"s_wo_print_eyemark_color"=>$printingNames[14],
"s_wo_print_size"=>$printingNames[15],
"s_wo_print_eyemark_path"=>$printingNames[16],
"s_wo_print_approvalby"=>$printingNames[17],
"s_wo_print_plate_cyl_pr"=>$printingNames[18],
"s_wo_print_ink_system"=>$printingNames[19],
"s_wo_print_baseshel"=>$printingNames[20],
"s_wo_print_ink_gsm"=>$printingNames[21],
"s_wo_print_pantone_1"=>$printingNames[22],
"s_wo_print_pantone_2"=>$printingNames[23],
"s_wo_print_pantone_3"=>$printingNames[24],
"s_wo_print_pantone_4"=>$printingNames[25],
"s_wo_print_pantone_5"=>$printingNames[26],
"s_wo_print_pantone_6"=>$printingNames[27],
"s_wo_print_pantone_7"=>$printingNames[28],
"s_wo_print_pantone_8"=>$printingNames[29],
"s_wo_remarks_print"=>$printingNames[30],
"s_wo_lam_lam_sleeve"=>$laminationNames[0],
"s_wo_remarks_lam"=>$laminationNames[1],
"s_wo_pouch_qty"=>$pouchNames[0],
"s_wo_pouch_unit"=>$pouchNames[1],
"s_wo_pouch_width"=>$pouchNames[2],
"s_wo_pouch_length"=>$pouchNames[3],
"s_wo_pouch_gus_side"=>$pouchNames[4],
"s_wo_pouch_gus_bot"=>$pouchNames[5],
"s_wo_pouch_seal_width"=>$pouchNames[6],
"s_wo_pouch_side_gus_w"=>$pouchNames[7],
"s_wo_pouch_side_gus_l"=>$pouchNames[8],
" s_wo_pouch_bot_gus_w "=>$pouchNames[9],
"s_wo_pouch_bot_gus_l"=>$pouchNames[10],
"s_wo_pouch_euro_punch"=>$pouchNames[11],
"s_wo_pouch_open"=>$pouchNames[12],
"s_wo_pouch_corner_type"=>$pouchNames[13],
"s_wo_pouch_seal_type"=>$pouchNames[14],
"s_wo_pouch_zip_dist_top"=>$pouchNames[15],
"s_wo_pouch_notch_side"=>$pouchNames[16],
"s_wo_pouch_notch_dist_top"=>$pouchNames[17],
"s_wo_pouch_notch_dist_side"=>$pouchNames[18],
"s_wo_pouch_hole_punch"=>$pouchNames[19],
"s_wo_pouch_hole_punch_dia"=>$pouchNames[20],
"s_wo_pouch_special_tooling"=>$pouchNames[21],
"s_wo_remarks_pouch" => $pouchNames[22],
"s_wo_bag_qty"=>$bagsNames[0],
"s_wo_bag_units"=>$bagsNames[1],
"s_wo_bag_width"=>$bagsNames[2],
"s_wo_bag_length"=>$bagsNames[3],
"s_wo_bag_gus_s_w"=>$bagsNames[4],
"s_wo_bag_gus_s_l"=>$bagsNames[5],
"s_wo_bag_gus_b_w"=>$bagsNames[6],
"s_wo_bag_gus_b_l"=>$bagsNames[7],
"s_wo_bag_handle_dist_top"=>$bagsNames[8],
"s_wo_bag_handle_w"=>$bagsNames[9],
"s_wo_bag_handle_l"=>$bagsNames[10],
"s_wo_bag_thick"=>$bagsNames[11],
"s_wo_bag_gusset_side_type"=>$bagsNames[12],
"s_wo_bag_gusset_bottom_type"=>$bagsNames[13],
"s_wo_bag_top_fold"=>$bagsNames[14],
"s_wo_bag_flap"=>$bagsNames[15],
"s_wo_bag_lip"=>$bagsNames[16],
"s_wo_bag_handle_type"=>$bagsNames[17],
"s_wo_bag_vest_hande_type"=>$bagsNames[18],
"s_wo_bag_spl_dia"=>$bagsNames[19],
"s_wo_remarks_bag" => $bagsNames[20],
"s_wo_slit_s_width"=>$slittingNames[0],
"s_wo_slit_wind_dir"=>$slittingNames[1],
"s_wo_slit_roll_od"=>$slittingNames[2],
"s_wo_slit_wt"=>$slittingNames[3],
"s_wo_slit_mtr"=>$slittingNames[4],
"s_wo_slit_pallet"=>$slittingNames[5],
"s_wo_slit_sticker"=>$slittingNames[6],
"s_wo_slit_pallet_length"=>$slittingNames[7],
"s_wo_slit_pallet_width"=>$slittingNames[8],
"s_wo_slit_pallet_height"=>$slittingNames[9],
"s_wo_slit_core_id"=>$slittingNames[10],
"s_wo_slit_core_type"=>$slittingNames[11],
"s_wo_slit_core_plugs"=>$slittingNames[12],
"s_wo_slit_reel_flag_col"=>$slittingNames[13],
"s_wo_slit_qc_max_jointrolls"=>$slittingNames[14],
"s_wo_remarks_slit"=>$slittingNames[15]);	
echo '	$straightArrays = array(<br>
';
foreach($WorkOrderMaster as $k=>$v){
	echo	'"'.str_replace("s_wo_","master_wo_",$k).'"=>$Draft["'.$k.'"],<br> '; 
	/*
if ((strpos($v, '_4_') == false) && (strpos($v, '_3_') == false) && (strpos($v, '_5_') == false ) && (strpos($v, '_remarks_') == false )) { 
	echo	'"'.$v.'"=>"'.$k.'",<br> ';
}
*/
}

echo ');';

