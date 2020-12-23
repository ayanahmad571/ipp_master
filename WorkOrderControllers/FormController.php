<?php

function getFormRepHead($lwo)
{
?>
    <div class="row">
        <div class="form-group col-sm-12 col-md-6 col-xl-4 ">
            <label>LWO</label>
            <input type="text" class="form-control" disabled value="# <?php echo $lwo ?>">
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
<?php
}


function getRow($getAttachedTreeSqlIn)
{
?>
    <div class="row">
        <div class="form-group col-12 col-md-6 col-lg-3 col-xl-2">
            <label>IPP Sales Person Code</label>
            <select class="form-control select_a" required name="work_order_2_sales_id">
                <?php
                $getDrafts = mysqlSelect($getAttachedTreeSqlIn);

                if (is_array($getDrafts)) {
                    foreach ($getDrafts as $Draft) {
                        echo '<option value="' . $Draft['lum_id'] . '">' . $Draft['lum_code'] . ' - ' . $Draft['lum_name'] . '</option>';
                    }
                }
                ?>
            </select>


        </div>

        <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-1">
            <label>Cust Code</label>
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

        <div class="form-group col-sm-12 col-lg-6 col-xl-2">
            <label>Approved Sample WO No.</label>
            <input type="text" class="form-control" name="work_order_approved_sample_wo_no" placeholder="Approved Sample WO NO">
        </div>
        <div class="form-group col-8 col-xl-2">
            <label>Order Qty</label>
            <input placeholder="Order Quantity" name="work_order_quantity" type="number" step="0.01" class="form-control" min="0.10">
        </div>


        <?php
        getSelectBox(
            "form-group col-4 col-xl-1",
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
            "form-group col-sm-12 col-xl-2",
            "Application",
            "work_order_2_application",
            "SELECT * FROM `work_order_applications` where application_show =1 order by application_value asc ",
            'application_id',
            'application_value'
        );
        ?>
        <div class="classPouchRoll col-sm-12 col-xl-2">

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
        <div class="form-group  col-12 col-md-6 col-xl-3">
            <label>Customer Specified Total Laminate GSM</label>
            <input placeholder="Customer Specified Total Laminate GSM" name="work_order_total_gsm" type="number" step="0.01" class="form-control" min="0.10">
        </div>

        <div class="form-group  col-12 col-md-6 col-xl-2">
            <label>Laminate GSM Tolerance % +/-</label>
            <input placeholder="Tolerance +/-" name="work_order_total_gsm_tolerance" type="number" step="0.01" class="form-control" min="0">
        </div>


    </div>

    <hr>
<?php
}


