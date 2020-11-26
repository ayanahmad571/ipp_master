<?php
require_once("server_fundamentals/SessionHandler.php");
require_once("server_fundamentals/PostDataHeadChecker.php");


//If Rep from Pub and Rep From Draft are both in the URL, Redirect Back
if (!isset($_GET['repeatChange'])) {
  header('Location: work_order_sales');
  die();
}
//If Repreat from Published is present then pull all the data of this MAIN WORK ORDER
if (!is_numeric($_GET['repeatChange'])) {
  header('Location: work_order_sales');
  die();
}

getHead("Sales Order - Repeat with Change #" . $_GET['repeatChange']);

$getWo = mysqlSelect($UpdatedStatusQuery . "
       
        
		left join clients_main on master_wo_2_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id

        where master_wo_status = 9 and master_wo_ref= " . $_GET['repeatChange'] . " 
		" . $inColsWO . "
		order by master_wo_id desc
    ");


if (!is_array($getWo)) {
  header('Location: work_order_sales');
  die();
}

$WorkOrderRepPub =  $getWo[0];


?>
<link href="assets/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />

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
            <h1>Repeat with Change WO#<?php echo $_GET['repeatChange'] ?></h1>
          </div>
          <!-- TOP CONTENT BLOCKS -->
          <?php
          /*
          2 = dropdown
          3 = multiple
          */
          ?>

          <div class="row">
            <div class="col-12 ">
              <div class="card card-warning">
                <div class="card-header">
                  <h4>Repeat with Change</h4>
                </div>

                <div class="card-body text-justify">
                  <div id="formFail" class="alert alert-danger" style="display:none">
                  </div>
                  <div id="formLoading" class="alert alert-warning">
                    Form Is Loading....
                  </div>

                  <div id="formSuccess" class="alert alert-success" style="display:none">
                    A new Sales order has been created. Data from the Last Work Order has been utilised.
                  </div>

                  <!-- <form id="formContainer" action="server_fundamentals/SalesWorkOrderSubmit" method="post"> -->
                  <form id="formContainer" action="server_fundamentals/SalesWorkOrderRepeatChange" method="post">
                    <input type="hidden" name="work_order_repeat_publish_id" value="<?php echo $_GET['repeatChange'] ?>" />

                    <div class="row">
                      <div class="form-group col-sm-12 ">
                        <label>Change Type</label>

                        <div class="selectgroup selectgroup-pills">
                          <?php
                          $getSlitCustomrs = mysqlSelect("SELECT * FROM `work_order_ui_repeat_types` where rept_show = 1 ");
                          if (is_array($getSlitCustomrs)) {
                            foreach ($getSlitCustomrs as $SingularOP) {
                              echo '
                          <label class="selectgroup-item">
                            <input type="checkbox" name="work_order_3_changes[]" value="' . $SingularOP['rept_id'] . '" class="selectgroup-input" ' . ($SingularOP['rept_id'] == 1 ? 'checked' : '') . ' />
                            <span class="selectgroup-button">' . $SingularOP['rept_value'] . '</span>
                          </label>';
                            }
                          }
                          ?>

                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-12 col-md-6 col-xl-4 ">
                        <label>LWO</label>
                        <input type="text" class="form-control" disabled value="# <?php echo $_GET['repeatChange'] ?>">
                      </div>

                      <div class="form-group col-sm-12 col-md-6 col-xl-4 ">
                        <label>Previous NCR #</label>
                        <input type="text" class="form-control" name="work_order_ncr_no" placeholder="NCR Number">
                      </div>

                      <div class="form-group col-sm-12 col-md-6 col-xl-4 ">
                        <label>Previous CCR #</label>
                        <input type="text" class="form-control" name="work_order_ccr_no" placeholder="CCR Number">
                      </div>

                    </div>

                    <div class="row">

                      <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-1">
                        <label>Customer Code</label>
                        <select class="form-control select_a" required name="work_order_2_client_id">
                          <?php
                          $getClients = mysqlSelect("SELECT * FROM `clients_main` where `client_show` = 1 order by client_name asc ");
                          if (is_array($getClients)) {
                            foreach ($getClients as $Client) {
                              echo '<option data-name="' . $Client['client_name'] . '" value="' . $Client['client_id'] . '">' . $Client['client_code'] . '</option>';
                            }
                          } else {
                            echo '<option value="-m-x">None</option>';
                          }
                          ?>
                        </select>
                      </div>

                      <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-3">
                        <label>Customer Name</label>
                        <input type="text" disabled class="form-control" id="custNameGetter" placeholder="">
                      </div>

                      <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                        <label>Customer's Design Name</label>
                        <input type="text" class="form-control" name="work_order_customer_design_name" placeholder="Customer Design Name">
                      </div>
                      <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                        <label>Customer's Item Code</label>
                        <input type="text" class="form-control" name="work_order_customer_item_code" placeholder="Customer Item Code">
                      </div>

                      <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                        <label>Customer P.O#</label>
                        <input type="text" class="form-control" name="work_order_customer_po" placeholder="Customer P.O#">
                      </div>
                      <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                        <label>Customer P.O Date</label>
                        <input onchange="getDif()" type="text" class="form-control" name="work_order_po_date" placeholder="DD-MM-YYYY">
                      </div>

                      <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                        <label>Required Delivery Date</label>
                        <input onchange="getDif()" type="text" class="form-control" name="work_order_delivery_date" placeholder="DD-MM-YYYY">
                      </div>

                      <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                        <label>Delivery Required In</label>
                        <input id="numberOfDays" type="text" disabled class="form-control" name="">
                      </div>

                      <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                        <label>Customer Location</label>

                        <div class="selectgroup selectgroup-pills">
                          <?php
                          $getSlitCustomrs = mysqlSelect("SELECT * FROM `work_order_ui_customer_location` where customer_location_show = 1 ");
                          if (is_array($getSlitCustomrs)) {
                            foreach ($getSlitCustomrs as $SingularOP) {
                              echo '
<label class="selectgroup-item">
  <input type="checkbox" name="work_order_3_customer_loc[]" value="' . $SingularOP['customer_location_id'] . '" class="selectgroup-input" ' . ($SingularOP['customer_location_id'] == 1 ? 'checked' : '') . '>
  <span class="selectgroup-button">' . $SingularOP['customer_location_value'] . '</span>
</label>';
                            }
                          }
                          ?>

                        </div>
                      </div>

                      <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                        <label>Contact Person Name</label>
                        <input type="text" class="form-control" name="work_order_contact_person_name" placeholder="Contact Person Name">
                      </div>
                      <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                        <label>Contact Person Mob NO</label>
                        <input type="text" class="form-control" name="work_order_contact_person_mob_no" placeholder="Contact Person Mob NO">
                      </div>
                      <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                        <label>Contact Person Email</label>
                        <input type="text" class="form-control" name="work_order_contact_person_email" placeholder="Contact Person Email">
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-12 col-md-6 col-lg-3 col-xl-2">
                        <label>IPP Sales Person Code</label>
                        <select class="form-control select_a" required name="work_order_2_sales_id">
                          <?php
                          $getDrafts = mysqlSelect($getAttachedTreeSql);

                          if (is_array($getDrafts)) {
                            foreach ($getDrafts as $Draft) {
                              echo '<option value="' . $Draft['lum_id'] . '">' . $Draft['lum_code'] . ' - ' . $Draft['lum_name'] . '</option>';
                            }
                          }
                          ?>
                        </select>


                      </div>
                      <?php
                      getSelectBox(
                        "form-group col-12 col-md-6 col-lg-3 col-xl-2",
                        "Product Type",
                        "work_order_2_structure",
                        "SELECT * FROM `work_order_ui_structure` ",
                        'structure_id',
                        'structure_value'
                      );
                      ?>
                      <?php
                      getSelectBox(
                        "form-group col-12 col-md-6 col-lg-3 col-xl-2",
                        "_ ",
                        "work_order_2_type_printed",
                        "SELECT * FROM `work_order_product_type_printed` where ptp_show = 1 order by ptp_value asc ",
                        'ptp_id',
                        'ptp_value'
                      );
                      ?>
                      <div id="whenPrintedClickedGO" class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                        <label>Ink GSM as per PRE-COSTING</label>
                        <input type="text" class="form-control" name="work_order_ink_gsm_pre_c" placeholder="Ink GSM">
                      </div>

                      <div class="col-12 col-md-6 col-xl-4">
                        <div class="row">
                          <div class="form-group col-sm-12 col-md-9">
                            <label>IPP Design ID</label>
                            <input type="text" class="form-control" name="work_order_design_id" placeholder="IPP Design ID">
                          </div>
                          <div class="form-group col-sm-12 col-md-3">
                            <label>Rev No</label>
                            <input type="number" min="0" value="0" class="form-control" name="work_order_rev_no" placeholder="Rev">
                          </div>
                        </div>
                      </div>


                    </div>
                    <hr>
                    <div class="row">
                      <?php
                      getSelectBox(
                        "form-group col-sm-12 col-xl-2",
                        "Application",
                        "work_order_2_application",
                        "SELECT * FROM `work_order_applications` where application_show =1 order by application_value asc ",
                        'application_id',
                        'application_value'
                      );
                      ?>
                      <?php
                      getSelectBox(
                        "form-group col-sm-12 col-xl-2 classOnlyRoll",
                        "Roll Filling Options",
                        "work_order_2_roll_fill_opts",
                        "SELECT * FROM `work_order_ui_roll_options` where rollopts_show =1 order by rollopts_value asc ",
                        'rollopts_id',
                        'rollopts_value'
                      );
                      ?>
                      <?php
                      getSelectBox(
                        "form-group col-sm-12 col-xl-2 classBagPouch",
                        "Bag/Pouch Filling Options Temperature",
                        "work_order_2_pouchbag_fillops",
                        "SELECT * FROM `work_order_ui_pouch_bag_fill_opts` where pbfo_show =1 order by pbfo_value asc ",
                        'pbfo_id',
                        'pbfo_value'
                      );
                      ?>

                      <?php
                      getSelectBox(
                        "form-group col-sm-12 col-xl-2",
                        "Customer Filling Machine Details",
                        "work_order_2_fill_temp",
                        "SELECT * FROM `work_order_ui_filling_temp` where filling_temp_show =1 order by filling_temp_value asc ",
                        'filling_temp_id',
                        'filling_temp_value'
                      );
                      ?>
                      <div class="form-group col-sm-12 col-md-6 col-lg-2">
                        <label>Filling Time Duration</label>
                        <input type="text" class="form-control" name="work_order_fill_duration" placeholder="Time Duration">
                      </div>
                      <div class="form-group col-sm-12 col-md-6 col-lg-2">
                        <label>Filling Temperature</label>
                        <input type="text" class="form-control" name="work_order_fill_temp" placeholder="Temperature">
                      </div>

                      <div class="form-group col-sm-12 col-md-6 col-lg-2">
                        <label>Line Speed Time Duration</label>
                        <input type="text" class="form-control" name="work_order_line_speed" placeholder="Time Duration">
                      </div>
                      <div class="form-group col-sm-12 col-md-6 col-lg-2">
                        <label>Dwell Time</label>
                        <input type="text" class="form-control" name="work_order_dwell_time" placeholder="Temperature">
                      </div>
                      <div class="form-group col-sm-12 col-md-6 col-lg-2">
                        <label>Seal Temperature</label>
                        <input type="text" class="form-control" name="work_order_seal_temp" placeholder="Time Duration">
                      </div>
                      <div class="form-group col-sm-12 col-lg-6 col-xl-2">
                        <label>Pack Size </label>
                        <input type="number" min="1" max="999999" step="0.01" class="form-control" name="work_order_pack_size" placeholder="Pack Size ">
                      </div>

                      <div class="form-group col-sm-12 col-lg-6 col-xl-2">
                        <label>Pack Weight </label>
                        <input type="number" min="1" max="999999" step="0.01" class="form-control" name="work_order_pack_weight" placeholder="Pack Weight ">
                      </div>



                      <?php
                      getSelectBox(
                        "form-group col-4 col-xl-2",
                        "Weight Unit",
                        "work_order_2_pack_weight_unit",
                        "SELECT * FROM `work_order_pack_size_unit` where psu_show = 1",
                        'psu_id',
                        'psu_value'
                      );
                      ?>


                    </div>
                    <hr>

                    <div class="row">




                      <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                        <label>Approved Sample WO No.</label>
                        <input type="text" class="form-control" name="work_order_approved_sample_wo_no" placeholder="Approved Sample WO NO">
                      </div>


                      <div class="form-group col-8 col-xl-2">
                        <label>Order Qty</label>
                        <input placeholder="Order Quantity" name="work_order_quantity" type="number" step="0.01" class="form-control" min="0.10">
                      </div>

                      <?php
                      getSelectBox(
                        "form-group col-4 col-xl-2",
                        "Qty Unit",
                        "work_order_2_units",
                        "SELECT * FROM `work_order_qty_units` where unit_show =1",
                        'unit_id',
                        'unit_value'
                      );
                      ?>

                      <div class="form-group col-4 col-xl-2">
                        <label>Tolerance % +/-</label>
                        <input placeholder="Tolerance +/-" name="work_order_quantity_tolerance" type="number" step="0.01" class="form-control" />
                      </div>


                      <div class="classPouchRoll col-sm-12 col-xl-3">

                        <?php
                        getSelectBox(
                          "form-group",
                          "Laser Configuration",
                          "work_order_2_laser_config",
                          "SELECT * FROM `work_order_ui_slitting_laser_config` where laser_show =1 order by laser_value asc ",
                          'laser_id',
                          'laser_value'
                        );
                        ?>
                      </div>

                    </div>

                    <hr>


                    <div class="row">
                      <div class="form-group col-sm-12 col-lg-6 col-xl-2 ">
                        <label>Number of Layers</label>
                        <input id="plyValueInput" type="number" min="1" max="5" class="form-control" name="work_order_ply" value="2" placeholder="Ply">
                      </div>
                      <?php
                      getSelectBox(
                        "form-group col-sm-12 col-lg-6 col-xl-2 ",
                        "C.O.F",
                        "work_order_2_extrusion_cof",
                        "SELECT * FROM `work_order_ui_ext_cof` where cof_show = 1 ",
                        'cof_id',
                        'cof_value'
                      );
                      ?>
                    </div>

                    <div id="containerLaminateLayers">
                    </div>

                    <div class="row">
                      <div class="form-group  col-12 col-md-6 col-xl-4">
                        <label>Customer Specified Total Laminate GSM</label>
                        <input placeholder="Customer Specified Total Laminate GSM" name="work_order_total_gsm" type="number" step="0.01" class="form-control" min="0.10">
                      </div>

                      <div class="form-group  col-12 col-md-6 col-xl-4">
                        <label>&nbsp;</label>
                        <input placeholder="Tolerance +/-" name="work_order_total_gsm_tolerance" type="number" step="0.01" class="form-control" min="0">
                      </div>
                      <div class="form-group  col-12 col-md-6 col-xl-4">
                        <label>Calculated Laminate GSM</label>
                        <input id="calcLamGSM" disabled class="form-control" min="0.10">
                      </div>
                    </div>

                    <hr>

                    <div class="classOnlyRoll">
                      <div class="row">

                        <div class="col-12 col-lg-4">
                          <div class="row">
                            <div id="imgRollPut" class="col-12 ">
                              <img class="img-thumbnail" src="assets/img/winding_dir.png" />
                            </div>
                          </div>
                        </div>


                        <div class="col-12 col-lg-8">
                          <div class="row">
                            <div class="form-group col-12 col-lg-3">
                              <label>Wind DIR</label>
                              <select class="form-control select_a" required name="work_order_2_wind_dir">
                                <?php
                                $getWinds = mysqlSelect("SELECT * FROM `work_order_wind_dir` where wind_show =1 order by wind_value asc");
                                if (is_array($getWinds)) {
                                  foreach ($getWinds  as $Wind) {
                                    echo '<option data-id="' . strtolower($Wind['wind_value']) . '" value="' . $Wind['wind_id'] . '">' . $Wind['wind_value'] . '</option>';
                                  }
                                }
                                ?>
                              </select>
                            </div>


                            <div class="form-group col-12 col-lg-3">
                              <label>Customer Roll OD(mm)</label>
                              <input type="number" min="1" max="999999999" step="0.01" class="form-control" name="work_order_roll_od" placeholder="Customer Roll OD">
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3 col-xl-3">
                              <label>Roll Width</label>
                              <input type="text" class="form-control" name="work_order_roll_width" placeholder="Roll Width">
                            </div>

                            <div class="form-group col-12 col-md-6 col-lg-3 col-xl-3">
                              <label>Roll Cut Off Length</label>
                              <input type="text" class="form-control" name="work_order_roll_cutoff_len" placeholder="Roll Cut Off Length">
                            </div>



                            <div class="form-group col-12 col-lg-4">
                              <label>Max Weight per Roll</label>
                              <input type="number" min="1" max="999999999" step="0.01" class="form-control" name="work_order_max_w_p_r" placeholder="Max Weight per Roll">
                            </div>
                            <div class="form-group col-12 col-lg-4">
                              <label>Max L.MTR per Roll</label>
                              <input type="number" min="1" max="999999999" step="0.01" class="form-control" name="work_order_max_lmtr_p_r" placeholder="Max L.MTR per Roll">
                            </div>
                            <div class="form-group col-12 col-lg-4">
                              <label>Max IMPs per Roll</label>
                              <input type="number" min="1" max="999999999" step="0.01" class="form-control" name="work_order_max_imps_p_r" placeholder="Max IMPs per Roll">
                            </div>

                            <?php
                            getSelectBox(
                              "form-group col-12 col-lg-6 col-xl-2",
                              "Core ID",
                              "work_order_2_slitting_core_id",
                              "SELECT * FROM `work_order_ui_slitting_core_id_length` where slitting_core_id_length_show = 1 ",
                              'slitting_core_id_length_id',
                              'slitting_core_id_length_value'
                            );
                            ?>

                            <?php
                            getSelectBox(
                              "form-group col-12 col-sm-6 col-xl-2",
                              "Core Material",
                              "work_order_2_slitting_core_material",
                              "SELECT * FROM `work_order_ui_slitting_core_id_type` where slitting_core_id_type_show = 1  ",
                              'slitting_core_id_type_id',
                              'slitting_core_id_type_value'
                            );
                            ?>

                            <?php
                            getSelectBox(
                              "form-group col-12 col-sm-6 col-lg-2 col-xl-2",
                              "Core Plugs",
                              "work_order_2_slitting_core_plugs",
                              "SELECT * FROM `work_order_ui_slitting_core_plugs` where core_plugs_show = 1  ",
                              'core_plugs_id',
                              'core_plugs_value'
                            );
                            ?>



                            <?php
                            getSelectBox(
                              "form-group col-12 col-lg-2",
                              "Roll Joint Color",
                              "work_order_2_slitting_qc_ins",
                              "SELECT * FROM `work_order_ui_slitting_qc_ins` where slitting_qc_ins_show = 1 ",
                              'slitting_qc_ins_id',
                              'slitting_qc_ins_value'
                            );
                            ?>


                            <div class="form-group col-12 col-lg-4">
                              <label>Max No of Joints per Roll</label>
                              <input type="number" min="0" max="3" class="form-control" name="work_order_max_joints" placeholder="Max Joints/Roll">
                            </div>





                          </div>
                        </div>


                      </div>

                      <br>
                      <div class="row">
                        <div class="form-group col-12">
                          <label>Roll Remarks</label>
                          <textarea name="work_order_remarks_roll" class="form-control remarksEdit" placeholder="Remarks" style="height:200px"></textarea>
                        </div>
                      </div>
                    </div>

                    <div class="classOnlyPouch">
                      <div class="row">
                        <div class="col-8" id="pouchSwHolder">

                        </div>
                        <div class="form-group col-4">
                          <label>Pouch Type</label>
                          <select id="pouch_switcher" class="form-control select_a" required name="work_order_pouch_type">
                            <?php
                            $getWinds = mysqlSelect("SELECT * FROM `work_order_digital_master` where dm_type =1 order by dm_header asc");
                            if (is_array($getWinds)) {
                              foreach ($getWinds  as $Wind) {
                                echo '<option data-id="' . $Wind['dm_img_url'] . '" value="' . $Wind['dm_id'] . '">' . $Wind['dm_header'] . '</option>';
                              }
                            }
                            ?>
                          </select>
                          <hr>
                          <div class="row">
                            <div class="form-group col-sm-6 col-xl-4">
                              <label>A </label>
                              <input type="text" class="form-control" name="work_order_pouch_val_a" placeholder="A">
                            </div>
                            <div class="form-group col-sm-6 col-xl-4">
                              <label>B </label>
                              <input type="text" class="form-control" name="work_order_pouch_val_b" placeholder="B">
                            </div>
                            <div class="form-group col-sm-6 col-xl-4">
                              <label>C </label>
                              <input type="text" class="form-control" name="work_order_pouch_val_c" placeholder="C">
                            </div>
                            <div class="form-group col-sm-6 col-xl-4">
                              <label>D </label>
                              <input type="text" class="form-control" name="work_order_pouch_val_d" placeholder="D">
                            </div>
                            <div class="form-group col-sm-6 col-xl-4">
                              <label>E </label>
                              <input type="text" class="form-control" name="work_order_pouch_val_e" placeholder="E">
                            </div>
                            <div class="form-group col-sm-6 col-xl-4">
                              <label>F </label>
                              <input type="text" class="form-control" name="work_order_pouch_val_f" placeholder="F">
                            </div>
                            <div class="form-group col-sm-6 col-xl-4">
                              <label>G</label>
                              <input type="text" class="form-control" name="work_order_pouch_val_g" placeholder="G">
                            </div>
                            <div class="form-group col-sm-6 col-xl-4">
                              <label>H</label>
                              <input type="text" class="form-control" name="work_order_pouch_val_h" placeholder="H">
                            </div>

                            <div class="form-group col-12">
                              <label class="form-label">Options</label>
                              <div class="selectgroup selectgroup-pills">
                                <?php
                                $getExtOp1 = mysqlSelect("SELECT * FROM `work_order_ui_pouch_lap_fin` where lap_fin_show = 1 ");
                                if (is_array($getExtOp1)) {
                                  foreach ($getExtOp1 as $ExtOp1) {
                                    echo '
      <label class="selectgroup-item">
              <input type="checkbox" name="work_order_3_pouch_lap_fin[]" value="' . $ExtOp1['lap_fin_id'] . '" class="selectgroup-input" ' . ($ExtOp1['lap_fin_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $ExtOp1['lap_fin_value'] . '</span>
            </label>';
                                  }
                                }
                                ?>

                              </div>

                            </div>


                          </div>
                        </div>
                      </div>

                      <br>
                      <div class="row">
                        <div class="form-group col-12">
                          <label>Pouch Remarks</label>
                          <textarea name="work_order_remarks_pouch" class="form-control remarksEdit" placeholder="Remarks" style="height:200px"></textarea>
                        </div>
                      </div>

                    </div>

                    <div class="classOnlyBag">

                      <div class="row">
                        <div class="col-8" id="bagSwHolder">

                        </div>
                        <div class="form-group col-4">
                          <label>Bag Type</label>
                          <select id="bag_switcher" class="form-control select_a" required name="work_order_bag_type">
                            <?php
                            $getWinds = mysqlSelect("SELECT * FROM `work_order_digital_master` where dm_type =2 order by dm_header asc");
                            if (is_array($getWinds)) {
                              foreach ($getWinds  as $Wind) {
                                echo '<option data-id="' . $Wind['dm_img_url'] . '" value="' . $Wind['dm_id'] . '">' . $Wind['dm_header'] . '</option>';
                              }
                            }
                            ?>
                          </select>
                          <hr>
                          <div class="row">
                            <div class="form-group col-sm-6 col-xl-4">
                              <label>A </label>
                              <input type="text" class="form-control" name="work_order_bags_val_a" placeholder="A">
                            </div>
                            <div class="form-group col-sm-6 col-xl-4">
                              <label>B </label>
                              <input type="text" class="form-control" name="work_order_bags_val_b" placeholder="B">
                            </div>
                            <div class="form-group col-sm-6 col-xl-4">
                              <label>C </label>
                              <input type="text" class="form-control" name="work_order_bags_val_c" placeholder="C">
                            </div>
                            <div class="form-group col-sm-6 col-xl-4">
                              <label>D </label>
                              <input type="text" class="form-control" name="work_order_bags_val_d" placeholder="D">
                            </div>
                            <div class="form-group col-sm-6 col-xl-4">
                              <label>E </label>
                              <input type="text" class="form-control" name="work_order_bags_val_e" placeholder="E">
                            </div>
                            <div class="form-group col-sm-6 col-xl-4">
                              <label>F </label>
                              <input type="text" class="form-control" name="work_order_bags_val_f" placeholder="F">
                            </div>
                            <div class="form-group col-sm-6 col-xl-4">
                              <label>G</label>
                              <input type="text" class="form-control" name="work_order_bags_val_g" placeholder="G">
                            </div>
                            <div class="form-group col-sm-6 col-xl-4">
                              <label>H</label>
                              <input type="text" class="form-control" name="work_order_bags_val_h" placeholder="H">
                            </div>
                          </div>

                        </div>
                      </div>
                      <br>

                      <div class="row">
                        <div class="form-group col-12">
                          <label>Bags Remarks</label>

                          <textarea name="work_order_remarks_bags" class="form-control remarksEdit" placeholder="Remarks" style="height:200px"></textarea>
                        </div>
                      </div>

                    </div>

                    <hr>

                    <div class="row">
                      <div class="form-group col-12 col-lg-6 col-xl-3" id="workOrderFoilPrint">
                        <?php
                        getSelectBox(
                          "form-group",
                          "Foil Finish Towards Printing Substrate",
                          "work_order_2_foil_print_side",
                          "SELECT * FROM `work_order_ui_foil_print_side` where foil_print_side_show = 1 order by foil_print_side_value asc ",
                          'foil_print_side_id',
                          'foil_print_side_value'
                        );
                        ?>
                      </div>


                      <?php
                      getSelectBox(
                        "form-group col-12 col-lg-6 col-xl-2",
                        "Printing Method",
                        "work_order_2_printing_method",
                        "SELECT * FROM `work_order_ui_print_surfrev` where surfrev_show = 1 ",
                        'surfrev_id',
                        'surfrev_value'
                      );
                      ?>

                      <?php
                      getSelectBox(
                        "form-group col-12 col-lg-6 col-xl-2",
                        "Shade Card Required",
                        "work_order_2_printing_shade_card_needed",
                        "SELECT * FROM `work_order_ui_print_shadecardreq` where shadecardreq_show = 1 ",
                        'shadecardreq_id',
                        'shadecardreq_value'
                      );
                      ?>
                      <?php
                      getSelectBox(
                        "form-group col-12 col-lg-6 col-xl-2",
                        "Color Reference Type",
                        "work_order_2_printing_color_ref_type",
                        "SELECT * FROM `work_order_ui_print_shadecard_ref_type` where shadecard_ref_type_show = 1 and  shadecard_ref_type_id not in (1,5)",
                        'shadecard_ref_type_id',
                        'shadecard_ref_type_value'
                      );
                      ?>

                      <?php
                      getSelectBox(
                        "form-group col-12 col-lg-6 col-xl-2",
                        "Print Approval by",
                        "work_order_2_printing_approvalby",
                        "SELECT * FROM `work_order_ui_print_options` where print_options_show = 1  ",
                        'print_options_id',
                        'print_options_value'
                      );
                      ?>

                    </div>

                    <HR>

                    <div id="workOrderSlitProcess">

                      <div class="row">
                        <div class="classOnlyRoll col-sm-12 col-md-6 col-xl-4">
                          <?php
                          getSelectBox(
                            "form-group ",
                            "Individual Roll Packing Instructions",
                            "work_order_2_roll_pack_ins",
                            "SELECT * FROM `work_order_ui_slitting_pack_ins` where pack_ins_show = 1  ",
                            'pack_ins_id',
                            'pack_ins_value'
                          );
                          ?>
                        </div>

                        <div class="classBagPouch col-sm-12 col-md-6 col-xl-3">
                          <?php
                          getSelectBox(
                            "form-group ",
                            "Carton Packing Instructions",
                            "work_order_2_carton_pack_ins",
                            "SELECT * FROM `work_order_ui_pouch_pack_ins` where pouch_pack_ins_show = 1  ",
                            'pouch_pack_ins_id',
                            'pouch_pack_ins_value'
                          );
                          ?>
                        </div>
                        <?php
                        getSelectBox(
                          "form-group col-sm-12  col-md-6 col-xl-3",
                          "Pallet Marking Instructions",
                          "work_order_2_pallet_mark_ins",
                          "SELECT * FROM `work_order_ui_slitting_pallet_instructions` where pallet_instructions_show = 1  ",
                          'pallet_instructions_id',
                          'pallet_instructions_value'
                        );
                        ?>

                        <div class="classBagPouch form-group col-12 col-sm-6 col-lg-6 col-xl-2">
                          <label>No. Pouches per Bundle</label>
                          <input id="pouchPerBundle" min="1" max="99999999999" type="number" class="form-control" name="work_order_pouch_per_bund" placeholder="Pouches per Bundle">
                        </div>

                        <div class="classBagPouch form-group col-12 col-sm-6 col-lg-6 col-xl-2">
                          <label>No. Bundles per Box</label>
                          <input id="bundlePerBox" min="1" max="99999999999" type="number" class="form-control" name="work_order_bund_per_box" placeholder="Bundles per Box">
                        </div>
                        <div class="classBagPouch form-group col-12 col-sm-6 col-lg-6 col-xl-2">
                          <label>Max Pouches in a BOX</label>
                          <input type="text" class="form-control" id="piecePerBox" placeholder="" disabled>
                        </div>

                      </div>

                      <div class="row">
                        <?php
                        getSelectBox(
                          "form-group col-12 col-sm-6 col-lg-6 col-xl-2",
                          "Pallet Type",
                          "work_order_2_pallet_type",
                          "SELECT * FROM `work_order_ui_slitting_pallet` where slitting_pallet_show = 1  ",
                          'slitting_pallet_id',
                          'slitting_pallet_value'
                        );
                        ?>
                        <?php
                        getSelectBox(
                          "form-group col-12 col-lg-6 col-xl-2",
                          "Container Stuffing",
                          "work_order_2_cont_stuff",
                          "SELECT * FROM `work_order_ui_slitting_shipping_dets` where shipping_dets_show = 1 ",
                          'shipping_dets_id',
                          'shipping_dets_value'
                        );
                        ?>

                        <div class="form-group col-12 col-sm-6 col-lg-6 col-xl-2">
                          <label>Max Gross Weight per Pallet (KG)</label>
                          <input min="1" max="99999999999" type="number" class="form-control" name="work_order_max_gross_pallet_weight" placeholder="Max Gross Weight per Pallet">
                        </div>

                        <?php
                        getSelectBox(
                          "form-group col-sm-12 col-lg-2",
                          "Pallet Dimension",
                          "work_order_2_pallet_dim",
                          "SELECT * FROM `work_order_ui_pallet_size` where pallet_size_show = 1 order by pallet_size_value asc ",
                          'pallet_size_id',
                          'pallet_size_value'
                        );
                        ?>

                        <?php
                        getSelectBox(
                          "form-group col-sm-12 col-lg-2",
                          "Freight Type",
                          "work_order_2_freight_type",
                          "SELECT * FROM `work_order_ui_slitting_freight_ins` where freight_show = 1 ",
                          'freight_id',
                          'freight_value'
                        );
                        ?>

                        <div class="form-group col-12 col-sm-6 col-lg-6 col-xl-2">
                          <label>Carton Thickness</label>
                          <input name="work_order_cart_thick" type="number" min="3" max="7" class="form-control" value="3" placeholder="Ply">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-sm-12 ">
                          <label>Shipment Documents</label>

                          <div class="selectgroup selectgroup-pills">
                            <?php
                            $getSlitCustomrs = mysqlSelect("SELECT * FROM `work_order_ui_shipment` where shipment_show = 1 ");
                            if (is_array($getSlitCustomrs)) {
                              foreach ($getSlitCustomrs as $SingularOP) {
                                echo '
<label class="selectgroup-item">
  <input type="checkbox" name="work_order_3_docs[]" value="' . $SingularOP['shipment_id'] . '" class="selectgroup-input" ' . ($SingularOP['shipment_id'] == 1 ? 'checked' : '') . '>
  <span class="selectgroup-button">' . $SingularOP['shipment_value'] . '</span>
</label>';
                              }
                            }
                            ?>

                          </div>
                        </div>


                      </div>


                      <hr>

                      <div class="row">
                        <div class="form-group col-12">
                          <label>Overall Remarks</label>
                          <textarea name="work_order_remarks_overall" class="remarksEdit form-control" placeholder="Remarks" style="height:200px"></textarea>
                        </div>
                      </div>

                    </div>

                    <div class="form-group" align="center">
                      <button type="submit" class="btn btn-success">Save</button>
                    </div>


                  </form>
                </div>
              </div>
            </div>
          </div>






        </section>



      </div><!-- Main Content  -->

      <?php
      getFooter();
      ?>

    </div><!-- Main Wrapper  -->
  </div><!-- App -->
  <?php

  getScripts();
  ?>
  <script src="assets/js/bootbox.min.js"></script>
  <script src="assets/js/select2.full.min.js"></script>
  <script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
  <script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>


  <?php
  if (is_array($WorkOrderRepPub)) {
  ?>
    <script>
      $(document).ready(function(e) {
        <?php
        foreach ($WOstraightArrays as $k => $v) {
          if (!is_null($WorkOrderRepPub[$v])) {
            if ($k == 'work_order_delivery_date' || $k == "work_order_po_date") {
              echo '$(\'input[name="' . $k . '"]\').val("' . date('d-m-Y', $WorkOrderRepPub[$v]) . '");
						';
            } else {
              echo '$(\'input[name="' . $k . '"]\').val("' . $WorkOrderRepPub[$v] . '");
						';
            }
          }
        }
        ?>

        <?php
        foreach ($WOcheckboxArrays as $k => $v) {

          echo '$(\'input[name="' . $k . '[]"]\').each(function() {
						this.checked = false;
					});
					';
          if ($WorkOrderRepPub[$v] != '') {
            $s = explode(',', $WorkOrderRepPub[$v]);
            foreach ($s as $val) {
              echo '$(\'input:checkbox[name="' . $k . '[]"]\').filter("[value=\'' . $val . '\']").prop(\'checked\', true);
							';
            }
          }
        }
        ?>

        <?php
        foreach ($WOselectArrays as $k => $v) {
          if (!is_null($WorkOrderRepPub[$v])) {
            echo '$(\'select[name="' . $k . '"]\').val("' . $WorkOrderRepPub[$v] . '").change();
          ';
          }
        }
        ?>




      });
    </script>

  <?php
  }


  ?>


  <script>
    $(document).ready(function() {

      //Initial Setup
      setUpLaminateEntryLayers();

      setPrintedSetup();
      setBagPouchSetup();
      setUpSelect2s();
      setUpFilmToLaminate();
      getDif();
      setUpPouchImage();
      setUpBagImage();
      setUpRollImage();
      setCustName();
      setUpMaxPouch();
      setUpPrintingOption();
      setLamGSM();
      // setCartonPly();
      $(".remarksEdit").wysihtml5();

      //Listeners	

      //Trigger Functions for Ply Value Change
      $('#plyValueInput').change(function(e) {
        if ($('#plyValueInput').val() > 0 && $('#plyValueInput').val() < 6) {
          setUpLaminateEntryLayers();

          setUpFilmToLaminate();
          setUpSelect2s();
        }
      });

      //Trigger Functions for Essentials Printed Change
      $("input[name=work_order_3_essentials_printed]").change(function(e) {
        setPrintedSetup();
      });

      //Trigger Functions for Structure
      $("select[name=work_order_2_structure]").change(function(e) {
        setBagPouchSetup();
      });


      $("select[name=work_order_2_client_id]").change(function(e) {
        setCustName();
      });


      for (l = 1; l <= ($('#plyValueInput').val()); l++) {

        $('select[name="work_order_5_layer_' + l + '_material"]').change(function(e) {
          setUpFilmToLaminate();
          setLamGSM();
        });

      }

      for (l = 1; l <= ($('#plyValueInput').val()); l++) {

        $('input[name="work_order_layer_' + l + '_micron"]').change(function(e) {
          setUpFilmToLaminate();
          setLamGSM();
        });

      }


      $('#plyValueInput').change(function(e) {
        if ($('#plyValueInput').val() > 0 && $('#plyValueInput').val() < 6) {

          for (l = 1; l <= ($('#plyValueInput').val()); l++) {
            $('input[name="work_order_layer_' + l + '_micron"]').change(function(e) {
              setUpFilmToLaminate();
              setLamGSM();
            });

            $('select[name="work_order_5_layer_' + l + '_material"]').change(function(e) {
              setUpFilmToLaminate();
              setLamGSM();
            });

          }


        }
      });


      $("#pouch_switcher").change(function(e) {
        setUpPouchImage();
      });

      $("#bag_switcher").change(function(e) {
        setUpBagImage();
      });

      $("select[name=work_order_2_wind_dir]").change(function(e) {
        setUpRollImage();
      });

      $("#pouchPerBundle").change(function(e) {
        setUpMaxPouch();
      });

      $("#bundlePerBox").change(function(e) {
        setUpMaxPouch();
      });

      $("select[name=work_order_2_type_printed]").change(function(e) {
        setUpPrintingOption();
      });

      $("#formLoading").hide();
    });

    // function setCartonPly() {
    //   let struct = $('select[name=work_order_2_structure]').find(':selected').val();
    //   let bagPouchCont = $('select[name=work_order_2_roll_pack_ins]').find(':selected').val();
    //   let rollCont = $('select[name=work_order_2_carton_pack_ins]').find(':selected').val();

    //   if (struct == 1 || struct == 2) {
    //     //Bag/Pouch
    //     $("#cartonPly").show();
    //   } else {
    //     //ROll

    //     if (bagPouchCont == ) {
    //       $("#cartonPly").hide();
    //     } else {
    //       $("#cartonPly").show();
    //     }
    //   }
    // }

    function setLamGSM() {

      var layers = $('#plyValueInput').val();
      var l;
      var c = 0;

      for (l = 1; l <= (layers); l++) {
        var den = $('select[name=work_order_5_layer_' + l + '_material]').find(':selected').data('density');
        var gsm = $('input[name=work_order_layer_' + l + '_micron]').val();
        c += den * gsm;
      }
      $("#calcLamGSM").val(c);
    }

    function setUpPrintingOption() {
      var a = $("select[name=work_order_2_type_printed] :selected").val();
      if (a == 1) {
        $('#whenPrintedClickedGO').show();
      } else {
        $('#whenPrintedClickedGO').hide();
      }


    }

    function setUpMaxPouch() {
      var a = $("#pouchPerBundle").val();
      var b = $("#bundlePerBox").val();

      if (isNaN(a)) {
        a = 0;
      }

      if (isNaN(b)) {
        b = 0;
      }

      $("#piecePerBox").val(a * b)

    }

    function setCustName() {
      var custNameVar = $("select[name=work_order_2_client_id]").children("option:selected").data("name");
      $("input[id=custNameGetter]").val(custNameVar);
    }

    function setBagPouchSetup() {
      bagPouchRoll = $("select[name=work_order_2_structure]").children("option:selected").val();

      if (bagPouchRoll == 1) {
        $(".classOnlyBag").fadeIn();
        $(".classBagPouch").fadeIn();
        $(".classBagRoll").fadeIn();

        $(".classOnlyPouch").fadeOut();
        $(".classPouchRoll").fadeOut();

        $(".classOnlyRoll").fadeOut();
        $(".classPouchRoll").fadeOut();

      } else if (bagPouchRoll == 2) {
        $(".classOnlyBag").fadeOut();
        $(".classBagRoll").fadeOut();

        $(".classOnlyPouch").fadeIn();
        $(".classBagPouch").fadeIn();
        $(".classPouchRoll").fadeIn();

        $(".classOnlyRoll").fadeOut();
        $(".classBagRoll").fadeOut();

      } else if (bagPouchRoll == 3) {
        $(".classOnlyBag").fadeOut();
        $(".classBagPouch").fadeOut();

        $(".classOnlyPouch").fadeOut();
        $(".classBagPouch").fadeOut();

        $(".classOnlyRoll").fadeIn();
        $(".classPouchRoll").fadeIn();
        $(".classBagRoll").fadeIn();
      }


    }

    function setPrintedSetup() {
      printedVal = $("input[name=work_order_3_essentials_printed]:checked").val();
      if (printedVal == 0) {
        $("#workOrderPrintingProcess").fadeOut();
      } else {
        $("#workOrderPrintingProcess").fadeIn();
      }
    }

    function setUpSelect2s() {
      $('.select_a').select2();
    }

    function getDif() {
      // To set two dates to two variables 
      var a = $("input[name=work_order_po_date]").val();
      var s = a.split("-");
      var d1 = s[2] + "-" + s[1] + "-" + s[0];

      var b = $("input[name=work_order_delivery_date]").val();
      var s1 = b.split("-");
      var d2 = s1[2] + "-" + s1[1] + "-" + s1[0];

      var date1 = new Date(d1);

      var date2 = new Date(d2);


      // To calculate the time difference of two dates 
      var Difference_In_Time = date2.getTime() - date1.getTime();

      // To calculate the no. of days between two dates 
      var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);


      $("input[id=numberOfDays]").val(Difference_In_Days + " days");


    }

    function setUpLaminateEntryLayers() {
      var layers = $('#plyValueInput').val();
      var containerLayer = $('#containerLaminateLayers');
      var lamPrefix = 'laminateRowId';
      var stringOutput = "";
      var l;

      for (l = 1; l <= (layers); l++) {
        stringOutput = stringOutput.concat("",
          "<div id=\"laminateRowId" + l + "\" class=\"row\">",
          "    <div class=\"col-12\">",
          "        <div class=\"row\">",
          "           <div class=\"col-12\">",
          "               <p align=\"left\" style=\"margin-left:10px\">Film/Laminate Layer " + l + "</p>",
          "            </div>",
          "        </div>",
          "       <div class=\"row\">",
          "           <div class=\"form-group col-6\">",
          "            <label>Micron</label>",
          "             <input type=\"number\" class=\"form-control\" min='0' step='0.01' required name=\"work_order_layer_" + l + "_micron\" placeholder=\"Film Micron\">",
          "           </div>",
          "           <div class=\"form-group col-6\">",
          "             <label>Film</label>",
          "             <select class=\"form-control select_a\" required name=\"work_order_5_layer_" + l + "_material\">",
          <?php
          $getMaterials = mysqlSelect("SELECT * FROM `materials_main` order by material_value asc");
          if (is_array($getMaterials)) {
            foreach ($getMaterials as $Material) {
              echo '"<option data-density=\"' . $Material['material_density'] . '\" value=\"' . $Material['material_id'] . '\">' . $Material['material_value'] . '</option>",';
            }
          }
          ?> "            </select> ",
          "           </div>",
          "        </div>",
          "   </div>",
          "</div>");
      }

      containerLayer.html(stringOutput);
      stringOutput = "";
      setLamGSM();

    }

    function setUpFilmToLaminate() {
      var layers = $('#plyValueInput').val();
      var l;

      var foilPrint = false;


      for (l = 1; l <= (layers); l++) {
        var valFilmID = $('select[name="work_order_5_layer_' + l + '_material"] option:selected').val();


        if ((l == 1) && (valFilmID == 3 || valFilmID == 17 || valFilmID == 52)) {
          foilPrint = true;
        }

      }

      if (!foilPrint) {
        $("#workOrderFoilPrint").fadeOut();
      } else {
        $("#workOrderFoilPrint").fadeIn();
      }

    }

    function setUpPouchImage() {
      $("#pouchSwHolder").html('<img class="img-thumbnail" src="' + $("#pouch_switcher").find(':selected').data('id') + '" />');

    }

    function setUpBagImage() {
      $("#bagSwHolder").html('<img class="img-thumbnail" src="' + $("#bag_switcher").find(':selected').data('id') + '" />');

    }

    function setUpRollImage() {
      $("#imgRollPut").html('<img class="img-thumbnail" src="assets/slitting/' + $("select[name=work_order_2_wind_dir]").find(':selected').data('id') + '.jpg" />');

    }
  </script>

  <script>
    $(document).ready(function(e) {
      <?php

      if (is_array($WorkOrderRepPub)) {
        if (is_numeric($WorkOrderRepPub['master_wo_ply'])) {

          for ($counterL = 1; $counterL <= $WorkOrderRepPub['master_wo_ply']; $counterL++) {
            echo '$(\'input[name="work_order_layer_' . $counterL . '_micron"]\').val("' . $WorkOrderRepPub['master_wo_layer_' . $counterL . '_micron'] . '");';
            echo '$(\'select[name="work_order_5_layer_' . $counterL . '_material"]\').val("' . $WorkOrderRepPub['master_wo_layer_' . $counterL . '_structure'] . '").change();';
          }
        }
      }

      ?>


    });
  </script>

  <script>
    $(document).ready(function(e) {

      $('#formContainer').on('submit', (function(e) {
        var formCont = $(this)[0];

        e.preventDefault();

        bootbox.confirm("Are you sure you want to add this Work Order to drafts ?", function(result) {
          if (result) {
            $('#formContainer').fadeOut();
            var formData = new FormData(formCont);
            $.ajax({
              type: 'POST',
              url: $(formCont).attr('action'),
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success: function(data) {

                if (data.trim() == "") {
                  $('#formContainer').html("");
                  $("#formSuccess").fadeIn();
                  $("#formFail").fadeOut();
                  $('html,body').animate({
                    scrollTop: $("html").offset().top
                  }, 'slow');
                } else {
                  $("#formFail").html(data);
                  $('#formContainer').fadeIn();
                  $("#formSuccess").fadeOut();
                  $("#formFail").fadeIn();
                  $('html,body').animate({
                    scrollTop: $("#formFail").offset().top
                  }, 'slow');
                }
              },
              error: function(data) {
                alert("Contact Admin.");
              }
            });

          }
        });


      }));

    });
  </script>
</body>

</html>