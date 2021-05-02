<?php

function getChangeTypePills()
{
?>
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
                                <input type="checkbox" name="work_order_3_changes[]" 
                                value="' . $SingularOP['rept_id'] . '" 
                                class="selectgroup-input" ' . ($SingularOP['rept_id'] == 1 ? 'checked' : '') . ' />
                                <span class="selectgroup-button">' . $SingularOP['rept_value'] . '</span>
                              </label>';
                    }
                }
                ?>

            </div>
        </div>
    </div>
<?php
}

function getTransitionFields()
{
?>
    <div class="row">
        <div class="form-group col-sm-12 col-md-6 col-xl-4 ">
            <label>Manual LWO</label>
            <input type="text" class="form-control" name="work_order_m_lwo" placeholder="Manual Last Work Order">
        </div>

        <div class="form-group col-sm-12 col-md-6 col-xl-4 ">
            <label>NCR #</label>
            <input type="text" class="form-control" name="work_order_ncr_no" placeholder="NCR Number">
        </div>

        <div class="form-group col-sm-12 col-md-6 col-xl-4 ">
            <label>CCR #</label>
            <input type="text" class="form-control" name="work_order_ccr_no" placeholder="CCR Number">
        </div>

    </div>

    <hr>
<?php
}

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
                $getDrafts = mysqlSelect($getAttachedTreeSqlIn . " order by lum_code asc");

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
            <label>RFP #</label>
            <input type="text" class="form-control" name="work_order_rfp_no" placeholder="RFP Number">
        </div>

        <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
            <label>RFP Date</label>
            <input type="text" class="form-control" name="work_order_rfp_date" placeholder="DD-MM-YYYY">
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

        <?php
        getSelectBox(
            "form-group col-sm-12 col-md-6 col-lg-3 col-xl-2",
            "Partial Delivery",
            "work_order_2_partial_delivery",
            "SELECT * FROM `work_order_ui_partial_del` where partial_del_show = 1 order by partial_del_value",
            'partial_del_id',
            'partial_del_value'
        );
        ?>

        <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
            <label>Required Delivery Date</label>
            <input onchange="getDif()" type="text" class="form-control" name="work_order_delivery_date" placeholder="DD-MM-YYYY">
        </div>

        <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
            <label>Delivery Required In</label>
            <input id="numberOfDays" type="text" disabled class="form-control" name="">
        </div>

        <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-3">
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
            "form-group col-sm-12 col-xl-3",
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


function getPrintedSection($isTechnical = false)
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


        <?php
        getSelectBox(
            "form-group col-12 col-lg-6 col-xl-2 whenPrintedClickedGO",
            "LSD Required",
            "work_order_2_lsd_required",
            "SELECT * FROM `work_order_ui_lsd_required` where lsd_required_show = 1  order by lsd_required_value asc",
            'lsd_required_id',
            'lsd_required_value'
        );
        ?>

        <div class="whenPrintedAndLSDClicked form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
            <label>Number of LSD Copies</label>
            <input type="text" class="form-control" name="work_order_lsd_copies" placeholder="LSD Copies">
        </div>



        <?php
        if ($isTechnical) {
        ?>
            <div class="form-group col-sm-12 col-md-6 whenPrintedClickedGO">
                <label>Printing End Options</label>

                <div class="selectgroup selectgroup-pills">
                    <?php
                    $getSlitCustomrs = mysqlSelect("SELECT * FROM `work_order_ui_print_end_options` where print_end_opts_show = 1 ");
                    if (is_array($getSlitCustomrs)) {
                        foreach ($getSlitCustomrs as $SingularOP) {
                            echo '	
	                              <label class="selectgroup-item">	
	                                <input type="checkbox" name="work_order_3_pr_end_ops[]" 	
	                                value="' . $SingularOP['print_end_opts_id'] . '" 	
	                                class="selectgroup-input" ' . ($SingularOP['print_end_opts_id'] == 1 ? 'checked' : '') . ' />	
	                                <span class="selectgroup-button">' . $SingularOP['print_end_opts_value'] . '</span>	
	                              </label>';
                        }
                    }
                    ?>

                </div>
            </div>
        <?php
        }
        ?>

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