function getPrintedSection()
{
?>
    <div class="row">
        <?php
        getSelectBox(
            "form-group col-12 col-md-6 col-lg-3 col-xl-2",
            "Select P or U",
            "work_order_2_type_printed",
            "SELECT * FROM `work_order_product_type_printed` where ptp_show = 1 order by ptp_value asc ",
            'ptp_id',
            'ptp_value'
        );
        ?>



        <?php
        getSelectBox(
            "form-group col-12 col-lg-6 col-xl-2 whenPrintedClickedGO",
            "Printing Method",
            "work_order_2_printing_method",
            "SELECT * FROM `work_order_ui_print_surfrev` where surfrev_show = 1 ",
            'surfrev_id',
            'surfrev_value'
        );
        ?>

        <?php
        getSelectBox(
            "form-group col-12 col-lg-6 col-xl-2 whenPrintedClickedGO",
            "Shade Card Required",
            "work_order_2_printing_shade_card_needed",
            "SELECT * FROM `work_order_ui_print_shadecardreq` where shadecardreq_show = 1 ",
            'shadecardreq_id',
            'shadecardreq_value'
        );
        ?>
        <?php
        getSelectBox(
            "form-group col-12 col-lg-6 col-xl-2 whenPrintedClickedGO",
            "Color Reference Type",
            "work_order_2_printing_color_ref_type",
            "SELECT * FROM `work_order_ui_print_shadecard_ref_type` where shadecard_ref_type_show = 1 and  shadecard_ref_type_id not in (1,5)",
            'shadecard_ref_type_id',
            'shadecard_ref_type_value'
        );
        ?>

        <?php
        getSelectBox(
            "form-group col-12 col-lg-6 col-xl-2 whenPrintedClickedGO",
            "Print Approval by",
            "work_order_2_printing_approvalby",
            "SELECT * FROM `work_order_ui_print_options` where print_options_show = 1  ",
            'print_options_id',
            'print_options_value'
        );
        ?>

        <div class="whenPrintedClickedGO form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
            <label>Ink GSM as per PRE-COSTING</label>
            <input type="text" class="form-control" name="work_order_ink_gsm_pre_c" placeholder="Ink GSM">
        </div>

        <div class="col-12 col-md-6 col-xl-3 whenPrintedClickedGO">
            <div class="row">
                <div class="form-group col-sm-12 col-md-8">
                    <label>IPP Design ID</label>
                    <input type="text" class="form-control" name="work_order_design_id" placeholder="IPP Design ID">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                    <label>Rev No</label>
                    <input type="number" min="0" value="0" class="form-control" name="work_order_rev_no" placeholder="Rev">
                </div>
            </div>
        </div>

    </div>

    <hr>
<?php
}


function getCoatingSection()
{
?>
    <div class="row">
        <?php
        getSelectBox(
            "form-group col-sm-12 col-xl-2",
            "Coating Type",
            "work_order_2_coating_options",
            "SELECT * FROM `work_order_ui_lam_options` where lamo_show =1 order by lamo_value asc ",
            'lamo_id',
            'lamo_value'
        );
        ?>
        <div class="form-group col-sm-12 col-md-6 col-lg-2">
            <label>Coating GSM</label>
            <input type="text" class="form-control" name="work_order_coating_gsm" placeholder="Coating GSM">
        </div>

    </div>

    <HR>
<?php
}


function getFill()
{
?>
    <div class="row">

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
            "Filling Method",
            "work_order_2_pouchbag_fillops",
            "SELECT * FROM `work_order_ui_pouch_bag_fill_opts` where pbfo_show =1 order by pbfo_value asc ",
            'pbfo_id',
            'pbfo_value'
        );
        ?>

        <?php
        getSelectBox(
            "form-group col-sm-12 col-xl-2",
            "Product Filling Temperature Type",
            "work_order_2_fill_temp",
            "SELECT * FROM `work_order_ui_filling_temp` where filling_temp_show =1 order by filling_temp_value asc ",
            'filling_temp_id',
            'filling_temp_value'
        );
        ?>
        <div class="form-group col-sm-12 col-md-6 col-lg-2 nonPastRetShow">
            <label>Filling Temperature</label>
            <input type="text" class="form-control" name="work_order_fill_temp" placeholder="Filling Temperature">
        </div>
        <div class="form-group col-sm-12 col-md-6 col-lg-2 pastRetShow">
            <label>Submersion Temperature</label>
            <input type="text" class="form-control" name="work_order_submersion_temp" placeholder="Submersion Temperature">
        </div>
        <div class="form-group col-sm-12 col-md-6 col-lg-2 pastRetShow">
            <label>Submersion Duration</label>
            <input type="text" class="form-control" name="work_order_submersion_duration" placeholder="Submersion Duration">
        </div>


        <div class="form-group col-sm-12 col-md-6 col-lg-2">
            <label>Line Speed</label>
            <input type="text" class="form-control" name="work_order_line_speed" placeholder="Line Speed">
        </div>
        <div class="form-group col-sm-12 col-md-6 col-lg-2">
            <label>Dwell Time</label>
            <input type="text" class="form-control" name="work_order_dwell_time" placeholder="Dwell Time">
        </div>
        <div class="form-group col-sm-12 col-md-6 col-lg-2">
            <label>Seal Temperature</label>
            <input type="text" class="form-control" name="work_order_seal_temp" placeholder="Seal Temperature">
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

        <div class="form-group col-sm-12 col-lg-6 col-xl-2">
            <label>Cust Specified COF</label>
            <input type="text" class="form-control" name="work_order_cof_val" placeholder="COF">
        </div>

    </div>
    <hr>
