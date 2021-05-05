<?php
require_once("SessionHandler.php");
require_once("PostDataHeadChecker.php");
require_once("../WorkOrderControllers/FormController.php");

//user type_check only sales and MD people can make this WO
// if (!in_array($USER_ARRAY['user_type_id'], array(1, 2, 4, 10, 16))) {
//     die('User Not Authorized');
// }

if (isset($_POST['work_order_repeat_publish_id'])) {
	if (is_numeric($_POST['work_order_repeat_publish_id'])) {
		$getWO = mysqlSelect($UpdatedStatusQuery . "
       
        
		left join clients_main on master_wo_2_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id
		
        where master_wo_status = 9 and master_wo_ref= " . $_POST['work_order_repeat_publish_id'] . " 
		" . $inColsWO . "
		order by master_wo_id desc
        ");

		if (!is_array($getWO)) {
			die("Editing Sales Order Not Found.");
		}
		$getWO = $getWO[0];
	} else {
		die("Work Order ID Invalid");
	}
} else {
	die("Expected a Last Work Order ID, got nothing.");
}

$toCheck = submitParams();


checkPost($toCheck);

$plyNumber = $_POST["work_order_ply"];
$foilPrint = false;
$RemarksMain = array();
$QueryCols = array();
$QueryVals = array();

//checkPly
submitPlyCheck($plyNumber);


$adhesiveNos = $plyNumber - 1;

#check for the Layers in essentials since they are not included in the Essential Checkers

submitLayerCheck($plyNumber, $_POST);

submitAdhesiveCheck($adhesiveNos, $_POST);

submitMaterialsCheck($plyNumber, $_POST);

$foilPrint = submitFoilPrintSet($plyNumber, $_POST);


//check dates x2
$obj = submitDateCheck($_POST['work_order_po_date'] . ' @ 12:10:00', "Invalid Customer PO Date Format");
$checkCustPoDate = strtotime($obj['date']);


$obj2 = submitDateCheck($_POST['work_order_delivery_date'] . ' @ 12:10:00', "Invalid Delivery Date Format");
$checkDeliveryDate = strtotime($obj2['date']);

submitFutureCheckDate($checkDeliveryDate, "Invalid Delivery Date, Date Must be in the Future");



$structureMaster = $_POST['work_order_2_structure'];
if (!is_numeric($structureMaster)) {
	die('Invalid Structure');
}

$WorkOrderMaster = array();


selectChecker("SELECT * FROM `work_order_ui_structure` where structure_id = " . $_POST['work_order_2_structure'], 'Structure Not Found', 'mysqlSelect');
$WorkOrderMaster["master_wo_2_structure"] = $_POST["work_order_2_structure"];

selectChecker("SELECT * FROM `work_order_qty_units` where unit_show =1 and unit_id = " . $_POST['work_order_2_units'], 'Order Qty Units Not Found', 'mysqlSelect');
$WorkOrderMaster["master_wo_2_units"] = $_POST["work_order_2_units"];

selectChecker("SELECT * FROM `clients_main` where `client_show` = 1 and client_id = " . $_POST['work_order_2_client_id'], 'Invalid Client', 'mysqlSelect');
$WorkOrderMaster["master_wo_2_client_id"] = $_POST["work_order_2_client_id"];

selectChecker("SELECT * FROM `work_order_product_type_printed` where ptp_show = 1 and ptp_id = " . $_POST['work_order_2_type_printed'], 'Printing Yes or No Type Not Found', 'mysqlSelect');
$WorkOrderMaster["master_wo_2_type_printed"] = $_POST["work_order_2_type_printed"];

selectChecker($getAttachedTreeSql . " and lum_id = " . $_POST['work_order_2_sales_id'], 'Sales ID Not Found', 'mysqlSelect');
$WorkOrderMaster["master_wo_2_sales_id"] = $_POST["work_order_2_sales_id"];

selectChecker("SELECT * FROM `work_order_applications` where application_show =1 and application_id = " . $_POST['work_order_2_application'], 'Application Not Found', 'mysqlSelect');
$WorkOrderMaster["master_wo_2_application"] = $_POST["work_order_2_application"];

selectChecker("SELECT * FROM `work_order_ui_filling_temp` where filling_temp_show =1 and filling_temp_id = " . $_POST['work_order_2_fill_temp'], 'Fill Temperature Not Found', 'mysqlSelect');
$WorkOrderMaster["master_wo_2_fill_temp"] = $_POST["work_order_2_fill_temp"];

selectChecker("SELECT * FROM `work_order_pack_size_unit` where psu_show = 1 and psu_id = " . $_POST['work_order_2_pack_weight_unit'], 'Pack Weight Unit Not Found', 'mysqlSelect');
$WorkOrderMaster["master_wo_2_pack_weight_unit"] = $_POST["work_order_2_pack_weight_unit"];

selectChecker("SELECT * FROM `work_order_ui_lam_options` where lamo_show =1 and lamo_id = " . $_POST['work_order_2_coating_options'], 'Coating Options Value Not Found', 'mysqlSelect');
$WorkOrderMaster["master_wo_2_coating_options"] = $_POST["work_order_2_coating_options"];

selectChecker("SELECT * FROM `work_order_ui_print_surfrev` where surfrev_show = 1 and surfrev_id = " . $_POST['work_order_2_printing_method'], 'Printing Method Not Found', 'mysqlSelect');
$WorkOrderMaster["master_wo_2_printing_method"] = $_POST["work_order_2_printing_method"];

selectChecker("SELECT * FROM `work_order_ui_print_shadecardreq` where shadecardreq_show = 1 and shadecardreq_id = " . $_POST['work_order_2_printing_shade_card_needed'], 'Shade Card Type Not Found', 'mysqlSelect');
$WorkOrderMaster["master_wo_2_printing_shade_card_needed"] = $_POST["work_order_2_printing_shade_card_needed"];

selectChecker(
	"SELECT * FROM `work_order_ui_print_shadecard_ref_type` where shadecard_ref_type_show = 1 and shadecard_ref_type_id = " . $_POST['work_order_2_printing_color_ref_type'],
	'Color Reference Type Not Found',
	'mysqlSelect'
);
$WorkOrderMaster["master_wo_2_printing_color_ref_type"] = $_POST["work_order_2_printing_color_ref_type"];

selectChecker("SELECT * FROM `work_order_ui_print_options` where print_options_show = 1 and print_options_id = " . $_POST['work_order_2_printing_approvalby'], 'Approval By Not Found', 'mysqlSelect');
$WorkOrderMaster["master_wo_2_printing_approvalby"] = $_POST["work_order_2_printing_approvalby"];

selectChecker(
	"SELECT * FROM `work_order_ui_slitting_pallet_instructions` where pallet_instructions_show = 1  and pallet_instructions_id = " . $_POST['work_order_2_pallet_mark_ins'],
	'Pallet Marking Ins Not Found',
	'mysqlSelect'
);
$WorkOrderMaster["master_wo_2_pallet_mark_ins"] = $_POST["work_order_2_pallet_mark_ins"];

selectChecker("SELECT * FROM `work_order_ui_slitting_pallet` where slitting_pallet_show = 1 and slitting_pallet_id = " . $_POST['work_order_2_pallet_type'], 'Pallet Type Not Found', 'mysqlSelect');
$WorkOrderMaster["master_wo_2_pallet_type"] = $_POST["work_order_2_pallet_type"];

selectChecker("SELECT * FROM `work_order_ui_slitting_shipping_dets` where shipping_dets_show = 1 and shipping_dets_id = " . $_POST['work_order_2_cont_stuff'], 'Container Stuffing Type Not Found', 'mysqlSelect');
$WorkOrderMaster["master_wo_2_cont_stuff"] = $_POST["work_order_2_cont_stuff"];

selectChecker("SELECT * FROM `work_order_ui_pallet_size` where pallet_size_show = 1 and pallet_size_id = " . $_POST['work_order_2_pallet_dim'], 'Pallet Dimensions Not Found', 'mysqlSelect');
$WorkOrderMaster["master_wo_2_pallet_dim"] = $_POST["work_order_2_pallet_dim"];

selectChecker("SELECT * FROM `work_order_ui_slitting_freight_ins` where freight_show = 1 and freight_id = " . $_POST['work_order_2_freight_type'], 'Freight Type Not Found', 'mysqlSelect');
$WorkOrderMaster["master_wo_2_freight_type"] = $_POST["work_order_2_freight_type"];

if ($foilPrint) {
	selectChecker("SELECT * FROM `work_order_ui_foil_print_side` where foil_print_side_show = 1 and foil_print_side_id = " . $_POST['work_order_2_foil_print_side'], 'Foil Printing Side Type Not Found', 'mysqlSelect');
	$WorkOrderMaster["master_wo_2_foil_print_side"] = $_POST["work_order_2_foil_print_side"];
}

selectChecker("SELECT * FROM `work_order_ui_partial_del` where partial_del_show = 1 and partial_del_id = " . $_POST['work_order_2_partial_delivery'], 'Partial Delivery Type Not Found', 'mysqlSelect');
$WorkOrderMaster["master_wo_2_partial_delivery"] = $_POST["work_order_2_partial_delivery"];

selectChecker("SELECT * FROM `work_order_ui_lsd_required` where lsd_required_show = 1 and lsd_required_id = " . $_POST['work_order_2_lsd_required'], 'LSD Required Type Not Found', 'mysqlSelect');
$WorkOrderMaster["master_wo_2_lsd_required"] = $_POST["work_order_2_lsd_required"];


$WorkOrderMaster["master_wo_m_lwo"] = $_POST["work_order_m_lwo"];
$WorkOrderMaster["master_wo_extra_ncr"] = $_POST["work_order_ncr_no"];
$WorkOrderMaster["master_wo_extra_ccr"] = $_POST["work_order_ccr_no"];

$WorkOrderMaster["master_wo_rfp_date"] = $_POST["work_order_rfp_date"];
$WorkOrderMaster["master_wo_rfp_no"] = $_POST["work_order_rfp_no"];


$WorkOrderMaster["master_wo_ship_port_name"] = $_POST["work_order_ship_port_name"];


$WorkOrderMaster["master_wo_customer_design_name"] = $_POST["work_order_customer_design_name"];
$WorkOrderMaster["master_wo_customer_item_code"] = $_POST["work_order_customer_item_code"];
$WorkOrderMaster["master_wo_customer_po"] = $_POST["work_order_customer_po"];
$WorkOrderMaster["master_wo_po_date"] = $checkCustPoDate;
$WorkOrderMaster["master_wo_delivery_date"] = $checkDeliveryDate;

if ($_POST['work_order_2_type_printed'] == 1) {
	$WorkOrderMaster["master_wo_ink_gsm_pre_c"] = $_POST["work_order_ink_gsm_pre_c"];
	$WorkOrderMaster["master_wo_design_id"] = $_POST["work_order_design_id"];
	$WorkOrderMaster["master_wo_rev_no"] = $_POST["work_order_rev_no"];
	if ($_POST['work_order_2_lsd_required'] == 2) {
		$WorkOrderMaster["master_wo_lsd_copies"] = $_POST["work_order_lsd_copies"];
	}
}

if ($_POST['work_order_2_fill_temp'] == 4 || $_POST['work_order_2_fill_temp'] == 5) {
	$WorkOrderMaster["master_wo_submersion_temp"] = $_POST["work_order_submersion_temp"];
	$WorkOrderMaster["master_wo_submersion_duration"] = $_POST["work_order_submersion_duration"];
} else {
	$WorkOrderMaster["master_wo_fill_temp"] = $_POST["work_order_fill_temp"];
}


$WorkOrderMaster["master_wo_fill_temp"] = $_POST["work_order_fill_temp"];
$WorkOrderMaster["master_wo_line_speed"] = $_POST["work_order_line_speed"];
$WorkOrderMaster["master_wo_dwell_time"] = $_POST["work_order_dwell_time"];
$WorkOrderMaster["master_wo_seal_temp"] = $_POST["work_order_seal_temp"];
$WorkOrderMaster["master_wo_approved_sample_wo_no"] = $_POST["work_order_approved_sample_wo_no"];
$WorkOrderMaster["master_wo_coating_gsm"] = $_POST["work_order_coating_gsm"];
$WorkOrderMaster["master_wo_pack_weight"] = $_POST["work_order_pack_weight"];
$WorkOrderMaster["master_wo_quantity"] = $_POST["work_order_quantity"];
$WorkOrderMaster["master_wo_quantity_tolerance"] = $_POST["work_order_quantity_tolerance"];
$WorkOrderMaster["master_wo_ply"] = $_POST["work_order_ply"];

$WorkOrderMaster["master_wo_total_gsm"] = $_POST["work_order_total_gsm"];
$WorkOrderMaster["master_wo_total_gsm_tolerance"] = $_POST["work_order_total_gsm_tolerance"];

$WorkOrderMaster["master_wo_cart_thick"] = $_POST["work_order_cart_thick"];
$WorkOrderMaster["master_wo_max_gross_pallet_weight"] = $_POST["work_order_max_gross_pallet_weight"];

$WorkOrderMaster["master_wo_cof_val"] = $_POST["work_order_cof_val"];


for ($counter1 = 1; $counter1 <= $plyNumber; $counter1++) {
	//checkLayerStructure
	$WorkOrderMaster['master_wo_layer_' . $counter1 . '_micron'] = $_POST['work_order_layer_' . $counter1 . '_micron'];
	$WorkOrderMaster['master_wo_layer_' . $counter1 . '_structure'] = $_POST['work_order_5_layer_' . $counter1 . '_material'];
}

for ($counter1 = 1; $counter1 < $plyNumber; $counter1++) {
	//checkLayerStructure
	$WorkOrderMaster['master_wo_adh' . $counter1] = $_POST['work_order_adh' . $counter1];
}

//Check if the posted options are valid work_order_3_customer_loc
if (isset($_POST['work_order_3_customer_loc'])) {
	foreach ($_POST['work_order_3_customer_loc'] as $exP) {
		//check Antistatic
		selectChecker(
			"SELECT * FROM `work_order_ui_customer_location` where customer_location_show = 1  and customer_location_id = " . $exP,
			'Customer Location Option Value at ID= ' . $exP . ' Not Found',
			'mysqlSelect'
		);
	}
	$WorkOrderMaster['master_wo_3_customer_loc'] = implode(',', $_POST['work_order_3_customer_loc']);
}


//Check if the posted options are valid work_order_3_docs
if (isset($_POST['work_order_3_docs'])) {
	foreach ($_POST['work_order_3_docs'] as $exP) {
		//check Antistatic
		selectChecker(
			"SELECT * FROM `work_order_ui_shipment` where shipment_show = 1 and shipment_id = " . $exP,
			'Shipping Document Invalid Selection at ID= ' . $exP . ' Not Found',
			'mysqlSelect'
		);
	}
	$WorkOrderMaster['master_wo_3_docs'] = implode(',', $_POST['work_order_3_docs']);
}

//Check if the posted options are valid work_order_3_customer_loc$WorkOrderType
$WorkOrderType = "";
if (isset($_POST['work_order_3_changes'])) {
	foreach ($_POST['work_order_3_changes'] as $exP) {
		//check Antistatic
		selectChecker(
			"SELECT * FROM `work_order_ui_repeat_types` where rept_show = 1  and rept_id = " . $exP,
			'Repeat Type Option Value at ID= ' . $exP . ' Not Found',
			'mysqlSelect'
		);
	}
	$WorkOrderType = implode(',', $_POST['work_order_3_changes']);
}


if ($structureMaster == 1) {
	//Bag
	selectChecker(
		"SELECT * FROM `bag_digital_master` 
	where bdm_valid =1 and bdm_id = " . $_POST["work_order_2_bag_type"],
		'Bag Type Not Found',
		'mysqlSelect'
	);
	$WorkOrderMaster["master_wo_2_bag_type"] = $_POST["work_order_2_bag_type"];

	selectChecker(
		"SELECT * FROM `work_order_ui_bag_handle` 
	where bag_handle_show =1 and bag_handle_id=" . $_POST['work_order_2_bags_handle'],
		'Bag Handle Not Found',
		'mysqlSelect'
	);
	$WorkOrderMaster["master_wo_2_bags_handle"] = $_POST["work_order_2_bags_handle"];


	selectChecker("SELECT * FROM `work_order_ui_pouch_pack_ins` where pouch_pack_ins_show = 1", 'Carton Packing Instructions Type Not Found', 'mysqlSelect');
	$WorkOrderMaster["master_wo_2_carton_pack_ins"] = $_POST["work_order_2_carton_pack_ins"];

	$WorkOrderMaster["master_wo_bags_top_fold"] = $_POST["work_order_bags_top_fold"];
	$WorkOrderMaster["master_wo_bags_flap"] = $_POST["work_order_bags_flap"];
	$WorkOrderMaster["master_wo_bags_lip"] = $_POST["work_order_bags_lip"];

	$WorkOrderMaster["master_wo_pouch_per_bund"] = $_POST["work_order_pouch_per_bund"];
	$WorkOrderMaster["master_wo_bund_per_box"] = $_POST["work_order_bund_per_box"];
	$WorkOrderMaster["master_wo_bags_distance_top_extra"] = $_POST["work_order_bags_distance_top_extra"];

	$getAllParams = mysqlSelect("SELECT * FROM `bag_digital_params` where bdp_bdm_id =" . $_POST["work_order_2_bag_type"]);
	if (!isset($_POST['bags'])) {
		die("Bag Params Not Set");
	}

	if (!is_array($_POST['bags'])) {
		die("Invalid Bag Params Sent");
	}

	foreach ($getAllParams as $Param) {
		if (!isset($_POST['bags'][$Param['bdp_id']])) {
			die("Bag Parameter for " . $Param['bdp_title'] . " Not Found");
		}
	}

	$WorkOrderMaster["master_wo_bags_values"] = json_encode($_POST['bags']);
} elseif ($structureMaster == 2) {
	//Pouch
	selectChecker(
		"SELECT * FROM `pouch_digital_sub` 
	where pds_valid =1 and pds_id = " . $_POST["work_order_2_pouch_master"],
		'Pouch Type Not Found',
		'mysqlSelect'
	);
	$WorkOrderMaster["master_wo_2_pouch_master"] = $_POST["work_order_2_pouch_master"];

	selectChecker(
		"SELECT * FROM `work_order_ui_pouch_punch_type` 
	where punch_show =1 and punch_id=" . $_POST['work_order_2_pouch_punch_type'],
		'Punch Type Not Found',
		'mysqlSelect'
	);

	selectChecker(
		"SELECT * FROM `work_order_ui_pouch_euro_punch` 
	where euro_show =1 and euro_id=" . $_POST['work_order_2_pouch_euro_punch'],
		'Euro Punch Not Found',
		'mysqlSelect'
	);
	###
	selectChecker(
		"SELECT * FROM `work_order_ui_pouch_round_corner` 
	where round_corner_show =1 and round_corner_id=" . $_POST['work_order_2_pouch_round_corner'],
		'Round Corner Not Found',
		'mysqlSelect'
	);
	###
	selectChecker(
		"SELECT * FROM `work_order_ui_pouch_zipper` 
	where zipper_show =1 and zipper_id=" . $_POST['work_order_2_pouch_zipper'],
		'Zipper Not Found',
		'mysqlSelect'
	);

	selectChecker(
		"SELECT * FROM `work_order_ui_pouch_zipper_opc` 
	where zipopc_show =1 and zipopc_id=" . $_POST['work_order_2_pouch_zipper_opc'],
		'Open/Close? Not Found',
		'mysqlSelect'
	);

	selectChecker(
		"SELECT * FROM `work_order_ui_pouch_pe_strip` 
	where pestrip_show =1 and pestrip_id=" . $_POST['work_order_2_pouch_pestrip'],
		'PE Strip Not Found',
		'mysqlSelect'
	);
	###
	selectChecker(
		"SELECT * FROM `work_order_ui_pouch_tear_notch` 
	where tear_notch_show =1 and tear_notch_id=" . $_POST['work_order_2_pouch_tear_notch'],
		'Tear Notch Not Found',
		'mysqlSelect'
	);

	selectChecker(
		"SELECT * FROM `work_order_ui_pouch_tear_notch_qty` 
	where tear_notch_qty_show =1 and tear_notch_qty_id=" . $_POST['work_order_2_pouch_tear_notch_qty'],
		'Tear Notch Number of Sides Not Found',
		'mysqlSelect'
	);

	selectChecker(
		"SELECT * FROM `work_order_ui_pouch_tear_notch_side` 
	where tear_notch_side_show =1 and tear_notch_side_id=" . $_POST['work_order_2_pouch_tear_notch_side'],
		'Tear Notch Side Not Found',
		'mysqlSelect'
	);

	selectChecker(
		"SELECT * FROM `work_order_ui_pouch_perforation`
	where pouch_perforation_show = 1 and pouch_perforation_id = " . $_POST['work_order_2_pouch_perforation'],
		'Perforation Type Not Found',
		'mysqlSelect'
	);

	$WorkOrderMaster["master_wo_2_pouch_perforation"] = $_POST["work_order_2_pouch_perforation"];
	$WorkOrderMaster["master_wo_2_pouch_round_corner"] = $_POST["work_order_2_pouch_round_corner"];
	$WorkOrderMaster["master_wo_2_pouch_punch_type"] = $_POST["work_order_2_pouch_punch_type"];

	if ($_POST["work_order_2_pouch_punch_type"] == 10) {
		$WorkOrderMaster["master_wo_2_pouch_euro_punch"] = $_POST["work_order_2_pouch_euro_punch"];
	}

	$WorkOrderMaster["master_wo_2_pouch_zipper"] = $_POST["work_order_2_pouch_zipper"];
	if ($_POST['work_order_2_pouch_zipper'] == 1) {
		$WorkOrderMaster["master_wo_2_pouch_zipper_opc"] = $_POST["work_order_2_pouch_zipper_opc"];
		$WorkOrderMaster["master_wo_pouch_top_dist"] = $_POST["work_order_pouch_top_dist"];
		if ($_POST['work_order_2_pouch_master'] == 9 || $_POST['work_order_2_pouch_master'] == 10) {
			$WorkOrderMaster["master_wo_2_pouch_pestrip"] = $_POST["work_order_2_pouch_pestrip"];
		}
	}

	$WorkOrderMaster["master_wo_2_pouch_tear_notch"] = $_POST["work_order_2_pouch_tear_notch"];
	if ($_POST["work_order_2_pouch_tear_notch"] == 1) {
		$WorkOrderMaster["master_wo_2_pouch_tear_notch_qty"] = $_POST["work_order_2_pouch_tear_notch_qty"];
		$WorkOrderMaster["master_wo_2_pouch_tear_notch_side"] = $_POST["work_order_2_pouch_tear_notch_side"];
	}

	$WorkOrderMaster["master_wo_pouch_per_bund"] = $_POST["work_order_pouch_per_bund"];
	$WorkOrderMaster["master_wo_bund_per_box"] = $_POST["work_order_bund_per_box"];

	$WorkOrderMaster["master_wo_pouch_distance_top_extra"] = $_POST["work_order_pouch_distance_top_extra"];
	if ($_POST['work_order_2_pouch_perforation'] == 2) {
		$WorkOrderMaster["master_wo_pouch_perforation_distance_top"] = $_POST["work_order_pouch_perforation_distance_top"];
	}

	//Check if the posted options are valid
	// if (isset($_POST['work_order_3_pouch_lap_fin'])) {
	// 	foreach ($_POST['work_order_3_pouch_lap_fin'] as $exP) {
	// 		//check Antistatic
	// 		selectChecker(
	// 			"SELECT * FROM `work_order_ui_pouch_lap_fin` where lap_fin_show = 1  and lap_fin_id = " . $exP,
	// 			'Pouch Lap Fin Value Not Found at ID= ' . $exP . ' Not Found',
	// 			'mysqlSelect'
	// 		);
	// 	}
	// 	$WorkOrderMaster['master_wo_3_pouch_lap_fin'] = implode(',', $_POST['work_order_3_pouch_lap_fin']);
	// }
	$getAllParams = mysqlSelect("SELECT * FROM `pouch_digital_params` where pdp_pds_id =" . $_POST["work_order_2_pouch_master"]);
	if (!isset($_POST['pouch'])) {
		die("Pouch Params Not Set");
	}

	if (!is_array($_POST['pouch'])) {
		die("Invalid Pouch Params Sent");
	}

	foreach ($getAllParams as $Param) {
		if (!isset($_POST['pouch'][$Param['pdp_id']])) {
			die("Pouch Parameter for " . $Param['pdp_title'] . " Not Found");
		}
	}

	$WorkOrderMaster["master_wo_pouch_values"] = json_encode($_POST['pouch']);
} elseif ($structureMaster == 3) {
	//Roll
	selectChecker(
		"SELECT * FROM `work_order_ui_slitting_laser_config` where laser_show =1 and laser_id = " . $_POST['work_order_2_laser_config'],
		'Laser Configuration Type Not Found',
		'mysqlSelect'
	);
	$WorkOrderMaster["master_wo_2_laser_config"] = $_POST["work_order_2_laser_config"];

	selectChecker(
		"SELECT * FROM `work_order_ui_roll_options` where rollopts_show =1 and rollopts_id = " . $_POST['work_order_2_roll_fill_opts'],
		'Roll Filling Option Type Not Found',
		'mysqlSelect'
	);
	$WorkOrderMaster["master_wo_2_roll_fill_opts"] = $_POST["work_order_2_roll_fill_opts"];

	selectChecker(
		"SELECT * FROM `work_order_wind_dir` where wind_show =1 and wind_id = " . $_POST['work_order_2_wind_dir'],
		'Winding Direction Not Found',
		'mysqlSelect'
	);
	$WorkOrderMaster["master_wo_2_wind_dir"] = $_POST["work_order_2_wind_dir"];

	selectChecker(
		"SELECT * FROM `work_order_ui_slitting_core_id_length` where slitting_core_id_length_show = 1 and slitting_core_id_length_id = " . $_POST['work_order_2_slitting_core_id'],
		'Slitting Core ID Not Found',
		'mysqlSelect'
	);
	$WorkOrderMaster["master_wo_2_slitting_core_id"] = $_POST["work_order_2_slitting_core_id"];

	selectChecker(
		"SELECT * FROM `work_order_ui_slitting_core_id_type` where slitting_core_id_type_show = 1 and slitting_core_id_type_id = " . $_POST['work_order_2_slitting_core_material'],
		'Core Material Type Not Found',
		'mysqlSelect'
	);
	$WorkOrderMaster["master_wo_2_slitting_core_material"] = $_POST["work_order_2_slitting_core_material"];

	selectChecker(
		"SELECT * FROM `work_order_ui_slitting_core_plugs` where core_plugs_show = 1 and core_plugs_id = " . $_POST['work_order_2_slitting_core_plugs'],
		'Core Plugs Type Not Found',
		'mysqlSelect'
	);
	$WorkOrderMaster["master_wo_2_slitting_core_plugs"] = $_POST["work_order_2_slitting_core_plugs"];

	selectChecker(
		"SELECT * FROM `work_order_ui_slitting_qc_ins` where slitting_qc_ins_show = 1 and slitting_qc_ins_id = " . $_POST['work_order_2_slitting_qc_ins'],
		'QC Instructions Type Not Found',
		'mysqlSelect'
	);
	$WorkOrderMaster["master_wo_2_slitting_qc_ins"] = $_POST["work_order_2_slitting_qc_ins"];

	selectChecker(
		"SELECT * FROM `work_order_ui_slitting_pack_ins` where pack_ins_show = 1 and pack_ins_id = " . $_POST['work_order_2_roll_pack_ins'],
		'Packing Instructions Not Found',
		'mysqlSelect'
	);

	if ($_POST["work_order_max_w_p_r"] !== "" && $_POST["work_order_roll_od"] !== "") {
		die("Please only enter either Roll OD or Weight");
	}

	$WorkOrderMaster["master_wo_2_roll_pack_ins"] = $_POST["work_order_2_roll_pack_ins"];
	$WorkOrderMaster["master_wo_roll_od"] = $_POST["work_order_roll_od"];
	$WorkOrderMaster["master_wo_roll_width"] = $_POST["work_order_roll_width"];
	$WorkOrderMaster["master_wo_roll_cutoff_len"] = $_POST["work_order_roll_cutoff_len"];
	$WorkOrderMaster["master_wo_max_w_p_r"] = $_POST["work_order_max_w_p_r"];
	$WorkOrderMaster["master_wo_max_lmtr_p_r"] = $_POST["work_order_max_lmtr_p_r"];
	$WorkOrderMaster["master_wo_max_imps_p_r"] = $_POST["work_order_max_imps_p_r"];
	$WorkOrderMaster["master_wo_max_joints"] = $_POST["work_order_max_joints"];
}

$insertReference = mysqlInsertData("INSERT INTO `master_work_order_reference_number` 
(`mwo_dnt`, `mwo_gen_on_behalf_lum_id`, `mwo_gen_lum_id`, `mwo_type`, `mwo_repeat_wo_id`,`mwo_repeat_wo_type`) VALUES (
        '" . time() . "',
        '" . $getWO['master_wo_2_sales_id'] . "',
        '" . $USER_ARRAY['lum_id'] . "',
        '3' , 
        '" . $_POST["work_order_repeat_publish_id"] . "',
        '" . $WorkOrderType . "')", true);


if (!is_numeric($insertReference)) {
	die("503: Internal Error, Could not insert WORK ORDER REFERENCE");
}
$statusNo = 1;


if (($_POST["work_order_remarks_overall"] != '')) {
	$RemarksMain[] = "(
				'" . $USER_ARRAY['lum_id'] . "',
				'" . $_POST["work_order_remarks_overall"] . "',
				'" . $insertReference . "',
				'" . time() . "',
				'1')";
}
if (($_POST["work_order_remarks_pouch"] != '')) {
	$RemarksMain[] = "(
				'" . $USER_ARRAY['lum_id'] . "',
				'" . $_POST["work_order_remarks_pouch"] . "',
				'" . $insertReference . "',
				'" . time() . "',
				'2')";
}
if (($_POST["work_order_remarks_bags"] != '')) {
	$RemarksMain[] = "(
				'" . $USER_ARRAY['lum_id'] . "',
				'" . $_POST["work_order_remarks_bags"] . "',
				'" . $insertReference . "',
				'" . time() . "',
				'4')";
}
if (($_POST["work_order_remarks_roll"] != '')) {
	$RemarksMain[] = "(
				'" . $USER_ARRAY['lum_id'] . "',
				'" . $_POST["work_order_remarks_roll"] . "',
				'" . $insertReference . "',
				'" . time() . "',
				'3')";
}

