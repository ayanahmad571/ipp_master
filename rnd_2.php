
<?php
include("server_fundamentals/FunctionsController.php");


$string = "lum_id|lum_user_type|lum_code|lum_email|lum_hash|lum_name
1|2|MD-1|intgpack@eim.ae|abc|Ahmed S.
2|20|S-03|mohammed.nasrullah@ipp.ae|abc|Nasrullah
3|4|S-21|ritesh.tak@ipp.ae|abc|Ritesh 
4|4|S-22|ankit.kumar@ipp.ae|abc|Ankit
5|4|S-25|upashna.s@ipp.ae|abc|Upashna
6|4|NA|pulkit.jain@ipp.ae|abc|Pulkit
7|4|S-17|alihasan@ipp.ae|abc|Ali
8|20|S-02|malik.tauqeer@ipp.ae|abc|Malik
9|4|S-26|Madina.ayazbayeva@ipp.ae|abc|Madina
10|4|S-13|shivang.sharma@ipp.ae|abc|Shivang
11|4|S-19 M|navneet.behl@ipp.ae|abc|Navneet
12|4|NA|rahil.asif@ipp.ae|abc|Rahil
13|4|S-11 Abrey|abrey.page@ipp.ae|abc|Abrey 
14|4|S-11|arjun.chitra@ipp.ae|abc|Arjun
15|4|S-18|basel.meaari@ipp.ae|abc|Basel
16|4|S-19E|ian.crofts@ipp.ae|abc|Ian
17|1|S-24|abid.r@ipp.ae|abc|Abid
18|15|NA|accounts.receivable@ipp.ae|abc|Accounts R.
19|5|NA|jayachandran@ipp.ae|abc|JC
20|17|NA|qc.manager@ipp.ae|abc|Bipin
21|17|NA|manoj.pandey@ipp.ae|abc|MP
22|3|NA|steven.baretto@ipp.ae|abc|Steven
23|7|NA|ppc@ipp.ae|abc|Shakil
24|2|MD-2|shahid@ipp.ae|abc|Shahid S.";


