<?php 
require_once("server_fundamentals/SessionHandler.php");

getHead("Print View");

	$trail = 'master_wo';

if(isset($_GET['id'])){
	if(!is_numeric($_GET['id'])){
		die("Invalid ID");
	}
	$d = false;
}else if(isset($_GET['did'])){
	if(!is_numeric($_GET['did'])){
		die("Invalid Draft ID");
	}
	$d = true;
	$trail = 's_wo';
}else if(isset($_GET['pid'])){
	if(!is_numeric($_GET['pid'])){
		die("Invalid Published ID");
	}
	$d = false;

}else{
	die("No ID Founds");
	$d = false;
}


if(isset($_GET['pid'])){
	$os = array(1, 2, 3, 4);
	if (!in_array($USER_ARRAY['lum_user_type'], $os)) {
		die("Access Denied");
	}

		$sql = "
		SELECT * FROM `master_work_order_main` 
		left join master_work_order_reference_number on mwo_ref_id = master_wo_ref
		left join clients_main on master_wo_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id
		left join user_main on master_wo_lum_id = lum_id
		
		left join work_order_qty_units on unit_id = master_wo_qty_unit
		left join work_order_applications on application_id = master_wo_application_id
		left join work_order_ui_structure on structure_id = master_wo_structure
		
		
		left join work_order_ui_ext_antistatic on anti_id = master_wo_ex_antistatic
		left join work_order_ui_ext_layer_type on layer_type_id = master_wo_ex_layer
		left join work_order_ui_ext_treatment on treat_id = master_wo_ex_treatment
		left join work_order_ui_ext_extrude_in on extrude_in_id = master_wo_ex_extrude_in
		left join work_order_ui_ext_cof on cof_id = master_wo_ex_cof
		
		left join work_order_ui_print_type on print_type_id = master_wo_print_type
		left join work_order_ui_print_surfrev on surfrev_id = master_wo_print_type_2
		left join work_order_ui_print_tubesheet on tubesheet_id = master_wo_print_type_3
		left join work_order_ui_print_shadecardreq on shadecardreq_id = master_wo_print_shade_card_req
		left join work_order_ui_print_shadecard_ref_type on shadecard_ref_type_id = master_wo_print_col_ref_type
		
		left join work_order_ui_pouch_sealing on pouch_sealing_id = master_wo_pouch_sealing
		left join work_order_ui_pouch_seal_type on pouch_seal_type_id = master_wo_pouch_seal_type
		left join work_order_ui_pouch_euro_punch on pouch_euro_punch_id = master_wo_pouch_euro_punch
		left join work_order_ui_pouch_pouch_open on pouch_open_id = master_wo_pouch_pouch_open
		left join work_order_ui_pouch_seal on pouch_seal_id = master_wo_pouch_seal
		left join work_order_ui_pouch_pouch_type on pouch_pouch_type_id = master_wo_pouch_pouch_type
		
		left join work_order_ui_bag_handle on bag_handle_id = master_wo_bag_handle
		left join work_order_ui_bag_vest_handle on bag_vest_handle_id = master_wo_bag_vest_handle
		
		left join work_order_ui_slitting_pallet on slitting_pallet_id = master_wo_slit_pallet
		left join work_order_ui_slitting_5ply_packing_options on slitting_5ply_packing_options_id = master_wo_slit_packing_5ply
		left join work_order_ui_slitting_sticker on slitting_sticker_id = master_wo_slit_sticker
		left join work_order_ui_slitting_core_id_length on slitting_core_id_length_id = master_wo_slit_core_id
		left join work_order_ui_slitting_core_id_type on slitting_core_id_type_id = master_wo_slit_core_type
		left join work_order_wind_dir on wind_id = master_wo_slit_wind_dir
		where master_wo_id= ".$_GET['pid']."
		order by master_wo_id asc";

		$getWO = mysqlSelect($sql);
		if(!is_array($getWO)){
			die("WO Not Found");
		}
		$getWO = $getWO[0];

		$ref = $getWO['master_wo_ref'];	
	
}else if(isset($_GET['id'])){
	$sql = $UpdatedStatusQuery."
left join clients_main on master_wo_client_id = client_id
left join master_work_order_main_identitiy on master_wo_status = mwoid_id
left join user_main on master_wo_lum_id = lum_id
left join work_order_wind_dir on wind_id = master_wo_slit_wind_dir
left join work_order_qty_units on unit_id = master_wo_qty_unit
left join work_order_applications on application_id = master_wo_application_id
left join work_order_ui_structure on master_wo_aaaaaaaaa = structure_id 
left join work_order_ui_customer_location on master_wo_aaaaaaaaa = customer_location_id
left join work_order_ui_lam_end_options on master_wo_aaaaaaaaa = lam_end_options_id
left join work_order_ui_pe_film_feature on master_wo_aaaaaaaaa = pe_film_feature_id

left join work_order_ui_bag_gusset_bottom on master_wo_aaaaaaaaa = gusset_bottom_id
left join work_order_ui_bag_gusset_side on master_wo_aaaaaaaaa = gusset_side_id
left join work_order_ui_bag_handle on master_wo_aaaaaaaaa = bag_handle_id
left join work_order_ui_bag_punch_opts on master_wo_aaaaaaaaa = bag_punch_opts_id
left join work_order_ui_bag_sealing_opts on master_wo_aaaaaaaaa = bag_sealing_opts_id
left join work_order_ui_bag_vest_handle on master_wo_aaaaaaaaa = bag_vest_handle_id

left join work_order_ui_ext_antistatic on master_wo_aaaaaaaaa = anti_id
left join work_order_ui_ext_cof on master_wo_aaaaaaaaa = cof_id
left join work_order_ui_ext_extrude_in on master_wo_aaaaaaaaa = extrude_in_id
left join work_order_ui_ext_layer_type on master_wo_aaaaaaaaa = layer_type_id
left join work_order_ui_ext_options on master_wo_aaaaaaaaa = ext_options_id
left join work_order_ui_ext_treatment on master_wo_aaaaaaaaa = treat_id

left join work_order_ui_pouch_closure_type on master_wo_aaaaaaaaa = pouch_closure_type_id
left join work_order_ui_pouch_corner_type on master_wo_aaaaaaaaa = pouch_corner_type_id
left join work_order_ui_pouch_euro_punch on master_wo_aaaaaaaaa = pouch_euro_punch_id
left join work_order_ui_pouch_gusset_bottom on master_wo_aaaaaaaaa = pouch_gusset_bottom_id
left join work_order_ui_pouch_gusset_side on master_wo_aaaaaaaaa = pouch_gusset_side_id
left join work_order_ui_pouch_hole_punch on master_wo_aaaaaaaaa = pouch_hole_punch_id
left join work_order_ui_pouch_notch_side on master_wo_aaaaaaaaa = pouch_notch_side_id
left join work_order_ui_pouch_pouch_open on master_wo_aaaaaaaaa = pouch_open_id
left join work_order_ui_pouch_seal on master_wo_aaaaaaaaa = pouch_seal_id
left join work_order_ui_pouch_sealing on master_wo_aaaaaaaaa = pouch_sealing_id
left join work_order_ui_pouch_special_tooling on master_wo_aaaaaaaaa = pouch_special_tooling_id
left join work_order_ui_pouch_type on master_wo_aaaaaaaaa = pouch_type_id

left join work_order_ui_print_baseshel on master_wo_aaaaaaaaa = print_baseshel_id
left join work_order_ui_print_cylinder_supplier on master_wo_aaaaaaaaa = cylinder_supplier_id
left join work_order_ui_print_end_options on master_wo_aaaaaaaaa = print_end_options_id
left join work_order_ui_print_eyemark_da on master_wo_aaaaaaaaa = eyemark_da_id
left join work_order_ui_print_eyemark_path on master_wo_aaaaaaaaa = eyemark_path_id
left join work_order_ui_print_ink_sys on master_wo_aaaaaaaaa = ink_sys_id
left join work_order_ui_print_options on master_wo_aaaaaaaaa = print_options_id
left join work_order_ui_print_shadecard_ref_type on master_wo_aaaaaaaaa = shadecard_ref_type_id
left join work_order_ui_print_shadecardreq on master_wo_aaaaaaaaa = shadecardreq_id
left join work_order_ui_print_surfrev on master_wo_aaaaaaaaa = surfrev_id

left join work_order_ui_slitting_core_id_length on master_wo_aaaaaaaaa = slitting_core_id_length_id
left join work_order_ui_slitting_core_id_type on master_wo_aaaaaaaaa = slitting_core_id_type_id
left join work_order_ui_slitting_core_plugs on master_wo_aaaaaaaaa = core_plugs_id
left join work_order_ui_slitting_packing_opts on master_wo_aaaaaaaaa = slitting_packing_opts_id
left join work_order_ui_slitting_pallet on master_wo_aaaaaaaaa = slitting_pallet_id
left join work_order_ui_slitting_pallet_instructions on master_wo_aaaaaaaaa = pallet_instructions_id
left join work_order_ui_slitting_qc_ins on master_wo_aaaaaaaaa = slitting_qc_ins_id
left join work_order_ui_slitting_sticker on master_wo_aaaaaaaaa = slitting_sticker_id
        where master_wo_ref = ".$_GET['id']."
		
		".$inColsWO;
		$getWO = mysqlSelect($sql);
		
		if(!is_array($getWO)){
			die("WO Not Found");
		}
		$getWO = $getWO[0];
		$ref = $getWO['master_wo_ref'];	

}else if(isset($_GET['did'])){
		$sql = "
		SELECT * FROM `sales_work_order_main` 
		left join clients_main on s_wo_client_id = client_id
		left join  sales_work_order_main_identitiy  on s_wo_status = woi_id
		left join user_main on s_wo_lum_id = lum_id
		
		left join work_order_qty_units on unit_id = s_wo_qty_unit
		left join work_order_applications on application_id = s_wo_application_id
		left join work_order_ui_structure on structure_id = s_wo_structure
		
		
		left join work_order_ui_ext_antistatic on anti_id = s_wo_ex_antistatic
		left join work_order_ui_ext_layer_type on layer_type_id = s_wo_ex_layer
		left join work_order_ui_ext_treatment on treat_id = s_wo_ex_treatment
		left join work_order_ui_ext_extrude_in on extrude_in_id = s_wo_ex_extrude_in
		left join work_order_ui_ext_cof on cof_id = s_wo_ex_cof
		
		left join work_order_ui_print_type on print_type_id = s_wo_print_type
		left join work_order_ui_print_surfrev on surfrev_id = s_wo_print_type_2
		left join work_order_ui_print_tubesheet on tubesheet_id = s_wo_print_type_3
		left join work_order_ui_print_shadecardreq on shadecardreq_id = s_wo_print_shade_card_req
		left join work_order_ui_print_shadecard_ref_type on shadecard_ref_type_id = s_wo_print_col_ref_type
		
		left join work_order_ui_pouch_sealing on pouch_sealing_id = s_wo_pouch_sealing
		left join work_order_ui_pouch_seal_type on pouch_seal_type_id = s_wo_pouch_seal_type
		left join work_order_ui_pouch_euro_punch on pouch_euro_punch_id = s_wo_pouch_euro_punch
		left join work_order_ui_pouch_pouch_open on pouch_open_id = s_wo_pouch_pouch_open
		left join work_order_ui_pouch_seal on pouch_seal_id = s_wo_pouch_seal
		left join work_order_ui_pouch_pouch_type on pouch_pouch_type_id = s_wo_pouch_pouch_type
		
		left join work_order_ui_bag_handle on bag_handle_id = s_wo_bag_handle
		left join work_order_ui_bag_vest_handle on bag_vest_handle_id = s_wo_bag_vest_handle
		
		left join work_order_ui_slitting_pallet on slitting_pallet_id = s_wo_slit_pallet
		left join work_order_ui_slitting_5ply_packing_options on slitting_5ply_packing_options_id = s_wo_slit_packing_5ply
		left join work_order_ui_slitting_sticker on slitting_sticker_id = s_wo_slit_sticker
		left join work_order_ui_slitting_core_id_length on slitting_core_id_length_id = s_wo_slit_core_id
		left join work_order_ui_slitting_core_id_type on slitting_core_id_type_id = s_wo_slit_core_type
		left join work_order_wind_dir on wind_id = s_wo_slit_wind_dir
		where s_wo_id= ".$_GET['did']."
		".$inColsDRAFT."
		order by s_wo_id asc";
		$getWO = mysqlSelect($sql);
		
		if(!is_array($getWO)){
			die("WO Not Found");
		}
		$getWO = $getWO[0];
		$ref = 'NULL';	
}

		
		