$WorkOrderMaster['master_wo_ref'] = $insertReference;
$WorkOrderMaster['master_wo_gen_dnt'] = time();
$WorkOrderMaster['master_wo_gen_lum_id'] = $USER_ARRAY['lum_id'];
$WorkOrderMaster['master_wo_status'] = $statusNo;



//Insert  Query Content Builder
foreach ($WorkOrderMaster as $a => $b) {
	$QueryCols[] = '`' . $a . '`';
	$QueryVals[] = ((is_null($b)) ? "NULL" : "'" . $b . "'");
}

//Append Data from Content Builder onto Main Query
$insertWO = 'INSERT INTO `master_work_order_main` (' . implode(', 
	', $QueryCols) . ') VALUES (' . implode(',
	', $QueryVals) . ')';

//Insert the Work Order into the Main Conainter TAble
$insertWorkOrderMain = mysqlInsertData($insertWO, true);
if (!is_numeric($insertWorkOrderMain)) {
	die("503.1 - Fatal Internal Server Error, Work Order Could not be inserted, REFERENCE INSERTED");
}

//If previous insert is sucessful then take the ID and insert the remarks associated to it
if (is_array($RemarksMain)) {
	if (count($RemarksMain) > 0) {
		$q = mysqlInsertData("INSERT INTO `remarks_wo`(
			`remark_lum_id`, `remark_text`, `remark_master_wo_id`, `remark_dnt`, `remark_type`) VALUES " . implode(', ', $RemarksMain), true);

		if (!is_numeric($q)) {
			die("Internal Server Error. <br> Work Order Added, Remark Not Added  <br>ERR: " . $q);
		}
	}
}

