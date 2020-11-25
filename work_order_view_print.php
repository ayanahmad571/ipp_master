<?php
require_once("server_fundamentals/SessionHandler.php");
require_once("server_fundamentals/PostDataHeadChecker.php");
getHead("Work Order Production");


if (isset($_GET['id'])) {
  if (is_numeric($_GET['id'])) {
    $getWO = mysqlSelect($UpdatedStatusQuery . "
     
      
  left join clients_main on master_wo_2_client_id = client_id
  left join master_work_order_main_identitiy on master_wo_status = mwoid_id
  
      where master_wo_ref= " . $_GET['id'] . " 
  " . $inColsWO . "
  order by master_wo_id desc
      ");


    if (!is_array($getWO)) {
      die("Error - Work Order Not Found.");
    }
    $getWO = $getWO[0];
  } else {
    die("Error - Work Order ID Invalid");
  }
} else {
  die("Error - Expected a Work Order ID, got nothing.");
}

?>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>

      <?php

      getTopBar();
      getNavbar($USER_ARRAY['user_type_mod_id']);
      ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Work Order #<?php echo $_GET['id'] ?> Print View</h1>
          </div>
          <!-- TOP CONTENT BLOCKS -->

          <div class="row">
            <div class="col-12 ">
              <div class="card card-warning">
                <div class="card-header">
                  <h4>New Sales Order</h4>
                </div>

                <div class="card-body text-justify">
                  <?php
                  // $c = 1;
                  // foreach ($getWO as $key => $value) {
                  //   echo 'getTableTD("'.$key.' - ".$getWO["'.$key.'"]);
                  //   <br>';

                  //   if($c%4 ==0){
                  //     echo '
                  //     ?&gt;
                  //     <br>
                  //     &lt;/tr&gt;
                  //     &lt;tr&gt;
                  //     &lt;?php <br>';
                  //   }

                  //   $c++;
                  // }
                  ?>

                  <table class="mt-0 mb-1 table table-bordered">
                    <tr>
                      <th colspan="12">Work Order Print View</th>

                    </tr>
                    <tr>
                      <?php
                      getTableTD("WO#", $getWO["mwo_ref_id"]);
                      getTableTD("Date Generated", date('d-M-Y', $getWO["mwo_dnt"]));
                      getTableTD("LWO#", 
                     $getWO["mwo_repeat_wo_id"]);
                     getTableTD("Repeat Type", 
                     ($getWO["mwo_type"] == 1 ? "New" : ($getWO["mwo_type"] == 2 ? "Repeat" : "Repeat With Change")));
                      
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("Sales ID", 
                     $getWO["mwo_gen_on_behalf_lum_id"], 3);
                      getTableTD("Generated By", 
                     $getWO["mwo_gen_lum_id"], 3);
                     getTableTD("Repeat Changes", 
                     $getWO["mwo_repeat_wo_type"]);
                      getTableTD("SUB#", 
                     $getWO["master_wo_id"], 3);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("Client", 
                     $getWO["master_wo_2_client_id"], 4);
                      getTableTD("CCR", 
                     $getWO["master_wo_extra_ccr"], 4);
                      getTableTD("NCR", 
                     $getWO["master_wo_extra_ncr"], 4);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("Printing End Options", 
                     $getWO["master_wo_extra_print_end_ops"]);
                      getTableTD("Design Name", 
                     $getWO["master_wo_customer_design_name"]);
                      getTableTD("Item Code", 
                     $getWO["master_wo_customer_item_code"]);
                      getTableTD("PO#", 
                     $getWO["master_wo_customer_po"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("PO Date", 
                      date('d-M-Y', $getWO["master_wo_po_date"]));
                      getTableTD("Delivery Date", 
                      date('d-M-Y', $getWO["master_wo_delivery_date"]));
                      getTableTD("Customer Location", 
                     $getWO["master_wo_3_customer_loc"]);
                      getTableTD("Contact Person Name", 
                     $getWO["master_wo_contact_person_name"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("Contact Mob NO", 
                     $getWO["master_wo_contact_person_mob_no"],4);
                      getTableTD("Contact Email", 
                     $getWO["master_wo_contact_person_email"],4);
                      getTableTD("Structure", 
                     $getWO["master_wo_2_structure"],4);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("Printed?", 
                     $getWO["master_wo_2_type_printed"]);
                      getTableTD("INK GSM Pre -Costing", 
                     $getWO["master_wo_ink_gsm_pre_c"]);
                      getTableTD("Application", 
                     $getWO["master_wo_2_application"]);
                      getTableTD("Roll Filling Options", 
                     $getWO["master_wo_2_roll_fill_opts"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("Filling Options", 
                     $getWO["master_wo_2_pouchbag_fillops"]);
                      getTableTD("Fill Temperature", 
                     $getWO["master_wo_2_fill_temp"]);
                      getTableTD("Fill Duration", 
                     $getWO["master_wo_fill_duration"]);
                      getTableTD("Fill temperature", 
                     $getWO["master_wo_fill_temp"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("Line Speed", 
                     $getWO["master_wo_line_speed"]);
                      getTableTD("Dwell Time", 
                     $getWO["master_wo_dwell_time"]);
                      getTableTD("Seal Temp", 
                     $getWO["master_wo_seal_temp"]);
                      getTableTD("Design ID", 
                     $getWO["master_wo_design_id"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("REV NO", 
                     $getWO["master_wo_rev_no"]);
                      getTableTD("Sample Approved?", 
                     $getWO["master_wo_approved_sample_wo_no"]);
                      getTableTD("Pack Size", 
                     $getWO["master_wo_pack_size"]);
                      getTableTD("Pack Weight", 
                     $getWO["master_wo_pack_weight"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("Pack Weight Unit", 
                     $getWO["master_wo_2_pack_weight_unit"]);
                      getTableTD("Quantity", 
                     $getWO["master_wo_quantity"]);
                      getTableTD("Units", 
                     $getWO["master_wo_2_units"]);
                      getTableTD("Tolerance", 
                     $getWO["master_wo_quantity_tolerance"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("Laser Config", 
                     $getWO["master_wo_2_laser_config"]);
                      getTableTD("master_wo_layer_1_micron", 
                     $getWO["master_wo_layer_1_micron"]);
                      getTableTD("master_wo_layer_1_structure", 
                     $getWO["master_wo_layer_1_structure"]);
                      getTableTD("master_wo_layer_2_micron", 
                     $getWO["master_wo_layer_2_micron"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("master_wo_layer_2_structure", 
                     $getWO["master_wo_layer_2_structure"]);
                      getTableTD("master_wo_layer_3_micron", 
                     $getWO["master_wo_layer_3_micron"]);
                      getTableTD("master_wo_layer_3_structure", 
                     $getWO["master_wo_layer_3_structure"]);
                      getTableTD("master_wo_layer_4_micron", 
                     $getWO["master_wo_layer_4_micron"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("master_wo_layer_4_structure", 
                     $getWO["master_wo_layer_4_structure"]);
                      getTableTD("master_wo_layer_5_micron", 
                     $getWO["master_wo_layer_5_micron"]);
                      getTableTD("master_wo_layer_5_structure", 
                     $getWO["master_wo_layer_5_structure"]);
                      getTableTD("PLY", 
                     $getWO["master_wo_ply"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("COF", 
                     $getWO["master_wo_2_extrusion_cof"]);
                      getTableTD("GSM", 
                     $getWO["master_wo_total_gsm"]);
                      getTableTD("GSM Tolerance", 
                     $getWO["master_wo_total_gsm_tolerance"]);
                      getTableTD("Winding Direction", 
                     $getWO["master_wo_2_wind_dir"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("ROLL OD", 
                     $getWO["master_wo_roll_od"]);
                      getTableTD("ROLL Width", 
                     $getWO["master_wo_roll_width"]);
                      getTableTD("Roll Cutoff Length", 
                     $getWO["master_wo_roll_cutoff_len"]);
                      getTableTD("Max WPR", 
                     $getWO["master_wo_max_w_p_r"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("master_wo_max_lmtr_p_r", 
                     $getWO["master_wo_max_lmtr_p_r"]);
                      getTableTD("master_wo_max_imps_p_r", 
                     $getWO["master_wo_max_imps_p_r"]);
                      getTableTD("master_wo_2_slitting_core_id", 
                     $getWO["master_wo_2_slitting_core_id"]);
                      getTableTD("master_wo_2_slitting_core_material", 
                     $getWO["master_wo_2_slitting_core_material"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("master_wo_2_slitting_core_plugs", 
                     $getWO["master_wo_2_slitting_core_plugs"]);
                      getTableTD("master_wo_2_slitting_qc_ins", 
                     $getWO["master_wo_2_slitting_qc_ins"]);
                      getTableTD("master_wo_max_joints", 
                     $getWO["master_wo_max_joints"]);
                      getTableTD("master_wo_remarks_roll", 
                     $getWO["master_wo_remarks_roll"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("master_wo_pouch_type", 
                     $getWO["master_wo_pouch_type"]);
                      getTableTD("master_wo_pouch_val_a", 
                     $getWO["master_wo_pouch_val_a"]);
                      getTableTD("master_wo_pouch_val_b", 
                     $getWO["master_wo_pouch_val_b"]);
                      getTableTD("master_wo_pouch_val_c", 
                     $getWO["master_wo_pouch_val_c"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("master_wo_pouch_val_d", 
                     $getWO["master_wo_pouch_val_d"]);
                      getTableTD("master_wo_pouch_val_e", 
                     $getWO["master_wo_pouch_val_e"]);
                      getTableTD("master_wo_pouch_val_f", 
                     $getWO["master_wo_pouch_val_f"]);
                      getTableTD("master_wo_pouch_val_g", 
                     $getWO["master_wo_pouch_val_g"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("master_wo_pouch_val_h", 
                     $getWO["master_wo_pouch_val_h"]);
                      getTableTD("master_wo_3_pouch_lap_fin", 
                     $getWO["master_wo_3_pouch_lap_fin"]);
                      getTableTD("master_wo_remarks_pouch", 
                     $getWO["master_wo_remarks_pouch"]);
                      getTableTD("master_wo_bag_type", 
                     $getWO["master_wo_bag_type"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("master_wo_bags_val_a", 
                     $getWO["master_wo_bags_val_a"]);
                      getTableTD("master_wo_bags_val_b", 
                     $getWO["master_wo_bags_val_b"]);
                      getTableTD("master_wo_bags_val_c", 
                     $getWO["master_wo_bags_val_c"]);
                      getTableTD("master_wo_bags_val_d", 
                     $getWO["master_wo_bags_val_d"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("master_wo_bags_val_e", 
                     $getWO["master_wo_bags_val_e"]);
                      getTableTD("master_wo_bags_val_f", 
                     $getWO["master_wo_bags_val_f"]);
                      getTableTD("master_wo_bags_val_g", 
                     $getWO["master_wo_bags_val_g"]);
                      getTableTD("master_wo_bags_val_h", 
                     $getWO["master_wo_bags_val_h"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("master_wo_remarks_bags", 
                     $getWO["master_wo_remarks_bags"]);
                      getTableTD("master_wo_2_foil_print_side", 
                     $getWO["master_wo_2_foil_print_side"]);
                      getTableTD("master_wo_2_printing_method", 
                     $getWO["master_wo_2_printing_method"]);
                      getTableTD("master_wo_2_printing_shade_card_needed", 
                     $getWO["master_wo_2_printing_shade_card_needed"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("master_wo_2_printing_color_ref_type", 
                     $getWO["master_wo_2_printing_color_ref_type"]);
                      getTableTD("master_wo_2_printing_approvalby", 
                     $getWO["master_wo_2_printing_approvalby"]);
                      getTableTD("master_wo_2_roll_pack_ins", 
                     $getWO["master_wo_2_roll_pack_ins"]);
                      getTableTD("master_wo_2_carton_pack_ins", 
                     $getWO["master_wo_2_carton_pack_ins"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("master_wo_2_pallet_mark_ins", 
                     $getWO["master_wo_2_pallet_mark_ins"]);
                      getTableTD("master_wo_pouch_per_bund", 
                     $getWO["master_wo_pouch_per_bund"]);
                      getTableTD("master_wo_bund_per_box", 
                     $getWO["master_wo_bund_per_box"]);
                      getTableTD("master_wo_2_pallet_type", 
                     $getWO["master_wo_2_pallet_type"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("master_wo_2_cont_stuff", 
                     $getWO["master_wo_2_cont_stuff"]);
                      getTableTD("master_wo_max_gross_pallet_weight", 
                     $getWO["master_wo_max_gross_pallet_weight"]);
                      getTableTD("master_wo_2_pallet_dim", 
                     $getWO["master_wo_2_pallet_dim"]);
                      getTableTD("master_wo_2_freight_type", 
                     $getWO["master_wo_2_freight_type"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("master_wo_cart_thick", 
                     $getWO["master_wo_cart_thick"]);
                      getTableTD("master_wo_3_docs", 
                     $getWO["master_wo_3_docs"]);
                      getTableTD("master_wo_gen_dnt", 
                     $getWO["master_wo_gen_dnt"]);
                      getTableTD("master_wo_gen_lum_id", 
                     $getWO["master_wo_gen_lum_id"]);
                      ?>
                    </tr>
                    <tr>
                      <?php
                      getTableTD("master_wo_status", 
                     $getWO["master_wo_status"]);
                      getTableTD("client_id", 
                     $getWO["client_id"]);
                      getTableTD("client_code", 
                     $getWO["client_code"]);
                      getTableTD("Client name", 
                     $getWO["client_name"]);
                      ?>

                    </tr>
                  </table>

                </div>
              </div>
            </div>
          </div>
        </section>



      </div><!-- Main Content  -->

      <?php getFooter(); ?>

    </div><!-- Main Wrapper  -->
  </div><!-- App -->
  <?php getScripts(); ?>
</body>

</html>