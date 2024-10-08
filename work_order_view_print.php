<?php
require_once("server_fundamentals/SessionHandler.php");
require_once("server_fundamentals/PostDataHeadChecker.php");
$stringCond = "";
$topQuery = $UpdatedStatusQuery;

if (isset($_GET['id'])) {
  $stringCond = "master_wo_ref = " . $_GET['id'];
} else if (isset($_GET['pid'])) {

  $topQuery = "select * from master_work_order_main left join master_work_order_reference_number on master_wo_ref = mwo_ref_id ";
  $stringCond = "master_wo_id = " . $_GET['pid'];
} else {
  die("<br><h1>Error - Expected a Work Order ID, got nothing.</h1>");
}


$getWO = mysqlSelect($topQuery . "
     
      
  left join clients_main on master_wo_2_client_id = client_id
  left join user_main on mwo_gen_on_behalf_lum_id = lum_id 
  left join master_work_order_main_identitiy on master_wo_status = mwoid_id
  left join work_order_ui_structure on master_wo_2_structure = structure_id
  left join work_order_qty_units on master_wo_2_units =  unit_id
  left join work_order_applications on master_wo_2_application =  application_id
  left join work_order_ui_slitting_laser_config on master_wo_2_laser_config = laser_id
  
  left join work_order_ui_print_surfrev on master_wo_2_printing_method = surfrev_id
  left join work_order_ui_print_shadecardreq on master_wo_2_printing_shade_card_needed =  shadecardreq_id 
  left join work_order_ui_print_options on master_wo_2_printing_approvalby =  print_options_id
  left join work_order_ui_print_shadecard_ref_type on  master_wo_2_printing_color_ref_type = shadecard_ref_type_id
  left join work_order_ui_lam_options on lamo_id = master_wo_2_coating_options
  left join work_order_ui_filling_temp on filling_temp_id = master_wo_2_fill_temp
  left join work_order_pack_size_unit on psu_id = master_wo_2_pack_weight_unit
  left join work_order_ui_foil_print_side on foil_print_side_id = master_wo_2_foil_print_side
  left join work_order_wind_dir on master_wo_2_wind_dir = wind_id
  left join work_order_ui_slitting_core_id_length on master_wo_2_slitting_core_id = slitting_core_id_length_id
  left join work_order_ui_slitting_core_id_type on master_wo_2_slitting_core_material = slitting_core_id_type_id
  left join work_order_ui_slitting_core_plugs on master_wo_2_slitting_core_plugs = core_plugs_id
  left join work_order_ui_slitting_qc_ins on master_wo_2_slitting_qc_ins = slitting_qc_ins_id
  left join work_order_ui_slitting_pallet on master_wo_2_pallet_type = slitting_pallet_id
  left join work_order_ui_slitting_shipping_dets on master_wo_2_cont_stuff =  shipping_dets_id
  left join work_order_ui_pallet_size on  master_wo_2_pallet_dim = pallet_size_id
  left join work_order_ui_slitting_freight_ins on master_wo_2_freight_type = freight_id
  left join work_order_ui_slitting_pallet_instructions on  master_wo_2_pallet_mark_ins  = pallet_instructions_id

  left join work_order_ui_bag_handle on master_wo_2_bags_handle = bag_handle_id

  left join work_order_ui_pouch_punch_type on master_wo_2_pouch_punch_type = punch_id
  left join work_order_ui_pouch_euro_punch on master_wo_2_pouch_euro_punch = euro_id
  left join work_order_ui_pouch_round_corner on master_wo_2_pouch_round_corner = round_corner_id
  left join work_order_ui_pouch_zipper on master_wo_2_pouch_zipper = zipper_id
  left join work_order_ui_pouch_zipper_opc on master_wo_2_pouch_zipper_opc = zipopc_id
  left join work_order_ui_pouch_pe_strip on master_wo_2_pouch_pestrip = pestrip_id
  left join work_order_ui_pouch_tear_notch on master_wo_2_pouch_tear_notch = tear_notch_id
  left join work_order_ui_pouch_tear_notch_qty on master_wo_2_pouch_tear_notch_qty = tear_notch_qty_id
  left join work_order_ui_pouch_tear_notch_side on master_wo_2_pouch_tear_notch_side = tear_notch_side_id

  left join work_order_ui_lsd_required on master_wo_2_lsd_required = lsd_required_id 
  left join work_order_ui_partial_del on master_wo_2_partial_delivery = partial_del_id
  left join work_order_ui_pouch_perforation on master_wo_2_pouch_perforation = pouch_perforation_id 
  
      where " . $stringCond . " 
  order by master_wo_id desc
      ");


if (!is_array($getWO)) {
  die("<br><h1>Error - Work Order Not Found.</h1>");
}
$getWO = $getWO[0];


$repeat = $getWO['mwo_type'] != 1;

$checkConditional = mysqlSelect("SELECT * FROM `conditional_release_wo` WHERE `crw_wo_ref` = " . $getWO['master_wo_ref'] . " order by crw_dnt limit 1");

$checkAmendments = mysqlSelect("SELECT * FROM `amendment_form_main` where `afm_rel_wo_ref` = " . $getWO['master_wo_ref'] . " and afm_status = 10 order by afm_gen_dnt desc");

?>


<!DOCTYPE html>
<html>

<head>
  <title>
    Work Order <?php echo $getWO['master_wo_ref'] ?> Print
  </title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap');

    /* Styles go here */
    body {
      font-family: 'Open Sans', sans-serif;
    }

    .page-header,
    .page-header-space {
      height: 25px;
    }

    .page-footer,
    .page-footer-space {
      height: 20px;

    }

    .page-footer {
      position: fixed;
      bottom: 0;
      width: 100%;
      background-color: blue;
      color: white;
    }

    .page-header {
      position: fixed;
      top: 0mm;
      width: 100%;
      background-color: blue;
      color: white;
    }

    .page {
      page-break-after: always;
    }

    button {
      background-color: rgb(255, 168, 168);
      border: none;
      border-radius: 2px;
      cursor: pointer;
      padding: 2px;
    }

    button:hover {
      background-color: rgb(215, 168, 168);
      border: none;
      border-radius: 2px;
      cursor: pointer;
      padding: 3px;
    }

    .table {
      border-collapse: collapse;
      border: 1px solid black;
    }

    .titleMan,
    .question,
    .table {
      border: 1px solid black;
    }

    td {
      font-size: 12px
    }

    @page {
      margin: 20mm
    }

    @media print {
      thead {
        display: table-header-group;
      }

      tfoot {
        display: table-footer-group;
      }

      button {
        display: none;
      }

      body {
        margin: 0;
      }

    }
  </style>

  <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css" crossorigin="anonymous">

</head>

<body>

  <div class="page-header" style="text-align: center">
    <h5 style="margin-top:3px; margin-bottom:0">Integrated Plastic Packaging - Work Order #<?php echo $getWO['master_wo_ref'] ?> Print View <button type="button" onClick="window.print()"> Click to Print </button></h5>

  </div>

  <div style="text-align: center" class="page-footer">
    <h6 style="margin-top:3px; margin-bottom:0"><?php echo $getWO["master_wo_ref"] . "UUID" . $getWO["master_wo_gen_lum_id"] . "SUB" . $getWO["master_wo_id"] . "ST" . $getWO["master_wo_status"] ?> was generated by user <u><?php echo $USER_ARRAY['lum_name'] ?></u> at <u><?php echo date("j-m-Y @ h:i:s a", time()) ?> </u> </h6>
  </div>

  <table>

    <thead>
      <tr>
        <td>
          <!--place holder for the fixed-position header-->
          <div class="page-header-space"></div>
        </td>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>
          <!--*** CONTENT GOES HERE ***-->
          <div class="page">
            <table class="pure-table pure-table-bordered pure-table-striped">
              <?php if (is_array($checkConditional)) {
              ?>
                <tr>
                  <td style="background-color: red; color:white" colspan="12">
                    <h3 align="center" style="margin:2px;">THIS WORK ORDER HAS BEEN RELEASED CONDITIONALLY</h3>
                  </td>
                </tr>
              <?php
              } ?>

              <?php if (is_array($checkAmendments)) {
                $num = count($checkAmendments);
                foreach ($checkAmendments as $amendment) {
              ?>
                  <tr>
                    <td style="background-color: orange; color:white" colspan="12">
                      <h3 align="center" style="margin:2px;">AMENDMENT # <?php echo $num; ?></h3>
                    </td>
                  </tr>
                  <tr>
                    <?php
                    getTableTD("Reason", $amendment["afm_reason"], 6);
                    getTableTD("Modification 1", $amendment["afm_mod_1"], 6);
                    ?>
                  </tr>
                  <tr>
                    <?php
                    getTableTD("Modification 2", $amendment["afm_mod_2"], 6);
                    getTableTD("Modification 3", $amendment["afm_mod_3"], 6);
                    ?>
                  </tr>
                  <tr>
                    <?php
                    getTableTD("Notes", $amendment["afm_notes"], 12);
                    ?>
                  </tr>
                <?php
                  $num--;
                }
                ?>

                <tr>
                  <td style="background-color: BLACK; color:white" colspan="12">
                    <h3 align="center" style="margin:2px;">WORK ORDER</h3>
                 </td>
                </tr>

              <?php
              } ?>



              <tr>
                <?php
                getTableTD("Sales ID", $getWO["lum_code"], 1);

                getTableTD("WO#", $getWO["mwo_ref_id"], 1);


                getTableTD("Date Generated", date('d-M-Y', $getWO["mwo_dnt"]), 3);

                getTableTD(
                  "Job Type",
                  ($getWO["mwo_type"] == 1 ? "New" : ($getWO["mwo_type"] == 2 ? "Repeat" : "Repeat With Change")),
                  3
                );
                getTableTD(
                  "Generated By",
                  $getWO["mwo_gen_lum_id"],
                  4
                );

                ?>
              </tr>
              <?php if ($repeat) { ?>
                <tr>
                  <?php



                  getTableTD(
                    "Repeat Changes",
                    $getWO["mwo_repeat_wo_type"]
                  );

                  getTableTD(
                    "LWO#",
                    $getWO["mwo_repeat_wo_id"]
                  );

                  getTableTD(
                    "CCR",
                    $getWO["master_wo_extra_ccr"]
                  );

                  getTableTD(
                    "NCR",
                    $getWO["master_wo_extra_ncr"]
                  );

                  ?>
                </tr>
              <?php } else { ?>
                <tr>
                  <?php

                  getTableTD(
                    "Manual LWO#",
                    $getWO["master_wo_m_lwo"],
                    4
                  );

                  getTableTD(
                    "CCR",
                    $getWO["master_wo_extra_ccr"],
                    3
                  );

                  getTableTD(
                    "NCR",
                    $getWO["master_wo_extra_ncr"],
                    3
                  );

                  ?>
                </tr>
              <?php } ?>
              <tr>
                <?php getSectionSep("Client Information"); ?>
              </tr>
              <tr>
                <?php
                getTableTD(
                  "Client",
                  $getWO["client_code"] . " " . $getWO["client_name"]
                );
                getTableTD(
                  "Design Name",
                  $getWO["master_wo_customer_design_name"],
                  2
                );

                getTableTD(
                  "Item Code",
                  $getWO["master_wo_customer_item_code"],
                  2
                );

                getTableTD(
                  "PO#",
                  $getWO["master_wo_customer_po"],
                  2
                );

                getTableTD(
                  "PO Date",
                  date('d-M-Y', $getWO["master_wo_po_date"])
                );

                ?>
              </tr>

              <tr>
                <?php


                getTableTD(
                  "Delivery Date",
                  date('d-M-Y', $getWO["master_wo_delivery_date"])
                );

                getTableTD(
                  "Customer Location",
                  groupConcatGetVal("work_order_ui_customer_location", "customer_location", $getWO["master_wo_3_customer_loc"], 'mysqlSelect'),
                  2

                );
                getTableTD(

                  "Quantity",
                  $getWO["master_wo_quantity"] . " " . $getWO["unit_value"] . " +- " . $getWO["master_wo_quantity_tolerance"] . "%",
                  4

                );

                getTableTD(
                  "Product Type",
                  $getWO["structure_value"]

                );


                ?>
              </tr>
              <tr>
                <?php
                getTableTD(
                  "Partial Delivery",
                  $getWO["partial_del_value"],
                  4
                );

                getTableTD(
                  "RFP Date",
                  $getWO["master_wo_rfp_date"],
                  4
                );

                getTableTD(
                  "RFP Number",
                  $getWO["master_wo_rfp_no"],
                  4
                );

                ?>
              </tr>
              <tr>
                <?php
                $colVal = 4;
                if ($getWO['structure_id'] == 1) {
                  $colVal = 6;
                } else {
                  $colVal = 4;
                }


                getTableTD(
                  "Application",


                  $getWO["application_value"],
                  $colVal

                );

                if ($getWO['structure_id'] != 1) {
                  getTableTD(

                    "Laser Config",
                    $getWO["laser_value"],
                    4
                  );
                }

                getTableTD(
                  "Customer Specified Total Laminate GSM",
                  $getWO["master_wo_total_gsm"] . " +- " . $getWO["master_wo_total_gsm_tolerance"] . "%",
                  $colVal
                );


                ?>
              </tr>
              <?php if (!$repeat) { ?>
                <tr>
                  <?php


                  getTableTD(
                    "Approved Sample WO No.",
                    $getWO["master_wo_approved_sample_wo_no"],
                    12
                  );


                  ?>
                </tr>
              <?php } ?>

              <?php if ($getWO["master_wo_2_type_printed"] == 1) { ?>
                <tr>
                  <?php getSectionSep("Printing Section"); ?>
                </tr>
                <tr>
                  <?php
                  getTableTD(

                    "Printing Method",
                    $getWO["surfrev_value"]
                  );

                  getTableTD(

                    "Shade Card Needed",
                    $getWO["shadecardreq_value"],
                    1
                  );

                  getTableTD(

                    "Printing Color Ref Type",
                    $getWO["shadecard_ref_type_value"],
                    4
                  );

                  getTableTD(

                    "Print Approval By",
                    $getWO["print_options_value"],
                    4
                  );
                  ?>
                </tr>
                <tr>
                  <?php
                  getTableTD(
                    "Ink GSM as per PRE-COSTING",
                    $getWO["master_wo_ink_gsm_pre_c"],
                    4
                  );

                  getTableTD(
                    "Design ID",
                    $getWO["master_wo_design_id"],
                    1
                  );
                  getTableTD(
                    "REV NO",
                    $getWO["master_wo_rev_no"],
                    2
                  );
                  getTableTD(
                    "Printing End Options",
                    groupConcatGetVal("work_order_ui_print_end_options", "print_end_opts", $getWO["master_wo_extra_print_end_ops"], 'mysqlSelect'),
                    5
                  );

                  ?>
                </tr>
                <tr>
                  <?php

                  if ($getWO["master_wo_2_lsd_required"] == 2) {
                    $colValLSD = 6;
                    getTableTD(
                      "LSD Required",
                      $getWO["lsd_required_value"],
                      $colValLSD
                    );

                    getTableTD(
                      "LSD Copied",
                      $getWO["master_wo_lsd_copies"],
                      $colValLSD
                    );
                  } else {
                    getTableTD(
                      "LSD Required",
                      $getWO["lsd_required_value"],
                      12
                    );
                  }


                  ?>
                </tr>

              <?php } ?>
              <tr>
                <?php getSectionSep("Coating Section"); ?>
              </tr>
              <tr>
                <?php

                getTableTD(
                  "Coating Type",

                  $getWO["lamo_value"],
                  6
                );

                getTableTD(
                  "Coating GSM",
                  $getWO["master_wo_coating_gsm"],
                  6
                );


                ?>
              </tr>
              <tr>
                <?php getSectionSep("Customer Machine Section"); ?>
              </tr>
              <tr>
                <?php
                if ($getWO['master_wo_2_structure'] == 3) {
                  $getVal = mysqlSelect("SELECT * FROM `work_order_ui_roll_options` where rollopts_id= " . $getWO['master_wo_2_roll_fill_opts']);
                  getTableTD(
                    "Roll Filling Options",
                    (is_array($getVal) ? $getVal[0]['rollopts_value'] : "-")
                  );
                } else {
                  if (is_null($getWO['master_wo_2_pouchbag_fillops'])) {
                    $getVal = null;
                  } else {
                    $getVal = mysqlSelect("SELECT * FROM `work_order_ui_pouch_bag_fill_opts` where pbfo_id= " . $getWO['master_wo_2_pouchbag_fillops']);
                  }
                  getTableTD(
                    "Pouch/Bag Filling Options",
                    (is_array($getVal) ? $getVal[0]['pbfo_value'] : "-")
                  );
                }

                getTableTD(
                  "Product Filling Temperature Type ",
                  $getWO["filling_temp_value"]
                );

                if ($getWO["master_wo_2_fill_temp"] == 5 || $getWO["master_wo_2_fill_temp"] == 4) {
                  getTableTD(
                    "Submersion Duration",
                    $getWO["master_wo_submersion_duration"],
                    2
                  );
                  getTableTD(
                    "Submersion Temperature",
                    $getWO["master_wo_submersion_temp"],
                    2
                  );
                } else {
                  getTableTD(
                    "Fill Temperature",
                    $getWO["master_wo_fill_temp"],
                    4
                  );
                }


                getTableTD(
                  "Line Speed Time Duration",
                  $getWO["master_wo_line_speed"],
                  2
                );

                ?>
              </tr>
              <tr>
                <?php


                getTableTD(
                  "Dwell Time",
                  $getWO["master_wo_dwell_time"],
                  2
                );

                getTableTD(
                  "Seal Temp",
                  $getWO["master_wo_seal_temp"],
                  2
                );

                getTableTD(
                  "Pack Weight",
                  $getWO["master_wo_pack_weight"],
                  2
                );

                getTableTD(

                  "Pack Weight Unit",
                  $getWO["psu_value"],
                  3
                );

                getTableTD(
                  "Cust Specified COF",
                  $getWO["master_wo_cof_val"],
                  3
                );

                ?>
              </tr>

              <tr>
                <?php getSectionSep("Layers Section"); ?>
              </tr>

              <?php
              $showFoil = false;
              for ($from = 1; $from <= $getWO['master_wo_ply']; $from++) {

                $thisIter = $getWO['master_wo_layer_' . ($from) . '_structure'];
                $micron = $getWO['master_wo_layer_' . ($from) . '_micron'];
                $struct = "NONE";
                if (is_numeric($thisIter)) {
                  $getLayerOut = mysqlSelect("SELECT * FROM `materials_main` where material_id = " . $thisIter);

                  if (is_array($getLayerOut)) {
                    $struct = $getLayerOut[0]['material_value'];
                    $valFilmID = $getLayerOut[0]['material_id'];

                    if ($from == 1 && ($valFilmID == 3 || $valFilmID == 17 || $valFilmID == 52)) {
                      $showFoil = true;
                    }
                  }
                }



                echo '<tr>';
                $colVal = 6;

                getTableTD(
                  "Layer " . $from,
                  $micron . "u / " . $struct,
                  $colVal
                );
                if ($from + 1  <= $getWO['master_wo_ply']) {
                  getTableTD(
                    "Adhesive " . $from,
                    $getWO['master_wo_adh' . $from],
                    $colVal
                  );
                } else {
                  if ($showFoil) {
                    getTableTD(

                      "Foil Print Side",
                      $getWO["foil_print_side_value"],
                      $colVal
                    );
                  } else {
                    getTableTD(

                      "",
                      "",
                      $colVal
                    );
                  }
                }

                echo '</tr>';
              }
              ?>


              <?php
              if ($getWO["master_wo_2_structure"] == 2) {
              ?>
                <tr><?php getSectionSep("Pouch Section"); ?></tr>
                <tr>
                  <?php

                  $getDigitalType = mysqlSelect("SELECT * FROM `pouch_digital_sub` where 
                    pds_id =" . $getWO['master_wo_2_pouch_master']);
                  if (!is_array($getDigitalType)) {
                    $getDigitalType['pds_url'] = '';
                    $getDigitalType['pds_name'] = "NOT FOUND";
                  }
                  $getDigitalType = $getDigitalType[0];

                  $col1Out = "<strong>" . $getDigitalType["pds_name"] . "</strong><br><hr>";
                  $getParams = mysqlSelect("SELECT * FROM `pouch_digital_params` where pdp_pds_id =" . $getWO['master_wo_2_pouch_master']);
                  $ParamsDatabase = json_decode($getWO['master_wo_pouch_values']);
                  if (is_array($getParams)) {
                    foreach ($getParams as $Param) {
                      if (isset($ParamsDatabase->{$Param['pdp_id']})) {
                        $col1Out .= "<strong>" . $Param['pdp_title'] . "</strong> - 
                          " .  $ParamsDatabase->{$Param['pdp_id']} . "<br>";
                      }
                    }
                  }
                  $col1Out .= "<hr>Extra Options - Punch/Perforation<br><br>";
                  $col1Out .= "<strong>Punch Type</strong> - " . $getWO["punch_value"] . "<br>";
                  $col1Out .= "<strong>Distance from Top</strong> - " . $getWO["master_wo_pouch_distance_top_extra"] . "<br>";
                  $col1Out .= "<strong>Perforation</strong> - " . $getWO["pouch_perforation_value"] . "<br>";
                  $col1Out .= "<strong>Perforation Distance from Top</strong> - " . $getWO["master_wo_pouch_perforation_distance_top"] . "<br>";

                  if ($getWO["master_wo_2_pouch_punch_type"] == 10) {
                    $col1Out .= "<strong>Euro Punch</strong> - " . $getWO["euro_value"] . "<br>";
                  }

                  $col1Out .= "<hr>Extra Options - Corner<br><br>";

                  $col1Out .= "<strong>Round Corner</strong> - " . $getWO["round_corner_value"] . "<br>";

                  $col1Out .= "<hr>Extra Options - Zipper<br><br>";

                  if ($getWO['master_wo_2_pouch_zipper'] == 1) {
                    $col1Out .= "<strong>Zipper Open Close?</strong> - " . $getWO["zipopc_value"] . "<br>";
                    $col1Out .= "<strong>Distance From Top</strong> - " . $getWO["master_wo_pouch_top_dist"] . "<br>";

                    if ($getWO['master_wo_2_pouch_master'] == 9 || $getWO['master_wo_2_pouch_master'] == 10) {
                      $col1Out .= "<strong>PE Strip</strong> - " . $getWO["pestrip_value"] . "<br>";
                    }
                  } else {
                    $col1Out .= "<strong>Zipper</strong> - No<br>";
                  }

                  $col1Out .= "<hr>Extra Options - Notch<br><br>";
                  if ($getWO["master_wo_2_pouch_tear_notch"] == 1) {
                    $col1Out .= "<strong>Tear Notch Number of Sides</strong> - " . $getWO["tear_notch_qty_value"] . "<br>";
                    $col1Out .= "<strong>Tear Notch Side</strong> - " . $getWO["tear_notch_side_value"] . "<br>";
                  } else {
                    $col1Out .= "<strong>Tear Notch</strong> - No<br>";
                  }
                  // $col1Out .= "<strong>Options</strong> - " . groupConcatGetVal("work_order_ui_pouch_lap_fin", "lap_fin", $getWO['master_wo_3_pouch_lap_fin'], 'mysqlSelect');

                  getTableTD(
                    "",
                    "<img src ='" . $getDigitalType['pds_url'] . "' width='600px' />",
                    6
                  );
                  getTableTD(
                    "",
                    $col1Out,
                    6
                  );
                  ?>
                </tr>
                <tr>
                  <?php echo getSectionSep("Pouch Remarks", true) ?>
                </tr>
                <tr>
                  <td colspan="12">
                    <table style="width: 100%;" class="pure-table-bordered ">
                      <tr>
                        <th width="20%">User </th>
                        <th width="70%">Remark</th>
                        <th width="10%">Time</th>
                      </tr>
                      <?php
                      $getOverallRem = mysqlSelect("SELECT r.*,m.lum_code,m.lum_name FROM `remarks_wo` r
                              left join user_main m on remark_lum_id = m.lum_id
                              where remark_status = 1
                              and remark_type = 2
                              and remark_master_wo_id = " . $getWO['master_wo_ref']);

                      if (is_array($getOverallRem)) {
                        foreach ($getOverallRem as $OverallRem) {
                          echo '
                                  <tr>
                                      <td>' . $OverallRem['lum_code'] . ' - ' . $OverallRem['lum_name'] . '</td>
                                      <td>' . $OverallRem['remark_text'] . '</td>
                                      <td>' . date(getDateTimeFormat(), $OverallRem['remark_dnt']) . '</td>
                                  </tr>
                                  
                                  ';
                        }
                      }

                      ?>
                    </table>
                  </td>
                </tr>
              <?php
              } else if ($getWO["master_wo_2_structure"] == 1) {
              ?>
                <tr>
                  <?php getSectionSep("Bag Section") ?>
                </tr>
                <tr>
                  <?php
                  //bag
                  $getDigitalType = mysqlSelect("SELECT * FROM `bag_digital_master` 
                  where bdm_id =" . $getWO['master_wo_2_bag_type']);
                  if (!is_array($getDigitalType)) {
                    $getDigitalType['bdm_url'] = '';
                    $getDigitalType['bdm_name'] = "NOT FOUND";
                  }
                  $getDigitalType = $getDigitalType[0];

                  $col1Out = "<strong>" . $getDigitalType["bdm_name"] . "</strong><br><hr>";
                  $getParams = mysqlSelect("SELECT * FROM `bag_digital_params` where bdp_bdm_id =" . $getWO['master_wo_2_bag_type']);
                  $ParamsDatabase = json_decode($getWO['master_wo_bags_values']);
                  if (is_array($getParams)) {
                    foreach ($getParams as $Param) {
                      if (isset($ParamsDatabase->{$Param['bdp_id']})) {
                        $col1Out .= "<strong>" . $Param['bdp_title'] . "</strong> - " .  $ParamsDatabase->{$Param['bdp_id']} . "<br>";
                      }
                    }
                  }
                  $col1Out .= "<hr><strong>Extra Options</strong><br>";
                  $col1Out .= "<strong>Handle</strong> - " . $getWO["bag_handle_value"] . "<br>";
                  $col1Out .= "<strong>Top Fold</strong> - " . $getWO["master_wo_bags_top_fold"] . "<br>";
                  $col1Out .= "<strong>Flap</strong> - " . $getWO["master_wo_bags_flap"] . "<br>";
                  $col1Out .= "<strong>Lip</strong> - " . $getWO["master_wo_bags_lip"] . "<br>";
                  $col1Out .= "<strong>Distance from Top</strong> - " . $getWO["master_wo_bags_distance_top_extra"] . "<br>";




                  getTableTD(
                    "",
                    "<img src ='" . $getDigitalType['bdm_url'] . "' width='400px' />",
                    6
                  );
                  getTableTD(
                    "",
                    $col1Out,
                    6
                  );
                  ?>
                </tr>
                <tr>
                  <?php echo getSectionSep("Bags Remarks", true) ?>
                </tr>
                <tr>
                  <td colspan="12">
                    <table style="width: 100%;" class="pure-table-bordered ">
                      <tr>
                        <th width="20%">User </th>
                        <th width="70%">Remark</th>
                        <th width="10%">Time</th>
                      </tr>
                      <?php
                      $getOverallRem = mysqlSelect("SELECT r.*,m.lum_code,m.lum_name FROM `remarks_wo` r
                              left join user_main m on remark_lum_id = m.lum_id
                              where remark_status = 1
                              and remark_type = 4
                              and remark_master_wo_id = " . $getWO['master_wo_ref']);

                      if (is_array($getOverallRem)) {
                        foreach ($getOverallRem as $OverallRem) {
                          echo '
                                  <tr>
                                      <td>' . $OverallRem['lum_code'] . ' - ' . $OverallRem['lum_name'] . '</td>
                                      <td>' . $OverallRem['remark_text'] . '</td>
                                      <td>' . date(getDateTimeFormat(), $OverallRem['remark_dnt']) . '</td>
                                  </tr>
                                  
                                  ';
                        }
                      }

                      ?>
                    </table>
                  </td>
                </tr>

              <?php
              } else if ($getWO["master_wo_2_structure"] == 3) {

              ?>
                <tr>
                  <?php getSectionSep("Roll Section") ?>
                </tr>
                <tr>

                  <?php
                  // http://localhost/ipp_master/assets/slitting/2b.jpg
                  getTableTD(
                    "",
                    "<img src ='assets/slitting/" . strtolower($getWO['wind_value']) . ".jpg' width='150x' />"

                  );

                  getTableTD(
                    "Customer Roll OD(mm)",
                    $getWO["master_wo_roll_od"]
                  );

                  getTableTD(
                    "Roll Width",
                    $getWO["master_wo_roll_width"]
                  );

                  getTableTD(
                    "Roll Cut Off Length",
                    $getWO["master_wo_roll_cutoff_len"]
                  );


                  ?>
                </tr>
                <tr>
                  <?php

                  getTableTD(
                    "Max Weight per Roll",
                    $getWO["master_wo_max_w_p_r"]
                  );
                  getTableTD(
                    " Max L.MTR per Roll ",
                    $getWO["master_wo_max_lmtr_p_r"]
                  );

                  getTableTD(
                    "Max IMPs per Roll",
                    $getWO["master_wo_max_imps_p_r"]
                  );

                  getTableTD(
                    "Core ID",
                    $getWO["slitting_core_id_length_value"]
                  );



                  ?>
                </tr>
                <tr>
                  <?php
                  getTableTD(
                    "Core Material",
                    $getWO["slitting_core_id_type_value"]
                  );

                  getTableTD(
                    "Core Plugs",
                    $getWO["core_plugs_value"]
                  );

                  getTableTD(
                    " Roll Joint Color ",
                    $getWO["slitting_qc_ins_value"]
                  );

                  getTableTD(
                    "Max No of Joints per Roll",
                    $getWO["master_wo_max_joints"]
                  );

                  ?>
                </tr>
                <tr>
                  <?php echo getSectionSep("Roll Remarks", true) ?>
                </tr>
                <tr>
                  <td colspan="12">
                    <table style="width: 100%;" class="pure-table-bordered ">
                      <tr>
                        <th width="20%">User </th>
                        <th width="70%">Remark</th>
                        <th width="10%">Time</th>
                      </tr>
                      <?php
                      $getOverallRem = mysqlSelect("SELECT r.*,m.lum_code,m.lum_name FROM `remarks_wo` r
                              left join user_main m on remark_lum_id = m.lum_id
                              where remark_status = 1
                              and remark_type = 3
                              and remark_master_wo_id = " . $getWO['master_wo_ref']);

                      if (is_array($getOverallRem)) {
                        foreach ($getOverallRem as $OverallRem) {
                          echo '
                                  <tr>
                                      <td>' . $OverallRem['lum_code'] . ' - ' . $OverallRem['lum_name'] . '</td>
                                      <td>' . $OverallRem['remark_text'] . '</td>
                                      <td>' . date(getDateTimeFormat(), $OverallRem['remark_dnt']) . '</td>
                                  </tr>
                                  
                                  ';
                        }
                      }

                      ?>
                    </table>
                  </td>
                </tr>
              <?php
              }

              ?>
      </tr>

      <tr>
        <?php getSectionSep("Packing Instructions"); ?>
      </tr>
      <tr>
        <?php

        if ($getWO['master_wo_2_structure'] == 3) {
          //FIX
          $getVal = mysqlSelect("SELECT * FROM `work_order_ui_slitting_pack_ins` where pack_ins_id= " . $getWO['master_wo_2_roll_pack_ins']);
          getTableTD(
            "Roll Packing Instructions",
            (is_array($getVal) ? $getVal[0]['pack_ins_value'] : "-"),
            7
          );
        } else {
          // FIX
          // var_dump($getWO['master_wo_2_carton_pack_ins']);
          if (is_null($getWO['master_wo_2_carton_pack_ins'])) {
            $getVal23 = null;
          } else {
            $getVal23 = mysqlSelect("SELECT * FROM `work_order_ui_pouch_pack_ins` 
            where pouch_pack_ins_id= " . $getWO['master_wo_2_carton_pack_ins']);
          }

          getTableTD(
            "Carton Packing Instructions",
            (is_array($getVal23) ? $getVal23[0]['pouch_pack_ins_value'] : "-")
          );

          getTableTD(
            "Pouches per Bundle",
            $getWO["master_wo_pouch_per_bund"],
            2
          );

          getTableTD(
            "Bundles per Box",
            $getWO["master_wo_bund_per_box"],
            2
          );
        }

        //FIX
        getTableTD(
          "Pallet Marking Ins",
          $getWO["pallet_instructions_value"],
          5
        );



        ?>
      </tr>

      <?php
      if (($getWO['master_wo_2_structure'] == 3 && $getWO['master_wo_2_roll_pack_ins'] != 1) || ($getWO['master_wo_2_structure'] != 3)) {
        echo "<tr>";
        getTableTD(
          "Carton Thickness",
          $getWO["master_wo_cart_thick"],
          12
        );
        echo "</tr>";
      }
      ?>

      <tr>
        <?php
        getTableTD(
          "Pallet Type",
          $getWO["slitting_pallet_value"],
          4
        );

        getTableTD(
          "Container Stuffing",
          $getWO["shipping_dets_value"],
          4
        );

        getTableTD(
          "Max Gross Pallet Weight",
          $getWO["master_wo_max_gross_pallet_weight"],
          4
        );
        ?>
      </tr>
      <tr>
        <?php

        getTableTD(
          "Pallet Dimensions",
          $getWO["pallet_size_value"],
          4
        );

        getTableTD(
          "Freight Type",
          $getWO["freight_value"],
          4
        );


        getTableTD(
          "Shipping Port",
          $getWO["master_wo_ship_port_name"],
          4
        );
        ?>
      </tr>
      <tr>
        <?php
        getTableTD(
          "Documents Needed",
          groupConcatGetVal("work_order_ui_shipment", "shipment", $getWO['master_wo_3_docs'], 'mysqlSelect'),
          12
        );
        ?>
      </tr>
      <tr>
        <?php echo getSectionSep("Overall Remarks", true) ?>
      </tr>
      <tr>
        <td colspan="12">
          <table style="width: 100%;" class="pure-table-bordered ">
            <tr>
              <th width="20%">User </th>
              <th width="70%">Remark</th>
              <th width="10%">Time</th>
            </tr>
            <?php
            $getOverallRem = mysqlSelect("SELECT r.*,m.lum_code,m.lum_name FROM `remarks_wo` r
                              left join user_main m on remark_lum_id = m.lum_id
                              where remark_status = 1
                              and remark_type = 1
                              and remark_master_wo_id = " . $getWO['master_wo_ref']);

            if (is_array($getOverallRem)) {
              foreach ($getOverallRem as $OverallRem) {
                echo '
                  <tr>
                      <td>' . $OverallRem['lum_code'] . ' - ' . $OverallRem['lum_name'] . '</td>
                      <td>' . $OverallRem['remark_text'] . '</td>
                      <td>' . date(getDateTimeFormat(), $OverallRem['remark_dnt']) . '</td>
                  </tr>
                  
                  ';
              }
            }

            ?>
          </table>
        </td>
      </tr>

    </tbody>
  </table>


  <tfoot>
    <tr>
      <td>
        <!--place holder for the fixed-position footer-->
        <div class="page-footer-space"></div>
      </td>
    </tr>
  </tfoot>

  </table>

</body>

</html>