// if (isset($_POST['work_order_edit_draft_id'])) {

// 	$updateCols = array();

// 	foreach ($finalMaster as $a => $b) {
// 		$updateCols[] = '`' . $a . '`' . " = '" . $b . "' ";
// 	}

// 	$insertSql = 'update `sales_work_order_main` 
// 			set
// 			' . implode(', ', $updateCols) . ' 

// 			where
// 			s_wo_id = ' . $_POST['work_order_edit_draft_id'];

// 	$check = mysqlUpdateData($insertSql, true);
// 	if (!is_numeric($check)) {
// 		die("503 - Internal Server Error, Update Failed");
// 	}

// 	logInsert(
// 		basename($_SERVER['PHP_SELF']),
// 		$_SESSION[SESSION_HASH_NAME],
// 		$USER_ARRAY['lum_id'],
// 		$_SERVER['REMOTE_ADDR'],
// 		$USER_ARRAY['lum_code'] . " edited draft with ID: " . $_POST['work_order_edit_draft_id'],
// 		"mysqlInsertData"
// 	);
// } else {
// 	//Time and GEN LUM ID only added when a new WO is generated
// 	$finalMaster['s_wo_gen_dnt'] = time();
// 	$finalMaster['s_wo_gen_lum_id'] = $USER_ARRAY['lum_id'];

// 	$QueryCols = array();
// 	$QueryVals = array();

// 	foreach ($finalMaster as $a => $b) {
// 		$QueryCols[] = '`' . $a . '`';
// 		$QueryVals[] = "'" . $b . "'";
// 	}

// 	$insertSql = 'INSERT INTO `sales_work_order_main` (' . implode(', 
// 			', $QueryCols) . ') VALUES (' . implode(',
// 			', $QueryVals) . ')';


// 	$check = mysqlInsertData($insertSql, true);
// 	if (!is_numeric($check)) {
// 		die("503 - Internal Server Error, Insert Failed");
// 	}

logInsert(
	basename($_SERVER['PHP_SELF']),
	$_SESSION[SESSION_HASH_NAME],
	$USER_ARRAY['lum_id'],
	$_SERVER['REMOTE_ADDR'],
	$USER_ARRAY['lum_code'] . " added repeat with change sales order with REF: " . $insertReference . " ID: " . $insertWorkOrderMain,
	"mysqlInsertData"
);
// }
