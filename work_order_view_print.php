<?php
require_once("server_fundamentals/SessionHandler.php");
require_once("server_fundamentals/PostDataHeadChecker.php");
getHead("Work Order Complete Print View");

$exit_out = true;

//there must be exactly 1 getter present
if (count($_GET) != 1) {
  die("User passed invalid Parameters ");
}

//If workorder TABLE ID is given for Master
if (isset($_GET['pid'])) {
  $REF_NUMBER = 0;
  if (!is_numeric($_GET['pid'])) {
    die("Invalid ID Parameter for WO");
  }

  $getWo = mysqlSelect("
       select * from master_work_order_main 
        
		left join clients_main on master_wo_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id
		left join master_work_order_reference_number on master_wo_ref = mwo_ref_id

        where master_wo_id= " . $_GET['pid'] . " 
		" . $inColsWO . "
		");

  if (!is_array($getWo)) {
    die("Work Order Not Found");
  }

  $WorkOrderRepPub =  $getWo[0];
  $exit_out = false;
  $REF_NUMBER = $WorkOrderRepPub['master_wo_ref'];
}

//If draft is being pulled
if (isset($_GET['did'])) {
  if (!is_numeric($_GET['did'])) {
    die("Invalid Sales Parameter 1");
  }
  $getDraft = mysqlSelect("
SELECT * FROM `sales_work_order_main` 
		left join clients_main on s_wo_client_id = client_id
		where 
		" . $inColsDRAFT . "
		s_wo_id= " . $_GET['did']);

  if (!is_array($getDraft)) {
    var_dump($getDraft);
    die("Invalid Sales Parameter");
  }

  $WorkOrderRepDraft =  $getDraft[0];
  $exit_out = false;
}

//get all the work order trails and then track department wise who did what
if (isset($_GET['id'])) {
  $REF_NUMBER = 0;
  $getMasterDrafts = mysqlSelect($UpdatedStatusQuery . "
left join clients_main on master_wo_client_id = client_id
left join master_work_order_main_identitiy on master_wo_status = mwoid_id
		where master_wo_ref = " . $_GET['id'] . "
		order by master_wo_id asc
				");
  $exit_out = false;
  $REF_NUMBER = $getMasterDrafts[0]['master_wo_ref'];
}

if ($exit_out) {
  die("Invalid Parameters Passed");
}
?>
<link href="assets/css/select2.min.css" rel="stylesheet" />

<style>
  .colorSales {
    color: black;
  }

  .colorQuality {
    color: green;
  }

  .colorFactory {
    color: red;
  }

  .colorPlanning {
    color: blue;
  }
</style>

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
            <h1>Work Order Print View</h1>
          </div>
          <!-- TOP CONTENT BLOCKS -->

          <div class="row">
            <div class="col-12 ">
              <div class="card card-warning">


                <div class="card-body text-justify">
                  <div id="formFail" class="alert alert-danger" style="display:none">
                  </div>
                  <div id="formLoading" class="alert alert-warning">
                    Form Is Loading
                  </div>

                  <div id="formSuccess" class="alert alert-success" style="display:none">
                    Saved
                  </div>

                  <form id="formContainer" action="" method="post">
                    <div id="workOrderHeaderDetails">

                      <div class="row">

                        <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                          <label>Customer Code</label>
                          <select class="form-control select_a" required name="work_order_5_client_id">
                            <?php
                            $getClients = mysqlSelect("SELECT * FROM `clients_main` order by client_name asc ");
                            if (is_array($getClients)) {
                              foreach ($getClients as $Client) {
                                echo '<option value="' . $Client['client_id'] . '">' . $Client['client_code'] . ' - ' . $Client['client_name'] . '</option>';
                              }
                            } else {
                              echo '<option value="-m-x">None</option>';
                            }
                            ?>
                          </select>
                        </div>

                        <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                          <label>Customer(s) Required Delivery Date</label>
                          <input type="text" class="form-control" name="work_order_delivery_date" placeholder="DD-MM-YYYY">
                        </div>

                        <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                          <label>Customer P.O Date</label>
                          <input type="text" class="form-control" name="work_order_po_date" placeholder="DD-MM-YYYY">
                        </div>

                        <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                          <label>Customer Design Code</label>
                          <input type="text" class="form-control" name="work_order_customer_item_code" placeholder="Customer Design Code">
                        </div>

                        <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                          <label>Customer P.O#</label>
                          <input type="text" class="form-control" name="work_order_add_po" placeholder="Purchase Order Reference">
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
  <input type="checkbox" name="work_order_4_customer_loc[]" value="' . $SingularOP['customer_location_id'] . '" class="selectgroup-input" ' . ($SingularOP['customer_location_id'] == 1 ? 'checked' : '') . '>
  <span class="selectgroup-button">' . $SingularOP['customer_location_value'] . '</span>
</label>';
                              }
                            }
                            ?>

                          </div>
                        </div>

                      </div>

                      <div class="row">

                        <div class="form-group col-12 col-md-6 col-lg-3 col-xl-2">
                          <label>Sales Code</label>
                          <select class="form-control select_a" required name="work_order_5_sales_id">
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
                          "work_order_3_structure",
                          "SELECT * FROM `work_order_ui_structure` ",
                          'structure_id',
                          'structure_value'
                        );
                        ?>

                        <div class="form-group col-12 col-md-6 col-lg-3 col-xl-2">
                          <label>IPP Design ID</label>
                          <input type="text" class="form-control" name="work_order_design_id" placeholder="IPP Design ID">
                        </div>

                        <div class="form-group col-12 col-md-6 col-lg-3 col-xl-2">
                          <label>Approved Sample WO No.</label>
                          <input type="text" class="form-control" name="work_order_customer_item_code" placeholder="Approved Sample WO NO">
                        </div>


                      </div>

                      <div class="row">
                        <div class="form-group col-8 col-xl-4 ">
                          <label>Order Qty</label>
                          <input placeholder="Order Quantity" name="work_order_quantity" type="number" step="0.01" class="form-control" min="0.10">
                        </div>

                        <?php
                        getSelectBox(
                          "form-group col-4 col-xl-2 ",
                          "Qty Unit",
                          "work_order_5_units",
                          "SELECT * FROM `work_order_qty_units` ",
                          'unit_id',
                          'unit_value'
                        );
                        ?>

                        <div class="row col-12 col-xl-6">
                          <div class="form-group col-1 col-xl-1 ">
                            <label>&nbsp;</label>
                            <h6>+</h6>
                          </div>

                          <div class="form-group col-4 col-xl-4">
                            <label>&nbsp;</label>
                            <input placeholder="Tolerance Min" name="work_order_quantity_tolerance_1" type="number" step="0.01" class="form-control" min="0">
                          </div>

                          <div class="form-group col-1 col-xl-1 ">
                            <label>&nbsp;</label>
                            <h6>-</h6>
                          </div>

                          <div class="form-group col-4 col-xl-4 ">
                            <label>&nbsp;</label>
                            <input placeholder="Tolerance Max" name="work_order_quantity_tolerance_2" type="number" step="0.01" class="form-control" min="0">
                          </div>

                          <div class="form-group col-1 col-xl-1 ">
                            <label>&nbsp;</label>
                            <h6>%</h6>
                          </div>

                        </div>
                      </div>

                      <div class="row">
                        <?php
                        getSelectBox(
                          "form-group col-8 col-xl-3",
                          "Wind DIR",
                          "work_order_wind_dir",
                          "SELECT * FROM `work_order_wind_dir` order by wind_value asc",
                          'wind_id',
                          'wind_value'
                        );
                        ?>
                        <div class="form-group col-8 col-xl-3">
                          <label>Total Laminate GSM</label>
                          <input placeholder="Quantity" name="work_order_quantity" type="number" step="0.01" class="form-control" min="0.10">
                        </div>

                        <div class="row col-12 col-xl-6">
                          <div class="form-group col-1 col-xl-1 ">
                            <label>&nbsp;</label>
                            <h6>+</h6>
                          </div>

                          <div class="form-group col-4 col-xl-4">
                            <label>&nbsp;</label>
                            <input placeholder="Tolerance Min" name="work_order_quantity_tolerance_1" type="number" step="0.01" class="form-control" min="0">
                          </div>

                          <div class="form-group col-1 col-xl-1 ">
                            <label>&nbsp;</label>
                            <h6>-</h6>
                          </div>

                          <div class="form-group col-4 col-xl-4 ">
                            <label>&nbsp;</label>
                            <input placeholder="Tolerance Max" name="work_order_quantity_tolerance_2" type="number" step="0.01" class="form-control" min="0">
                          </div>

                          <div class="form-group col-1 col-xl-1 ">
                            <label>&nbsp;</label>
                            <h6>%</h6>
                          </div>

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
                          "form-group col-sm-12 col-lg-6 col-xl-4",
                          "Application",
                          "work_order_5_application",
                          "SELECT * FROM `work_order_applications` order by application_value asc ",
                          'application_id',
                          'application_value'
                        );
                        ?>


                      </div>

                      <div id="containerLaminateLayers">
                      </div>

                      <div class="row">
                        <div class="form-group col-12">
                          <label>Overall Remarks</label>
                          <textarea name="work_order_remarks_overall" class="form-control" placeholder="Remarks" style="height:90px"></textarea>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-12 col-lg-6" id="workOrderFoilPrint">
                          <?php
                          getSelectBox(
                            "form-group",
                            "Foil Printing Side",
                            "work_order_3_foil_print_side",
                            "SELECT * FROM `work_order_ui_foil_print_side` order by foil_print_side_value asc ",
                            'foil_print_side_id',
                            'foil_print_side_value'
                          );
                          ?>
                        </div>
                        <div class="form-group col-12 col-lg-6" id="workOrderFoilLam">
                          <?php
                          getSelectBox(
                            "form-group",
                            "Foil Lamination Side",
                            "work_order_3_foil_lam_side",
                            "SELECT * FROM `work_order_ui_foil_lam_side` order by foil_lam_side_value asc ",
                            'foil_lam_side_id',
                            'foil_lam_side_value'
                          );
                          ?>
                        </div>

                      </div>

                      <HR>

                    </div>

                    <div id="workOrderEssentialOptions">
                      <div class="row">
                        <div class="form-group col-sm-12 col-lg-6">
                          <label class="form-label">Printed?</label>
                          <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                              <input type="radio" name="work_order_3_essentials_printed" value="1" class="selectgroup-input" checked>
                              <span class="selectgroup-button">Yes</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="work_order_3_essentials_printed" value="0" class="selectgroup-input">
                              <span class="selectgroup-button">No</span>
                            </label>
                          </div>


                        </div>

                        <div class="form-group col-sm-12 col-lg-6">
                          <label class="form-label">In House PE?</label>
                          <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                              <input type="radio" name="work_order_3_essentials_plastic" value="1" class="selectgroup-input" checked>
                              <span class="selectgroup-button">Yes</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="work_order_3_essentials_plastic" value="0" class="selectgroup-input">
                              <span class="selectgroup-button">No</span>
                            </label>
                          </div>

                        </div>



                      </div>
                      <hr>
                    </div>

                    <div id="workOrderExtrusionProcess">
                      <div class="section-title">Extrusion Process (Only for Inhouse PE)</div>

                      <div class="row">
                        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
                          <label>PE Recipe:</label>
                          <input type="text" class="form-control" name="work_order_extrusion_pe_recipe" placeholder="PE Recipe">
                        </div>

                        <div class="form-group col-sm-12 col-sm-6 col-lg-4">
                          <label class="form-label">Antistatic</label>
                          <div class="selectgroup w-100">
                            <?php
                            $getAntis = mysqlSelect("SELECT * FROM `work_order_ui_ext_antistatic` where anti_show = 1 ");
                            if (is_array($getAntis)) {
                              foreach ($getAntis as $Anti) {
                                echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_extrusion_antistatic" value="' . $Anti['anti_id'] . '" class="selectgroup-input" ' . ($Anti['anti_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $Anti['anti_value'] . '</span>
            </label>
    ';
                              }
                            }
                            ?>

                          </div>
                        </div>

                        <div class="form-group col-sm-12 col-sm-6 col-lg-4">
                          <label class="form-label">Layer</label>
                          <div class="selectgroup w-100">
                            <?php
                            $getLayersTypes = mysqlSelect("SELECT * FROM `work_order_ui_ext_layer_type` where layer_type_show = 1 ");
                            if (is_array($getLayersTypes)) {
                              foreach ($getLayersTypes as $LayerType) {
                                echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_extrusion_layer" value="' . $LayerType['layer_type_id'] . '" class="selectgroup-input" ' . ($LayerType['layer_type_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $LayerType['layer_type_value'] . '</span>
            </label>
    ';
                              }
                            }
                            ?>

                          </div>
                        </div>


                      </div>

                      <div class="row">
                        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
                          <label>Pack Weight </label>
                          <input type="number" min="1" max="999999999" step="0.01" class="form-control" name="work_order_extrusion_pack_weight" placeholder="Weigth">
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
                          <label>Pack Size</label>
                          <input type="number" min="1" max="999999999" step="0.01" class="form-control" name="work_order_extrusion_pack_size" placeholder="Size">
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
                          <label>Pack QTY Unit</label>
                          <select class="form-control select_pack_qty_unit" name="work_order_5_extrusion_pack_units">
                            <?php
                            $getUnits = mysqlSelect("SELECT * FROM `work_order_qty_units` ");
                            if (is_array($getUnits)) {
                              foreach ($getUnits as $Unit) {
                                echo '<option value="' . $Unit['unit_id'] . '">' . $Unit['unit_value'] . '</option>';
                              }
                            }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-12">
                          <label class="form-label">Options</label>
                          <div class="selectgroup selectgroup-pills">
                            <?php
                            $getExtOp1 = mysqlSelect("SELECT * FROM `work_order_ui_ext_options` where ext_options_show = 1 ");
                            if (is_array($getExtOp1)) {
                              foreach ($getExtOp1 as $ExtOp1) {
                                echo '
			<label class="selectgroup-item">
              <input type="checkbox" name="work_order_4_extrusion_options[]" value="' . $ExtOp1['ext_options_id'] . '" class="selectgroup-input" ' . ($ExtOp1['ext_options_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $ExtOp1['ext_options_value'] . '</span>
            </label>
    ';
                              }
                            }
                            ?>

                          </div>

                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
                          <label>Thickness (U).</label>
                          <input type="number" min="1" max="999999999" step="0.01" class="form-control" name="work_order_extrusion_thickness" placeholder="Thickness">
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
                          <label>Treatment</label>
                          <div class="selectgroup w-100">
                            <?php
                            $getTreatments = mysqlSelect("SELECT * FROM `work_order_ui_ext_treatment` where treat_show = 1 ");
                            if (is_array($getTreatments)) {
                              foreach ($getTreatments as $Treatment) {
                                echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_extrusion_treatment" value="' . $Treatment['treat_id'] . '" class="selectgroup-input" ' . ($Treatment['treat_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $Treatment['treat_value'] . '</span>
            </label>
    ';
                              }
                            }
                            ?>

                          </div>

                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
                          <label>Customer Roll OD(mm)</label>
                          <input type="number" min="1" max="999999999" step="0.01" class="form-control" name="work_order_extrusion_roll_od" placeholder="Customer Roll OD">
                        </div>
                      </div>


                      <div class="row">
                        <div class="form-group col-sm-12 col-lg-6">
                          <label>Extrude In</label>
                          <div class="selectgroup w-100">
                            <?php
                            $getExtrudes = mysqlSelect("SELECT * FROM `work_order_ui_ext_extrude_in` where extrude_in_show = 1 ");
                            if (is_array($getExtrudes)) {
                              foreach ($getExtrudes as $Extrudes) {
                                echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_extrusion_extrude_in" value="' . $Extrudes['extrude_in_id'] . '" class="selectgroup-input" ' . ($Extrudes['extrude_in_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $Extrudes['extrude_in_value'] . '</span>
            </label>
    ';
                              }
                            }
                            ?>

                          </div>

                        </div>


                        <div class="form-group col-sm-12 col-lg-6">
                          <label>Film Color</label>
                          <input type="text" class="form-control" name="work_order_extrusion_film_color" placeholder="Film Color">
                        </div>

                      </div>

                      <div class="row">

                        <div class="form-group col-sm-12 col-lg-4 ">
                          <label>C.O.F </label>
                          <div class="selectgroup w-100">
                            <?php
                            $getCOFs = mysqlSelect("SELECT * FROM `work_order_ui_ext_cof` where cof_show = 1 ");
                            if (is_array($getCOFs)) {
                              foreach ($getCOFs as $COF) {
                                echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_extrusion_cof" value="' . $COF['cof_id'] . '" class="selectgroup-input" ' . ($COF['cof_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $COF['cof_value'] . '</span>
            </label>
    ';
                              }
                            }
                            ?>

                          </div>
                        </div>

                        <div class="form-group col-sm-12 col-lg-2 ">
                          <label>COF (Inner to Inner) Val</label>
                          <input type="text" class="form-control" name="work_order_cof_extr_i2i_value" placeholder="COF (Inner to Inner) Val">
                        </div>

                        <div class="form-group col-sm-12 col-lg-2 ">
                          <label>COF (Inner to Inner) Val</label>
                          <input type="text" class="form-control" name="work_order_cof_extr_o2o_value" placeholder="COF (Inner to Inner) Val">
                        </div>

                        <div class="form-group col-sm-12 col-lg-2 ">
                          <label>COF (Outer to Metal) Val</label>
                          <input type="text" class="form-control" name="work_order_cof_extr_o2m_value" placeholder="COF (Outer to Metal) Val">
                        </div>

                        <div class="form-group col-sm-12 col-lg-2 ">
                          <label>COF (Inner to Metal) Val</label>
                          <input type="text" class="form-control" name="work_order_cof_extr_i2m_value" placeholder="COF (Inner to Metal) Val">
                        </div>

                      </div>

                      <div class="row">

                        <div class="form-group col-sm-12 col-lg-6 ">
                          <label>PE Film Features </label>
                          <div class="selectgroup w-100">
                            <?php
                            $getDB = mysqlSelect("SELECT * FROM `work_order_ui_pe_film_feature` where pe_film_feature_show = 1 ");
                            if (is_array($getDB)) {
                              foreach ($getDB as $VAls) {
                                echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_extrusion_pe_film_feature" value="' . $VAls['pe_film_feature_id'] . '" class="selectgroup-input" ' . ($VAls['pe_film_feature_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $VAls['pe_film_feature_value'] . '</span>
            </label>
    ';
                              }
                            }
                            ?>

                          </div>
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 ">
                          <label>DYNE VALUE</label>
                          <input type="text" class="form-control" name="work_order_extrusion_dyne_value" placeholder="DYNE Value">
                        </div>


                      </div>

                      <div class="row">
                        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                          <label>Single Coil Width</label>
                          <input type="text" class="form-control" name="work_order_extrusion_single_coil_width" placeholder="Single Coil Width">
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                          <label>No. of UPS</label>
                          <input type="text" class="form-control" name="work_order_extrusion_no_of_ups" placeholder="No. of UPS">
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                          <label>Jumbo Film Width</label>
                          <input type="text" class="form-control" name="work_order_extrusion_jumbo_coil" placeholder="Jumbo Film Width">
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                          <label>Recycle Percentage</label>
                          <input type="text" class="form-control" name="work_order_extrusion_recycle_percentage" placeholder="Recycle Percentage">
                        </div>

                      </div>

                      <div class="row">
                        <div class="form-group col-12">
                          <label>Extrusion Remarks</label>
                          <table class="table table-striped table-bordered">
                            <tr>
                              <th width="20%">User </th>
                              <th width="70%">Remark</th>
                              <th width="10%">Time</th>
                            </tr>
                            <?php
                            if (!isset($_GET['did'])) {


                              $getOverallRem = mysqlSelect("SELECT r.*,m.lum_code,m.lum_name FROM `remarks_wo` r
                left join user_main m on remark_lum_id = m.lum_id
                where remark_status = 1
                and remark_type = 2
                and remark_master_wo_id = " . $REF_NUMBER);

                              if (is_array($getOverallRem)) {
                                foreach ($getOverallRem as $OverallRem) {
                                  echo '
                        <tr>
                            <td>' . $OverallRem['lum_code'] . ' - ' . $OverallRem['lum_name'] . '</td>
                            <td>' . $OverallRem['remark_text'] . '</td>
                            <td>' . date('d-m-Y @ h:i:s a', $OverallRem['remark_dnt']) . '</td>
                        </tr>
                        
                        ';
                                }
                              }
                            } else {
                              echo '
							<tr>
								<td colspan="3">' . $WorkOrderRepDraft['s_wo_remarks_ext'] . '</td>
							</tr>
							
							';
                            }

                            ?>
                          </table>

                        </div>
                      </div>
                      <HR>
                    </div>

                    <div id="workOrderPrintingProcess">
                      <div class="section-title">Printing Process (Only for jobs without unprinted in job names)</div>

                      <div class="row">
                        <div class="form-group col-sm-12 col-lg-4 ">
                          <label>Design Name</label>
                          <input type="text" class="form-control" name="work_order_printing_design" placeholder="Design Name">
                        </div>

                        <div class="form-group col-sm-12 col-lg-4 ">
                          <label>Cylinder Supplier</label>

                          <div class="selectgroup w-100">
                            <?php
                            $get_cylinder_supplier = mysqlSelect("SELECT * FROM `work_order_ui_print_cylinder_supplier` where cylinder_supplier_show = 1 ");
                            if (is_array($get_cylinder_supplier)) {
                              foreach ($get_cylinder_supplier as $cylinder_supplier) {
                                echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_printing_cylinder_supplier" value="' . $cylinder_supplier['cylinder_supplier_id'] . '" class="selectgroup-input" ' . ($cylinder_supplier['cylinder_supplier_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $cylinder_supplier['cylinder_supplier_value'] . '</span>
            </label>
    ';
                              }
                            }
                            ?>

                          </div>
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
                          <label>Printing Method</label>
                          <div class="selectgroup w-100">
                            <?php
                            $getSurfRev = mysqlSelect("SELECT * FROM `work_order_ui_print_surfrev` where surfrev_show = 1 ");
                            if (is_array($getSurfRev)) {
                              foreach ($getSurfRev as $SurfRev) {
                                echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_printing_surface_reverse" value="' . $SurfRev['surfrev_id'] . '" class="selectgroup-input" ' . ($SurfRev['surfrev_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $SurfRev['surfrev_value'] . '</span>  
            </label>
    ';
                              }
                            }
                            ?>

                          </div>
                        </div>


                      </div>

                      <div class="row">

                        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
                          <label>QTY.</label>
                          <input type="number" min="1" max="999999999" step="0.01" class="form-control" name="work_order_printing_qty" placeholder="Qty">
                        </div>

                        <div class="form-group col-12 col-lg-6 col-xl-4 ">
                          <label>Qty Unit</label>
                          <select class="form-control select_qty_unit" name="work_order_5_printing_units">
                            <?php
                            $getUnits = mysqlSelect("SELECT * FROM `work_order_qty_units` ");
                            if (is_array($getUnits)) {
                              foreach ($getUnits as $Unit) {
                                echo '<option value="' . $Unit['unit_id'] . '">' . $Unit['unit_value'] . '</option>';
                              }
                            }
                            ?>
                          </select>
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
                          <label>Substrate </label>
                          <input id="inputSubstrate" type="text" class="form-control" placeholder="Substrate" name="work_order_printing_substrate">
                        </div>

                      </div>

                      <div class="row">


                        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                          <label>Single Coil Width </label>
                          <input onChange="setUpTubeLength()" type="number" class="form-control" name="work_order_printing_single_coil_width" step=".01" value="0" min="0" max="999999999" placeholder="Single Coil Width">
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                          <label>UPS</label>
                          <input onChange="setUpTubeLength()" type="number" class="form-control" name="work_order_printing_ups_val" step=".01" value="0" min="0" max="999999999" placeholder="UPS">
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                          <label>Trim</label>
                          <input onChange="setUpTubeLength()" type="number" class="form-control" name="work_order_printing_trim_val" step=".01" value="0" min="0" max="999999999" placeholder="Trim">
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                          <label>Total Jumbo Film Width</label>
                          <p id="cylinderLengthCalculation">0 x 0 + 0 = 0</p>
                        </div>



                      </div>

                      <div class="row">


                        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                          <label>Single Coil Circumference </label>
                          <input onChange="setUpTubeCircum()" type="number" class="form-control" name="work_order_printing_single_coil_circ" step=".01" value="0" min="0" max="999999999" placeholder="Single Coil Circumference">
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                          <label>No. Of Across</label>
                          <input onChange="setUpTubeCircum()" type="number" class="form-control" name="work_order_printing_accross_val" step=".01" value="0" min="0" max="999999999" placeholder="Accross">
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                          <label>Bleed </label>
                          <input onChange="setUpTubeCircum()" type="number" class="form-control" name="work_order_printing_bleed_val" step=".01" value="0" min="0" max="999999999" placeholder="Bleed">
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                          <label>Total Circumference </label>
                          <p id="cylinderCircumferenceCalculation">0 x 0 + 0 = 0</p>
                        </div>



                      </div>

                      <div class="row">

                        <div class="form-group col-sm-12 col-lg-4 ">
                          <label>Shade Card Required</label>

                          <div class="selectgroup w-100">
                            <?php
                            $getShadeCardsReq = mysqlSelect("SELECT * FROM `work_order_ui_print_shadecardreq` where shadecardreq_show = 1 ");
                            if (is_array($getShadeCardsReq)) {
                              foreach ($getShadeCardsReq as $ShadeCardsReq) {
                                echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_printing_shade_card_needed" value="' . $ShadeCardsReq['shadecardreq_id'] . '" class="selectgroup-input" ' . ($ShadeCardsReq['shadecardreq_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $ShadeCardsReq['shadecardreq_value'] . '</span>
            </label>
    ';
                              }
                            }
                            ?>

                          </div>
                        </div>


                        <div class="form-group col-sm-12 col-lg-8 ">
                          <label>Color Reference Type </label>
                          <div class="selectgroup w-100">
                            <?php
                            $getColRef = mysqlSelect("SELECT * FROM `work_order_ui_print_shadecard_ref_type` where shadecard_ref_type_show = 1 ");
                            if (is_array($getColRef)) {
                              foreach ($getColRef as $ColRef) {
                                echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_printing_color_ref_type" value="' . $ColRef['shadecard_ref_type_id'] . '" class="selectgroup-input" ' . ($ColRef['shadecard_ref_type_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $ColRef['shadecard_ref_type_value'] . '</span>  
            </label>
    ';
                              }
                            }
                            ?>

                          </div>
                        </div>

                      </div>

                      <div class="row">


                        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                          <label>Eyemark Color</label>
                          <input type="text" class="form-control" name="work_order_printing_eyemark_color" placeholder="Eyemark Color">
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                          <label>Eyemark Size (mm) (width x length)</label>
                          <input type="text" class="form-control" name="work_order_printing_size" placeholder="numberxnumber" value="0x0">
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                          <label>Eyemark Path</label>
                          <div class="selectgroup w-100">
                            <?php
                            $geteyemark_path = mysqlSelect("SELECT * FROM `work_order_ui_print_eyemark_path` where eyemark_path_show = 1 ");
                            if (is_array($geteyemark_path)) {
                              foreach ($geteyemark_path as $eyemark_path) {
                                echo '
		<label class="selectgroup-item">
		  <input type="radio" name="work_order_3_printing_eyemark_path" value="' . $eyemark_path['eyemark_path_id'] . '" class="selectgroup-input" ' . ($eyemark_path['eyemark_path_id'] == 1 ? 'checked' : '') . '>
		  <span class="selectgroup-button">' . $eyemark_path['eyemark_path_value'] . '</span>  
		</label>
    ';
                              }
                            }
                            ?>

                          </div>
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                          <label>Eyemark Side (in D.A) </label>
                          <div class="selectgroup selectgroup-pills">
                            <?php
                            $getPrintEye = mysqlSelect("SELECT * FROM `work_order_ui_print_eyemark_da` where eyemark_da_show = 1 ");
                            if (is_array($getPrintEye)) {
                              foreach ($getPrintEye as $PrintEye) {
                                echo '
			<label class="selectgroup-item">
              <input type="checkbox" name="work_order_4_printing_eyemark_side[]" value="' . $PrintEye['eyemark_da_id'] . '" class="selectgroup-input" ' . ($PrintEye['eyemark_da_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $PrintEye['eyemark_da_value'] . '</span>
            </label>
    ';
                              }
                            }
                            ?>

                          </div>
                        </div>

                      </div>

                      <div class="row">

                        <div class="form-group col-sm-12">
                          <label>Print Approval by</label>
                          <div class="selectgroup w-100">
                            <?php
                            $getPrintOp = mysqlSelect("SELECT * FROM `work_order_ui_print_options` where print_options_show = 1 ");
                            if (is_array($getPrintOp)) {
                              foreach ($getPrintOp as $PrintOp) {
                                echo '

		<label class="selectgroup-item">
		  <input type="radio" name="work_order_3_printing_approvalby" value="' . $PrintOp['print_options_id'] . '" class="selectgroup-input" ' . ($PrintOp['print_options_id'] == 1 ? 'checked' : '') . '>
		  <span class="selectgroup-button">' . $PrintOp['print_options_value'] . '</span>  
		</label>
    ';
                              }
                            }
                            ?>
                          </div>
                        </div>

                      </div>

                      <div class="row">

                        <div class="form-group col-sm-12 col-lg-6 ">
                          <label>CYL PR# </label>
                          <input type="text" class="form-control" name="work_order_printing_plate_cyl_pr" placeholder="Plate CYL PR#">
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 ">
                          <label>Ink System</label>
                          <div class="selectgroup w-100">
                            <?php
                            $getink_sys = mysqlSelect("SELECT * FROM `work_order_ui_print_ink_sys` where ink_sys_show = 1 ");
                            if (is_array($getink_sys)) {
                              foreach ($getink_sys as $ink_sys) {
                                echo '
		<label class="selectgroup-item">
		  <input type="radio" name="work_order_3_printing_ink_system" value="' . $ink_sys['ink_sys_id'] . '" class="selectgroup-input" ' . ($ink_sys['ink_sys_id'] == 1 ? 'checked' : '') . '>
		  <span class="selectgroup-button">' . $ink_sys['ink_sys_value'] . '</span>  
		</label>
    ';
                              }
                            }
                            ?>

                          </div>
                        </div>


                      </div>

                      <div class="row">

                        <div class="form-group col-sm-12 col-lg-6 ">
                          <label>Baseshell</label>
                          <div class="selectgroup w-100">
                            <?php
                            $big = mysqlSelect("SELECT * FROM `work_order_ui_print_baseshel` where print_baseshel_show = 1 ");
                            if (is_array($big)) {
                              foreach ($big as $small) {
                                echo '
		<label class="selectgroup-item">
		  <input type="radio" name="work_order_3_printing_baseshel" value="' . $small['print_baseshel_id'] . '" class="selectgroup-input" ' . ($small['print_baseshel_id'] == 1 ? 'checked' : '') . '>
		  <span class="selectgroup-button">' . $small['print_baseshel_value'] . '</span>  
		</label>
    ';
                              }
                            }
                            ?>

                          </div>
                        </div>


                        <div class="form-group col-sm-12 col-lg-6 ">
                          <label>Ink GSM</label>
                          <input type="text" class="form-control" name="work_order_printing_ink_gsm" placeholder="Ink GSM">
                        </div>

                      </div>

                      <p align="left"><strong>Pantone</strong></p>

                      <div class="row">

                        <div class="form-group col-12 col-sm-6 col-lg-4 col-xl-3">
                          <label>Process Color 1</label>
                          <input type="text" class="form-control" name="work_order_printing_pantone_1" placeholder="Process Color 1">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-4 col-xl-3">
                          <label>Process Color 2</label>
                          <input type="text" class="form-control" name="work_order_printing_pantone_2" placeholder="Process Color 2">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-4 col-xl-3">
                          <label>Process Color 3</label>
                          <input type="text" class="form-control" name="work_order_printing_pantone_3" placeholder="Process Color 3">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-4 col-xl-3">
                          <label>Process Color 4</label>
                          <input type="text" class="form-control" name="work_order_printing_pantone_4" placeholder="Process Color 4">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-4 col-xl-3">
                          <label>Pantone 1</label>
                          <input type="text" class="form-control" name="work_order_printing_pantone_5" placeholder="Pantone 1">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-4 col-xl-3">
                          <label>Pantone 2</label>
                          <input type="text" class="form-control" name="work_order_printing_pantone_6" placeholder="Pantone 2">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-4 col-xl-3">
                          <label>Pantone 3</label>
                          <input type="text" class="form-control" name="work_order_printing_pantone_7" placeholder="Pantone 3">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-4 col-xl-3">
                          <label>Pantone 4</label>
                          <input type="text" class="form-control" name="work_order_printing_pantone_8" placeholder="Pantone 4">
                        </div>



                      </div>

                      <div class="row">
                        <div class="form-group col-12">
                          <div class="selectgroup selectgroup-pills">
                            <?php
                            $getPrintPant = mysqlSelect("SELECT * FROM `work_order_ui_print_end_options` where print_end_options_show = 1 ");
                            if (is_array($getPrintPant)) {
                              foreach ($getPrintPant as $PrintPant) {
                                echo '
			<label class="selectgroup-item">
              <input type="checkbox" name="work_order_4_printing_end_options[]" value="' . $PrintPant['print_end_options_id'] . '" class="selectgroup-input" ' . ($PrintPant['print_end_options_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $PrintPant['print_end_options_value'] . '</span>
            </label>
    ';
                              }
                            }
                            ?>

                          </div>

                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-12">
                          <label>Printing Remarks</label>
                          <table class="table table-striped table-bordered">
                            <tr>
                              <th width="20%">User </th>
                              <th width="70%">Remark</th>
                              <th width="10%">Time</th>
                            </tr>
                            <?php
                            if (!isset($_GET['did'])) {


                              $getOverallRem = mysqlSelect("SELECT r.*,m.lum_code,m.lum_name FROM `remarks_wo` r
                left join user_main m on remark_lum_id = m.lum_id
                where remark_status = 1
                and remark_type = 3
                and remark_master_wo_id = " . $REF_NUMBER);

                              if (is_array($getOverallRem)) {
                                foreach ($getOverallRem as $OverallRem) {
                                  echo '
                        <tr>
                            <td>' . $OverallRem['lum_code'] . ' - ' . $OverallRem['lum_name'] . '</td>
                            <td>' . $OverallRem['remark_text'] . '</td>
                            <td>' . date('d-m-Y @ h:i:s a', $OverallRem['remark_dnt']) . '</td>
                        </tr>
                        
                        ';
                                }
                              } else {
                                echo '
							<tr>
								<td colspan="3">' . $WorkOrderRepDraft['s_wo_remarks_print'] . '</td>
							</tr>
							
							';
                              }
                            }

                            ?>
                          </table>

                        </div>
                      </div>

                      <HR>
                    </div>

                    <div id="workOrderLaminationProcess">

                      <div class="section-title">Lamination (Only for 2ply or more)</div>


                      <div class="row">

                        <div class="form-group col-12 col-sm-6 ">
                          <label>Lam Sleeve (mm)</label>
                          <input type="text" class="form-control" placeholder="Laminate Sleeve" name="work_order_lamination_lam_sleeve">
                        </div>

                        <div class="form-group col-12 col-sm-6 ">
                          <label>Options</label>
                          <div class="selectgroup selectgroup-pills">
                            <?php
                            $getLamOp = mysqlSelect("SELECT * FROM `work_order_ui_lam_end_options` where lam_end_options_show = 1 ");
                            if (is_array($getLamOp)) {
                              foreach ($getLamOp as $LamOp) {
                                echo '
			<label class="selectgroup-item">
              <input type="checkbox" name="work_order_4_lamination_options[]" value="' . $LamOp['lam_end_options_id'] . '" class="selectgroup-input" ' . ($LamOp['lam_end_options_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $LamOp['lam_end_options_value'] . '</span>
            </label>
    ';
                              }
                            }
                            ?>

                          </div>

                        </div>




                      </div>

                      <div id="workOrderLaminationFilmLayerContainer">

                      </div>

                      <div class="row">
                        <div class="form-group col-12">
                          <label>Lamination Remarks</label>
                          <table class="table table-striped table-bordered">
                            <tr>
                              <th width="20%">User </th>
                              <th width="70%">Remark</th>
                              <th width="10%">Time</th>
                            </tr>
                            <?php
                            if (!isset($_GET['did'])) {


                              $getOverallRem = mysqlSelect("SELECT r.*,m.lum_code,m.lum_name FROM `remarks_wo` r
                left join user_main m on remark_lum_id = m.lum_id
                where remark_status = 1
                and remark_type = 4
                and remark_master_wo_id = " . $REF_NUMBER);

                              if (is_array($getOverallRem)) {
                                foreach ($getOverallRem as $OverallRem) {
                                  echo '
                        <tr>
                            <td>' . $OverallRem['lum_code'] . ' - ' . $OverallRem['lum_name'] . '</td>
                            <td>' . $OverallRem['remark_text'] . '</td>
                            <td>' . date('d-m-Y @ h:i:s a', $OverallRem['remark_dnt']) . '</td>
                        </tr>
                        
                        ';
                                }
                              }
                            } else {
                              echo '
							<tr>
								<td colspan="3">' . $WorkOrderRepDraft['s_wo_remarks_lam'] . '</td>
							</tr>
							
							';
                            }
                            ?>
                          </table>
                        </div>
                      </div>

                      <HR>
                    </div>

                    <div id="workOrderPouchProcess">
                      <div class="section-title">Pouch</div>

                      <div class="row">

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Quantity</label>
                          <input type="text" class="form-control" name="work_order_pouch_qty" placeholder="Quantity">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Qty Unit</label>
                          <select class="form-control select_qty_unit" name="work_order_5_pouch_units">
                            <?php
                            $getUnits = mysqlSelect("SELECT * FROM `work_order_qty_units` ");
                            if (is_array($getUnits)) {
                              foreach ($getUnits as $Unit) {
                                echo '<option value="' . $Unit['unit_id'] . '">' . $Unit['unit_value'] . '</option>';
                              }
                            }
                            ?>
                          </select>
                        </div>


                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Width (mm) INCL Sealing</label>
                          <input type="number" min="0" max="9999999999" step="0.01" class="form-control" name="work_order_pouch_width_inc_seal" placeholder="Width (mm) INCL Sealing">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Length (mm) INCL Sealing</label>
                          <input type="number" min="0" max="9999999999" step="0.01" class="form-control" name="work_order_pouch_length_inc_seal" placeholder="Length (mm) INCL Sealing">
                        </div>





                      </div>

                      <div class="row">

                        <div class="form-group col-12 col-sm-6 col-lg-6 col-xl-4 ">
                          <label>Side Gusset</label>
                          <div class="selectgroup w-100">
                            <?php
                            $get_gusset_side = mysqlSelect("SELECT * FROM `work_order_ui_pouch_gusset_side` where pouch_gusset_side_show = 1 ");
                            if (is_array($get_gusset_side)) {
                              foreach ($get_gusset_side as $gusset_side) {
                                echo '
<label class="selectgroup-item">
  <input type="radio" name="work_order_3_pouch_guset_side" value="' . $gusset_side['pouch_gusset_side_id'] . '" class="selectgroup-input" ' . ($gusset_side['pouch_gusset_side_id'] == 1 ? 'checked' : '') . '>
  <span class="selectgroup-button">' . $gusset_side['pouch_gusset_side_value'] . '</span>
</label>';
                              }
                            }
                            ?>

                          </div>
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-6 col-xl-4 ">
                          <label>Bottom Gusset</label>
                          <div class="selectgroup w-100">
                            <?php
                            $getgusset_bottom = mysqlSelect("SELECT * FROM `work_order_ui_pouch_gusset_bottom` where pouch_gusset_bottom_show = 1 ");
                            if (is_array($getgusset_bottom)) {
                              foreach ($getgusset_bottom as $gusset_bottom) {
                                echo '
<label class="selectgroup-item">
  <input type="radio" name="work_order_3_pouch_guset_bottom" value="' . $gusset_bottom['pouch_gusset_bottom_id'] . '" class="selectgroup-input" ' . ($gusset_bottom['pouch_gusset_bottom_id'] == 1 ? 'checked' : '') . '>
  <span class="selectgroup-button">' . $gusset_bottom['pouch_gusset_bottom_value'] . '</span>
</label>';
                              }
                            }
                            ?>

                          </div>
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-6 col-xl-4 ">
                          <label>Seal Width (mm)</label>
                          <input type="number" min="0" max="9999999999" step="0.01" class="form-control" name="work_order_pouch_seal_width" placeholder="Seal Width (mm)">
                        </div>


                      </div>

                      <div class="row">

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Side Gusset Width Inc Seal</label>
                          <input type="text" class="form-control" name="work_order_pouch_side_gus_w" placeholder="Side Gusset Width Inc Seal">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Side Gusset Length Inc Seal</label>
                          <input type="text" class="form-control" name="work_order_pouch_side_gus_l" placeholder="Side Gusset Length Inc Seal">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Bottom Gusset Width Inc Seal</label>
                          <input type="text" class="form-control" name="work_order_pouch_bot_gus_w" placeholder="Bottom Gusset Width Inc Seal">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Bottom Gusset Length Inc Seal</label>
                          <input type="text" class="form-control" name="work_order_pouch_bot_gus_l" placeholder="Bottom Gusset Length Inc Seal">
                        </div>



                      </div>

                      <div class="row">

                        <div class="form-group col-sm-12 col-lg-6 ">
                          <label>Pouch Type</label>
                          <div class="selectgroup selectgroup-pills">
                            <?php
                            $getPouchClosure = mysqlSelect("SELECT * FROM `work_order_ui_pouch_type` where pouch_type_show = 1 ");
                            if (is_array($getPouchClosure)) {
                              foreach ($getPouchClosure as $PouchClosure) {
                                echo '
                <label class="selectgroup-item">
                  <input type="checkbox" name="work_order_4_pouch_type_radio[]" value="' . $PouchClosure['pouch_type_id'] . '" class="selectgroup-input" ' . ($PouchClosure['pouch_type_id'] == 1 ? 'checked' : '') . '>
                  <span class="selectgroup-button">' . $PouchClosure['pouch_type_value'] . '</span>
                </label>
        ';
                              }
                            }
                            ?>

                          </div>
                        </div>


                        <div class="form-group col-sm-12 col-lg-6 ">
                          <label>Euro Punch </label>
                          <div class="selectgroup w-100">
                            <?php
                            $getPouchEUP = mysqlSelect("SELECT * FROM `work_order_ui_pouch_euro_punch` where pouch_euro_punch_show = 1 ");
                            if (is_array($getPouchEUP)) {
                              foreach ($getPouchEUP as $PouchEUP) {
                                echo '
			<label class="selectgroup-item">
			  <input type="radio" name="work_order_3_pouch_euro_punch" value="' . $PouchEUP['pouch_euro_punch_id'] . '" class="selectgroup-input" ' . ($PouchEUP['pouch_euro_punch_id'] == 1 ? 'checked' : '') . '>
			  <span class="selectgroup-button">' . $PouchEUP['pouch_euro_punch_value'] . '</span>
			</label>';
                              }
                            }
                            ?>

                          </div>
                        </div>



                      </div>

                      <div class="row">


                        <div class="form-group col-sm-12 col-lg-6 col-xl-4 ">
                          <label>Pouch Open</label>
                          <div class="selectgroup w-100">
                            <?php
                            $getPouchOpens = mysqlSelect("SELECT * FROM `work_order_ui_pouch_pouch_open` where pouch_open_show = 1 ");
                            if (is_array($getPouchOpens)) {
                              foreach ($getPouchOpens as $PouchOpens) {
                                echo '
			<label class="selectgroup-item">
			  <input type="radio" name="work_order_3_pouch_open" value="' . $PouchOpens['pouch_open_id'] . '" class="selectgroup-input" ' . ($PouchOpens['pouch_open_id'] == 1 ? 'checked' : '') . '>
			  <span class="selectgroup-button">' . $PouchOpens['pouch_open_value'] . '</span>
			</label>';
                              }
                            }
                            ?>

                          </div>
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-4 ">
                          <label>Pouch Corner Type</label>
                          <div class="selectgroup w-100">
                            <?php
                            $gpouch_corner_type = mysqlSelect("SELECT * FROM `work_order_ui_pouch_corner_type` where pouch_corner_type_show = 1 ");
                            if (is_array($gpouch_corner_type)) {
                              foreach ($gpouch_corner_type as $pouch_corner_type) {
                                echo '
			<label class="selectgroup-item">
			  <input type="radio" name="work_order_3_pouch_corner_type" value="' . $pouch_corner_type['pouch_corner_type_id'] . '" class="selectgroup-input" ' . ($pouch_corner_type['pouch_corner_type_id'] == 1 ? 'checked' : '') . '>
			  <span class="selectgroup-button">' . $pouch_corner_type['pouch_corner_type_value'] . '</span>
			</label>';
                              }
                            }
                            ?>

                          </div>
                        </div>


                        <div class="form-group col-sm-12 col-lg-6 col-xl-4 ">
                          <label>Seal </label>
                          <div class="selectgroup w-100">
                            <?php
                            $getPouchSeal3 = mysqlSelect("SELECT * FROM `work_order_ui_pouch_seal` where pouch_seal_show = 1 ");
                            if (is_array($getPouchSeal3)) {
                              foreach ($getPouchSeal3 as $PouchSeal3) {
                                echo '
			<label class="selectgroup-item">
			  <input type="radio" name="work_order_3_pouch_seal" value="' . $PouchSeal3['pouch_seal_id'] . '" class="selectgroup-input" ' . ($PouchSeal3['pouch_seal_id'] == 1 ? 'checked' : '') . '>
			  <span class="selectgroup-button">' . $PouchSeal3['pouch_seal_value'] . '</span>
			</label>';
                              }
                            }
                            ?>

                          </div>
                        </div>

                      </div>

                      <div class="row">
                        <div class="form-group col-sm-12 col-lg-6 ">
                          <label>Ziplock Closure Type </label>
                          <div class="selectgroup selectgroup-pills">
                            <?php
                            $getPouchClosure = mysqlSelect("SELECT * FROM `work_order_ui_pouch_closure_type` where pouch_closure_type_show = 1 ");
                            if (is_array($getPouchClosure)) {
                              foreach ($getPouchClosure as $PouchClosure) {
                                echo '
                <label class="selectgroup-item">
                  <input type="checkbox" name="work_order_4_pouch_zip_closure_type[]" value="' . $PouchClosure['pouch_closure_type_id'] . '" class="selectgroup-input" ' . ($PouchClosure['pouch_closure_type_id'] == 1 ? 'checked' : '') . '>
                  <span class="selectgroup-button">' . $PouchClosure['pouch_closure_type_value'] . '</span>
                </label>
        ';
                              }
                            }
                            ?>

                          </div>
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 ">
                          <label>Ziplock Dist(mm) from TOP</label>
                          <input type="text" class="form-control" name="work_order_pouch_zip_closure_type_dist_mm" placeholder="Ziplock Dist(mm) from TOP">
                        </div>

                      </div>

                      <div class="row">

                        <div class="form-group col-sm-12 col-lg-6 col-xl-6 ">
                          <label>Notch Side</label>
                          <div class="selectgroup w-100">
                            <?php
                            $gpouch_notch_side = mysqlSelect("SELECT * FROM `work_order_ui_pouch_notch_side` where pouch_notch_side_show = 1 ");
                            if (is_array($gpouch_notch_side)) {
                              foreach ($gpouch_notch_side as $pouch_notch_side) {
                                echo '
			<label class="selectgroup-item">
			  <input type="radio" name="work_order_3_pouch_notch_side" value="' . $pouch_notch_side['pouch_notch_side_id'] . '" class="selectgroup-input" ' . ($pouch_notch_side['pouch_notch_side_id'] == 1 ? 'checked' : '') . '>
			  <span class="selectgroup-button">' . $pouch_notch_side['pouch_notch_side_value'] . '</span>
			</label>';
                              }
                            }
                            ?>

                          </div>
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                          <label>Notch Dist(mm) from TOP</label>
                          <input type="text" class="form-control" name="work_order_pouch_notch_dist_from_top" placeholder="Notch Dist(mm) from TOP">
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
                          <label>Notch Dist(mm) from Side</label>
                          <input type="text" class="form-control" name="work_order_pouch_notch_dist_from_side" placeholder="Notch Dist(mm) from Side">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
                          <label>Hole Punch</label>
                          <div class="selectgroup w-100">
                            <?php
                            $getPouchType2 = mysqlSelect("SELECT * FROM `work_order_ui_pouch_hole_punch` where pouch_hole_punch_show = 1 ");
                            if (is_array($getPouchType2)) {
                              foreach ($getPouchType2 as $PouchType2) {
                                echo '
			<label class="selectgroup-item">
			  <input type="radio" name="work_order_3_pouch_hole_punch" value="' . $PouchType2['pouch_hole_punch_id'] . '" class="selectgroup-input" ' . ($PouchType2['pouch_hole_punch_id'] == 1 ? 'checked' : '') . '>
			  <span class="selectgroup-button">' . $PouchType2['pouch_hole_punch_value'] . '</span>
			</label>';
                              }
                            }
                            ?>

                          </div>
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
                          <label>Hole Punch Diameter</label>
                          <input type="text" class="form-control" name="work_order_pouch_hole_punch_dia" placeholder="Hole Punch Diameter">
                        </div>

                        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
                          <label>Special Tooling</label>
                          <div class="selectgroup w-100">
                            <?php
                            $getVariable = mysqlSelect("SELECT * FROM `work_order_ui_pouch_special_tooling` where pouch_special_tooling_show = 1 ");
                            if (is_array($getVariable)) {
                              foreach ($getVariable as $Singular) {
                                echo '
			<label class="selectgroup-item">
			  <input type="radio" name="work_order_3_pouch_special_tooling" value="' . $Singular['pouch_special_tooling_id'] . '" class="selectgroup-input" ' . ($Singular['pouch_special_tooling_id'] == 1 ? 'checked' : '') . '>
			  <span class="selectgroup-button">' . $Singular['pouch_special_tooling_value'] . '</span>
			</label>';
                              }
                            }
                            ?>

                          </div>
                        </div>

                      </div>

                      <div class="row">
                        <div class="form-group col-12">
                          <label>Pouch Remarks</label>
                          <table class="table table-striped table-bordered">
                            <tr>
                              <th width="20%">User </th>
                              <th width="70%">Remark</th>
                              <th width="10%">Time</th>
                            </tr>
                            <?php
                            if (!isset($_GET['did'])) {


                              $getOverallRem = mysqlSelect("SELECT r.*,m.lum_code,m.lum_name FROM `remarks_wo` r
                left join user_main m on remark_lum_id = m.lum_id
                where remark_status = 1
                and remark_type = 5
                and remark_master_wo_id = " . $REF_NUMBER);

                              if (is_array($getOverallRem)) {
                                foreach ($getOverallRem as $OverallRem) {
                                  echo '
                        <tr>
                            <td>' . $OverallRem['lum_code'] . ' - ' . $OverallRem['lum_name'] . '</td>
                            <td>' . $OverallRem['remark_text'] . '</td>
                            <td>' . date('d-m-Y @ h:i:s a', $OverallRem['remark_dnt']) . '</td>
                        </tr>
                        
                        ';
                                }
                              }
                            } else {
                              echo '
							<tr>
								<td colspan="3">' . $WorkOrderRepDraft['s_wo_remarks_pouch'] . '</td>
							</tr>
							
							';
                            }

                            ?>
                          </table>
                        </div>
                      </div>

                      <HR>

                    </div>

                    <div id="workOrderBagProcess">
                      <div class="section-title">Bags</div>

                      <div class="row">

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Quantity</label>
                          <input class="form-control" min="0" max="999999999" type="number" name="work_order_bag_quantity" placeholder="Quantity">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Qty Unit</label>
                          <select class="form-control select_qty_unit" name="work_order_5_bag_units">
                            <?php
                            $getUnits = mysqlSelect("SELECT * FROM `work_order_qty_units` ");
                            if (is_array($getUnits)) {
                              foreach ($getUnits as $Unit) {
                                echo '<option value="' . $Unit['unit_id'] . '">' . $Unit['unit_value'] . '</option>';
                              }
                            }
                            ?>
                          </select>

                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Bag Width (mm)</label>
                          <input class="form-control" min="0" max="999999999" type="number" name="work_order_bag_width" placeholder="Width">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Bag Length (mm)</label>
                          <input class="form-control" min="0" max="999999999" type="number" name="work_order_bag_length" placeholder="Length">
                        </div>





                      </div>

                      <div class="row">

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Side Gusset Width Inc Seal</label>
                          <input type="text" class="form-control" name="work_order_bag_side_gus_w" placeholder="Side Gusset Width Inc Seal">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Side Gusset Length Inc Seal</label>
                          <input type="text" class="form-control" name="work_order_bag_side_gus_l" placeholder="Side Gusset Length Inc Seal">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Bottom Gusset Width Inc Seal</label>
                          <input type="text" class="form-control" name="work_order_bag_bot_gus_w" placeholder="Bottom Gusset Width Inc Seal">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Bottom Gusset Length Inc Seal</label>
                          <input type="text" class="form-control" name="work_order_bag_bot_gus_l" placeholder="Bottom Gusset Length Inc Seal">
                        </div>



                      </div>

                      <div class="row">

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Handle Dist from Top</label>
                          <input type="text" class="form-control" name="work_order_bag_handle_dist_top" placeholder="Handle Dist from Top">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Handle Width (mm)</label>
                          <input class="form-control" min="0" max="999999999" type="number" name="work_order_bag_handle_width" placeholder="Width">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Handle Length (mm)</label>
                          <input class="form-control" min="0" max="999999999" type="number" name="work_order_bag_handle_length" placeholder="Length">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Thick (u)</label>
                          <input class="form-control" min="0" max="999999999" type="number" name="work_order_bag_handle_thick" placeholder="Thickness">
                        </div>





                      </div>

                      <div class="row">

                        <div class="form-group col-12 col-sm-6 col-lg-6 ">
                          <label>Gusset Side</label>
                          <div class="selectgroup w-100">
                            <?php
                            $get_gusset_side = mysqlSelect("SELECT * FROM `work_order_ui_bag_gusset_side` where gusset_side_show = 1 ");
                            if (is_array($get_gusset_side)) {
                              foreach ($get_gusset_side as $gusset_side) {
                                echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_bag_guset_side" value="' . $gusset_side['gusset_side_id'] . '" class="selectgroup-input" ' . ($gusset_side['gusset_side_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $gusset_side['gusset_side_value'] . '</span>
            </label>';
                              }
                            }
                            ?>

                          </div>
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-6 ">
                          <label>Gusset Bottom</label>
                          <div class="selectgroup w-100">
                            <?php
                            $getgusset_bottom = mysqlSelect("SELECT * FROM `work_order_ui_bag_gusset_bottom` where gusset_bottom_show = 1 ");
                            if (is_array($getgusset_bottom)) {
                              foreach ($getgusset_bottom as $gusset_bottom) {
                                echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_bag_guset_bottom" value="' . $gusset_bottom['gusset_bottom_id'] . '" class="selectgroup-input" ' . ($gusset_bottom['gusset_bottom_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $gusset_bottom['gusset_bottom_value'] . '</span>
            </label>';
                              }
                            }
                            ?>

                          </div>
                        </div>

                      </div>

                      <div class="row">
                        <div class="form-group col-12 col-sm-6 col-lg-4 ">
                          <label>Top Fold </label>
                          <input class="form-control" min="0" max="999999999" type="number" name="work_order_bag_guset_top_fold" placeholder="Top Fold">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-4 ">
                          <label>Flap</label>
                          <input class="form-control" min="0" max="999999999" type="number" name="work_order_bag_guset_flap" placeholder="Flap">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-4 ">
                          <label>Lip</label>
                          <input class="form-control" min="0" max="999999999" type="number" name="work_order_bag_guset_lip" placeholder="Lip">
                        </div>





                      </div>

                      <div class="row">


                        <div class="form-group col-sm-12 col-lg-6 ">
                          <label>Handle</label>
                          <div class="selectgroup w-100">
                            <?php
                            $getBagHandle = mysqlSelect("SELECT * FROM `work_order_ui_bag_handle` where bag_handle_show = 1 ");
                            if (is_array($getBagHandle)) {
                              foreach ($getBagHandle as $BagHandle) {
                                echo '
			<label class="selectgroup-item">
			  <input type="radio" name="work_order_3_bag_handle_type" value="' . $BagHandle['bag_handle_id'] . '" class="selectgroup-input" ' . ($BagHandle['bag_handle_id'] == 1 ? 'checked' : '') . '>
			  <span class="selectgroup-button">' . $BagHandle['bag_handle_value'] . '</span>
			</label>';
                              }
                            }
                            ?>

                          </div>
                        </div>


                        <div class="form-group col-sm-12 col-lg-6 ">
                          <label>Vest Handle </label>
                          <div class="selectgroup w-100">
                            <?php
                            $getBagVesthandle = mysqlSelect("SELECT * FROM `work_order_ui_bag_vest_handle` where bag_vest_handle_show = 1 ");
                            if (is_array($getBagVesthandle)) {
                              foreach ($getBagVesthandle as $BagVesthandle) {
                                echo '
			<label class="selectgroup-item">
			  <input type="radio" name="work_order_3_bag_vest_handle" value="' . $BagVesthandle['bag_vest_handle_id'] . '" class="selectgroup-input" ' . ($BagVesthandle['bag_vest_handle_id'] == 1 ? 'checked' : '') . '>
			  <span class="selectgroup-button">' . $BagVesthandle['bag_vest_handle_value'] . '</span>
			</label>';
                              }
                            }
                            ?>

                          </div>

                        </div>

                      </div>

                      <div class="row">
                        <div class="form-group col-12 col-xl-5">
                          <label>Sealing</label>
                          <div class="selectgroup selectgroup-pills">
                            <?php
                            $getBagOps = mysqlSelect("SELECT * FROM `work_order_ui_bag_sealing_opts` where bag_sealing_opts_show = 1 ");
                            if (is_array($getBagOps)) {
                              foreach ($getBagOps as $BagOps) {
                                echo '
                <label class="selectgroup-item">
                  <input ' . ($BagOps['bag_sealing_opts_id'] == 4 ? 'id="splHoleInputCheck"' : '') . ' type="checkbox" name="work_order_4_bag_sealing[]" value="' . $BagOps['bag_sealing_opts_id'] . '" class="selectgroup-input" ' . ($BagOps['bag_sealing_opts_id'] == 1 ? 'checked' : '') . '>
                  <span class="selectgroup-button">' . $BagOps['bag_sealing_opts_value'] . '</span>
                </label>
        ';
                              }
                            }
                            ?>

                          </div>
                        </div>

                        <div id="splHoleDiaContainer" class="form-group col-12 col-xl-2">
                          <label>SPL HOLE Diameter</label>
                          <input class="form-control" min="0" max="999999999" type="number" name="work_order_bag_sealing_spl_hole_dia" placeholder="Diameter">
                        </div>

                        <div class="form-group col-12 col-xl-5">
                          <label>Handle Punch</label>
                          <div class="selectgroup selectgroup-pills">
                            <?php
                            $getBagOps2 = mysqlSelect("SELECT * FROM `work_order_ui_bag_punch_opts` where bag_punch_opts_show = 1 ");
                            if (is_array($getBagOps2)) {
                              foreach ($getBagOps2 as $BagOps) {
                                echo '
                <label class="selectgroup-item">
                  <input type="checkbox" name="work_order_4_bag_handle_punch_type[]" value="' . $BagOps['bag_punch_opts_id'] . '" class="selectgroup-input" ' . ($BagOps['bag_punch_opts_id'] == 1 ? 'checked' : '') . '>
                  <span class="selectgroup-button">' . $BagOps['bag_punch_opts_value'] . '</span>
                </label>
        ';
                              }
                            }
                            ?>

                          </div>
                        </div>
                      </div>


                      <div class="row">
                        <div class="form-group col-12">
                          <label>Bags Remarks</label>
                          <table class="table table-striped table-bordered">
                            <tr>
                              <th width="20%">User </th>
                              <th width="70%">Remark</th>
                              <th width="10%">Time</th>
                            </tr>
                            <?php
                            if (isset($_GET['did'])) {


                              $getOverallRem = mysqlSelect("SELECT r.*,m.lum_code,m.lum_name FROM `remarks_wo` r
                left join user_main m on remark_lum_id = m.lum_id
                where remark_status = 1
                and remark_type = 6
                and remark_master_wo_id = " . $REF_NUMBER);

                              if (is_array($getOverallRem)) {
                                foreach ($getOverallRem as $OverallRem) {
                                  echo '
                        <tr>
                            <td>' . $OverallRem['lum_code'] . ' - ' . $OverallRem['lum_name'] . '</td>
                            <td>' . $OverallRem['remark_text'] . '</td>
                            <td>' . date('d-m-Y @ h:i:s a', $OverallRem['remark_dnt']) . '</td>
                        </tr>
                        
                        ';
                                }
                              }
                            } else {
                              echo '
							<tr>
								<td colspan="3">' . $WorkOrderRepDraft['s_wo_remarks_bag'] . '</td>
							</tr>
							
							';
                            }

                            ?>
                          </table>
                        </div>
                      </div>

                      <HR>
                    </div>

                    <div id="workOrderSlitProcess">

                      <div class="section-title">Slitting</div>

                      <div class="row">

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Slit Width (mm)</label>
                          <input min="1" max="99999999999" type="number" class="form-control" name="work_order_slitting_slit_width" placeholder="Slit Width">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-3 ">
                          <label>Wind DIR</label>
                          <select class="form-control select_wind_dir" required name="work_order_5_slitting_wind_dir">
                            <?php
                            $getWinds = mysqlSelect("SELECT * FROM `work_order_wind_dir` order by wind_value asc");
                            if (is_array($getWinds)) {
                              foreach ($getWinds  as $Wind) {
                                echo '<option value="' . $Wind['wind_id'] . '">' . $Wind['wind_value'] . '</option>';
                              }
                            }
                            ?>
                          </select>
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-2 ">
                          <label>Roll OD (mm)</label>
                          <input min="1" max="99999999999" type="number" class="form-control" name="work_order_slitting_roll_od" placeholder="Roll OD">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-2 ">
                          <label>Weight</label>
                          <input type="text" class="form-control" name="work_order_slitting_wt" placeholder="Weight">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-2 ">
                          <label>MTR.</label>
                          <input type="text" class="form-control" name="work_order_slitting_mtr" placeholder="MTR">
                        </div>





                      </div>

                      <div class="row">
                        <div class="form-group col-sm-12">
                          <label>Pallet</label>
                          <div class="selectgroup w-100">
                            <?php
                            $getSlittingPallet = mysqlSelect("SELECT * FROM `work_order_ui_slitting_pallet` where slitting_pallet_show = 1 ");
                            if (is_array($getSlittingPallet)) {
                              foreach ($getSlittingPallet as $SlittingPallet) {
                                echo '
			<label class="selectgroup-item">
			  <input type="radio" name="work_order_3_slitting_pallet" value="' . $SlittingPallet['slitting_pallet_id'] . '" class="selectgroup-input" ' . ($SlittingPallet['slitting_pallet_id'] == 1 ? 'checked' : '') . '>
			  <span class="selectgroup-button">' . $SlittingPallet['slitting_pallet_value'] . '</span>
			</label>';
                              }
                            }
                            ?>

                          </div>
                        </div>




                      </div>

                      <div class="row">
                        <div class="form-group col-sm-12">
                          <label>Packing Options</label>
                          <div class="selectgroup selectgroup-pills">
                            <?php
                            $getBagOps = mysqlSelect("SELECT * FROM `work_order_ui_slitting_packing_opts` where slitting_packing_opts_show = 1 ");
                            if (is_array($getBagOps)) {
                              foreach ($getBagOps as $BagOps) {
                                echo '
                <label class="selectgroup-item">
                  <input type="checkbox" name="work_order_4_packing_opts[]" value="' . $BagOps['slitting_packing_opts_id'] . '" class="selectgroup-input" ' . ($BagOps['slitting_packing_opts_id'] == 1 ? 'checked' : '') . '>
                  <span class="selectgroup-button">' . $BagOps['slitting_packing_opts_value'] . '</span>
                </label>
        ';
                              }
                            }
                            ?>

                          </div>

                        </div>

                      </div>

                      <div class="row">
                        <div class="form-group col-sm-12 col-lg-6">
                          <label>Sticker Type</label>
                          <div class="selectgroup w-100">

                            <?php
                            $getSlittingSticker = mysqlSelect("SELECT * FROM `work_order_ui_slitting_sticker` where slitting_sticker_show = 1 ");
                            if (is_array($getSlittingSticker)) {
                              foreach ($getSlittingSticker as $SlittingSticker) {
                                echo '
			<label class="selectgroup-item">
			  <input type="radio" name="work_order_3_slitting_sticker_type" value="' . $SlittingSticker['slitting_sticker_id'] . '" class="selectgroup-input" ' . ($SlittingSticker['slitting_sticker_id'] == 1 ? 'checked' : '') . '>
			  <span class="selectgroup-button">' . $SlittingSticker['slitting_sticker_value'] . '</span>
			</label>';
                              }
                            }
                            ?>

                          </div>
                        </div>


                        <div class="form-group col-sm-12 col-lg-6 ">
                          <label>Pallet Packing Instructions</label>
                          <div class="selectgroup selectgroup-pills">
                            <?php
                            $getSlitOpsSticks = mysqlSelect("SELECT * FROM `work_order_ui_slitting_pallet_instructions` where pallet_instructions_show = 1 ");
                            if (is_array($getSlitOpsSticks)) {
                              foreach ($getSlitOpsSticks as $SingularOP) {
                                echo '
                <label class="selectgroup-item">
                  <input type="checkbox" name="work_order_4_slitting_pallet_ins[]" value="' . $SingularOP['pallet_instructions_id'] . '" class="selectgroup-input" ' . ($SingularOP['pallet_instructions_id'] == 1 ? 'checked' : '') . '>
                  <span class="selectgroup-button">' . $SingularOP['pallet_instructions_value'] . '</span>
                </label>
        ';
                              }
                            }
                            ?>

                          </div>
                        </div>


                      </div>

                      <div class="row">

                        <div class="form-group col-12 col-sm-6 col-lg-4 ">
                          <label>Pallet Length</label>
                          <input min="1" max="99999999999" type="number" class="form-control" name="work_order_slitting_pal_l" placeholder="Pallet Length">
                        </div>


                        <div class="form-group col-12 col-sm-6 col-lg-4 ">
                          <label>Pallet Width</label>
                          <input min="1" max="99999999999" type="number" class="form-control" name="work_order_slitting_pal_w" placeholder="Pallet Width">
                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-4 ">
                          <label>Pallet Height</label>
                          <input min="1" max="99999999999" type="number" class="form-control" name="work_order_slitting_pal_h" placeholder="Pallet Height">
                        </div>





                      </div>

                      <div class="row">
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                          <label>Core ID</label>
                          <div class="selectgroup w-100">
                            <?php
                            $getSlittingCIDL = mysqlSelect("SELECT * FROM `work_order_ui_slitting_core_id_length` where slitting_core_id_length_show = 1 ");
                            if (is_array($getSlittingCIDL)) {
                              foreach ($getSlittingCIDL as $SlittingCIDL) {
                                echo '
			<label class="selectgroup-item">
			  <input type="radio" name="work_order_3_slitting_core_id" value="' . $SlittingCIDL['slitting_core_id_length_id'] . '" class="selectgroup-input" ' . ($SlittingCIDL['slitting_core_id_length_id'] == 1 ? 'checked' : '') . '>
			  <span class="selectgroup-button">' . $SlittingCIDL['slitting_core_id_length_value'] . '</span>
			</label>';
                              }
                            }
                            ?>

                          </div>
                        </div>


                        <div class="form-group col-12 col-sm-6 col-lg-5">
                          <label>Core Material</label>
                          <div class="selectgroup w-100">
                            <?php
                            $getSlitCIDT = mysqlSelect("SELECT * FROM `work_order_ui_slitting_core_id_type` where slitting_core_id_type_show = 1 ");
                            if (is_array($getSlitCIDT)) {
                              foreach ($getSlitCIDT as $SlitCIDT) {
                                echo '
			<label class="selectgroup-item">
			  <input type="radio" name="work_order_3_slitting_core_material" value="' . $SlitCIDT['slitting_core_id_type_id'] . '" class="selectgroup-input" ' . ($SlitCIDT['slitting_core_id_type_id'] == 1 ? 'checked' : '') . '>
			  <span class="selectgroup-button">' . $SlitCIDT['slitting_core_id_type_value'] . '</span>
			</label>';
                              }
                            }
                            ?>

                          </div>

                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-2">
                          <label>Core Plugs</label>
                          <div class="selectgroup w-100">
                            <?php
                            $getSlitCIDT = mysqlSelect("SELECT * FROM `work_order_ui_slitting_core_plugs` where core_plugs_show = 1 ");
                            if (is_array($getSlitCIDT)) {
                              foreach ($getSlitCIDT as $SlitCIDT) {
                                echo '
			<label class="selectgroup-item">
			  <input type="radio" name="work_order_3_slitting_core_plugs" value="' . $SlitCIDT['core_plugs_id'] . '" class="selectgroup-input" ' . ($SlitCIDT['core_plugs_id'] == 1 ? 'checked' : '') . '>
			  <span class="selectgroup-button">' . $SlitCIDT['core_plugs_value'] . '</span>
			</label>';
                              }
                            }
                            ?>

                          </div>

                        </div>

                        <div class="form-group col-12 col-sm-6 col-lg-2">
                          <label>Reel Flag Color</label>
                          <input type="text" class="form-control" name="work_order_slitting_flag_tape_col" placeholder="Reel Flag Color">
                        </div>


                      </div>

                      <div class="row">
                        <div class="form-group col-12 col-lg-8">
                          <label class="form-label">QC Instructions</label>
                          <div class="selectgroup selectgroup-pills">
                            <?php
                            $getSlitOpsEnd = mysqlSelect("SELECT * FROM `work_order_ui_slitting_qc_ins` where slitting_qc_ins_show = 1 ");
                            if (is_array($getSlitOpsEnd)) {
                              foreach ($getSlitOpsEnd as $SingularOP) {
                                echo '
                <label class="selectgroup-item">
                  <input type="checkbox" name="work_order_4_slitting_qc_ins[]" value="' . $SingularOP['slitting_qc_ins_id'] . '" class="selectgroup-input" ' . ($SingularOP['slitting_qc_ins_id'] == 1 ? 'checked' : '') . '>
                  <span class="selectgroup-button">' . $SingularOP['slitting_qc_ins_value'] . '</span>
                </label>
        ';
                              }
                            }
                            ?>

                          </div>

                        </div>

                        <div class="form-group col-12 col-lg-4">
                          <label>Max Joints/Roll</label>
                          <input type="text" class="form-control" name="work_order_slitting_qc_max_joint" placeholder="Max Joints/Roll">
                        </div>

                      </div>

                      <div class="row">
                        <?php
                        getSelectBox("form-group col-sm-12 col-lg-4",
                        "Shipment Documents",
                        "work_order_3_shipment_documents",
                        "SELECT * FROM `work_order_ui_shipment`  order by shipment_value asc ",
                        'shipment_id',
                        'shipment_value'
                        );
                        ?>

                        <?php
                        getSelectBox("form-group col-sm-12 col-lg-4",
                        "Laser Configuration",
                        "work_order_3_laser_config",
                        "SELECT * FROM `work_order_ui_slitting_laser_config`  order by laser_value asc ",
                        'laser_id',
                        'laser_value'
                        );
                        ?>

                        <?php
                        getSelectBox("form-group col-sm-12 col-lg-4 ",
                        "Freight Type",
                        "work_order_3_freight",
                        "SELECT * FROM `work_order_ui_slitting_freight_ins` where freight_show = 1 ",
                        'freight_id',
                        'freight_value'
                        );
                        ?>
                      </div>


                      <div class="row">
                        <div class="form-group col-12">
                          <label>Slitting Remarks</label>
                          <table class="table table-striped table-bordered">
                            <tr>
                              <th width="20%">User </th>
                              <th width="70%">Remark</th>
                              <th width="10%">Time</th>
                            </tr>
                            <?php
                            if (!isset($_GET['did'])) {


                              $getOverallRem = mysqlSelect("SELECT r.*,m.lum_code,m.lum_name FROM `remarks_wo` r
                left join user_main m on remark_lum_id = m.lum_id
                where remark_status = 1
                and remark_type = 7
                and remark_master_wo_id = " . $REF_NUMBER);

                              if (is_array($getOverallRem)) {
                                foreach ($getOverallRem as $OverallRem) {
                                  echo '
                        <tr>
                            <td>' . $OverallRem['lum_code'] . ' - ' . $OverallRem['lum_name'] . '</td>
                            <td>' . $OverallRem['remark_text'] . '</td>
                            <td>' . date('d-m-Y @ h:i:s a', $OverallRem['remark_dnt']) . '</td>
                        </tr>
                        
                        ';
                                }
                              }
                            } else {
                              echo '
							<tr>
								<td colspan="3">' . $WorkOrderRepDraft['s_wo_remarks_slit'] . '</td>
							</tr>
							
							';
                            }

                            ?>
                          </table>

                        </div>
                      </div>

                      <hr>
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
  <?php
  if (isset($_GET['pid'])) {
    #load all contents onto the page when just the ROW ID of a published table is given
    if (is_array($WorkOrderRepPub)) {
  ?>

      <script>
        $(document).ready(function(e) {

          <?php
          foreach ($master_wo_straightArrays as $k => $v) {
            if ($k == 'work_order_delivery_date') {
              echo '$(\'input[name="' . $k . '"]\').val("' . date('d-m-Y', $WorkOrderRepPub[$v]) . '");';
            } else if ($k == 'work_order_lwo') {
              echo '$(\'input[name="' . $k . '"]\').val("' . $_GET['pid'] . '");';
            } else {
              echo '$(\'input[name="' . $k . '"]\').val("' . $WorkOrderRepPub[$v] . '");';
            }
          }

          foreach ($master_wo_radioArrays as $k => $v) {
            echo '$(\'input:radio[name="' . $k . '"]\').filter(\'[value="' . $WorkOrderRepPub[$v] . '"]\').attr(\'checked\', true);';
          }

          foreach ($master_wo_checkboxArrays as $k => $v) {

            echo '$(\'input[name="' . $k . '[]"]\').each(function() {
						this.checked = false;
					});';
            if ($WorkOrderRepPub[$v] != '') {
              $s = explode(',', $WorkOrderRepPub[$v]);
              foreach ($s as $val) {
                echo '$(\'input:checkbox[name="' . $k . '[]"]\').filter("[value=\'' . $val . '\']").prop(\'checked\', true);';
              }
            }
          }


          foreach ($master_wo_selectArrays as $k => $v) {
            echo '$(\'select[name="' . $k . '"]\').val("' . $WorkOrderRepPub[$v] . '").change();';
          }
          ?>

        });
      </script>

      <?php
    }
  }

  if (isset($_GET['id'])) {
    if (is_array($getMasterDrafts)) {

      foreach ($getMasterDrafts as $Draft) {

      ?>

        <script>
          $(document).ready(function(e) {

            <?php
            foreach ($master_wo_straightArrays as $k => $v) {

              if ($k == 'work_order_delivery_date') {
                echo '$(\'input[name="' . $k . '"]\').val("' . date('d-m-Y', $Draft[$v]) . '");';
              } else {
                echo '$(\'input[name="' . $k . '"]\').val("' . $Draft[$v] . '");';
              }
            }

            foreach ($master_wo_radioArrays as $k => $v) {
              echo '$(\'input:radio[name="' . $k . '"]\').filter(\'[value="' . $Draft[$v] . '"]\').attr(\'checked\', true);';
            }

            foreach ($master_wo_checkboxArrays as $k => $v) {

              echo '$(\'input[name="' . $k . '[]"]\').each(function() {
											this.checked = false;
										});';
              if ($Draft[$v] != '') {
                $s = explode(',', $Draft[$v]);
                foreach ($s as $val) {
                  echo '$(\'input:checkbox[name="' . $k . '[]"]\').filter("[value=\'' . $val . '\']").prop(\'checked\', true);';
                }
              }
            }

            foreach ($master_wo_selectArrays as $k => $v) {
              echo '$(\'select[name="' . $k . '"]\').val("' . $Draft[$v] . '").change();';
            }
            ?>

          });
        </script>

  <?php
      }
    }
  }
  ?>

  <?php
  if (isset($_GET['did'])) {
    #load all contents onto the page when draft id is given
    if (is_array($WorkOrderRepDraft)) {
  ?>

      <script>
        $(document).ready(function(e) {

          <?php
          foreach ($sales_straightArrays as $k => $v) {
            if ($k == 'work_order_delivery_date') {
              echo '$(\'input[name="' . $k . '"]\').val("' . date('d-m-Y', $WorkOrderRepDraft[$v]) . '");	
						';
            } else {
              echo '$(\'input[name="' . $k . '"]\').val("' . $WorkOrderRepDraft[$v] . '");
						';
            }
          }

          foreach ($sales_radioArrays as $k => $v) {
            echo '$(\'input:radio[name="' . $k . '"]\').filter(\'[value="' . $WorkOrderRepDraft[$v] . '"]\').attr(\'checked\', true)
						';
          }

          foreach ($sales_checkboxArrays as $k => $v) {

            echo '$(\'input[name="' . $k . '[]"]\').each(function() {
						this.checked = false;
					});
					';
            if ($WorkOrderRepDraft[$v] != '') {
              $s = explode(',', $WorkOrderRepDraft[$v]);
              foreach ($s as $val) {
                echo '$(\'input:checkbox[name="' . $k . '[]"]\').filter("[value=\'' . $val . '\']").prop(\'checked\', true);
							';
              }
            }
          }

          foreach ($sales_selectArrays as $k => $v) {
            echo '$(\'select[name="' . $k . '"]\').val("' . $WorkOrderRepDraft[$v] . '").change();
					';
          }
          ?>


        });
      </script>

  <?php
    }
  }
  ?>


  <script>
    $(document).ready(function() {

      //Initial Setup
      setUpLaminateEntryLayers();
      setUpFilmStructureLayers();
      setPrintedSetup();
      setBagPouchSetup();
      setUpLaminationSection();
      setSplHoleDia();
      setUpSelect2s();
      setUpFilmToLaminate();
      fillSubstrate();
      setUpTubeLength();
      setUpTubeCircum();

      //Listeners	

      //Trigger Functions for Ply Value Change
      $('#plyValueInput').change(function(e) {
        if ($('#plyValueInput').val() > 0 && $('#plyValueInput').val() < 6) {
          setUpLaminateEntryLayers();
          setUpFilmStructureLayers();
          setUpLaminationSection();
          setUpFilmToLaminate();
          $('.select_material').select2();
        }
      });

      //Trigger Functions for Essentials Printed Change
      $("input[name=work_order_3_essentials_printed]").change(function(e) {
        setPrintedSetup();
      });

      //Trigger Functions for Structure
      $("input[name=work_order_3_structure]").change(function(e) {
        setBagPouchSetup();
      });

      $('#splHoleInputCheck').click(function(e) {
        setSplHoleDia();
      });

      for (l = 1; l <= ($('#plyValueInput').val()); l++) {
        $('input[name="work_order_layer_' + l + '_micron"]').change(function(e) {
          setUpFilmToLaminate();
          fillSubstrate();
        });

        $('select[name="work_order_5_layer_' + l + '_material"]').change(function(e) {
          setUpFilmToLaminate();
          fillSubstrate();
        });

      }

      $('#plyValueInput').change(function(e) {
        if ($('#plyValueInput').val() > 0 && $('#plyValueInput').val() < 6) {

          for (l = 1; l <= ($('#plyValueInput').val()); l++) {
            $('input[name="work_order_layer_' + l + '_micron"]').change(function(e) {
              setUpFilmToLaminate();
              fillSubstrate();
            });

            $('select[name="work_order_5_layer_' + l + '_material"]').change(function(e) {
              setUpFilmToLaminate();
              fillSubstrate();
            });

          }


        }
      });

      $("#formLoading").hide();
    });

    function setSplHoleDia() {
      var splHoleDiaCont = $("#splHoleDiaContainer");
      var optionsVal = $("#splHoleInputCheck");
      if (optionsVal.is(":checked")) {
        splHoleDiaCont.fadeIn();
      } else {
        splHoleDiaCont.fadeOut();
      }

    }

    function setBagPouchSetup() {
      bagPouchRoll = $("input[name=work_order_3_structure]:checked").val();

      if (bagPouchRoll == 1) {
        $("#workOrderBagProcess").fadeIn();
        $("#workOrderPouchProcess").fadeOut();
      } else if (bagPouchRoll == 2) {
        $("#workOrderBagProcess").fadeOut();
        $("#workOrderPouchProcess").fadeIn();
      } else if (bagPouchRoll == 3) {
        $("#workOrderBagProcess").fadeOut();
        $("#workOrderPouchProcess").fadeOut();
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
      $('.select_client').select2();
      $('.select_sales').select2();
      $('.select_qty_unit').select2();
      $('.select_application').select2();
      $('.select_wind_dir').select2();
      $('.select_material').select2();
      $('.select_pack_qty_unit').select2();
    }

    function setUpLaminationSection() {
      var layers = $('#plyValueInput').val();
      var containerLayer = $('#workOrderLaminationProcess');
      if (layers > 1) {
        containerLayer.fadeIn();
      } else {
        containerLayer.fadeOut();
      }
    }

    function setUpLaminateEntryLayers() {
      var layers = $('#plyValueInput').val();
      var containerLayer = $('#containerLaminateLayers');
      var lamPrefix = 'laminateRowId';
      var stringOutput = "";
      var l;

      for (l = 1; l <= (layers); l++) {
        stringOutput = stringOutput.concat("" +
          "<div id=\"laminateRowId" + l + "\" class=\"row\">" +
          "    <div class=\"col-12\">" +
          "        <div class=\"row\">" +
          "           <div class=\"col-12\">" +
          "               <p align=\"left\" style=\"margin-left:10px\">Film/Laminate Layer " + l + "</p>" +
          "            </div>" +
          "        </div>" +
          "       <div class=\"row\">" +
          "           <div class=\"form-group col-6\">" +
          "            <label>Micron</label>" +
          "             <input type=\"number\" class=\"form-control\" min='0' step='0.01' required name=\"work_order_layer_" + l + "_micron\" placeholder=\"Film Micron\">" +
          "           </div>" +
          "           <div class=\"form-group col-6\">" +
          "             <label>Film</label>" +
          "             <select class=\"form-control select_material\" required name=\"work_order_5_layer_" + l + "_material\">                        <?php
                                                                                                                                                        $getMaterials = mysqlSelect("SELECT * FROM `materials_main` order by material_value asc");
                                                                                                                                                        if (is_array($getMaterials)) {
                                                                                                                                                          foreach ($getMaterials as $Material) {
                                                                                                                                                            echo '<option value=\"' . $Material['material_id'] . '\">' . $Material['material_value'] . '</option>';
                                                                                                                                                          }
                                                                                                                                                        }
                                                                                                                                                        ?> <
          /select>"+
          "           </div>" +
          "        </div>" +
          "   </div>" +
          "</div>");
      }

      containerLayer.html(stringOutput);
      stringOutput = "";

    }

    function setUpFilmStructureLayers() {
      var layers = $('#plyValueInput').val();
      var containerLayer = $('#workOrderLaminationFilmLayerContainer');
      var stringOutput = "";
      var l;

      for (l = 1; l <= (layers); l++) {

        stringOutput = stringOutput.concat('' +
          '<p align="left"><strong>Film ' + l + ' </strong></p>' +
          '<div class="row" id="lamFilmFiller' + l + '"></div> ' +
          '<div class="row">' +
          '<div class="form-group col-12 col-sm-4 col-lg-4 ">' +
          '<label>Jumbo Reel Width</label>' +
          '<input type="number" step="0.01" max="99999999" min="1" class="form-control" name="work_order_lamination_layer_' + l + '_film_width" placeholder="Film Width">' +
          '</div>' +
          '<div class="form-group col-12 col-sm-4 col-lg-4 ">' +
          '<label>KGS</label>' +
          '<input type="number" step="0.01" max="99999999" min="1" class="form-control" name="work_order_lamination_layer_' + l + '_kgs" placeholder="KGS">' +
          '</div>' +
          '<div class="form-group col-12 col-sm-4 col-lg-4 ">' +
          '<label>MTR</label>' +
          '<input type="number" step="0.01" max="99999999" min="1" class="form-control" name="work_order_lamination_layer_' + l + '_mtr" placeholder="MTR">' +
          '</div>' +
          '</div>');

        if ((l + 1) <= (layers)) {
          stringOutput = stringOutput.concat('' +
            '<p align="left"><i>Pass ' + l + ' </i></p>' +
            '<div class="row">' +
            '<div class="form-group col-12 col-sm-5 ">' +
            '<input type="text" class="form-control"  name="work_order_lamination_pass_' + l + '_desc_1" placeholder="Adhesive Grade">' +
            '</div>' +
            '<div align="center" class="form-group col-12 col-sm-2 ">' +
            '<label>+</label>' +
            '</div>' +
            '<div class="form-group col-12 col-sm-5  ">' +
            '<input type="text" class="form-control"  name="work_order_lamination_pass_' + l + '_desc_2" placeholder="Adhesive GSM">' +
            '</div>' +
            '</div>');


        }
      }

      containerLayer.html(stringOutput);
      stringOutput = "";

    }

    function setUpFilmToLaminate() {
      var layers = $('#plyValueInput').val();
      var stringOutput = "";
      var l;
      var checker = 0;

      for (l = 1; l <= (layers); l++) {
        var valMicron = $('input[name="work_order_layer_' + l + '_micron"]').val();
        var valFilm = $('select[name="work_order_5_layer_' + l + '_material"] option:selected').text();
        var valFilmID = $('select[name="work_order_5_layer_' + l + '_material"] option:selected').val();

        if (valFilmID == 4 || valFilmID == 5 || valFilmID == 36) {
          checker = 1;
        }

        stringOutput = ('' +
          '<div class="form-group col-12 col-sm-6 ">' +
          '<label>Micron</label>' +
          '<input type="text" class="form-control" disabled value="' + valMicron + '">' +
          '</div>' +
          '<div class="form-group col-12 col-sm-6 ">' +
          '<label>Film</label>' +
          '<input type="text" class="form-control" disabled value="' + valFilm + '">' +
          '</div>');
        $("#lamFilmFiller" + l).html(stringOutput);
        stringOutput = "";

      }

      if (checker == 0) {
        $("#workOrderExtrusionProcess").fadeOut();
      } else {
        $("#workOrderExtrusionProcess").fadeIn();
      }

    }

    function setUpTubeLength() {
      var a = parseFloat($('input[name="work_order_printing_single_coil_width"]').val());
      var b = parseFloat($('input[name="work_order_printing_ups_val"]').val());
      var c = parseFloat($('input[name="work_order_printing_trim_val"]').val());
      var holder = $('#cylinderLengthCalculation');

      holder.html(a + " x " + b + " + " + c + " = " + ((a * b) + c));
    }

    function setUpTubeCircum() {
      var a = parseFloat($('input[name="work_order_printing_single_coil_circ"]').val());
      var b = parseFloat($('input[name="work_order_printing_accross_val"]').val());
      var c = parseFloat($('input[name="work_order_printing_bleed_val"]').val());
      var holder = $('#cylinderCircumferenceCalculation');

      holder.html(a + " x " + b + " + " + c + " = " + ((a * b) + c));
    }

    function fillSubstrate() {
      var micronLevel = $('input[name="work_order_layer_1_micron"]').val();
      var FilmLevel = $('select[name="work_order_5_layer_1_material"] option:selected').text();

      $("#inputSubstrate").val(micronLevel + "u, " + FilmLevel);
    }
  </script>

  <script>
    $(document).ready(function(e) {
      <?php
      //Fill the Laminate Layers with the Database Data
      if (isset($_GET['pid'])) {
        if (is_array($WorkOrderRepPub)) {
          if (is_numeric($WorkOrderRepPub['master_wo_ply'])) {

            for ($counterL = 1; $counterL <= $WorkOrderRepPub['master_wo_ply']; $counterL++) {
              echo '$(\'input[name="work_order_layer_' . $counterL . '_micron"]\').val("' . $WorkOrderRepPub['master_wo_layer_' . $counterL . '_micron'] . '");';
              echo '$(\'select[name="work_order_5_layer_' . $counterL . '_material"]\').val("' . $WorkOrderRepPub['master_wo_layer_' . $counterL . '_structure'] . '").change();';

              echo '$(\'input[name="work_order_lamination_layer_' . $counterL . '_film_width"]\').val("' . $WorkOrderRepPub['master_wo_lam_f' . $counterL . '_width'] . '");';
              echo '$(\'input[name="work_order_lamination_layer_' . $counterL . '_kgs"]\').val("' . $WorkOrderRepPub['master_wo_lam_f' . $counterL . '_kgs'] . '");';
              echo '$(\'input[name="work_order_lamination_layer_' . $counterL . '_mtr"]\').val("' . $WorkOrderRepPub['master_wo_lam_f' . $counterL . '_mtr'] . '");';

              if (($counterL + 1) <= $WorkOrderRepPub['master_wo_ply']) {

                echo '$(\'input[name="work_order_lamination_pass_' . $counterL . '_desc_1"]\').val("' . $WorkOrderRepPub['master_wo_lam_p' . $counterL . '_desc_1'] . '");';
                echo '$(\'input[name="work_order_lamination_pass_' . $counterL . '_desc_2"]\').val("' . $WorkOrderRepPub['master_wo_lam_p' . $counterL . '_desc_2'] . '");';
              }
            }
          }
        }
      }

      if (isset($_GET['id'])) {
        if (is_array($getMasterDrafts)) {
          if (is_numeric($getMasterDrafts[0]['master_wo_ply'])) {

            for ($counterL = 1; $counterL <= $getMasterDrafts[0]['master_wo_ply']; $counterL++) {
              echo '$(\'input[name="work_order_layer_' . $counterL . '_micron"]\').val("' . $getMasterDrafts[0]['master_wo_layer_' . $counterL . '_micron'] . '");';
              echo '$(\'select[name="work_order_5_layer_' . $counterL . '_material"]\').val("' . $getMasterDrafts[0]['master_wo_layer_' . $counterL . '_structure'] . '").change();';

              echo '$(\'input[name="work_order_lamination_layer_' . $counterL . '_film_width"]\').val("' . $getMasterDrafts[0]['master_wo_lam_f' . $counterL . '_width'] . '");';
              echo '$(\'input[name="work_order_lamination_layer_' . $counterL . '_kgs"]\').val("' . $getMasterDrafts[0]['master_wo_lam_f' . $counterL . '_kgs'] . '");';
              echo '$(\'input[name="work_order_lamination_layer_' . $counterL . '_mtr"]\').val("' . $getMasterDrafts[0]['master_wo_lam_f' . $counterL . '_mtr'] . '");';

              if (($counterL + 1) <= $getMasterDrafts[0]['master_wo_ply']) {

                echo '$(\'input[name="work_order_lamination_pass_' . $counterL . '_desc_1"]\').val("' . $getMasterDrafts[0]['master_wo_lam_p' . $counterL . '_desc_1'] . '");';
                echo '$(\'input[name="work_order_lamination_pass_' . $counterL . '_desc_2"]\').val("' . $getMasterDrafts[0]['master_wo_lam_p' . $counterL . '_desc_2'] . '");';
              }
            }
          }
        }
      }

      if (isset($_GET['did'])) {
        if (is_array($WorkOrderRepDraft)) {
          if (is_numeric($WorkOrderRepDraft['s_wo_ply'])) {

            for ($counterL = 1; $counterL <= $WorkOrderRepDraft['s_wo_ply']; $counterL++) {
              echo '$(\'input[name="work_order_layer_' . $counterL . '_micron"]\').val("' . $WorkOrderRepDraft['s_wo_layer_' . $counterL . '_micron'] . '");
			';
              echo '$(\'select[name="work_order_5_layer_' . $counterL . '_material"]\').val("' . $WorkOrderRepDraft['s_wo_layer_' . $counterL . '_structure'] . '").change();
			';

              echo '$(\'input[name="work_order_lamination_layer_' . $counterL . '_film_width"]\').val("' . $WorkOrderRepDraft['s_wo_lam_f' . $counterL . '_width'] . '");
			';
              echo '$(\'input[name="work_order_lamination_layer_' . $counterL . '_kgs"]\').val("' . $WorkOrderRepDraft['s_wo_lam_f' . $counterL . '_kgs'] . '");
			';
              echo '$(\'input[name="work_order_lamination_layer_' . $counterL . '_mtr"]\').val("' . $WorkOrderRepDraft['s_wo_lam_f' . $counterL . '_mtr'] . '");
			';

              if (($counterL + 1) <= $WorkOrderRepDraft['s_wo_ply']) {

                echo '$(\'input[name="work_order_lamination_pass_' . $counterL . '_desc_1"]\').val("' . $WorkOrderRepDraft['s_wo_lam_p' . $counterL . '_desc_1'] . '");
				';
                echo '$(\'input[name="work_order_lamination_pass_' . $counterL . '_desc_2"]\').val("' . $WorkOrderRepDraft['s_wo_lam_p' . $counterL . '_desc_2'] . '");
				';
              }
            }
          }
        }
      }
      ?>

    });
  </script>
  <script>
    $(document).ready(function(e) {

      $('#formContainer').on('submit', (function(e) {


        e.preventDefault();




      }));

    });
  </script>
</body>

</html>