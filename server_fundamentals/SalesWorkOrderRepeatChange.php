<?php
require_once("SessionHandler.php");
require_once("PostDataHeadChecker.php");
//user type_check only sales and MD people can make this WO
if (!in_array($USER_ARRAY['user_type_id'], array(1, 2, 4, 10, 16))) {
    die('User Not Authorized');
}

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

//NOT COMPLETE DONT USER
$toCheck = array(
	"work_order_2_client_id", "work_order_customer_design_name", "work_order_customer_item_code", "work_order_customer_po", "work_order_po_date", "work_order_delivery_date",
	"work_order_3_customer_loc", "work_order_2_sales_id",
	"work_order_2_structure", "work_order_2_type_printed", "work_order_ink_gsm_pre_c", "work_order_2_application", "work_order_2_roll_fill_opts",
	"work_order_2_pouchbag_fillops", "work_order_2_fill_temp", "work_order_fill_temp", "work_order_line_speed",
	"work_order_dwell_time", "work_order_seal_temp", "work_order_design_id", "work_order_rev_no", "work_order_approved_sample_wo_no",
	"work_order_pack_weight", "work_order_2_pack_weight_unit", "work_order_quantity", "work_order_2_units",
	"work_order_quantity_tolerance", "work_order_2_laser_config", "work_order_ply", "work_order_total_gsm", "work_order_total_gsm_tolerance",
	"work_order_2_wind_dir", "work_order_roll_od", "work_order_roll_width", "work_order_roll_cutoff_len", "work_order_max_w_p_r",
	"work_order_max_lmtr_p_r", "work_order_max_imps_p_r", "work_order_2_slitting_core_id", "work_order_2_slitting_core_material", "work_order_2_slitting_core_plugs",
	"work_order_2_slitting_qc_ins", "work_order_max_joints", "work_order_remarks_roll", "work_order_pouch_type",
	"work_order_pouch_val_a", "work_order_pouch_val_b", "work_order_pouch_val_c", "work_order_pouch_val_d", "work_order_pouch_val_e",
	"work_order_pouch_val_f", "work_order_pouch_val_g", "work_order_pouch_val_h", "work_order_remarks_pouch",
	"work_order_bag_type", "work_order_bags_val_a", "work_order_bags_val_b", "work_order_bags_val_c", "work_order_bags_val_d",
	"work_order_bags_val_e", "work_order_bags_val_f", "work_order_bags_val_g", "work_order_bags_val_h", "work_order_remarks_bags",
	"work_order_2_foil_print_side", "work_order_2_printing_method", "work_order_2_printing_shade_card_needed", "work_order_2_printing_color_ref_type", "work_order_2_printing_approvalby",
	"work_order_2_roll_pack_ins", "work_order_2_carton_pack_ins", "work_order_2_pallet_mark_ins", "work_order_pouch_per_bund", "work_order_bund_per_box",
	"work_order_2_pallet_type", "work_order_2_cont_stuff", "work_order_max_gross_pallet_weight", "work_order_2_pallet_dim", "work_order_2_freight_type",
	"work_order_cart_thick", "work_order_3_docs", "work_order_remarks_overall",
	"work_order_2_coating_options", "work_order_coating_gsm", "work_order_cof_val", "work_order_submersion_temp", "work_order_submersion_duration"
);



checkPost($toCheck);

$plyNumber = $_POST["work_order_ply"];
$foilPrint = false;
$RemarksMain = array();
$QueryCols = array();
$QueryVals = array();
//checkPly
if ($plyNumber > 5 || $plyNumber < 1) {
	die("PLY Value not in range [1,5]");
}

$adhesiveNos = $plyNumber - 1;

#check for the Layers in essentials since they are not included in the Essential Checkers
for ($counter1 = 1; $counter1 <= $plyNumber; $counter1++) {

	if (!isset($_POST['work_order_layer_' . $counter1 . '_micron'])) {
		die('Missing Value of Layer ' . $counter1 . ' Micron ');
	}
	if (!isset($_POST['work_order_5_layer_' . $counter1 . '_material'])) {
		die('Missing Value of Layer ' . $counter1 . ' Structure ');
	}
}


for ($counter1 = 1; $counter1 <= $plyNumber; $counter1++) {

	if (!is_numeric($_POST['work_order_layer_' . $counter1 . '_micron'])) {
		die('Invalid Numeric Value of Layer ' . $counter1 . ' Micron ');
	}

	if (!is_numeric($_POST['work_order_5_layer_' . $counter1 . '_material'])) {
		die('Invalid Value of Layer ' . $counter1 . ' Material ');
	}
}