<?php
}


function getLayer()
{
?>

    <div class="row">
        <div class="form-group col-sm-12 col-lg-6 col-xl-2">
            <label>Number of Layers</label>
            <input id="plyValueInput" type="number" min="1" max="5" class="form-control" name="work_order_ply" value="2" placeholder="Ply">
        </div>
        <div class="form-group col-sm-12 col-lg-6 col-xl-10">
            <div class="row">
                <div class="form-group  col-12 col-md-6 col-xl-3">
                    <label>Combined Film GSM</label>
                    <input id="calcLamGSM" value="0" disabled class="form-control">
                </div>
                <div class="form-group  col-12 col-md-6 col-xl-3">
                    <label>INK GSM</label>
                    <input id="calcInkGSM" value="0" disabled class="form-control">
                </div>
                <div class="form-group  col-12 col-md-6 col-xl-3">
                    <label>Total Adhesive GSM</label>
                    <input id="calcAdhGSM" value="0" disabled class="form-control">
                </div>
                <div class="form-group  col-12 col-md-6 col-xl-3">
                    <label>Total Laminate GSM</label>
                    <input id="calcTotGSM" disabled class="form-control">
                </div>
            </div>
        </div>

    </div>

    <div id="containerLaminateLayers" class="row">
    </div>
    <div class="row" id="adhesiveSection">
    </div>

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
    </div>

    <hr>
<?php
}


function getRoll($itisEdit)
{
?>
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
                <?php if ($itisEdit) { ?>
                    <table class="table table-striped table-bordered">
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
                              and remark_master_wo_id = " . $_GET['editId']);

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

                        ?>
                    </table>
                <?php } ?>
                <textarea name="work_order_remarks_roll" class="form-control remarksEdit" placeholder="Remarks" style="height:200px"></textarea>
            </div>
        </div>
    </div>
<?php
}


function getPouch($itisEdit)
{
?>
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
                <?php if ($itisEdit) { ?>
                    <table class="table table-striped table-bordered">
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
                              and remark_master_wo_id = " . $_GET['editId']);

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

                        ?>
                    </table>
                <?php } ?>
                <textarea name="work_order_remarks_pouch" class="form-control remarksEdit" placeholder="Remarks" style="height:200px"></textarea>
            </div>
        </div>

    </div>
<?php
}


function getBag($itisEdit)
{
?>
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
                <?php if ($itisEdit) { ?>
                    <table class="table table-striped table-bordered">
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
        and remark_master_wo_id = " . $_GET['editId']);

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

                        ?>
                    </table>
                <?php } ?>
                <textarea name="work_order_remarks_bags" class="form-control remarksEdit" placeholder="Remarks" style="height:200px"></textarea>
            </div>
        </div>

    </div>
    <hr>
<?php
}


function getSlit($itisEdit)
{
?>

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

            <div id="cartonPly" class="form-group col-12 col-sm-6 col-lg-6 col-xl-2">
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
    <input type="checkbox" name="work_order_3_docs[]" value="' . $SingularOP['shipment_id'] . '" class="selectgroup-input" ' . ($SingularOP['shipment_id'] == 4 ? 'checked' : '') . '>
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
                <?php if ($itisEdit) { ?>
                    <table class="table table-striped table-bordered">
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
                        and remark_master_wo_id = " . $_GET['editId']);

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

                        ?>
                    </table>
                <?php } ?>
                <textarea name="work_order_remarks_overall" class="remarksEdit form-control" placeholder="Remarks" style="height:200px"></textarea>
            </div>
        </div>

    </div>
<?php
}

?>