function getRoll($itisEdit, $woid = 0)
{
    # $itisEdit = Show Remarks Box with Usernames and Text
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
                              and remark_master_wo_id = " . $woid);

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


function getPouch($itisEdit, $woid = 0)
{
?>
    <div class="classOnlyPouch">
        <div class="row">
            <div class="col-8" id="pouchImageHolder">
                Loading Image...
            </div>
            <div class="form-group col-4">
                <label>Pouch Type</label>
                <select id="pouch_switcher" class="form-control select_a" required name="work_order_2_pouch_master">
                    <?php
                    $getPouches = mysqlSelect("SELECT * FROM `pouch_digital_master` where pdm_valid =1 order by pdm_name asc");
                    if (is_array($getPouches)) {
                        foreach ($getPouches as $Pouch) {
                            $getPouchSub = mysqlSelect("SELECT * FROM `pouch_digital_sub` where pds_valid =1 and pds_pdm_id = " . $Pouch['pdm_id'] . " order by pds_name asc");
                            echo '<optgroup label="' . $Pouch['pdm_name'] . '">';
                            foreach ($getPouchSub  as $PouchSub) {
                                echo '<option value="' . $PouchSub['pds_id'] . '">' . $PouchSub['pds_name'] . '</option>';
                            }
                            echo '</optgroup>';
                        }
                    }
                    ?>
                </select>

                <hr>

                <div class="row" id="pouchFormHolder">
                    <div class="col-12">Awaiting Type Selection...</div>
                </div>

                <hr>

                <h6>Extra Options - Punch</h6>
                <div class="row">
                    <?php
                    getSelectBox(
                        "form-group col-xs-12 col-sm-6",
                        "Punch Type",
                        "work_order_2_pouch_punch_type",
                        "SELECT * FROM `work_order_ui_pouch_punch_type` where punch_show =1 order by punch_value asc ",
                        'punch_id',
                        'punch_value'
                    );
                    ?>
                    <!-- Only If Punch Type is Euro punch, or ID is 10 -->
                    <?php
                    getSelectBox(
                        "euroPunchPouch form-group col-xs-12 col-sm-6",
                        "Euro Punch",
                        "work_order_2_pouch_euro_punch",
                        "SELECT * FROM `work_order_ui_pouch_euro_punch` where euro_show =1 ",
                        'euro_id',
                        'euro_value'
                    );
                    ?>
                    <div class="form-group col-xs-12 col-sm-6">
                        <label>Distance from Top</label>
                        <input type="text" class="form-control" name="work_order_pouch_distance_top_extra" placeholder="Distance from Top">
                    </div>

                    <?php
                    getSelectBox(
                        "form-group col-xs-12 col-sm-6",
                        "Perforation",
                        "work_order_2_pouch_perforation",
                        "SELECT * FROM `work_order_ui_pouch_perforation` where pouch_perforation_show =1 order by pouch_perforation_value asc ",
                        'pouch_perforation_id',
                        'pouch_perforation_value'
                    );
                    ?>
                    <div class="PerforationClickedShow form-group col-xs-12 col-sm-6">
                        <label>Perforation Distance from Top</label>
                        <input type="text" class="form-control" name="work_order_pouch_perforation_distance_top" placeholder="Perforation Distance from Top">
                    </div>

                </div>
                <hr>
                <h6>Extra Options - Corner</h6>
                <div class="row">
                    <?php
                    getSelectBox(
                        "form-group col-xs-12 col-sm-6",
                        "Round Corner",
                        "work_order_2_pouch_round_corner",
                        "SELECT * FROM `work_order_ui_pouch_round_corner` where round_corner_show =1 order by round_corner_value asc ",
                        'round_corner_id',
                        'round_corner_value'
                    );
                    ?>

                </div>
                <hr>
                <h6>Extra Options - Zipper</h6>
                <div class="row">

                    <?php
                    getSelectBox(
                        "form-group col-xs-12 col-sm-6",
                        "Zipper",
                        "work_order_2_pouch_zipper",
                        "SELECT * FROM `work_order_ui_pouch_zipper` where zipper_show =1 order by zipper_value asc ",
                        'zipper_id',
                        'zipper_value'
                    );
                    ?>
                    <?php
                    getSelectBox(
                        "zipperYes form-group col-xs-12 col-sm-6",
                        "Open/Close?",
                        "work_order_2_pouch_zipper_opc",
                        "SELECT * FROM `work_order_ui_pouch_zipper_opc` where zipopc_show =1 order by zipopc_value asc ",
                        'zipopc_id',
                        'zipopc_value'
                    );
                    ?>
                    <?php
                    getSelectBox(
                        "zipperYes peStrip form-group col-xs-12 col-sm-6",
                        "PE Strip",
                        "work_order_2_pouch_pestrip",
                        "SELECT * FROM `work_order_ui_pouch_pe_strip` where pestrip_show =1 order by pestrip_value asc ",
                        'pestrip_id',
                        'pestrip_value'
                    );
                    ?>

                    <div class="zipperYes form-group col-xs-12 col-sm-6">
                        <label>Distance From Top</label>
                        <input type="text" class="form-control" name="work_order_pouch_top_dist" placeholder="Distance From Top">
                    </div>

                </div>
                <hr>
                <h6>Extra Options - Notch</h6>
                <div class="row">


                    <?php
                    getSelectBox(
                        "form-group col-xs-12 col-sm-6",
                        "Tear Notch",
                        "work_order_2_pouch_tear_notch",
                        "SELECT * FROM `work_order_ui_pouch_tear_notch` where tear_notch_show =1 order by tear_notch_value asc ",
                        'tear_notch_id',
                        'tear_notch_value'
                    );
                    ?>
                    <?php
                    getSelectBox(
                        "tearNotch form-group col-xs-12 col-sm-6",
                        "Tear Notch Number of Sides",
                        "work_order_2_pouch_tear_notch_qty",
                        "SELECT * FROM `work_order_ui_pouch_tear_notch_qty` where tear_notch_qty_show =1 order by tear_notch_qty_value asc ",
                        'tear_notch_qty_id',
                        'tear_notch_qty_value'
                    );
                    ?>
                    <?php
                    getSelectBox(
                        "tearNotch form-group col-xs-12 col-sm-6",
                        "Tear Notch Side",
                        "work_order_2_pouch_tear_notch_side",
                        "SELECT * FROM `work_order_ui_pouch_tear_notch_side` where tear_notch_side_show =1 order by tear_notch_side_value asc ",
                        'tear_notch_side_id',
                        'tear_notch_side_value'
                    );
                    ?>



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
                              and remark_master_wo_id = " . $woid);

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


function getBag($itisEdit, $woid = 0)
{
?>
    <div class="classOnlyBag">

        <div class="row">
            <div class="col-8" id="bagImageHolder">
                <div class="col-12">Loading Options...</div>
            </div>
            <div class="form-group col-4">
                <label>Bag Type</label>
                <select id="bag_switcher" class="form-control select_a" required name="work_order_2_bag_type">
                    <?php
                    $getBags = mysqlSelect("SELECT * FROM `bag_digital_master` where bdm_valid =1");
                    if (is_array($getBags)) {
                        foreach ($getBags  as $Bag) {
                            echo '<option value="' . $Bag['bdm_id'] . '">' . $Bag['bdm_name'] . '</option>';
                        }
                    }
                    ?>
                </select>
                <hr>
                <div class="row" id="bagFormHolder">
                    <div class="col-12">Loading Options...</div>
                </div>
                <hr>
                <h6>Extra Options</h6>
                <div class="row">
                    <?php
                    getSelectBox(
                        "form-group col-xs-12 col-sm-6",
                        "Handle",
                        "work_order_2_bags_handle",
                        "SELECT * FROM `work_order_ui_bag_handle` where bag_handle_show =1 order by bag_handle_value asc ",
                        'bag_handle_id',
                        'bag_handle_value'
                    );
                    ?>
                    <div class="form-group col-xs-12 col-sm-6">
                        <label>Top Fold</label>
                        <input type="text" class="form-control" name="work_order_bags_top_fold" placeholder="Top Fold">
                    </div>
                    <div class="form-group col-xs-12 col-sm-6">
                        <label>Flap</label>
                        <input type="text" class="form-control" name="work_order_bags_flap" placeholder="Flap">
                    </div>
                    <div class="form-group col-xs-12 col-sm-6">
                        <label>Lip</label>
                        <input type="text" class="form-control" name="work_order_bags_lip" placeholder="Lip">
                    </div>
                    <div class="form-group col-xs-12 col-sm-6">
                        <label>Distance from Top</label>
                        <input type="text" class="form-control" name="work_order_bags_distance_top_extra" placeholder="Distance from Top">
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
        and remark_master_wo_id = " . $woid);

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


function getSlit($itisEdit, $woid = 0)
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
            <div class="form-group col-12 col-sm-10 ">
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

            <div class="form-group col-12 col-sm-2">
                <label>Port Name</label>
                <input name="work_order_ship_port_name" type="text" class="form-control" placeholder="Port Name">
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
                        and remark_master_wo_id = " . $woid);

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

function getEditTrueBody($WorkOrderMain, $WOstraightArraysIn, $WOcheckboxArraysIn, $WOselectArraysIn)
{
    if (is_array($WorkOrderMain)) {
    ?>
        <script>
            $(document).ready(function(e) {
                <?php
                foreach ($WOstraightArraysIn as $k => $v) {
                    if (!is_null($WorkOrderMain[$v])) {
                        if ($k == 'work_order_delivery_date' || $k == "work_order_po_date") {
                            echo '$(\'input[name="' . $k . '"]\').val("' . date('d-m-Y', $WorkOrderMain[$v]) . '");
						';
                        } else {
                            echo '$(\'input[name="' . $k . '"]\').val("' . $WorkOrderMain[$v] . '");
						';
                        }
                    }
                }
                ?>

                <?php
                foreach ($WOcheckboxArraysIn as $k => $v) {

                    echo '$(\'input[name="' . $k . '[]"]\').each(function() {
						this.checked = false;
					});
					';
                    if ($WorkOrderMain[$v] != '') {
                        $s = explode(',', $WorkOrderMain[$v]);
                        foreach ($s as $val) {
                            echo '$(\'input:checkbox[name="' . $k . '[]"]\').filter("[value=\'' . $val . '\']").prop(\'checked\', true);
							';
                        }
                    }
                }
                ?>

                <?php
                foreach ($WOselectArraysIn as $k => $v) {
                    if (!is_null($WorkOrderMain[$v])) {
                        echo '$(\'select[name="' . $k . '"]\').val("' . $WorkOrderMain[$v] . '").change();
                        ';
                    }
                }

                ?>

            });
        </script>
    <?php
    }
}

function getEditTrueLayers($WorkOrderMain)
{
    if (is_array($WorkOrderMain)) {
        if (is_numeric($WorkOrderMain['master_wo_ply'])) {

            for ($counterL = 1; $counterL <= $WorkOrderMain['master_wo_ply']; $counterL++) {
                echo '$(\'input[name="work_order_layer_' . $counterL . '_micron"]\').val("' . $WorkOrderMain['master_wo_layer_' . $counterL . '_micron'] . '");
                ';
                echo '$(\'select[name="work_order_5_layer_' . $counterL . '_material"]\').val("' . $WorkOrderMain['master_wo_layer_' . $counterL . '_structure'] . '").change();
                ';
            }
            for ($counterL = 1; $counterL < $WorkOrderMain['master_wo_ply']; $counterL++) {
                echo '$(\'input[name="work_order_adh' . $counterL . '"]\').val("' . $WorkOrderMain['master_wo_adh' . $counterL] . '");
                ';
            }
        }
    }
}

function getScriptInitializer()
{
    ?>
    <script>
        $(document).ready(function() {

            setUpLaminateEntryLayers();

            setPrintedSetup();
            setBagPouchSetup();
            setUpSelect2s();
            setUpFilmToLaminate();
            getDif();
            setUpPouchImage();
            setUpPouchEuroPunch();
            setUpPouchZipper();
            setUpPouchZipperYesNo();
            setUpPouchTearNotch();
            setUpBagImage();
            setUpRollImage();
            setCustName();
            setUpMaxPouch();
            setUpPrintingOption();
            setLamGSM();
            setUpInkGsmCalc();
            setPastRet()
            setCartonPly();
            setUpLSD();
            setUpPerforation();
            $(".remarksEdit").wysihtml5();

        });
    </script>
<?php
}

function getScriptTriggers()
{
?>
    <script>
        $(document).ready(function() {


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
                setCartonPly();
            });


            $("select[name=work_order_2_client_id]").change(function(e) {
                setCustName();
            });

            $("select[name=work_order_2_pouch_punch_type]").change(function(e) {
                setUpPouchEuroPunch();
            });

            $("select[name=work_order_2_pouch_master]").change(function(e) {
                setUpPouchZipper();
            });

            $("select[name=work_order_2_pouch_zipper]").change(function(e) {
                setUpPouchZipperYesNo();
            });

            $("select[name=work_order_2_pouch_tear_notch]").change(function(e) {
                setUpPouchTearNotch();
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
            for (l = 1; l < ($('#plyValueInput').val()); l++) {

                $('input[name="work_order_adh' + l + '"]').change(function(e) {
                    setAdhesiveGsm();
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
                    for (l2 = 1; l2 < ($('#plyValueInput').val()); l2++) {

                        $('input[name="work_order_adh' + l2 + '"]').change(function(e) {
                            setAdhesiveGsm();

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

            $('input[name="work_order_ink_gsm_pre_c"]').change(function(e) {
                setUpInkGsmCalc();
            });

            $("select[name=work_order_2_fill_temp]").change(function(e) {
                setPastRet();
            });

            $("select[name=work_order_2_roll_pack_ins]").change(function(e) {
                setCartonPly();
            });

            $("select[name=work_order_2_lsd_required]").change(function(e) {
                setUpLSD();
            });

            $("select[name=work_order_2_pouch_perforation]").change(function(e) {
                setUpPerforation();
            });

            $("#formLoading").hide();

        });
    </script>
<?php
}

function getScriptFunctionalSetup()
{
?>
    <script>
        function setCartonPly() {
            let struct = $('select[name=work_order_2_structure]').find(':selected').val();
            let bagPouchCont = $('select[name=work_order_2_roll_pack_ins]').find(':selected').val();
            let rollCont = $('select[name=work_order_2_carton_pack_ins]').find(':selected').val();

            if (struct == 1 || struct == 2) {
                //Bag/Pouch
                $("#cartonPly").show();
            } else {
                //ROll

                if (bagPouchCont == 1) {
                    $("#cartonPly").hide();
                } else {
                    $("#cartonPly").show();
                }
            }
        }

        function setPastRet() {
            var selectedItem = $("select[name=work_order_2_fill_temp] :selected").val();
            if (selectedItem == 4 || selectedItem == 5) {
                $(".pastRetShow").show();
                $(".nonPastRetShow").hide();
            } else {
                $(".pastRetShow").hide();
                $(".nonPastRetShow").show();
            }
        }

        function setUpInkGsmCalc() {
            let vals = $('input[name="work_order_ink_gsm_pre_c"]').val();
            if (vals === '') {
                $("#calcInkGSM").val(0);
            } else {
                $("#calcInkGSM").val(vals);
            }
            totalGSM();

        }

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
            totalGSM();

        }

        function setAdhesiveGsm() {
            var layers = $('#plyValueInput').val();
            var l = 1;
            var c = 0;


            for (l; l < (layers); l++) {
                var adh = new Number($('input[name=work_order_adh' + l + ']').val());
                if ((adh) == '') {
                    adh = 0;
                }
                c += (adh);
            }
            $("#calcAdhGSM").val(c);
            totalGSM();

        }

        function totalGSM() {
            var a = new Number($('#calcLamGSM').val());
            var b = new Number($('#calcInkGSM').val());
            var c = new Number($('#calcAdhGSM').val());

            $("#calcTotGSM").val(a + b + c);
        }

        function setUpPrintingOption() {
            var a = $("select[name=work_order_2_type_printed] :selected").val();
            if (a == 1) {
                $('.whenPrintedClickedGO').show();
                setUpLSD();
            } else {
                $('.whenPrintedClickedGO').hide();
                setUpLSD();
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
            var colW = 12;

            if (layers == 2) {
                colW = 6;
            } else if (layers == 3) {
                colW = 4;
            } else if (layers == 4) {
                colW = 6;
            } else if (layers == 5) {
                colW = 6;
            }
            for (l = 1; l <= (layers); l++) {

                stringOutput = stringOutput.concat("",
                    "<div id=\"laminateRowId" + l + "\" class=\"col-12 col-lg-6 col-xl-" + colW + "\">",
                    "    <div >",
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
                    $getMaterials = mysqlSelect("SELECT * FROM `materials_main` order by material_position,material_value asc ");
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


            var adhesiveSection = $('#adhesiveSection');
            varOutString = "";

            for (l2 = 1; l2 <= (layers - 1); l2++) {
                varOutString = varOutString.concat("",
                    '<div class="form-group  col-12 col-md-6 col-xl-3">',
                    "<label>Adhesive Pass " + l2 + " GSM</label>",
                    '<input type="number" class="form-control" name="work_order_adh' + l2 + '" placeholder="Adhesive ' + l2 + ' GSM">',
                    "</div>");

            }
            adhesiveSection.html(varOutString);
            varOutString = "";




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

        async function setUpPouchImage() {
            // $("#pouchImageHolder").html('<img class="img-thumbnail" src="' + $("#pouch_switcher").find(':selected').data('id') + '" />');
            var pouchId = $("#pouch_switcher").find(':selected').val();

            await $.post("WorkOrderControllers/FormAllDynController", {
                    pouch_sub_id: pouchId
                },
                async function(data, status) {
                    var obj = JSON.parse(data);
                    console.log(obj);
                    $("#pouchImageHolder").html(obj[0]);
                    await $("#pouchFormHolder").html(obj[1]);
                });

        }

        async function setUpBagImage() {
            var bagId = $("#bag_switcher").find(':selected').val();

            await $.post("WorkOrderControllers/FormAllDynController", {
                    bag_id: bagId
                },
                async function(data, status) {
                    var obj = JSON.parse(data);
                    console.log(obj);
                    $("#bagImageHolder").html(obj[0]);
                    await $("#bagFormHolder").html(obj[1]);
                });

            // $("#bagFormHolder")


        }

        function setUpRollImage() {
            $("#imgRollPut").html('<img class="img-thumbnail" src="assets/slitting/' + $("select[name=work_order_2_wind_dir]").find(':selected').data('id') + '.jpg" />');

        }

        function setUpPouchEuroPunch() {
            var punchId = $("select[name=work_order_2_pouch_punch_type]").find(':selected').val();

            if (punchId != 10) {
                $(".euroPunchPouch").hide();
            } else {
                $(".euroPunchPouch").show();
            }
        }

        function setUpPouchZipper() {
            var pouchId = $("select[name=work_order_2_pouch_master]").find(':selected').val();

            if (pouchId == 9 || pouchId == 10) {
                $("select[name=work_order_2_pouch_zipper]").val(1).change();
            } else {
                $("select[name=work_order_2_pouch_zipper]").val(2).change();
            }
        }

        function setUpPouchZipperYesNo() {
            var yesNo = $("select[name=work_order_2_pouch_zipper]").find(':selected').val();
            var pouchId = $("select[name=work_order_2_pouch_master]").find(':selected').val();

            if (yesNo == 1) {
                $(".zipperYes").show();
            } else {
                $(".zipperYes").hide();
            }

            if (pouchId == 9 || pouchId == 10) {
                $(".peStrip").show();
            } else {
                $(".peStrip").hide();
            }
        }

        function setUpPouchTearNotch() {
            var yesNo = $("select[name=work_order_2_pouch_tear_notch]").find(':selected').val();

            if (yesNo == 1) {
                $(".tearNotch").show();
            } else {
                $(".tearNotch").hide();
            }

        }

        function setUpLSD() {
            var a = $("select[name=work_order_2_type_printed] :selected").val();
            var b = $("select[name=work_order_2_lsd_required] :selected").val();
            if (a == 1 && b == 2) {
                $('.whenPrintedAndLSDClicked').show();
            } else {
                $('.whenPrintedAndLSDClicked').hide();
            }

        }

        function setUpPerforation() {
            var a = $("select[name=work_order_2_pouch_perforation] :selected").val();
            if (a == 2) {
                $('.PerforationClickedShow').show();
            } else {
                $('.PerforationClickedShow').hide();
            }
        }
    </script>
<?php
}

function getEditBagPouchScript($WorkOrderMain)
{
    if (is_array($WorkOrderMain)) {
        echo "console.log('Requesting Clearance ');
        await setUpPouchImage();
        await setUpBagImage();
        ";

        if ($WorkOrderMain['master_wo_2_structure'] == 1) {
            #Bag
            $ParamsDatabase = json_decode($WorkOrderMain['master_wo_bags_values']);
            $getParams = mysqlSelect("SELECT * FROM `bag_digital_params` where bdp_bdm_id =" . $WorkOrderMain['master_wo_2_bag_type']);
            if (is_array($getParams)) {
                foreach ($getParams as $Param) {
                    if (isset($ParamsDatabase->{$Param['bdp_id']})) {
                        echo '$(\'input[name="bags[' .  $Param['bdp_id'] . ']"]\').val("' . $ParamsDatabase->{$Param['bdp_id']} . '");
                        ';
                    }
                }
            }
        } else if ($WorkOrderMain['master_wo_2_structure'] == 2) {
            #Pouch
            $ParamsDatabase = json_decode($WorkOrderMain['master_wo_pouch_values']);
            $getParams = mysqlSelect("SELECT * FROM `pouch_digital_params` where pdp_pds_id =" . $WorkOrderMain['master_wo_2_pouch_master']);
            if (is_array($getParams)) {
                foreach ($getParams as $Param) {
                    if (isset($ParamsDatabase->{$Param['pdp_id']})) {
                        echo '$(\'input[name="pouch[' .  $Param['pdp_id'] . ']"]\').val("' . $ParamsDatabase->{$Param['pdp_id']} . '");
                        ';
                    }
                }
            }
        }
    }
}


function submitParams()
{
    return array(
        "work_order_2_client_id", "work_order_customer_design_name", "work_order_customer_item_code", "work_order_customer_po", "work_order_po_date", "work_order_delivery_date",
        "work_order_3_customer_loc", "work_order_2_sales_id",
        "work_order_2_structure", "work_order_2_type_printed", "work_order_ink_gsm_pre_c", "work_order_2_application", "work_order_2_roll_fill_opts",
        "work_order_2_pouchbag_fillops", "work_order_2_fill_temp", "work_order_fill_temp", "work_order_line_speed",
        "work_order_dwell_time", "work_order_seal_temp", "work_order_design_id", "work_order_rev_no", "work_order_approved_sample_wo_no",
        "work_order_pack_weight", "work_order_2_pack_weight_unit", "work_order_quantity", "work_order_2_units",
        "work_order_quantity_tolerance", "work_order_2_laser_config", "work_order_ply", "work_order_total_gsm", "work_order_total_gsm_tolerance",
        "work_order_2_wind_dir", "work_order_roll_od", "work_order_roll_width", "work_order_roll_cutoff_len", "work_order_max_w_p_r",
        "work_order_max_lmtr_p_r", "work_order_max_imps_p_r", "work_order_2_slitting_core_id", "work_order_2_slitting_core_material", "work_order_2_slitting_core_plugs",
        "work_order_2_slitting_qc_ins", "work_order_max_joints", "work_order_remarks_roll", "work_order_remarks_pouch", "work_order_remarks_bags",
        "work_order_2_foil_print_side", "work_order_2_printing_method", "work_order_2_printing_shade_card_needed", "work_order_2_printing_color_ref_type", "work_order_2_printing_approvalby",
        "work_order_2_roll_pack_ins", "work_order_2_carton_pack_ins", "work_order_2_pallet_mark_ins", "work_order_pouch_per_bund", "work_order_bund_per_box",
        "work_order_2_pallet_type", "work_order_2_cont_stuff", "work_order_max_gross_pallet_weight", "work_order_2_pallet_dim", "work_order_2_freight_type",
        "work_order_cart_thick", "work_order_3_docs", "work_order_remarks_overall",
        "work_order_2_coating_options", "work_order_coating_gsm", "work_order_cof_val", "work_order_submersion_temp", "work_order_submersion_duration"
    );
}

function submitPlyCheck($plyNumber)
{
    if ($plyNumber > 5 || $plyNumber < 1) {
        die("PLY Value not in range [1,5]");
    }
}

function submitAdhesiveCheck($adhesiveNos, $superPOST)
{
    for ($counter2 = 1; $counter2 <= $adhesiveNos; $counter2++) {
        if (!isset($superPOST['work_order_adh' . $counter2])) {
            die('Missing Value of Adhesive ' . $counter2 . ' GSM ');
        }
    }

    for ($counter2 = 1; $counter2 <= $adhesiveNos; $counter2++) {
        if (!is_numeric($superPOST['work_order_adh' . $counter2])) {
            die('Invalid Value of Adhesive ' . $counter2 . ' GSM ');
        }
    }
}


function submitLayerCheck($plyNumber, $superPOST)
{
    for ($counter1 = 1; $counter1 <= $plyNumber; $counter1++) {
        if (!isset($superPOST['work_order_layer_' . $counter1 . '_micron'])) {
            die('Missing Value of Layer ' . $counter1 . ' Micron ');
        }
        if (!isset($superPOST['work_order_5_layer_' . $counter1 . '_material'])) {
            die('Missing Value of Layer ' . $counter1 . ' Structure ');
        }
    }

    for ($counter1 = 1; $counter1 <= $plyNumber; $counter1++) {

        if (!is_numeric($superPOST['work_order_layer_' . $counter1 . '_micron'])) {
            die('Invalid Numeric Value of Layer ' . $counter1 . ' Micron ');
        }

        if (!is_numeric($superPOST['work_order_5_layer_' . $counter1 . '_material'])) {
            die('Invalid Value of Layer ' . $counter1 . ' Material ');
        }
    }
}

function submitMaterialsCheck($plyNumber, $superPOST)
{

    for ($counter1 = 1; $counter1 <= $plyNumber; $counter1++) {
        //checkLayerStructure
        selectChecker(
            "SELECT * FROM `materials_main`  
        where material_id= " . $superPOST['work_order_5_layer_' . $counter1 . '_material'],
            'Structure Not Found for Layer-' . $counter1,
            'mysqlSelect'
        );
        $valFilmID = $superPOST['work_order_5_layer_' . $counter1 . '_material'];
    }
}

function submitFoilPrintSet($plyNumber, $superPOST)
{
    $foilPrint = false;
    for ($counter1 = 1; $counter1 <= $plyNumber; $counter1++) {
        //checkLayerStructure
        $valFilmID = $superPOST['work_order_5_layer_' . $counter1 . '_material'];

        if ($counter1 == 1) {
            if ($valFilmID == 3 || $valFilmID == 17 || $valFilmID == 52) {
                $foilPrint = true;
            }
        }
    }

    return $foilPrint;
}


function submitDateCheck($dateIn, $errorIn)
{
    $date_created = date_create_from_format("d-m-Y @ H:i:s", $dateIn);
    if (empty($date_created)) {
        die($errorIn);
    }
    return get_object_vars($date_created);
}

function submitFutureCheckDate($dateIn, $errorIn)
{
    if ($dateIn < time()) {
        die($errorIn);
    }
}
?>