for ($counter2 = 1; $counter2 <= $adhesiveNos; $counter2++) {
	if (!isset($_POST['work_order_adh' . $counter2])) {
		die('Missing Value of Adhesive ' . $counter2 . ' GSM ');
	}
}

for ($counter2 = 1; $counter2 <= $adhesiveNos; $counter2++) {
	if (!is_numeric($_POST['work_order_adh' . $counter2])) {
		die('Invalid Value of Adhesive ' . $counter2 . ' GSM ');
	}
}


for ($counter1 = 1; $counter1 <= $plyNumber; $counter1++) {
	//checkLayerStructure
	selectChecker("SELECT * FROM `materials_main`  where material_id= " . $_POST['work_order_5_layer_' . $counter1 . '_material'], 'Structure Not Found for Layer-' . $counter1, 'mysqlSelect');
	$valFilmID = $_POST['work_order_5_layer_' . $counter1 . '_material'];

	if ($counter1 == 1) {
		if ($valFilmID == 3 || $valFilmID == 17 || $valFilmID == 52) {
			$foilPrint = true;
		}
	}
}



//check dates x2
$date_created = date_create_from_format("d-m-Y @ H:i:s", $_POST['work_order_po_date'] . ' @ 12:10:00');
if (!empty($date_created)) {
	$obj = get_object_vars($date_created);
} else {
	die("Invalid Customer PO Date Format");
}

$checkCustPoDate = strtotime($obj['date']);
// if ($checkCustPoDate < time()) {
// 	die("Invalid Customer PO Date, Date Must be in the Future");
// }

$date_created2 = date_create_from_format("d-m-Y @ H:i:s", $_POST['work_order_delivery_date'] . ' @ 12:10:00');
if (!empty($date_created2)) {
	$obj2 = get_object_vars($date_created2);
} else {
	die("Invalid Delivery Date Format");
}

$checkDeliveryDate = strtotime($obj2['date']);
if ($checkDeliveryDate < time()) {
	die("Invalid Delivery Date, Date Must be in the Future");
}



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


$WorkOrderMaster["master_wo_customer_design_name"] = $_POST["work_order_customer_design_name"];
$WorkOrderMaster["master_wo_customer_item_code"] = $_POST["work_order_customer_item_code"];
$WorkOrderMaster["master_wo_customer_po"] = $_POST["work_order_customer_po"];
$WorkOrderMaster["master_wo_po_date"] = $checkCustPoDate;
$WorkOrderMaster["master_wo_delivery_date"] = $checkDeliveryDate;