getHead("Home");
?>

<link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
<style>
.sales{
	Black
}

.quality{
	Blue
}

.FM{
	Red
}

.PL{
	green
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
            <h1>Work Order # <?php echo ((!$d) ? $getWO['master_wo_ref'] : "Draft ") ?> - <?php echo (isset($_GET['pid']) ? "":((!$d) ? $getWO['mwoid_desc2']: $getWO['s_wo_id'])) ?></h1>
          </div>
          
            <div class="row">
                <div class="col-12 ">
                                <div class="card card-warning">
                                  <div class="card-header">
                                  <h4><button class="btn btn-primary" id="printTrigger">Print</button></h4>
                                  </div>
                                  <div id="contentHolder" class="card-body text-justify">
<table class="table table-striped table-bordered " id="EssentialsContainerTable">

    <tbody>
		<tr>
        	<td><strong class="question">Date:</strong> <font class="answer"><?php echo date('d-m-Y', $getWO[$trail.'_gen_dnt']); ?></font></td>
        	<td><strong class="question">Delivery Date:</strong> <font class="answer"><?php echo date('d-m-Y', $getWO[$trail.'_delivery_date']); ?></font></td>
        	<td><strong class="question">PO:</strong> <font class="answer"><?php echo $getWO[$trail.'_po']; ?></font></td>
        	<td><strong class="question">Sales Code:</strong> <font class="answer"><?php echo $getWO['lum_code']." - ".$getWO['lum_name']; ?></font></td>
        	<td><strong class="question">Customer:</strong> <font class="answer"><?php echo $getWO['client_code']." - ".$getWO['client_name']; ?></font></td>
        </tr>  
        
		<tr>
        	<td><strong class="question">WO:</strong> <font class="answer"><?php echo (!$d ? $getWO['master_wo_ref']:"-"); ?></font></td>
        	<td><strong class="question">LWO:</strong> <font class="answer"><?php echo $getWO[$trail.'_lwo']; ?></font></td>
        	<td colspan="2"><strong class="question">Final QTY:</strong> 
            	<font class="answer"><?php echo $getWO[$trail.'_final_qty']." ".$getWO['unit_value']." + "." ".$getWO[$trail.'_tolerance_1']." - ".$getWO[$trail.'_tolerance_2']; ?>
				</font>
			</td>
        	<td><strong class="question">Product Type:</strong> <font class="answer"><?php echo $getWO['structure_value']; ?> (<?php echo $getWO[$trail.'_ply']." ply"; ?>)</font></td>
        </tr>  

        <tr>
        	<td colspan="1"><strong class="question">Application:</strong> <font class="answer"><?php echo $getWO['application_value']; ?></font></td>
        	<td colspan="4"><strong class="question">Film Structure:</strong> <font class="answer"><?php 
	#check for the Layers in essentials
	$holderArray = array();
	for($counterL = 1; $counterL <= $getWO[$trail.'_ply']; $counterL++){
		$struc = mysqlSelect("SELECT * FROM `materials_main` where material_id = ".$getWO[$trail.'_layer_'.$counterL.'_structure']);
		$strucVal = (is_array($struc)? $struc[0]['material_value'] : 'NULL');
		$holderArray[] = $getWO[$trail.'_layer_'.$counterL.'_micron']."u ".$strucVal;		
	}
			echo implode(' + ', $holderArray);?></font></td>
        </tr>
                  	
    </tbody>

</table>
    <?php if(!$d){ ?><div class="row">
        <div class="form-group col-12">
          <label>Overall Remarks</label>
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
                and remark_master_wo_id = ".$ref);
                
                if(is_array($getOverallRem)){
                    foreach($getOverallRem as $OverallRem){
                        echo '
                        <tr>
                            <td>'.$OverallRem['lum_code'].' - '.$OverallRem['lum_name'].'</td>
                            <td>'.$OverallRem['remark_text'].'</td>
                            <td>'.date('d-m-Y @ h:i:s a',$OverallRem['remark_dnt']).'</td>
                        </tr>
                        
                        ';
                    }
                }
                    
                    ?>
                </table>
        </div>
    </div>
	
	<div class="row">
        <div class="form-group col-12">
          <label>Complaints</label>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th width="20%">Complaint ID </th>
                        <th width="70%">Text</th>
                        <th width="10%">Time</th>
                    </tr>
                    
				<?php
                $getComplaints= mysqlSelect("SELECT * FROM `complaints_main` 
                where complaint_wo_ref = ".$getWO['master_wo_ref']." 
                and complaint_status =1
                order by complaint_dnt desc
                        ");
                
                if(is_array($getComplaints)){
                    $x = 1;
                    foreach($getComplaints as $Complaints){
                        ?>
                        <tr>
                            <td><?php echo $Complaints['complaint_id']; ?></td>
                            <td><?php echo $Complaints['complaint_text']; ?></td>
                            <td><?php echo date('d-m-Y @ h:i:s a',$Complaints['complaint_dnt']) ?></td>
                        </tr>
                        <?php
                        $x++;
                    }
                }
                ?>
                </table>
        </div>
    </div>
	<?php 
}else{
    echo '<p>'.$getWO['s_wo_remarks_overall'].'</p>';
}
?>

<?php 
if($getWO[$trail.'_inhouse_pe_question'] == 1){
?>
<hr class="dotted">
    <h6>Extrusion</h6>
    <table class="table table-striped table-bordered " id="ExtrusionContainerTable">
    
        <tbody>
            <tr>
                <td colspan="4"><strong class="question">PE Recipe:</strong> <font class="answer"><?php echo $getWO[$trail.'_ex_pe_re']; ?></font></td>
                <td colspan="4"><strong class="question">Antistatic:</strong> <font class="answer"><?php echo $getWO['anti_value']; ?></font></td>
                <td colspan="4"><strong class="question">Layer Type:</strong> <font class="answer"><?php echo $getWO['layer_type_value']; ?></font></td>
            </tr>  
            
            <tr>
                <td colspan="2"><strong class="question">Pack Size/Wt:</strong> <font class="answer"><?php echo $getWO[$trail.'_ex_pack_size']; ?></font></td>
                <td colspan="2"><strong class="question">PKG Speed:</strong> <font class="answer"><?php echo $getWO[$trail.'_ex_pkg_speed']; ?></font></td>
                <td colspan="2"><strong class="question">QTY Kgs:</strong> <font class="answer"><?php echo $getWO[$trail.'_ex_qty_kgs']; ?></font></td>
                <td colspan="3"><strong class="question">MTR:</strong> <font class="answer"><?php echo $getWO[$trail.'_ex_mtr']; ?></font></td>
                <td colspan="3"><strong class="question">Options:</strong>
    <font class="answer">
    <?php 
    groupConcatGetVal("work_order_ui_bag_punch_opts","bag_punch_opts", $getWO[$trail.'_ex_options'], 'mysqlSelect');
    ?>
    </font>
                     </td>
            </tr>  
            
            <tr>
                <td colspan="2"><strong class="question">Thickness:</strong> <font class="answer"><?php echo $getWO[$trail.'_ex_thickness']; ?></font></td>
                <td colspan="2"><strong class="question">Treatment:</strong> <font class="answer"><?php echo $getWO['treat_value']; ?></font></td>
                <td colspan="2"><strong class="question">Roll OD:</strong> <font class="answer"><?php echo $getWO[$trail.'_ex_roll_od']; ?></font></td>
                <td colspan="2"><strong class="question">Extrude In:</strong> <font class="answer"><?php echo $getWO['extrude_in_value']; ?></font></td>
                <td colspan="2"><strong class="question">Film Width:</strong> <font class="answer"><?php echo $getWO[$trail.'_ex_film_width']; ?></font></td>
                <td colspan="1"><strong class="question">Film Color:</strong> <font class="answer"><?php echo $getWO[$trail.'_ex_film_color']; ?></font></td>
                <td colspan="1"><strong class="question">COF:</strong> <font class="answer"><?php echo $getWO['cof_value']; ?></font></td>
            </tr>  
                        
        </tbody>
    
    </table>
        <?php if(!$d){ ?><div class="row">
            <div class="form-group col-12">
              <label>Extrusion Remarks</label>
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
                    and remark_master_wo_id = ".$ref);
                    
                    if(is_array($getOverallRem)){
                        foreach($getOverallRem as $OverallRem){
                            echo '
                            <tr>
                                <td>'.$OverallRem['lum_code'].' - '.$OverallRem['lum_name'].'</td>
                                <td>'.$OverallRem['remark_text'].'</td>
                                <td>'.date('d-m-Y @ h:i:s a',$OverallRem['remark_dnt']).'</td>
                            </tr>
                            
                            ';
                        }
                    }
                        
                        ?>
                    </table>
    
            </div>
        </div><?php 
    }else{
        echo '<p>'.$getWO['s_wo_remarks_ext'].'</p>';
    }
    ?>
<?php
}
?>

<?php 
if($getWO[$trail.'_printed_question'] == 1){
?>
    <h6>Printing</h6>
    <table class="table table-striped table-bordered " id="PrintingContainerTable">
    
        <tbody>
            <tr>
                <td colspan="3"><strong class="question">Type:</strong> <font class="answer"><?php echo $getWO['print_type_value']; ?></font></td>
                <td colspan="3"><strong class="question">Design:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_design']; ?></font></td>
                <td colspan="3"><strong class="question">QTY KGS:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_qtykgs']; ?></font></td>
                <td colspan="3"><strong class="question">MTR:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_mtr']; ?></font></td>
            </tr>
    
            <tr>
                <td colspan="3"><strong class="question">Printing Method:</strong> <font class="answer"><?php echo $getWO['surfrev_value']; ?></font></td>
                <td colspan="3"><strong class="question">Roll Type:</strong> <font class="answer"><?php echo $getWO['tubesheet_value']; ?></font></td>
                <td colspan="3"><strong class="question">Substrate:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_substrate']; ?></font></td>
                <td colspan="3"><strong class="question">Printing UPS:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_ups']; ?></font></td>
            </tr>
    
            <tr>
                <td colspan="3"><strong class="question">Print Repeat:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_repeat']; ?></font></td>
                <td colspan="3"><strong class="question">Shade Card Required?:</strong> <font class="answer"><?php echo $getWO['shadecardreq_value']; ?></font></td>
                <td colspan="3"><strong class="question">Col Ref Type:</strong> <font class="answer"><?php echo $getWO['shadecard_ref_type_value']; ?></font></td>
                <td colspan="3"><strong class="question">Print Repeat(mm):</strong> <font class="answer"><?php echo $getWO[$trail.'_print_col_print_repeat']; ?></font></td>
            </tr>
    
            <tr>
                <td colspan="3"><strong class="question">Eyemark Color:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_eyemark_col']; ?></font></td>
                <td colspan="3"><strong class="question">Size MM:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_size']; ?></font></td>
                <td colspan="3"><strong class="question">Eyemark Side (DA):</strong> 
                <font class="answer">
                <?php 
                    groupConcatGetVal("work_order_ui_print_eyemark_da","eyemark_da", $getWO[$trail.'_print_eyemark_side'], 'mysqlSelect');
                     ?>
                    </font></td>
    
                <td colspan="3"><strong class="question">Print Approval BY:</strong> <font class="answer">
                <?php 
                groupConcatGetVal("work_order_ui_print_options","print_options", $getWO[$trail.'_print_approval_by'], 'mysqlSelect');
                 ?></font></td>
            </tr>
      
            <tr>
                <td colspan="3"><strong class="question">Plate CYL:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_plate_cyl']; ?></font></td>
                <td colspan="2"><strong class="question">Ink SYS:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_ink_sys']; ?></font></td>
                <td colspan="2"><strong class="question">B'CODE#:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_b_code']; ?></font></td>
                <td colspan="3"><strong class="question">Color:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_color']; ?></font></td>
                <td colspan="2"><strong class="question">GSM:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_ink_gsm']; ?></font></td>
            </tr>
      
            <tr>
                <td colspan="3"><strong class="question">Pantone 1:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_pantone_1']; ?></font></td>
                <td colspan="3"><strong class="question">Pantone 2:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_pantone_2']; ?></font></td>
                <td colspan="3"><strong class="question">Pantone 3:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_pantone_3']; ?></font></td>
                <td colspan="3"><strong class="question">Pantone 4:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_pantone_4']; ?></font></td>
            </tr>
      
            <tr>
                <td colspan="3"><strong class="question">Pantone 5:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_pantone_5']; ?></font></td>
                <td colspan="3"><strong class="question">Pantone 6:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_pantone_6']; ?></font></td>
                <td colspan="3"><strong class="question">Pantone 7:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_pantone_7']; ?></font></td>
                <td colspan="3"><strong class="question">Pantone 8:</strong> <font class="answer"><?php echo $getWO[$trail.'_print_pantone_8']; ?></font></td>
            </tr>
            
            <tr>
                <td colspan="12"><strong class="question">Options:</strong>
    <font class="answer">
    <?php 
    groupConcatGetVal("work_order_ui_print_end_options","print_end_options", $getWO[$trail.'_print_end_options'], 'mysqlSelect');
    ?>
    </font></td>
                
            </tr>
        </tbody>
    
    </table>
    
    <?php if(!$d){ ?><div class="row">
        <div class="form-group col-12">
          <label>Printing Remarks</label>
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
                and remark_master_wo_id = ".$ref);
                
                if(is_array($getOverallRem)){
                    foreach($getOverallRem as $OverallRem){
                        echo '
                        <tr>
                            <td>'.$OverallRem['lum_code'].' - '.$OverallRem['lum_name'].'</td>
                            <td>'.$OverallRem['remark_text'].'</td>
                            <td>'.date('d-m-Y @ h:i:s a',$OverallRem['remark_dnt']).'</td>
                        </tr>
                        
                        ';
                    }
                }
                    
                    ?>
                </table>
        </div>
    </div><?php 
    }else{
        echo '<p>'.$getWO['s_wo_remarks_print'].'</p>';
    }
    ?>
<?php
}
?>

<?php 
if($getWO[$trail.'_ply'] > 1){
?>

    <h6>Lamination</h6>
    <table class="table table-striped table-bordered " id="LaminationContainerTable">
    
        <tbody>
        
        <tr>
            <td colspan="4"><strong class="question">Lam Sleeve(mm):</strong> <font class="answer"><?php echo $getWO[$trail.'_lam_lam_sleeve']; ?></font></td>
            <td colspan="8"><strong class="question">Options:</strong>
    <font class="answer">
    <?php 
    groupConcatGetVal("work_order_ui_lam_end_options","lam_end_options", $getWO[$trail.'_lam_options'], 'mysqlSelect');
    ?>
    </font></td>
    
        </tr>  
            
        <?php
        for($counterL = 1; $counterL <= $getWO[$trail.'_ply']; $counterL++){
            ?>
            <tr>
                <td colspan="3"><strong class="question">Film <?php echo $counterL ?> Structure:</strong> <font class="answer"><?php echo $holderArray[$counterL-1]; ?></font></td>
                <td colspan="3"><strong class="question">Film <?php echo $counterL ?> Width:</strong> <font class="answer"><?php echo $getWO[$trail.'_lam_f'.$counterL.'_width']; ?></font></td>
                <td colspan="3"><strong class="question">Film <?php echo $counterL ?> KGS:</strong> <font class="answer"><?php echo $getWO[$trail.'_lam_f'.$counterL.'_kgs']; ?></font></td>
                <td colspan="3"><strong class="question">Film <?php echo $counterL ?> MTR:</strong> <font class="answer"><?php echo $getWO[$trail.'_lam_f'.$counterL.'_mtr']; ?></font></td>
            <tr>
            <?php
            if(($counterL+1) <= $getWO[$trail.'_ply']){
                ?>
            <tr>
                <td colspan="6"><strong class="question">Pass <?php echo $counterL ?> Desc1:</strong> <font class="answer"><?php echo $getWO[$trail.'_lam_p'.$counterL.'_desc_1']; ?></font></td>
                <td colspan="6"><strong class="question">Pass <?php echo $counterL ?>  Desc2:</strong> <font class="answer"><?php echo $getWO[$trail.'_lam_p'.$counterL.'_desc_2']; ?></font></td>
            </tr>
                <?php
            }
        
        }
    
        ?>
            
        </tbody>
    
    </table>
    <?php if(!$d){ ?><div class="row">
        <div class="form-group col-12">
          <label>Lamination Remarks</label>
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
                and remark_master_wo_id = ".$ref);
                
                if(is_array($getOverallRem)){
                    foreach($getOverallRem as $OverallRem){
                        echo '
                        <tr>
                            <td>'.$OverallRem['lum_code'].' - '.$OverallRem['lum_name'].'</td>
                            <td>'.$OverallRem['remark_text'].'</td>
                            <td>'.date('d-m-Y @ h:i:s a',$OverallRem['remark_dnt']).'</td>
                        </tr>
                        
                        ';
                    }
                }
                    
                    ?>
                </table>
        </div>
    </div><?php 
    }else{
        echo '<p>'.$getWO['s_wo_remarks_lam'].'</p>';
    }
    ?>
<?php
}
?>

<?php 
if($getWO[$trail.'_structure'] == 2){
?>
    <h6>Pouch</h6>
    <table class="table table-striped table-bordered " id="PouchContainerTable">
    
        <tbody>
            <tr>
                <td><strong class="question">QTy KGS:</strong> <font class="answer"><?php echo $getWO[$trail.'_pouch_qty_kg']; ?></font></td>
                <td><strong class="question">NOS:</strong> <font class="answer"><?php echo $getWO[$trail.'_pouch_nos']; ?></font></td>
                <td><strong class="question">Width (mm):</strong> <font class="answer"><?php echo $getWO[$trail.'_pouch_width']; ?></font></td>
                <td><strong class="question">Length (mm):</strong> <font class="answer"><?php echo $getWO[$trail.'_pouch_length']; ?></font></td>
            </tr>
            
            <tr>
                <td><strong class="question">Gusset Side (mm):</strong> <font class="answer"><?php echo $getWO[$trail.'_pouch_guset_side']; ?></font></td>
                <td><strong class="question">Gusset Bottom (mm):</strong> <font class="answer"><?php echo $getWO[$trail.'_pouch_bot']; ?></font></td>
                <td><strong class="question">Sealing:</strong> <font class="answer"><?php echo $getWO['pouch_sealing_value']; ?></font></td>
                <td><strong class="question">Sealing Width:</strong> <font class="answer"><?php echo $getWO[$trail.'_pouch_width_2']; ?></font></td>
            </tr>
            
            <tr>
                <td><strong class="question">Seal Type:</strong> <font class="answer"><?php echo $getWO['pouch_seal_type_value']; ?></font></td>
                <td><strong class="question">Euro Punch:</strong> <font class="answer"><?php echo $getWO['pouch_euro_punch_value']; ?></font></td>
                <td><strong class="question">Type:</strong> 
                
    <font class="answer">
    <?php 
    groupConcatGetVal("work_order_ui_pouch_type","pouch_type", $getWO[$trail.'_pouch_type'], 'mysqlSelect');
    ?>
    </font></td>
                <td><strong class="question">Pouch Open:</strong> <font class="answer"><?php echo $getWO['pouch_open_value']; ?></font></td>
            </tr>
            
            <tr>
                <td><strong class="question">Seal:</strong> <font class="answer"><?php echo $getWO['pouch_seal_value']; ?></font></td>
                <td><strong class="question">Closure Type:</strong>
                
    <font class="answer">
    <?php 
    groupConcatGetVal("work_order_ui_pouch_closure_type","pouch_closure_type", $getWO[$trail.'_pouch_closure_type'], 'mysqlSelect');
    ?>
    </font></td>
                <td><strong class="question">Dist From Top:</strong> <font class="answer"><?php echo $getWO[$trail.'_pouch_dist']; ?></font></td>
                <td><strong class="question">Pouch Type:</strong> <font class="answer"><?php echo $getWO['pouch_pouch_type_value']; ?></font></td>
            </tr>
        </tbody>
    </table>
    <?php if(!$d){ ?><div class="row">
        <div class="form-group col-12">
          <label>Pouch Remarks</label>
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
            and remark_type = 5
            and remark_master_wo_id = ".$ref);
            
            if(is_array($getOverallRem)){
                foreach($getOverallRem as $OverallRem){
                    echo '
                    <tr>
                        <td>'.$OverallRem['lum_code'].' - '.$OverallRem['lum_name'].'</td>
                        <td>'.$OverallRem['remark_text'].'</td>
                        <td>'.date('d-m-Y @ h:i:s a',$OverallRem['remark_dnt']).'</td>
                    </tr>
                    
                    ';
                }
            }
                
                ?>
            </table>
        </div>
    </div><?php 
    }else{
        echo '<p>'.$getWO['s_wo_remarks_pouch'].'</p>';
    }
    ?>
<?php
}
?>

<?php 
if($getWO[$trail.'_structure'] == 1){
?>
    <h6>Bags</h6>
    <table class="table table-striped table-bordered " id="BagsContainerTable">
    
        <tbody>
            <tr>
                <td><strong class="question">Quantity KGS:</strong> <font class="answer"><?php echo $getWO[$trail.'_bag_qty_kg']; ?></font></td>
                <td><strong class="question">NOs:</strong> <font class="answer"><?php echo $getWO[$trail.'_bag_nos']; ?></font></td>
                <td><strong class="question">Bag Width:</strong> <font class="answer"><?php echo $getWO[$trail.'_bag_width']; ?></font></td>
                <td><strong class="question">Bag Length:</strong> <font class="answer"><?php echo $getWO[$trail.'_bag_length']; ?></font></td>
            </tr>
            
            <tr>
                <td><strong class="question">Handle Width:</strong> <font class="answer"><?php echo $getWO[$trail.'_bag_width_2']; ?></font></td>
                <td><strong class="question">Handle Length:</strong> <font class="answer"><?php echo $getWO[$trail.'_bag_length_2']; ?></font></td>
                <td><strong class="question">Thickness(u):</strong> <font class="answer"><?php echo $getWO[$trail.'_bag_thick']; ?></font></td>
            </tr>
            
            <tr>
                <td><strong class="question">Gusset Side:</strong> <font class="answer"><?php echo $getWO[$trail.'_bag_guset_side']; ?></font></td>
                <td><strong class="question">Gusset Botton:</strong> <font class="answer"><?php echo $getWO[$trail.'_bag_guset_bottom']; ?></font></td>
                <td><strong class="question">Gusset Top Fold:</strong> <font class="answer"><?php echo $getWO[$trail.'_bag_guset_top_fold']; ?></font></td>
                <td><strong class="question">Gusset Flap:</strong> <font class="answer"><?php echo $getWO[$trail.'_bag_guset_flap']; ?></font></td>
                <td><strong class="question">Gusset Lip:</strong> <font class="answer"><?php echo $getWO[$trail.'_bag_guset_lip']; ?></font></td>
            </tr>
            
            <tr>
                <td><strong class="question">Handle:</strong> <font class="answer"><?php echo $getWO['bag_handle_value']; ?></font></td>
                <td><strong class="question">Vest Handle:</strong> <font class="answer"><?php echo $getWO['bag_vest_handle_value']; ?></font></td>
                <td><strong class="question">Sealing:</strong> 
                
    <font class="answer">
    <?php 
    groupConcatGetVal("work_order_ui_bag_sealing_opts","bag_sealing_opts", $getWO[$trail.'_bag_sealing'], 'mysqlSelect');
    ?>
    </font>
    </td>
                <td><strong class="question">SPL Hole Value:</strong> <font class="answer"><?php echo $getWO[$trail.'_bag_spl_dia']; ?></font></td>
                <td><strong class="question">Punch:</strong> 
    <font class="answer">
    <?php 
    groupConcatGetVal("work_order_ui_bag_punch_opts","bag_punch_opts", $getWO[$trail.'_bag_punch'], 'mysqlSelect');
    ?>
    </font>
    </td>
            </tr>
        </tbody>
    </table>
    <?php if(!$d){ ?><div class="row">
    <div class="form-group col-12">
      <label>Bags Remarks</label>
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
        and remark_type = 6
        and remark_master_wo_id = ".$ref);
        
        if(is_array($getOverallRem)){
            foreach($getOverallRem as $OverallRem){
                echo '
                <tr>
                    <td>'.$OverallRem['lum_code'].' - '.$OverallRem['lum_name'].'</td>
                    <td>'.$OverallRem['remark_text'].'</td>
                    <td>'.date('d-m-Y @ h:i:s a',$OverallRem['remark_dnt']).'</td>
                </tr>
                
                ';
            }
        }
            
            ?>
        </table>
    </div>
    </div><?php 
    }else{
        echo '<p>'.$getWO['s_wo_remarks_bag'].'</p>';
    }
    ?>
<?php
}
?>
 
<h6>Slitting</h6>
<table class="table table-striped table-bordered " id="SlittingContainerTable">

    <tbody>
		<tr>
            <td><strong class="question">Slit Width:</strong> <font class="answer"><?php echo $getWO[$trail.'_slit_s_width']; ?></font></td>
            <td><strong class="question">Winding Direction:</strong> <font class="answer"><?php echo $getWO['wind_value']; ?></font></td>
            <td><strong class="question">Roll OD:</strong> <font class="answer"><?php echo $getWO[$trail.'_slit_roll_od']; ?></font></td>
            <td><strong class="question">WT:</strong> <font class="answer"><?php echo $getWO[$trail.'_slit_wt']; ?></font></td>
        </tr>  
        
		<tr>
            <td><strong class="question">MTR:</strong> <font class="answer"><?php echo $getWO[$trail.'_slit_mtr']; ?></font></td>
            <td><strong class="question">Customer:</strong>
<font class="answer">
<?php 
groupConcatGetVal("work_order_ui_slitting_customer","slitting_customer", $getWO[$trail.'_slit_customer'], 'mysqlSelect');
?>
</font>
			</td>
            <td><strong class="question">Pallet:</strong> <font class="answer"><?php echo $getWO['slitting_pallet_value']; ?></font></td>
            <td><strong class="question">Packing:</strong>
<font class="answer">
<?php 
groupConcatGetVal("work_order_ui_slitting_packing_opts","slitting_packing_opts", $getWO[$trail.'_slit_packing'], 'mysqlSelect');
?>
</font>
			</td>
        </tr>  
        
		<tr>
            <td><strong class="question">5PLY TYPE:</strong> <font class="answer"><?php echo $getWO['slitting_5ply_packing_options_value']; ?></font></td>
            <td><strong class="question">Sticker:</strong> <font class="answer"><?php echo $getWO['slitting_sticker_value']; ?></font></td>
            <td><strong class="question">Sticker Type:</strong> <font class="answer">
<font class="answer">
<?php 
groupConcatGetVal("work_order_ui_slitting_sticker_opts","slitting_sticker_opts", $getWO[$trail.'_slit_sticker_type'], 'mysqlSelect');
?>
</font>
			</font></td>
            <td><strong class="question">Core ID:</strong> <font class="answer"><?php echo $getWO['slitting_core_id_length_value']; ?></font></td>
        </tr>  
        
		<tr>
            <td><strong class="question">Core ID Type:</strong> <font class="answer"><?php echo $getWO['slitting_core_id_type_value']; ?></font></td>
            <td><strong class="question">QC Instructions:</strong> <font class="answer">
<font class="answer">
<?php 
groupConcatGetVal("work_order_ui_slitting_qc_ins","slitting_qc_ins", $getWO[$trail.'_slit_qc_ins'], 'mysqlSelect');
?>
</font>
			</font></td>
            <td colspan="2"><strong class="question">Max Joint Rolls:</strong> <font class="answer"><?php echo $getWO[$trail.'_slit_qc_max_jointrolls']; ?></font></td>
        </tr>  
                  	
    </tbody>

</table>
<?php if(!$d){ ?><div class="row">
    <div class="form-group col-12">
      <label>Slitting Remarks</label>
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
        and remark_type = 7
        and remark_master_wo_id = ".$ref);
        
        if(is_array($getOverallRem)){
            foreach($getOverallRem as $OverallRem){
                echo '
                <tr>
                    <td>'.$OverallRem['lum_code'].' - '.$OverallRem['lum_name'].'</td>
                    <td>'.$OverallRem['remark_text'].'</td>
                    <td>'.date('d-m-Y @ h:i:s a',$OverallRem['remark_dnt']).'</td>
                </tr>
                
                ';
            }
        }
            
            ?>
        </table>
    </div>
</div><?php 
}else{
    echo '<p>'.$getWO['s_wo_remarks_slit'].'</p>';
}
?>


                                  </div>
                                </div>
                              </div>
            </div>


        </section>
        <div id="csscontainer" style="display:none" >
        </div>
        
        
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
<script>
$(document).ready(function(e) {
    $('#printTrigger').click(function(e) {
		PrintElem("contentHolder");
    });
});

function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=800,width=800');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
	mywindow.document.write('<style>');
	mywindow.document.write('table{border:1px solid #000;} tr{border:1px solid #000;} html {scale : 1}');
	mywindow.document.write('</style>');
	mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>Work Order #<?php echo (!$d ? $getWO['master_wo_ref']." : ".$getWO['mwoid_desc2']:"Draft ".$getWO['s_wo_id']) ?></h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}
</script>


</body>
</html>
