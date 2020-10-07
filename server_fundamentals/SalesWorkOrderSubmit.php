<?php
require_once("SessionHandler.php");
require_once("PostDataHeadChecker.php");

if(isset($_POST['work_order_edit_draft_id'])){
	if(is_numeric($_POST['work_order_edit_draft_id'])){
		$getDraftWork = mysqlSelect("SELECT s_wo_id FROM `sales_work_order_main` 
		where s_wo_status = 1 
		".$inColsDRAFT."
		and s_wo_id = ".$_POST['work_order_edit_draft_id']);
		
		if(!is_array($getDraftWork)){
			die("Editing Draft not Found.");
		}

	} else{
			die("Editing Draft Invalid ID.");
		}
}

#check Essentials
$doEssentailsModule = true;

$WorkOrderBags =array();
$WorkOrderExtrusion = array();
$WorkOrderLamination = array();
$WorkOrderMaster  = array();
$WorkOrderPrinting = array();
$WorkOrderSlitting = array();
$WorkOrderPouch = array();

$plyNumber = $_POST[$essentialNames[12]];
//checkPly
if($plyNumber >5 || $plyNumber < 1){
	die("PLY Value not in range [1,5]");
}

$ext = false;

if($doEssentailsModule){


		checkPost($essentialNames);
		checkString($essentialNames);
		
		#check for the Layers in essentials since they are not included in the Essential Checkers
		for($counter1 = 1; $counter1 <= $plyNumber; $counter1++){
			
			if(!isset($_POST['work_order_layer_'.$counter1.'_micron'])){
				die('Missing Value of Layer '.$counter1.' Micron ');
			}
			if(!isset($_POST['work_order_5_layer_'.$counter1.'_material'])){
				die('Missing Value of Layer '.$counter1.' Structure ');
			}
		}
		
		
		//user type_check only sales and MD people can make this WO
		if(!in_array($USER_ARRAY['user_type_id'], array(1,2,4,10,16))){
			die('User Not Authorized');
		}
		
		//checkNumeric
		checkNumeric(array($essentialNames[8],$essentialNames[12], $essentialNames[10], $essentialNames[11]));
		
		for($counter1 = 1; $counter1 <= $plyNumber; $counter1++){
			
			if(!is_numeric($_POST['work_order_layer_'.$counter1.'_micron'])){
				die('Invalid Numeric Value of Layer '.$counter1.' Micron ');
			}
		}
		
		//Check if the posted options are numeric
		if(isset($_POST[$essentialOptions[0]])){
			foreach($_POST[$essentialOptions[0]] as $exP){
				if(!is_numeric($exP)){
					die("Invalid Customer Location Options");
				}
			}
		}
		
		//check Customer Code
		selectChecker("SELECT * FROM `clients_main` where client_id = ".$_POST[$essentialNames[3]],'Client Not Found','mysqlSelect');
		
		//check if Sales ID is OK
		selectChecker($getAttachedTreeSql." and lum_id = ".$_POST[$essentialNames[2]],"Invalid Sales ID",'mysqlSelect');
		
		//check delivery date
		$date_created = date_create_from_format("d-m-Y @ H:i:s",$_POST[$essentialNames[4]].' @ 15:40:00');
		if(!empty($date_created)){
		$obj = get_object_vars($date_created);
		}else{
			die("Invalid Delivery Date Format");
		}
		
		$checkDeliveryDate = strtotime($obj['date']);
		if($checkDeliveryDate < time()){
			die("Invalid Delivery Date, Date Must be in the Future");
		}
		
		
		
		//checkStructureOptGroup
		selectChecker("SELECT * FROM `work_order_ui_structure` where structure_id = ".$_POST[$essentialNames[7]],'Structure Not Found','mysqlSelect');
		
		//checkQtyUnit
		selectChecker("SELECT * FROM `work_order_qty_units`  where unit_id = ".$_POST[$essentialNames[9]],'Unit Not Found','mysqlSelect');
		
		
		//checkApplication
		selectChecker("SELECT * FROM `work_order_applications`  where application_id = ".$_POST[$essentialNames[13]],'Application Not Found','mysqlSelect');
		
		
		for($counter1 = 1; $counter1 <= $plyNumber; $counter1++){
			//checkLayerStructure
			selectChecker("SELECT * FROM `materials_main`  where material_id= ".$_POST['work_order_5_layer_'.$counter1.'_material'],'Structure Not Found for Layer-'.$counter1,'mysqlSelect');
			$valFilmID = $_POST['work_order_5_layer_'.$counter1.'_material'];
			
			if($valFilmID ==4 || $valFilmID ==5 || $valFilmID ==36 ){
				$ext = true;
			}		
			
		}
		
		//Check if the posted options are valid
		if(isset($_POST[$essentialOptions[0]])){
			foreach($_POST[$essentialOptions[0]] as $exP){
				//check Antistatic
				selectChecker("SELECT * FROM `work_order_ui_customer_location` where customer_location_show = 1 and customer_location_id = ".$exP ,
				'Customer Location Option Value at ID= '.$exP.' Not Found',
				'mysqlSelect');
			}
		}
	
		//checkPrinted and CheckIn house PE
		if(!inRange($_POST[$essentialNames[17]],0,1,true)){
			die("Invalid Values for -> Is The order printed ");
		}
		
		if(!inRange($_POST[$essentialNames[18]],0,1,true)){
			die("Invalid Values for -> In house PE");
		}
		

		$WorkOrderMaster = array(
		"s_wo_lum_id"=>$_POST[$essentialNames[2]],
		"s_wo_design_id"=>$_POST[$essentialNames[0]],
		"s_wo_po"=>$_POST[$essentialNames[1]],
		"s_wo_client_id"=>$_POST[$essentialNames[3]],
		"s_wo_customer_item_code"=>$_POST[$essentialNames[5]],
		"s_wo_delivery_date"=>$checkDeliveryDate,
		"s_wo_lwo"=>$_POST[$essentialNames[6]],
		"s_wo_structure"=>$_POST[$essentialNames[7]],
		"s_wo_final_qty"=>$_POST[$essentialNames[8]],
		"s_wo_qty_unit"=>$_POST[$essentialNames[9]],
		"s_wo_tolerance_1"=>$_POST[$essentialNames[10]],
		"s_wo_tolerance_2"=>$_POST[$essentialNames[11]],
		"s_wo_ply"=>$plyNumber,
		"s_wo_application_id"=>$_POST[$essentialNames[13]],
		"s_wo_ncr_no"=>$_POST[$essentialNames[14]],
		"s_wo_ccr_no"=>$_POST[$essentialNames[15]],
		"s_wo_printed_question"=>$_POST[$essentialNames[17]],
		"s_wo_inhouse_pe_question"=>$_POST[$essentialNames[18]],
		"s_wo_remarks_overall"=>$_POST[$essentialNames[16]]);
		
		for($counter1 = 1; $counter1 <= $plyNumber; $counter1++){
			//checkLayerStructure
			$WorkOrderMaster['s_wo_layer_'.$counter1.'_micron'] = $_POST['work_order_layer_'.$counter1.'_micron'];
			$WorkOrderMaster['s_wo_layer_'.$counter1.'_structure'] = $_POST['work_order_5_layer_'.$counter1.'_material'];
		}
		
		//Check if the posted options are numeric
		if(isset($_POST[$essentialOptions[0]])){
			$WorkOrderMaster['s_wo_customer_location'] = implode(',',$_POST[$essentialOptions[0]]);	
		}
		
		$doExtrusionModule = $ext;
		$doPrintingModule = ($_POST[$essentialNames[17]] == 1);
		$doLaminationModule = ($plyNumber > 1 );
		$doBagsModule = ($_POST[$essentialNames[7]] == 1);
		$doPouchModule = ($_POST[$essentialNames[7]] == 2);
		$doSlittingModule = true;
		
}

#Check Extrusion
if($doExtrusionModule){
	checkPost($extrusionNames);
	checkString($extrusionNames);

	//Check if the posted options are numeric
	if(isset($_POST[$extrusionOptions[0]])){
		foreach($_POST[$extrusionOptions[0]] as $exP){
			if(!is_numeric($exP)){
				die("Invalid Extrusion Options");
			}
		}
	}

	//Check if the posted options are numeric
	if(isset($_POST[$extrusionOptions[0]])){
		foreach($_POST[$extrusionOptions[0]] as $exP){
			//check Antistatic
			selectChecker("SELECT * FROM `work_order_ui_ext_options` where ext_options_show = 1 and ext_options_id = ".$exP ,
			'Extrusion Option Value at ID= '.$exP.' Not Found',
			'mysqlSelect');
		}
	}

	//check Antistatic
	selectChecker("SELECT * FROM `work_order_ui_ext_antistatic` where anti_show = 1 and anti_id = ".$_POST[$extrusionNames[1]],
	'Extrusuion - Antistatic Option Value Not Found',
	'mysqlSelect');

	//check Layer Type
	selectChecker("SELECT * FROM `work_order_ui_ext_layer_type` where layer_type_show = 1 and layer_type_id = ".$_POST[$extrusionNames[2]],
	'Extrusuion - Layer Type Value Not Found',
	'mysqlSelect');

	//check Pack Units
	selectChecker("SELECT * FROM `work_order_qty_units` where unit_show = 1 and unit_id = ".$_POST[$extrusionNames[5]],
	'Extrusuion - Units Not Found',
	'mysqlSelect');

	//check Treatment
	selectChecker("SELECT * FROM `work_order_ui_ext_treatment` where treat_show = 1 and treat_id = ".$_POST[$extrusionNames[7]],
	'Extrusuion - Treatment Value Not Found',
	'mysqlSelect');

	//check ExtrudeIN
	selectChecker("SELECT * FROM `work_order_ui_ext_extrude_in` where extrude_in_show = 1 and extrude_in_id = ".$_POST[$extrusionNames[9]],
	'Extrusuion - Extrude In Value Not Found',
	'mysqlSelect');

	//check COF
	selectChecker("SELECT * FROM `work_order_ui_ext_cof` where cof_show = 1 and cof_id = ".$_POST[$extrusionNames[11]],
	'Extrusuion - COF Value Not Found',
	'mysqlSelect');
	
	//check COF
	selectChecker("SELECT * FROM `work_order_ui_pe_film_feature` where pe_film_feature_show = 1 and pe_film_feature_id = ".$_POST[$extrusionNames[16]],
	'Extrusuion - PE Film Feature Not Found',
	'mysqlSelect');

	$WorkOrderExtrusion = array(
	"s_wo_ex_pe_re"=>$_POST[$extrusionNames[0]],
	"s_wo_ex_antistatic"=>$_POST[$extrusionNames[1]],
	"s_wo_ex_layer"=>$_POST[$extrusionNames[2]],
	"s_wo_ex_pack_weight"=>$_POST[$extrusionNames[3]],
	"s_wo_ex_pkg_size"=>$_POST[$extrusionNames[4]],
	"s_wo_ex_qty_units"=>$_POST[$extrusionNames[5]],
	"s_wo_ex_thickness"=>$_POST[$extrusionNames[6]],
	"s_wo_ex_treatment"=>$_POST[$extrusionNames[7]],
	"s_wo_ex_roll_od"=>$_POST[$extrusionNames[8]],
	"s_wo_ex_extrude_in"=>$_POST[$extrusionNames[9]],
	"s_wo_ex_film_color"=>$_POST[$extrusionNames[10]],
	"s_wo_ex_cof"=>$_POST[$extrusionNames[11]],
	"s_wo_ext_cof_i2i"=>$_POST[$extrusionNames[12]],
	"s_wo_ext_cof_o2o"=>$_POST[$extrusionNames[13]],
	"s_wo_ext_cof_o2m"=>$_POST[$extrusionNames[14]],
	"s_wo_ext_cof_i2m"=>$_POST[$extrusionNames[15]],
	"s_wo_ext_pe_film_feature"=>$_POST[$extrusionNames[16]],
	"s_wo_ext_dyne"=>$_POST[$extrusionNames[17]],
	"s_wo_ext_single_coil_w"=>$_POST[$extrusionNames[18]],
	"s_wo_ext_no_ups"=>$_POST[$extrusionNames[19]],
	"s_wo_ext_jumbo_f_w"=>$_POST[$extrusionNames[20]],
	"s_wo_ext_recycle_p"=>$_POST[$extrusionNames[21]],
	"s_wo_remarks_ext"=>$_POST[$extrusionNames[22]]);
	
	
	//Check if the posted options are numeric
	if(isset($_POST[$extrusionOptions[0]])){
		$WorkOrderExtrusion['s_wo_ex_options'] = implode(',',$_POST[$extrusionOptions[0]]);	
	}




}

#Check Printing
if($doPrintingModule){
	checkPost($printingNames);
	checkString($printingNames);

	

	//Check if the posted options are numeric and are valid
	if(isset($_POST[$printingOptions[0]])){
		foreach($_POST[$printingOptions[0]] as $exP){
			if(!is_numeric($exP)){
				die("Printing - Invalid Eyemark Side");
			}else{
				selectChecker("SELECT * FROM `work_order_ui_print_eyemark_da` where eyemark_da_show = 1 and eyemark_da_id = ".$exP ,
				'Printing -  EyeMarkSide Options - Value at ID= '.$exP.' Not Found',
				'mysqlSelect');
			}
		}
	}

	//Check if the posted options are numeric
	if(isset($_POST[$printingOptions[1]])){
		foreach($_POST[$printingOptions[1]] as $exP){
			if(!is_numeric($exP)){
				die("Printing - Invalid End Options");
			}else{
				selectChecker("SELECT * FROM `work_order_ui_print_end_options` where print_end_options_show = 1 and print_end_options_id = ".$exP ,
				'Printing -  End Options - Value at ID= '.$exP.' Not Found',
				'mysqlSelect');
			}
		}
	}


	//0,4,5,9,10
	
	//check Print Type
	selectChecker("SELECT * FROM `work_order_ui_print_cylinder_supplier` 
	where cylinder_supplier_show = 1 
	and cylinder_supplier_id = ".$_POST[$printingNames[1]],
	'Printing - Cylinder Supplier Option Value Not Found',
	'mysqlSelect');

	//check SurfaceRev Type
	selectChecker("SELECT * FROM `work_order_ui_print_surfrev` 
	where surfrev_show = 1 
	and surfrev_id = ".$_POST[$printingNames[2]],
	'Printing - Print Surface/Reverse Option Value Not Found',
	'mysqlSelect');

	//check SurfaceRev Type
	selectChecker("SELECT * FROM `work_order_qty_units` 
	where unit_show = 1 
	and unit_id = ".$_POST[$printingNames[4]],
	'Printing - Print Units Option Value Not Found',
	'mysqlSelect');

	//check ShadeCardNeeded
	selectChecker("SELECT * FROM `work_order_ui_print_shadecardreq` 
	where shadecardreq_show = 1 
	and shadecardreq_id = ".$_POST[$printingNames[12]],
	'Printing - Shade Card Option Value Not Found',
	'mysqlSelect');

	//check Tubesheet
	selectChecker("SELECT * FROM `work_order_ui_print_shadecard_ref_type` 
	where shadecard_ref_type_show = 1 
	and shadecard_ref_type_id = ".$_POST[$printingNames[13]],
	'Printing - Color Reference Type Option Value Not Found',
	'mysqlSelect');
	
	//check Tubesheet
	selectChecker("SELECT * FROM `work_order_ui_print_eyemark_path` 
	where eyemark_path_show = 1 
	and eyemark_path_id = ".$_POST[$printingNames[16]],
	'Printing - Eyemark Path Show Value Not Found',
	'mysqlSelect');
	
	//check Tubesheet
	selectChecker("SELECT * FROM `work_order_ui_print_options` 
	where print_options_show = 1 
	and print_options_id = ".$_POST[$printingNames[17]],
	'Printing - Print Approval Option Value Not Found',
	'mysqlSelect');
	
	//check Tubesheet
	selectChecker("SELECT * FROM `work_order_ui_print_ink_sys` 
	where ink_sys_show = 1 
	and ink_sys_id = ".$_POST[$printingNames[19]],
	'Printing - Ink System Option Value Not Found',
	'mysqlSelect');
	
	//check Tubesheet
	selectChecker("SELECT * FROM `work_order_ui_print_baseshel` 
	where print_baseshel_show = 1 
	and print_baseshel_id = ".$_POST[$printingNames[20]],
	'Printing - Base Shel Option Value Not Found',
	'mysqlSelect');
	
	$PrintingEyeSize = str_replace(' ', '', $_POST[$printingNames[15]]);
	
	if(substr_count($PrintingEyeSize,"x") != 1){
		die("Eyemark Size (mm) Format Invalid, Missing 'x'");
	}

	/**/

	$pEyeScheck = explode("x",$PrintingEyeSize);
	if(!is_numeric($pEyeScheck[0])){
		die("Eyemark Size (mm) Format Invalid, Left side not Numeric");
	}
	if(!is_numeric($pEyeScheck[1])){
		die("Eyemark Size (mm) Format Invalid, Right side not Numeric");
	}

	$WorkOrderPrinting= array(
	"s_wo_print_design"=>$_POST[$printingNames[0]],
	"s_wo_print_cylinder_supplier"=>$_POST[$printingNames[1]],
	"s_wo_print_surface_reverse"=>$_POST[$printingNames[2]],
	"s_wo_print_qty"=>$_POST[$printingNames[3]],
	"s_wo_print_units"=>$_POST[$printingNames[4]],
	"s_wo_print_substrate"=>$_POST[$printingNames[5]],
	"s_wo_print_single_coil_width"=>$_POST[$printingNames[6]],
	"s_wo_print_ups_val"=>$_POST[$printingNames[7]],
	"s_wo_print_trim_val"=>$_POST[$printingNames[8]],
	"s_wo_print_single_coil_circ"=>$_POST[$printingNames[9]],
	"s_wo_print_accross_val"=>$_POST[$printingNames[10]],
	"s_wo_print_bleed_val"=>$_POST[$printingNames[11]],
	"s_wo_print_shade_card_needed"=>$_POST[$printingNames[12]],
	"s_wo_print_color_ref_type"=>$_POST[$printingNames[13]],
	"s_wo_print_eyemark_color"=>$_POST[$printingNames[14]],
	"s_wo_print_size"=>$_POST[$printingNames[15]],
	"s_wo_print_eyemark_path"=>$_POST[$printingNames[16]],
	"s_wo_print_approvalby"=>$_POST[$printingNames[17]],
	"s_wo_print_plate_cyl_pr"=>$_POST[$printingNames[18]],
	"s_wo_print_ink_system"=>$_POST[$printingNames[19]],
	"s_wo_print_baseshel"=>$_POST[$printingNames[20]],
	"s_wo_print_ink_gsm"=>$_POST[$printingNames[21]],
	"s_wo_print_pantone_1"=>$_POST[$printingNames[22]],
	"s_wo_print_pantone_2"=>$_POST[$printingNames[23]],
	"s_wo_print_pantone_3"=>$_POST[$printingNames[24]],
	"s_wo_print_pantone_4"=>$_POST[$printingNames[25]],
	"s_wo_print_pantone_5"=>$_POST[$printingNames[26]],
	"s_wo_print_pantone_6"=>$_POST[$printingNames[27]],
	"s_wo_print_pantone_7"=>$_POST[$printingNames[28]],
	"s_wo_print_pantone_8"=>$_POST[$printingNames[29]],
	"s_wo_remarks_print"=>$_POST[$printingNames[30]]);	
	
	//Insert Posted Options into Master Array
	if(isset($_POST[$printingOptions[0]])){
		$WorkOrderPrinting['s_wo_print_eyemark_side'] = implode(',',$_POST[$printingOptions[0]]);	
	}

	if(isset($_POST[$printingOptions[1]])){
		$WorkOrderPrinting['s_wo_print_end_options'] = implode(',',$_POST[$printingOptions[1]]);	
	}



}

#check Lamination
if($doLaminationModule){
	$plyNumberforLam = $plyNumber;
 
	checkPost($laminationNames);
	checkString($laminationNames);

	#check for the Layers in essentials
	for($counter1 = 1; $counter1 <= $plyNumberforLam; $counter1++){
		
		if(!isset($_POST['work_order_lamination_layer_'.$counter1.'_film_width'])){
			die('Missing Value of Lamination Layer  '.$counter1.' FILM Width ');
		}
		if(!isset($_POST['work_order_lamination_layer_'.$counter1.'_kgs'])){
			die('Missing Value of Lamination Layer  '.$counter1.' KGS ');
		}
		if(!isset($_POST['work_order_lamination_layer_'.$counter1.'_mtr'])){
			die('Missing Value of Lamination Layer '.$counter1.' MTR ');
		}
		
		if(($counter1+1) <= $plyNumberforLam){
			if(!isset($_POST['work_order_lamination_pass_'.$counter1.'_desc_1'])){
				die('Missing Value of Pass Number  '.$counter1.' Description 1');
			}
			if(!isset($_POST['work_order_lamination_pass_'.$counter1.'_desc_2'])){
				die('Missing Value of Pass Number '.$counter1.' Description 2');
			}
		}
		
	}

	

	//Check if the posted options are numeric and are valid
	if(isset($_POST[$laminationOptions[0]])){
		foreach($_POST[$laminationOptions[0]] as $exP){
			if(!is_numeric($exP)){
				die("Lamination - Invalid End Options ");
			}else{
				selectChecker("SELECT * FROM `work_order_ui_lam_end_options` 
				where lam_end_options_show = 1 
				and lam_end_options_id = ".$exP ,
				'Lamination -  End Options - Value at ID '.$exP.' Not Found',
				'mysqlSelect');
			}
		}
	}
	
	$WorkOrderLamination= array(
	"s_wo_lam_lam_sleeve"=>$_POST[$laminationNames[0]],
	"s_wo_remarks_lam"=>$_POST[$laminationNames[1]]
	);	

	#check for the Layers in essentials
	for($counterL = 1; $counterL <= $plyNumberforLam; $counterL++){

		$WorkOrderLamination['s_wo_lam_f'.$counterL.'_width'] = $_POST['work_order_lamination_layer_'.$counterL.'_film_width'];	
		$WorkOrderLamination['s_wo_lam_f'.$counterL.'_kgs'] = $_POST['work_order_lamination_layer_'.$counterL.'_kgs'];
		$WorkOrderLamination['s_wo_lam_f'.$counterL.'_mtr'] = $_POST['work_order_lamination_layer_'.$counterL.'_mtr'];

		
		if(($counterL+1) <= $plyNumberforLam){
			$WorkOrderLamination['s_wo_lam_p'.$counterL.'_desc_1'] = $_POST['work_order_lamination_pass_'.$counterL.'_desc_1'];	
			$WorkOrderLamination['s_wo_lam_p'.$counterL.'_desc_2'] = $_POST['work_order_lamination_pass_'.$counterL.'_desc_2'];
		}
	
	}

	//Insert Posted Options into Master Array
	if(isset($_POST[$laminationOptions[0]])){
		$WorkOrderLamination['s_wo_lam_options'] = implode(',',$_POST[$laminationOptions[0]]);	
	}
	

}

#checkPouch
if($doPouchModule){

	checkPost($pouchNames);
	checkString($pouchNames);
	
/*
D:\wamp64\www\IPP\server_fundamentals\PostDataHeadChecker.php:149:
array (size=22)
  1 => string 'work_order_5_pouch_units' (length=24)
  4 => string 'work_order_3_pouch_guset_side' (length=29)
  5 => string 'work_order_3_pouch_guset_bottom' (length=31)
  11 => string 'work_order_3_pouch_euro_punch' (length=29)
  12 => string 'work_order_3_pouch_open' (length=23)
  13 => string 'work_order_3_pouch_corner_type' (length=30)
  14 => string 'work_order_3_pouch_seal' (length=23)
  16 => string 'work_order_3_pouch_notch_side' (length=29)
  18 => string 'work_order_3_pouch_hole_punch' (length=29)
  20 => string 'work_order_3_pouch_special_tooling' (length=34)
*/
	//Check if the posted options are numeric and are valid
	if(isset($_POST[$pouchOptions[0]])){
		foreach($_POST[$pouchOptions[0]] as $exP){
			if(!is_numeric($exP)){
				die("Pouch - Invalid Pouch Type Type ");
			}else{
				selectChecker("SELECT * FROM `work_order_ui_pouch_type` where pouch_type_show = 1 and pouch_type_id = ".$exP ,
				'Pouch -  Pouch Type Options - Value at ID= '.$exP.' Not Found',
				'mysqlSelect');
			}
		}
	}

	//Check if the posted options are numeric
	if(isset($_POST[$pouchOptions[1]])){
		foreach($_POST[$pouchOptions[1]] as $exP){
			if(!is_numeric($exP)){
				die("Pouch - Invalid Closure Type");
			}else{
				selectChecker("SELECT * FROM `work_order_ui_pouch_closure_type` where pouch_closure_type_show = 1 and pouch_closure_type_id = ".$exP ,
				'Pouch -  Closure Type Options - Value at ID= '.$exP.' Not Found',
				'mysqlSelect');
			}
		}
	}

	//6,8,9,10,11,13
	
	//check Radio
	selectChecker("SELECT * FROM `work_order_qty_units` 
	where unit_show = 1 
	and unit_id = ".$_POST[$pouchNames[1]],
	'Pouch - Units Value Not Found',
	'mysqlSelect');

	selectChecker("SELECT * FROM `work_order_ui_pouch_gusset_side` 
	where pouch_gusset_side_show = 1 
	and pouch_gusset_side_id = ".$_POST[$pouchNames[4]],
	'Pouch - Gusset Side  Type Option Value Not Found',
	'mysqlSelect');

	selectChecker("SELECT * FROM `work_order_ui_pouch_gusset_bottom` 
	where pouch_gusset_bottom_show = 1 
	and pouch_gusset_bottom_id = ".$_POST[$pouchNames[5]],
	'Pouch - Gusset Bottom Option Value Not Found',
	'mysqlSelect');

	selectChecker("SELECT * FROM `work_order_ui_pouch_euro_punch` 
	where pouch_euro_punch_show = 1 
	and pouch_euro_punch_id = ".$_POST[$pouchNames[11]],
	'Pouch - Pouch Euro Punch Radio Option Value Not Found',
	'mysqlSelect');

	selectChecker("SELECT * FROM `work_order_ui_pouch_pouch_open` 
	where pouch_open_show = 1 
	and pouch_open_id = ".$_POST[$pouchNames[12]],
	'Pouch - Pouch Open Option Value Not Found',
	'mysqlSelect');

	selectChecker("SELECT * FROM `work_order_ui_pouch_corner_type` 
	where pouch_corner_type_show = 1 
	and pouch_corner_type_id = ".$_POST[$pouchNames[13]],
	'Pouch - Corner Type Option Value Not Found',
	'mysqlSelect');


	selectChecker("SELECT * FROM `work_order_ui_pouch_seal` 
	where pouch_seal_show = 1 
	and pouch_seal_id = ".$_POST[$pouchNames[14]],
	'Pouch - Pouch Seal Option Value Not Found',
	'mysqlSelect');


	selectChecker("SELECT * FROM `work_order_ui_pouch_notch_side` 
	where pouch_notch_side_show = 1 
	and pouch_notch_side_id = ".$_POST[$pouchNames[16]],
	'Pouch - Pouch Notch Side Option Value Not Found',
	'mysqlSelect');


	selectChecker("SELECT * FROM `work_order_ui_pouch_hole_punch` 
	where pouch_hole_punch_show = 1 
	and pouch_hole_punch_id = ".$_POST[$pouchNames[19]],
	'Pouch - Pouch Hole Punch Option Value Not Found',
	'mysqlSelect');


	selectChecker("SELECT * FROM `work_order_ui_pouch_special_tooling` 
	where pouch_special_tooling_show = 1 
	and pouch_special_tooling_id = ".$_POST[$pouchNames[21]],
	'Pouch - Special Tooling Option Value Not Found',
	'mysqlSelect');





	$WorkOrderPouch= array(
	"s_wo_pouch_qty"=>$_POST[$pouchNames[0]],
	"s_wo_pouch_unit"=>$_POST[$pouchNames[1]],
	"s_wo_pouch_width"=>$_POST[$pouchNames[2]],
	"s_wo_pouch_length"=>$_POST[$pouchNames[3]],
	"s_wo_pouch_gus_side"=>$_POST[$pouchNames[4]],
	"s_wo_pouch_gus_bot"=>$_POST[$pouchNames[5]],
	"s_wo_pouch_seal_width"=>$_POST[$pouchNames[6]],
	"s_wo_pouch_side_gus_w"=>$_POST[$pouchNames[7]],
	"s_wo_pouch_side_gus_l"=>$_POST[$pouchNames[8]],
	"s_wo_pouch_bot_gus_w"=>$_POST[$pouchNames[9]],
	"s_wo_pouch_bot_gus_l"=>$_POST[$pouchNames[10]],
	"s_wo_pouch_euro_punch"=>$_POST[$pouchNames[11]],
	"s_wo_pouch_open"=>$_POST[$pouchNames[12]],
	"s_wo_pouch_corner_type"=>$_POST[$pouchNames[13]],
	"s_wo_pouch_seal_type"=>$_POST[$pouchNames[14]],
	"s_wo_pouch_zip_dist_top"=>$_POST[$pouchNames[15]],
	"s_wo_pouch_notch_side"=>$_POST[$pouchNames[16]],
	"s_wo_pouch_notch_dist_top"=>$_POST[$pouchNames[17]],
	"s_wo_pouch_notch_dist_side"=>$_POST[$pouchNames[18]],
	"s_wo_pouch_hole_punch"=>$_POST[$pouchNames[19]],
	"s_wo_pouch_hole_punch_dia"=>$_POST[$pouchNames[20]],
	"s_wo_pouch_special_tooling"=>$_POST[$pouchNames[21]],
	"s_wo_remarks_pouch" => $_POST[$pouchNames[22]]
);	
	
	//Insert Posted Options into Master Array
	if(isset($_POST[$pouchOptions[0]])){
		$WorkOrderPouch['s_wo_pouch_type'] = implode(',',$_POST[$pouchOptions[0]]);	
	}
	if(isset($_POST[$pouchOptions[1]])){
		$WorkOrderPouch['s_wo_pouch_zip_closure_type'] = implode(',',$_POST[$pouchOptions[1]]);	
	}
	
	




}

#check Bags
if($doBagsModule){

	checkPost($bagsNames);
	checkString($bagsNames);

	$specialField = false;

	//Check if the posted options are numeric and are valid
	if(isset($_POST[$bagsOptions[0]])){
		foreach($_POST[$bagsOptions[0]] as $exP){
			if(!is_numeric($exP)){
				die("Bag - Invalid Sealing ");
			}else{
				selectChecker("SELECT * FROM `work_order_ui_bag_sealing_opts` where bag_sealing_opts_show = 1 and bag_sealing_opts_id = ".$exP ,
				'Bag -  Sealing Options - Value at ID= '.$exP.' Not Found',
				'mysqlSelect');
				if($exP == 4){
					$specialField = true;
				}
			}
		}
	}

	//Check if the posted options are numeric and are valid
	if(isset($_POST[$bagsOptions[1]])){
		foreach($_POST[$bagsOptions[1]] as $exP){
			if(!is_numeric($exP)){
				die("Bag - Invalid Bag Handle Punch Options ");
			}else{
				selectChecker("SELECT * FROM `work_order_ui_bag_punch_opts` where bag_punch_opts_show = 1 and bag_punch_opts_id = ".$exP ,
				'Bag -  Bag Punch Options - Value at ID= '.$exP.' Not Found',
				'mysqlSelect');
			}
		}
	}


	
	//check Radio
	selectChecker("SELECT * FROM `work_order_qty_units` 
	where unit_show = 1 
	and unit_id = ".$_POST[$bagsNames[1]],
	'Bag - Unit Option Value Not Found',
	'mysqlSelect');

	//check Radio
	selectChecker("SELECT * FROM `work_order_ui_bag_gusset_side` 
	where gusset_side_show = 1 
	and gusset_side_id = ".$_POST[$bagsNames[12]],
	'Bag - Gusset Side Type Option Value Not Found',
	'mysqlSelect');

	//check Radio
	selectChecker("SELECT * FROM `work_order_ui_bag_gusset_bottom` 
	where gusset_bottom_show = 1 
	and gusset_bottom_id = ".$_POST[$bagsNames[13]],
	'Bag - Gusset Bottom Option Value Not Found',
	'mysqlSelect');

	//check Radio
	selectChecker("SELECT * FROM `work_order_ui_bag_handle` 
	where bag_handle_show = 1 
	and bag_handle_id = ".$_POST[$bagsNames[17]],
	'Bag - Handle Type Value Not Found',
	'mysqlSelect');

	//check Radio
	selectChecker("SELECT * FROM `work_order_ui_bag_vest_handle` 
	where bag_vest_handle_show = 1 
	and bag_vest_handle_id = ".$_POST[$bagsNames[18]],
	'Bag - Bag Vest Handle Type Value Not Found',
	'mysqlSelect');
	
		 
	$WorkOrderBags = array(
	"s_wo_bag_qty"=>$_POST[$bagsNames[0]],
	"s_wo_bag_units"=>$_POST[$bagsNames[1]],
	"s_wo_bag_width"=>$_POST[$bagsNames[2]],
	"s_wo_bag_length"=>$_POST[$bagsNames[3]],
	"s_wo_bag_gus_s_w"=>$_POST[$bagsNames[4]],
	"s_wo_bag_gus_s_l"=>$_POST[$bagsNames[5]],
	"s_wo_bag_gus_b_w"=>$_POST[$bagsNames[6]],
	"s_wo_bag_gus_b_l"=>$_POST[$bagsNames[7]],
	"s_wo_bag_handle_dist_top"=>$_POST[$bagsNames[8]],
	"s_wo_bag_handle_w"=>$_POST[$bagsNames[9]],
	"s_wo_bag_handle_l"=>$_POST[$bagsNames[10]],
	"s_wo_bag_thick"=>$_POST[$bagsNames[11]],
	"s_wo_bag_gusset_side_type"=>$_POST[$bagsNames[12]],
	"s_wo_bag_gusset_bottom_type"=>$_POST[$bagsNames[13]],
	"s_wo_bag_top_fold"=>$_POST[$bagsNames[14]],
	"s_wo_bag_flap"=>$_POST[$bagsNames[15]],
	"s_wo_bag_lip"=>$_POST[$bagsNames[16]],
	"s_wo_bag_handle_type"=>$_POST[$bagsNames[17]],
	"s_wo_bag_vest_hande_type"=>$_POST[$bagsNames[18]],
	"s_wo_remarks_bag" => $_POST[$bagsNames[20]]
);	

	
	//Insert Posted Options into Master Array
	if(isset($_POST[$bagsOptions[0]])){
		$WorkOrderBags['s_wo_bag_sealing'] = implode(',',$_POST[$bagsOptions[0]]);
		if($specialField){
			$WorkOrderBags['s_wo_bag_spl_dia'] = $_POST[$bagsNames[19]];
		}
	}
	if(isset($_POST[$bagsOptions[1]])){
		$WorkOrderBags['s_wo_bag_handle_punch'] = implode(',',$_POST[$bagsOptions[1]]);	
	}
	
	




}

#check Slitting
if($doSlittingModule){

	checkPost($slittingNames);
	checkString($slittingNames);

	//Check if the posted options are numeric and are valid
	if(isset($_POST[$slittingOptions[0]])){
		foreach($_POST[$slittingOptions[0]] as $exP){
			if(!is_numeric($exP)){
				die("Slitting - Invalid Packing Options");
			}else{
				selectChecker("SELECT * FROM `work_order_ui_slitting_packing_opts` 
				where slitting_packing_opts_show = 1 
				and slitting_packing_opts_id = ".$exP ,
				'Slitting -  Packing Options - Value at ID= '.$exP.' Not Found',
				'mysqlSelect');
			}
		}
	}


	//Check if the posted options are numeric and are valid
	if(isset($_POST[$slittingOptions[1]])){
		foreach($_POST[$slittingOptions[1]] as $exP){
			if(!is_numeric($exP)){
				die("Slitting - Invalid Pallet Packing Instructions");
			}else{
				selectChecker("SELECT * FROM `work_order_ui_slitting_pallet_instructions` 
				where pallet_instructions_show = 1 
				and pallet_instructions_id = ".$exP ,
				'Slitting -  Pallet Packing - Value at ID= '.$exP.' Not Found',
				'mysqlSelect');
			}
		}
	}

	//Check if the posted options are numeric and are valid
	if(isset($_POST[$slittingOptions[2]])){
		foreach($_POST[$slittingOptions[2]] as $exP){
			if(!is_numeric($exP)){
				die("Slitting - Invalid Qc Option Type");
			}else{
				selectChecker("SELECT * FROM `work_order_ui_slitting_qc_ins` 
				where slitting_qc_ins_show = 1 
				and slitting_qc_ins_id = ".$exP ,
				'Slitting -  QC Option Type - Value at ID= '.$exP.' Not Found',
				'mysqlSelect');
			}
		}
	}


	//check Radio
	selectChecker("SELECT * FROM `work_order_wind_dir` 
	where wind_id= ".$_POST[$slittingNames[1]],
	'Slitting - Winding DIR Option Value Not Found',
	'mysqlSelect');

	//check Radio
	selectChecker("SELECT * FROM `work_order_ui_slitting_pallet` 
	where slitting_pallet_show = 1 
	and slitting_pallet_id = ".$_POST[$slittingNames[5]],
	'Slitting - Pallet Option Value Not Found',
	'mysqlSelect');

	//check Radio
	selectChecker("SELECT * FROM `work_order_ui_slitting_sticker` 
	where slitting_sticker_show = 1 
	and slitting_sticker_id = ".$_POST[$slittingNames[6]],
	'Slitting - Sticker Type Value Not Found',
	'mysqlSelect');

	//check Radio
	selectChecker("SELECT * FROM `work_order_ui_slitting_core_id_length` 
	where slitting_core_id_length_show = 1 
	and slitting_core_id_length_id = ".$_POST[$slittingNames[10]],
	'Slitting - Core ID Option Value Not Found',
	'mysqlSelect');

	//check Radio
	selectChecker("SELECT * FROM `work_order_ui_slitting_core_id_type` 
	where slitting_core_id_type_show = 1 
	and slitting_core_id_type_id = ".$_POST[$slittingNames[11]],
	'Slitting - Core Material Value Not Found',
	'mysqlSelect');

	//check Radio
	selectChecker("SELECT * FROM `work_order_ui_slitting_core_plugs` 
	where core_plugs_show = 1 
	and core_plugs_id = ".$_POST[$slittingNames[12]],
	'Slitting - Core Plugs Option Value Not Found',
	'mysqlSelect');

	$WorkOrderSlitting = array(
	"s_wo_slit_s_width"=>$_POST[$slittingNames[0]],
	"s_wo_slit_wind_dir"=>$_POST[$slittingNames[1]],
	"s_wo_slit_roll_od"=>$_POST[$slittingNames[2]],
	"s_wo_slit_wt"=>$_POST[$slittingNames[3]],
	"s_wo_slit_mtr"=>$_POST[$slittingNames[4]],
	"s_wo_slit_pallet"=>$_POST[$slittingNames[5]],
	"s_wo_slit_sticker"=>$_POST[$slittingNames[6]],
	"s_wo_slit_pallet_length"=>$_POST[$slittingNames[7]],
	"s_wo_slit_pallet_width"=>$_POST[$slittingNames[8]],
	"s_wo_slit_pallet_height"=>$_POST[$slittingNames[9]],
	"s_wo_slit_core_id"=>$_POST[$slittingNames[10]],
	"s_wo_slit_core_type"=>$_POST[$slittingNames[11]],
	"s_wo_slit_core_plugs"=>$_POST[$slittingNames[12]],
	"s_wo_slit_reel_flag_col"=>$_POST[$slittingNames[13]],
	"s_wo_slit_qc_max_jointrolls"=>$_POST[$slittingNames[14]],
	"s_wo_remarks_slit"=>$_POST[$slittingNames[15]]
	
);	

	
	
		//Insert Posted Options into Master Array
	if(isset($_POST[$slittingOptions[0]])){
		$WorkOrderSlitting['s_wo_slit_packing'] = implode(',',$_POST[$slittingOptions[0]]);	
	}

	if(isset($_POST[$slittingOptions[1]])){
		$WorkOrderSlitting['s_wo_slit_pallet_pack_ins'] = implode(',',$_POST[$slittingOptions[1]]);	
	}
	if(isset($_POST[$slittingOptions[2]])){
		$WorkOrderSlitting['s_wo_slit_qc_ins'] = implode(',',$_POST[$slittingOptions[2]]);	
	}
	

}


	$finalMaster = (array_merge($WorkOrderMaster,$WorkOrderExtrusion,$WorkOrderPrinting,
	$WorkOrderLamination,$WorkOrderPouch,$WorkOrderBags,$WorkOrderSlitting));

	if(isset($_POST['work_order_edit_draft_id'])){
			
			$updateCols = array();
		
			foreach($finalMaster as $a=>$b){
				$updateCols[] = '`'.$a.'`'." = '".$b."' "; 
			}
		
			$insertSql = 'update `sales_work_order_main` 
			set
			'.implode(', ',$updateCols).' 
			
			where
			s_wo_id = '.$_POST['work_order_edit_draft_id'];
			
			$check = mysqlUpdateData($insertSql,true);
			if(!is_numeric($check)){
				die("503 - Internal Server Error, Update Failed");
			}
		
			logInsert(basename($_SERVER['PHP_SELF']), 
					$_SESSION[SESSION_HASH_NAME], 
					$USER_ARRAY['lum_id'], 
					$_SERVER['REMOTE_ADDR'], 
					$USER_ARRAY['lum_code']." edited draft with ID: ".$_POST['work_order_edit_draft_id'], 
					"mysqlInsertData");


	}else{
			//Time and GEN LUM ID only added when a new WO is generated
			$finalMaster['s_wo_gen_dnt'] = time();
			$finalMaster['s_wo_gen_lum_id'] = $USER_ARRAY['lum_id'];

			$QueryCols = array();
			$QueryVals = array();
		
			foreach($finalMaster as $a=>$b){
				$QueryCols[] = '`'.$a.'`'; 
				$QueryVals[] = "'".$b."'";
			}
		
			$insertSql = 'INSERT INTO `sales_work_order_main` ('.implode(', 
			',$QueryCols).') VALUES ('.implode(',
			',$QueryVals).')';
			
			
			$check = mysqlInsertData($insertSql,true);
			if(!is_numeric($check)){
				die("503 - Internal Server Error, Insert Failed");
			}
			
			logInsert(basename($_SERVER['PHP_SELF']), 
					$_SESSION[SESSION_HASH_NAME], 
					$USER_ARRAY['lum_id'], 
					$_SERVER['REMOTE_ADDR'], 
					$USER_ARRAY['lum_code']." added a new draft with ID: ".$check, 
					"mysqlInsertData");



		
	}
?>