$ex = explode("
",$string);
echo 'INSERT INTO `user_main`(`lum_user_type`, `lum_code`, `lum_email`, `lum_hash`, `lum_name`, `lum_dnt`) VALUES <br>';
foreach($ex as $str){
	$us = explode('|', $str);
	
	echo '("'.$us[1].'","'.$us[2].'","'.$us[3].'","'.genHash($us[3],$us[4]).'","'.$us[5].'","'.time().'"),<br>';
}


die();
$arrayHolder = array(

	array("Work Order Applications", "work_order_applications", "application"),
	array("Work Order Pack Size Unit", "work_order_pack_size_unit", "psu"),
	array("Work Order Product Type Printed", "work_order_product_type_printed", "ptp"),
	array("Work Order Qty Units", "work_order_qty_units", "unit"),
	array("Bag Handle", "work_order_ui_bag_handle", "bag_handle"),
	array("Customer Location", "work_order_ui_customer_location", "customer_location"),
	array("Ext Cof", "work_order_ui_ext_cof", "cof"),
	array("Filling Temp", "work_order_ui_filling_temp", "filling_temp"),
	array("Foil Print Side", "work_order_ui_foil_print_side", "foil_print_side"),
	array("Lam Options", "work_order_ui_lam_options", "lamo"),
	array("Pallet Size", "work_order_ui_pallet_size", "pallet_size"),
	array("Pe Film Feature", "work_order_ui_pe_film_feature", "pe_film_feature"),
	array("Pouch Bag Fill Opts", "work_order_ui_pouch_bag_fill_opts", "pbfo"),
	array("Pouch Euro Punch", "work_order_ui_pouch_euro_punch", "euro"),
	array("Pouch Lap Fin", "work_order_ui_pouch_lap_fin", "lap_fin"),
	array("Pouch Pack Ins", "work_order_ui_pouch_pack_ins", "pouch_pack_ins"),
	array("Pouch Pe Strip", "work_order_ui_pouch_pe_strip", "pestrip"),
	array("Pouch Punch Type", "work_order_ui_pouch_punch_type", "punch"),
	array("Pouch Round Corner", "work_order_ui_pouch_round_corner", "round_corner"),
	array("Pouch Tear Notch", "work_order_ui_pouch_tear_notch", "tear_notch"),
	array("Pouch Tear Notch Qty", "work_order_ui_pouch_tear_notch_qty", "tear_notch_qty"),
	array("Pouch Tear Notch Side", "work_order_ui_pouch_tear_notch_side", "tear_notch_side"),
	array("Pouch Zipper", "work_order_ui_pouch_zipper", "zipper"),
	array("Pouch Zipper Opc", "work_order_ui_pouch_zipper_opc", "zipopc"),
	array("Print End Options", "work_order_ui_print_end_options", "print_end_opts"),
	array("Print Options", "work_order_ui_print_options", "print_options"),
	array("Print Shadecard Ref Type", "work_order_ui_print_shadecard_ref_type", "shadecard_ref_type"),
	array("Print Shadecardreq", "work_order_ui_print_shadecardreq", "shadecardreq"),
	array("Print Surfrev", "work_order_ui_print_surfrev", "surfrev"),
	array("Repeat Types", "work_order_ui_repeat_types", "rept"),
	array("Roll Options", "work_order_ui_roll_options", "rollopts"),
	array("Shipment", "work_order_ui_shipment", "shipment"),
	array("Slitting Core Id Length", "work_order_ui_slitting_core_id_length", "slitting_core_id_length"),
	array("Slitting Core Id Type", "work_order_ui_slitting_core_id_type", "slitting_core_id_type"),
	array("Slitting Core Plugs", "work_order_ui_slitting_core_plugs", "core_plugs"),
	array("Slitting Freight Ins", "work_order_ui_slitting_freight_ins", "freight"),
	array("Slitting Laser Config", "work_order_ui_slitting_laser_config", "laser"),
	array("Slitting Pack Ins", "work_order_ui_slitting_pack_ins", "pack_ins"),
	array("Slitting Packing Opts", "work_order_ui_slitting_packing_opts", "slitting_packing_opts"),
	array("Slitting Pallet", "work_order_ui_slitting_pallet", "slitting_pallet"),
	array("Slitting Pallet Instructions", "work_order_ui_slitting_pallet_instructions", "pallet_instructions"),
	array("Slitting Qc Ins", "work_order_ui_slitting_qc_ins", "slitting_qc_ins"),
	array("Slitting Shipping Dets", "work_order_ui_slitting_shipping_dets", "shipping_dets"),
	array("Structure", "work_order_ui_structure", "structure"),
	array("Work Order Wind Dir", "work_order_wind_dir", "wind")


);


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

die();
require_once("server_fundamentals/DatabaseConnection.php");

$get = mysqlSelect("SELECT g.table_name, (SELECT dd.COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS dd WHERE TABLE_NAME = g.table_name and dd.table_schema = 'IPP' limit 1 ) as nn FROM information_schema.tables g WHERE table_schema = 'IPP' ");
foreach($get as $Sing){
	echo 'array("'.trim(ucwords(str_replace("_"," ",str_replace("work_order_ui_"," ",$Sing['table_name'])))).'", "'.$Sing['table_name'].'", "'.str_replace("_id","",$Sing['nn']).'"),<br>';
}
die();

$str = '{"45":"7","46":"8","47":"9","48":"10","49":"11","50":"12","51":"13","52":"14"}';
$js = json_decode($str);
var_dump(($js->{45}));
$result = array_values(json_decode($str, true));
var_dump(($result));


$js[45];
die();

  $c = 1;
  foreach ($getWO as $key => $value) {
	echo 'getTableTD("'.$key.' - ".$getWO["'.$key.'"]);
	<br>';

	if($c%4 ==0){
	  echo '
	  ?&gt;
	  <br>
	  &lt;/tr&gt;
	  &lt;tr&gt;
	  &lt;?php <br>';
	}

	$c++;
  }
die();


die();
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