if ($_POST['work_order_2_type_printed'] == 1) {
	$WorkOrderMaster["master_wo_ink_gsm_pre_c"] = $_POST["work_order_ink_gsm_pre_c"];
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
$WorkOrderMaster["master_wo_design_id"] = $_POST["work_order_design_id"];
$WorkOrderMaster["master_wo_rev_no"] = $_POST["work_order_rev_no"];
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

$getWO["master_wo_extra_ncr"] = $_POST["work_order_ncr_no"];
$getWO["master_wo_extra_ccr"] = $_POST["work_order_ccr_no"];



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
	selectChecker("SELECT * FROM `work_order_ui_pouch_bag_fill_opts` where pbfo_show =1 order by pbfo_value asc", 'Bag Pouch Filling Option Type Not Found', 'mysqlSelect');
	$WorkOrderMaster["master_wo_2_pouchbag_fillops"] = $_POST["work_order_2_pouchbag_fillops"];


	selectChecker("SELECT * FROM `work_order_ui_pouch_pack_ins` where pouch_pack_ins_show = 1", 'Carton Packing Instructions Type Not Found', 'mysqlSelect');
	$WorkOrderMaster["master_wo_2_carton_pack_ins"] = $_POST["work_order_2_carton_pack_ins"];

	$WorkOrderMaster["master_wo_bag_type"] = $_POST["work_order_bag_type"];
	$WorkOrderMaster["master_wo_bags_val_a"] = $_POST["work_order_bags_val_a"];
	$WorkOrderMaster["master_wo_bags_val_b"] = $_POST["work_order_bags_val_b"];
	$WorkOrderMaster["master_wo_bags_val_c"] = $_POST["work_order_bags_val_c"];
	$WorkOrderMaster["master_wo_bags_val_d"] = $_POST["work_order_bags_val_d"];
	$WorkOrderMaster["master_wo_bags_val_e"] = $_POST["work_order_bags_val_e"];
	$WorkOrderMaster["master_wo_bags_val_f"] = $_POST["work_order_bags_val_f"];
	$WorkOrderMaster["master_wo_bags_val_g"] = $_POST["work_order_bags_val_g"];
	$WorkOrderMaster["master_wo_bags_val_h"] = $_POST["work_order_bags_val_h"];
	$WorkOrderMaster["master_wo_pouch_per_bund"] = $_POST["work_order_pouch_per_bund"];
	$WorkOrderMaster["master_wo_bund_per_box"] = $_POST["work_order_bund_per_box"];
} elseif ($structureMaster == 2) {
	//Pouch
	selectChecker("SELECT * FROM `work_order_ui_slitting_laser_config` where laser_show =1 and laser_id = " . $_POST['work_order_2_laser_config'], 'Laser Configuration Type Not Found', 'mysqlSelect');
	$WorkOrderMaster["master_wo_2_laser_config"] = $_POST["work_order_2_laser_config"];

	selectChecker("SELECT * FROM `work_order_ui_pouch_pack_ins` where pouch_pack_ins_show = 1 and pouch_pack_ins_id =" . $_POST['work_order_2_carton_pack_ins'], 'Carton Packing Instructions Type Not Found', 'mysqlSelect');
	$WorkOrderMaster["master_wo_2_carton_pack_ins"] = $_POST["work_order_2_carton_pack_ins"];

	selectChecker("SELECT * FROM `work_order_ui_pouch_bag_fill_opts` where pbfo_show =1 and pbfo_id =" . $_POST['work_order_2_pouchbag_fillops'], 'Bag Pouch Filling Option Type Not Found', 'mysqlSelect');
	$WorkOrderMaster["master_wo_2_pouchbag_fillops"] = $_POST["work_order_2_pouchbag_fillops"];

	$WorkOrderMaster["master_wo_pouch_type"] = $_POST["work_order_pouch_type"];
	$WorkOrderMaster["master_wo_pouch_val_a"] = $_POST["work_order_pouch_val_a"];
	$WorkOrderMaster["master_wo_pouch_val_b"] = $_POST["work_order_pouch_val_b"];
	$WorkOrderMaster["master_wo_pouch_val_c"] = $_POST["work_order_pouch_val_c"];
	$WorkOrderMaster["master_wo_pouch_val_d"] = $_POST["work_order_pouch_val_d"];
	$WorkOrderMaster["master_wo_pouch_val_e"] = $_POST["work_order_pouch_val_e"];
	$WorkOrderMaster["master_wo_pouch_val_f"] = $_POST["work_order_pouch_val_f"];
	$WorkOrderMaster["master_wo_pouch_val_g"] = $_POST["work_order_pouch_val_g"];
	$WorkOrderMaster["master_wo_pouch_val_h"] = $_POST["work_order_pouch_val_h"];
	$WorkOrderMaster["master_wo_pouch_per_bund"] = $_POST["work_order_pouch_per_bund"];
	$WorkOrderMaster["master_wo_bund_per_box"] = $_POST["work_order_bund_per_box"];

	//Check if the posted options are valid
	if (isset($_POST['work_order_3_pouch_lap_fin'])) {
		foreach ($_POST['work_order_3_pouch_lap_fin'] as $exP) {
			//check Antistatic
			selectChecker(
				"SELECT * FROM `work_order_ui_pouch_lap_fin` where lap_fin_show = 1  and lap_fin_id = " . $exP,
				'Pouch Lap Fin Value Not Found at ID= ' . $exP . ' Not Found',
				'mysqlSelect'
			);
		}
		$WorkOrderMaster['master_wo_3_pouch_lap_fin'] = implode(',', $_POST['work_order_3_pouch_lap_fin']);
	}
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
        '".$WorkOrderType."')", true);


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

// 	logInsert(
// 		basename($_SERVER['PHP_SELF']),
// 		$_SESSION[SESSION_HASH_NAME],
// 		$USER_ARRAY['lum_id'],
// 		$_SERVER['REMOTE_ADDR'],
// 		$USER_ARRAY['lum_code'] . " added a new draft with ID: " . $check,
// 		"mysqlInsertData"
// 	);
// }
