<?php

/**
What this page does:
Takes a published work order and applies the changes that the user has set.
Along with any remarks submitted to a new table
**/

require_once("SessionHandler.php");
require_once("PostDataHeadChecker.php");


	if(!isset($_POST['work_order_edit_id'])){
		die("Work Order ID Not Found");
	}

	if(!is_numeric($_POST['work_order_edit_id'])){
			die("Invalid Work Order ID Format, Must be numeric");
	}


	if(!isset($_POST['work_order_status_value'])){
		die("Work Order Status Not Found");
	}

	if(!is_numeric($_POST['work_order_status_value'])){
		die("Work Order Status Invalid ");
	}

/*
sales can only get if the WO is Returned = 2
quality if its recieved or returned = 1,4
FM only if its recieved = 3
*/

	$getWorkOrder= mysqlSelect($UpdatedStatusQuery." where master_wo_status in (8) 
	".$inColsWO."
	and master_wo_status = ".$_POST['work_order_status_value']."
	and master_wo_ref= ".$_POST['work_order_edit_id']);
	
	if(!is_array($getWorkOrder)){
		die("Work Order not Found.");
	}
	$getWorkOrder = $getWorkOrder[0];

#check Essentials
$doEssentailsModule = true;

$RemarksMain = array();	
$WorkOrderBags =array();
$WorkOrderExtrusion = array();
$WorkOrderLamination = array();
$WorkOrderMaster  = array();
$WorkOrderPrinting = array();
$WorkOrderSlitting = array();
$WorkOrderPouch = array();

$plyNumber = $getWorkOrder['master_wo_ply'];
//checkPly
if($plyNumber >5 || $plyNumber < 1){
	die("PLY Value not in range [1,5]");
}

$ext = false;
		for($counter1 = 1; $counter1 <= $plyNumber; $counter1++){
			//checkLayerStructure
			$valFilmID = $getWorkOrder['master_wo_layer_'.$counter1.'_structure'];
			
			if($valFilmID ==4 || $valFilmID ==5 || $valFilmID ==36 ){
				$ext = true;
			}		
			
		}
		
		
		$doExtrusionModule = $ext;
		$doPrintingModule = ($_POST[$essentialNames[17]] == 1);
		$doLaminationModule = ($plyNumber > 1 );

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
	"master_wo_ex_pe_re"=>$_POST[$extrusionNames[0]],
	"master_wo_ex_antistatic"=>$_POST[$extrusionNames[1]],
	"master_wo_ex_layer"=>$_POST[$extrusionNames[2]],
	"master_wo_ex_pack_weight"=>$_POST[$extrusionNames[3]],
	"master_wo_ex_pkg_size"=>$_POST[$extrusionNames[4]],
	"master_wo_ex_qty_units"=>$_POST[$extrusionNames[5]],
	"master_wo_ex_thickness"=>$_POST[$extrusionNames[6]],
	"master_wo_ex_treatment"=>$_POST[$extrusionNames[7]],
	"master_wo_ex_roll_od"=>$_POST[$extrusionNames[8]],
	"master_wo_ex_extrude_in"=>$_POST[$extrusionNames[9]],
	"master_wo_ex_film_color"=>$_POST[$extrusionNames[10]],
	"master_wo_ex_cof"=>$_POST[$extrusionNames[11]],
	"master_wo_ext_cof_i2i"=>$_POST[$extrusionNames[12]],
	"master_wo_ext_cof_o2o"=>$_POST[$extrusionNames[13]],
	"master_wo_ext_cof_o2m"=>$_POST[$extrusionNames[14]],
	"master_wo_ext_cof_i2m"=>$_POST[$extrusionNames[15]],
	"master_wo_ext_pe_film_feature"=>$_POST[$extrusionNames[16]],
	"master_wo_ext_dyne"=>$_POST[$extrusionNames[17]],
	"master_wo_ext_single_coil_w"=>$_POST[$extrusionNames[18]],
	"master_wo_ext_no_ups"=>$_POST[$extrusionNames[19]],
	"master_wo_ext_jumbo_f_w"=>$_POST[$extrusionNames[20]],
	"master_wo_ext_recycle_p"=>$_POST[$extrusionNames[21]]);
	
	
	//Check if the posted options are numeric
	if(isset($_POST[$extrusionOptions[0]])){
		$WorkOrderExtrusion['master_wo_ex_options'] = implode(',',$_POST[$extrusionOptions[0]]);	
	}


			if(($_POST[$extrusionNames[22]] != '')){
				$RemarksMain[] = "(
			'".$USER_ARRAY['lum_id']."',
			'".$_POST[$extrusionNames[22]]."',
			'".$getWorkOrder['master_wo_ref']."',
			'".time()."',
			'2')";
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
	"master_wo_print_design"=>$_POST[$printingNames[0]],
	"master_wo_print_cylinder_supplier"=>$_POST[$printingNames[1]],
	"master_wo_print_surface_reverse"=>$_POST[$printingNames[2]],
	"master_wo_print_qty"=>$_POST[$printingNames[3]],
	"master_wo_print_units"=>$_POST[$printingNames[4]],
	"master_wo_print_substrate"=>$_POST[$printingNames[5]],
	"master_wo_print_single_coil_width"=>$_POST[$printingNames[6]],
	"master_wo_print_ups_val"=>$_POST[$printingNames[7]],
	"master_wo_print_trim_val"=>$_POST[$printingNames[8]],
	"master_wo_print_single_coil_circ"=>$_POST[$printingNames[9]],
	"master_wo_print_accross_val"=>$_POST[$printingNames[10]],
	"master_wo_print_bleed_val"=>$_POST[$printingNames[11]],
	"master_wo_print_shade_card_needed"=>$_POST[$printingNames[12]],
	"master_wo_print_color_ref_type"=>$_POST[$printingNames[13]],
	"master_wo_print_eyemark_color"=>$_POST[$printingNames[14]],
	"master_wo_print_size"=>$_POST[$printingNames[15]],
	"master_wo_print_eyemark_path"=>$_POST[$printingNames[16]],
	"master_wo_print_approvalby"=>$_POST[$printingNames[17]],
	"master_wo_print_plate_cyl_pr"=>$_POST[$printingNames[18]],
	"master_wo_print_ink_system"=>$_POST[$printingNames[19]],
	"master_wo_print_baseshel"=>$_POST[$printingNames[20]],
	"master_wo_print_ink_gsm"=>$_POST[$printingNames[21]],
	"master_wo_print_pantone_1"=>$_POST[$printingNames[22]],
	"master_wo_print_pantone_2"=>$_POST[$printingNames[23]],
	"master_wo_print_pantone_3"=>$_POST[$printingNames[24]],
	"master_wo_print_pantone_4"=>$_POST[$printingNames[25]],
	"master_wo_print_pantone_5"=>$_POST[$printingNames[26]],
	"master_wo_print_pantone_6"=>$_POST[$printingNames[27]],
	"master_wo_print_pantone_7"=>$_POST[$printingNames[28]],
	"master_wo_print_pantone_8"=>$_POST[$printingNames[29]]);	
	
	//Insert Posted Options into Master Array
	if(isset($_POST[$printingOptions[0]])){
		$WorkOrderPrinting['master_wo_print_eyemark_side'] = implode(',',$_POST[$printingOptions[0]]);	
	}

	if(isset($_POST[$printingOptions[1]])){
		$WorkOrderPrinting['master_wo_print_end_options'] = implode(',',$_POST[$printingOptions[1]]);	
	}

			if(($_POST[$printingNames[30]] != '')){
				$RemarksMain[] = "(
			'".$USER_ARRAY['lum_id']."',
			'".$_POST[$printingNames[30]]."',
			'".$getWorkOrder['master_wo_ref']."',
			'".time()."',
			'3')";
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
	"master_wo_lam_lam_sleeve"=>$_POST[$laminationNames[0]]
	);	

	#check for the Layers in essentials
	for($counterL = 1; $counterL <= $plyNumberforLam; $counterL++){

		$WorkOrderLamination['master_wo_lam_f'.$counterL.'_width'] = $_POST['work_order_lamination_layer_'.$counterL.'_film_width'];	
		$WorkOrderLamination['master_wo_lam_f'.$counterL.'_kgs'] = $_POST['work_order_lamination_layer_'.$counterL.'_kgs'];
		$WorkOrderLamination['master_wo_lam_f'.$counterL.'_mtr'] = $_POST['work_order_lamination_layer_'.$counterL.'_mtr'];

		
		if(($counterL+1) <= $plyNumberforLam){
			$WorkOrderLamination['master_wo_lam_p'.$counterL.'_desc_1'] = $_POST['work_order_lamination_pass_'.$counterL.'_desc_1'];	
			$WorkOrderLamination['master_wo_lam_p'.$counterL.'_desc_2'] = $_POST['work_order_lamination_pass_'.$counterL.'_desc_2'];
		}
	
	}

	//Insert Posted Options into Master Array
	if(isset($_POST[$laminationOptions[0]])){
		$WorkOrderLamination['master_wo_lam_options'] = implode(',',$_POST[$laminationOptions[0]]);	
	}
	
			if(($_POST[$laminationNames[1]] != '')){
				$RemarksMain[] = "(
			'".$USER_ARRAY['lum_id']."',
			'".$_POST[$laminationNames[1]]."',
			'".$getWorkOrder['master_wo_ref']."',
			'".time()."',
			'4')";
			}





}

	$finalMaster = (array_merge($WorkOrderMaster,$WorkOrderExtrusion,$WorkOrderPrinting,
	$WorkOrderLamination,$WorkOrderPouch,$WorkOrderBags,$WorkOrderSlitting));
	
			
			$updateCols = array();
		
			foreach($finalMaster as $a=>$b){
				$updateCols[] = '`'.$a.'`'." = '".$b."' "; 
			}
		
			$insertSql = 'update `master_work_order_main` 
			set
			'.implode(', ',$updateCols).' 
			
			where
			master_wo_id = '.$getWorkOrder['master_wo_id'];
			
			$check = mysqlUpdateData($insertSql,true);
			if(!is_numeric($check)){
				die("503 - Internal Server Error, WO#".$getWorkOrder['master_wo_ref']." Update Failed");
			}
			
			
			

		if(is_array($RemarksMain)){
			if(count($RemarksMain)>0){
				$q = mysqlInsertData("INSERT INTO `remarks_wo`(
				`remark_lum_id`, `remark_text`, `remark_master_wo_id`, `remark_dnt`, `remark_type`) VALUES ".implode(', ',$RemarksMain),true);
				
				if(!is_numeric($q)){
					die("Internal Server Error. <br> Work Order Updated, Remark Not Added  <br>ERR: ".$q);
				}
			}
		}



logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." edited WO: ".$getWorkOrder['master_wo_ref']." with subID: ".$getWorkOrder['master_wo_id'], 
		"mysqlInsertData");


?>
