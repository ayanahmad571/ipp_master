<?php 
require_once("server_fundamentals/SessionHandler.php");
require_once("server_fundamentals/PostDataHeadChecker.php");

getHead("WO Edit");

	if(!isset($_GET['id'])){
			die("Work Order ID Not Found");
	}
	
	if(!is_numeric($_GET['id'])){
			die("Invalid Work Order ID Format, Must be numeric");
	}

	
	$getWo = mysqlSelect($UpdatedStatusQuery."
       
        
		left join clients_main on master_wo_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id
		
        where master_wo_status in (8) and master_wo_ref= ".$_GET['id']." 
		".$inColsWO."
		order by master_wo_id desc
		");
		
	if(!is_array($getWo)){
		die("Work Order Not Found");
	}
	
	$WorkOrderMain =  $getWo[0];
		



?>
<link href="assets/css/select2.min.css" rel="stylesheet" />
<style>
.highLightNew{
    border: 3px #03D52E solid;
	border-radius: 10px;
}
.highLightOld{
    border: 3px red solid;
	border-radius: 10px;
}
.highLightOverlap{
    border: 3px #6C11ED solid;
	border-radius: 10px;
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
            <h1>Work Order Edit - Planning</h1>
          </div>
          <!-- TOP CONTENT BLOCKS -->
          
            <div class="row">
                <div class="col-12 ">
                                <div class="card card-warning">
                                  <div class="card-header">
                                    <h4>Editing Work Order #<?php echo $_GET['id'] ?></h4>
                                  </div>
                                  <div class="card-body text-justify">
    <div id="formFail" class="alert alert-danger" style="display:none">
    </div>
    <div id="formLoading" class="alert alert-warning">
    	Form Is Loading
    </div>
    <div id="formSuccess" class="alert alert-success" style="display:none">
    	Changes have Been saved to the Work Order
    </div>

                                  <form id="formContainer" action="server_fundamentals/PlanningController" method="post">
                                  
                                  <input type="hidden" name="work_order_edit_id" value="<?php echo $_GET['id'] ?>"/>
                                  <input type="hidden" name="work_order_status_value" value="<?php echo $WorkOrderMain['master_wo_status'] ?>"/>
                                  
<div style="display:none" id="workOrderHeaderDetails">

    <div class="row">
        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
          <label>Design ID</label>
          <input type="text" class="form-control" name="work_order_design_id" placeholder="Design ID">
        </div>
    
        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
          <label>P.O#</label>
          <input type="text" class="form-control" name="work_order_add_po" placeholder="Purchase Order Reference">
        </div>
        
        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
          <label>Sales Code</label>
          <select class="form-control select_sales" required name="work_order_5_sales_id">
                <?php
		$getDrafts = mysqlSelect($getAttachedTreeSql);
		
		if(is_array($getDrafts)){
			foreach($getDrafts as $Draft){
				 echo '<option value="'.$Draft['lum_id'].'">'.$Draft['lum_code'].' - '.$Draft['lum_name'].'</option>';
			}
		}
                ?>
          </select>
        </div>
    
        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
          <label>Customer Code</label>
          <select class="form-control select_client" required name="work_order_5_client_id">
                <?php
                 $getClients = mysqlSelect("SELECT * FROM `clients_main` order by client_name asc ");
                 if(is_array($getClients)){
                     foreach($getClients as $Client){
                         echo '<option value="'.$Client['client_id'].'">'.$Client['client_code'].' - '.$Client['client_name'].'</option>';
                     }
                 }else{
                     echo '<option value="-m-x">None</option>';
                 }
                ?>
          </select>
        </div>
    
    </div>
    
    <div class="row">

        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
          <label>Delivery Date</label>
          <input type="text" class="form-control" name="work_order_delivery_date" placeholder="DD-MM-YYYY">
        </div>

        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
          <label>Customer Item Code</label>
          <input type="text" class="form-control" name="work_order_customer_item_code" placeholder="Customer Item Code">
        </div>
    
        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
          <label>L.W.O#</label>
          <input type="text" class="form-control" name="work_order_lwo" placeholder="Last Work Order" readonly>
        </div>
    
        <div class="form-group col-sm-12 col-sm-6 col-lg-3">
            <label class="form-label">Product Type</label>
          <div class="selectgroup w-100">
                <?php
                 $getStructures= mysqlSelect("SELECT * FROM `work_order_ui_structure` ");
                 if(is_array($getStructures)){
                     foreach($getStructures as $Structure){
                         echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_structure" value="'.$Structure['structure_id'].'" class="selectgroup-input" '.($Structure['structure_id'] == 2 ? 'checked':'').'>
              <span class="selectgroup-button">'.$Structure['structure_value'].'</span>
            </label>
    ';				 }
                 }
                ?>
          </div>
        </div>

    </div>

    <div class="row">
        <div class="form-group col-sm-12 col-lg-6">
          <label>Customer Location</label>
          
          <div class="selectgroup selectgroup-pills">
                <?php
                 $getSlitCustomrs= mysqlSelect("SELECT * FROM `work_order_ui_customer_location` where customer_location_show = 1 ");
                 if(is_array($getSlitCustomrs)){
                     foreach($getSlitCustomrs as $SingularOP){
                         echo '
            <label class="selectgroup-item">
              <input type="checkbox" name="work_order_4_customer_loc[]" value="'.$SingularOP['customer_location_id'].'" class="selectgroup-input" '.($SingularOP['customer_location_id'] == 1 ? 'checked':'').'>
              <span class="selectgroup-button">'.$SingularOP['customer_location_value'].'</span>
            </label>
    ';				 }
                 }
                ?>
          
          </div>
        </div>
    </div>
    
    <div class="row">
        <div class="form-group col-8 col-xl-4 ">
          <label>Final Qty</label>
          <input placeholder="Quantity" name="work_order_quantity" type="number" step="0.01" class="form-control" min="0.10">
        </div>
    
        <div class="form-group col-4 col-xl-2 ">
          <label>Qty Unit</label>
          <select class="form-control select_qty_unit" required name="work_order_5_units">
                <?php
                 $getUnits = mysqlSelect("SELECT * FROM `work_order_qty_units` ");
                 if(is_array($getUnits)){
                     foreach($getUnits as $Unit){
                         echo '<option value="'.$Unit['unit_id'].'">'.$Unit['unit_value'].'</option>';
                     }
                 }
                ?>
          </select>
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
    
    <div class="row">
        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Number of Layers</label>
          <input id="plyValueInput" type="number" min="1" max="5" class="form-control" name="work_order_ply" value="2" placeholder="Ply">
        </div>
    
        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Application</label>
          <select class="form-control select_application" required name="work_order_5_application">
                <?php
                 $getApps= mysqlSelect("SELECT * FROM `work_order_applications` order by application_value asc");
                 if(is_array($getApps)){
                     foreach($getApps as $App){
                         echo '<option value="'.$App['application_id'].'">'.$App['application_value'].'</option>';
                     }
                 }
                ?>
          </select>
        </div>
    
    </div>
    
    <div id="containerLaminateLayers">
    </div>

    <div class="row">

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>CCR #</label>
          <input type="text" class="form-control" name="work_order_ncr_no" placeholder="CCR Number">
        </div>
        <div class="form-group col-sm-12 col-lg-6 ">
          <label>NCR #</label>
          <input type="text" class="form-control" name="work_order_ccr_no" placeholder="NCR Number">
        </div>
    
    
    </div>

    <div class="row">
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
                and remark_master_wo_id = ".$_GET['id']);
                
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
          <textarea name="work_order_remarks_overall" class="form-control" placeholder="Remarks" style="height:150px"></textarea>
        </div>
    </div>

	<HR>
    
</div>

<div  style="display:none" id="workOrderEssentialOptions">
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
          <input type="text" class="form-control"  name="work_order_extrusion_pe_recipe" placeholder="PE Recipe">
        </div>
    
        <div class="form-group col-sm-12 col-sm-6 col-lg-4">
            <label class="form-label">Antistatic</label>
          <div class="selectgroup w-100">
                <?php
                 $getAntis= mysqlSelect("SELECT * FROM `work_order_ui_ext_antistatic` where anti_show = 1 ");
                 if(is_array($getAntis)){
                     foreach($getAntis as $Anti){
                         echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_extrusion_antistatic" value="'.$Anti['anti_id'].'" class="selectgroup-input" '.($Anti['anti_id'] == 1 ? 'checked':'').'>
              <span class="selectgroup-button">'.$Anti['anti_value'].'</span>
            </label>
    ';				 }
                 }
                ?>
          
          </div>
        </div>
    
        <div class="form-group col-sm-12 col-sm-6 col-lg-4">
            <label class="form-label">Layer</label>
          <div class="selectgroup w-100">
                <?php
                 $getLayersTypes= mysqlSelect("SELECT * FROM `work_order_ui_ext_layer_type` where layer_type_show = 1 ");
                 if(is_array($getLayersTypes)){
                     foreach($getLayersTypes as $LayerType){
                         echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_extrusion_layer" value="'.$LayerType['layer_type_id'].'" class="selectgroup-input" '.($LayerType['layer_type_id'] == 1 ? 'checked':'').'>
              <span class="selectgroup-button">'.$LayerType['layer_type_value'].'</span>
            </label>
    ';				 }
                 }
                ?>
          
          </div>
        </div>
        
        
    </div>
    
    <div class="row">
        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
          <label>Pack Weight </label>
          <input type="number" min="1" max="999999999" step="0.01" class="form-control"  name="work_order_extrusion_pack_weight" placeholder="Weigth">
        </div>
    
        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
          <label>Pack Size</label>
          <input type="number" min="1" max="999999999" step="0.01" class="form-control"  name="work_order_extrusion_pack_size" placeholder="Size">
        </div>
    
        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
          <label>Pack QTY Unit</label>
          <select class="form-control select_pack_qty_unit" name="work_order_5_extrusion_pack_units">
                <?php
                 $getUnits = mysqlSelect("SELECT * FROM `work_order_qty_units` ");
                 if(is_array($getUnits)){
                     foreach($getUnits as $Unit){
                         echo '<option value="'.$Unit['unit_id'].'">'.$Unit['unit_value'].'</option>';
                     }
                 }
                ?>
          </select>
        </div>
    </div>
    
    <div class="row">
        <div class="form-group col-12">
        <label  class="form-label">Options</label>
          <div class="selectgroup selectgroup-pills">
                <?php
                 $getExtOp1= mysqlSelect("SELECT * FROM `work_order_ui_ext_options` where ext_options_show = 1 ");
                 if(is_array($getExtOp1)){
                     foreach($getExtOp1 as $ExtOp1){
                         echo '
			<label class="selectgroup-item">
              <input type="checkbox" name="work_order_4_extrusion_options[]" value="'.$ExtOp1['ext_options_id'].'" class="selectgroup-input" '.($ExtOp1['ext_options_id'] == 1 ? 'checked':'').'>
              <span class="selectgroup-button">'.$ExtOp1['ext_options_value'].'</span>
            </label>
    ';				 }
                 }
                ?>
          
          </div>

        </div>
    </div>
    
    <div class="row">
        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
          <label>Thickness (U).</label>
          <input type="number" min="1" max="999999999" step="0.01" class="form-control"  name="work_order_extrusion_thickness" placeholder="Thickness">
        </div>
    
        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
          <label>Treatment</label>
          <div class="selectgroup w-100">
                <?php
                 $getTreatments= mysqlSelect("SELECT * FROM `work_order_ui_ext_treatment` where treat_show = 1 ");
                 if(is_array($getTreatments)){
                     foreach($getTreatments as $Treatment){
                         echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_extrusion_treatment" value="'.$Treatment['treat_id'].'" class="selectgroup-input" '.($Treatment['treat_id'] == 1 ? 'checked':'').'>
              <span class="selectgroup-button">'.$Treatment['treat_value'].'</span>
            </label>
    ';				 }
                 }
                ?>
          
          </div>

        </div>
    
        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
          <label>Customer Roll OD(mm)</label>
          <input type="number" min="1" max="999999999" step="0.01" class="form-control"  name="work_order_extrusion_roll_od" placeholder="Customer Roll OD">
        </div>
    </div>
    

    <div class="row">
        <div class="form-group col-sm-12 col-lg-6">
          <label>Extrude In</label>
          <div class="selectgroup w-100">
                <?php
                 $getExtrudes= mysqlSelect("SELECT * FROM `work_order_ui_ext_extrude_in` where extrude_in_show = 1 ");
                 if(is_array($getExtrudes)){
                     foreach($getExtrudes as $Extrudes){
                         echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_extrusion_extrude_in" value="'.$Extrudes['extrude_in_id'].'" class="selectgroup-input" '.($Extrudes['extrude_in_id'] == 1 ? 'checked':'').'>
              <span class="selectgroup-button">'.$Extrudes['extrude_in_value'].'</span>
            </label>
    ';				 }
                 }
                ?>
          
          </div>

        </div>
    
    
        <div class="form-group col-sm-12 col-lg-6">
          <label>Film Color</label>
          <input type="text" class="form-control"  name="work_order_extrusion_film_color" placeholder="Film Color">
        </div>
    
    </div>

    <div class="row">
    
        <div class="form-group col-sm-12 col-lg-4 ">
          <label>C.O.F </label>
          <div class="selectgroup w-100">
                <?php
                 $getCOFs= mysqlSelect("SELECT * FROM `work_order_ui_ext_cof` where cof_show = 1 ");
                 if(is_array($getCOFs)){
                     foreach($getCOFs as $COF){
                         echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_extrusion_cof" value="'.$COF['cof_id'].'" class="selectgroup-input" '.($COF['cof_id'] == 1 ? 'checked':'').'>
              <span class="selectgroup-button">'.$COF['cof_value'].'</span>
            </label>
    ';				 }
                 }
                ?>
          
          </div>
        </div>

        <div class="form-group col-sm-12 col-lg-2 ">
          <label>COF (Inner to Inner) Val</label>
          <input type="text" class="form-control"  name="work_order_cof_extr_i2i_value" placeholder="COF (Inner to Inner) Val">
        </div>

        <div class="form-group col-sm-12 col-lg-2 ">
          <label>COF (Inner to Inner) Val</label>
          <input type="text" class="form-control"  name="work_order_cof_extr_o2o_value" placeholder="COF (Inner to Inner) Val">
        </div>

        <div class="form-group col-sm-12 col-lg-2 ">
          <label>COF (Outer to Metal) Val</label>
          <input type="text" class="form-control"  name="work_order_cof_extr_o2m_value" placeholder="COF (Outer to Metal) Val">
        </div>

        <div class="form-group col-sm-12 col-lg-2 ">
          <label>COF (Inner to Metal) Val</label>
          <input type="text" class="form-control"  name="work_order_cof_extr_i2m_value" placeholder="COF (Inner to Metal) Val">
        </div>
        
    </div>

    <div class="row">
    
        <div class="form-group col-sm-12 col-lg-6 ">
          <label>PE Film Features </label>
          <div class="selectgroup w-100">
                <?php
                 $getDB= mysqlSelect("SELECT * FROM `work_order_ui_pe_film_feature` where pe_film_feature_show = 1 ");
                 if(is_array($getDB)){
                     foreach($getDB as $VAls){
                         echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_extrusion_pe_film_feature" value="'.$VAls['pe_film_feature_id'].'" class="selectgroup-input" '.($VAls['pe_film_feature_id'] == 1 ? 'checked':'').'>
              <span class="selectgroup-button">'.$VAls['pe_film_feature_value'].'</span>
            </label>
    ';				 }
                 }
                ?>
          
          </div>
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>DYNE VALUE</label>
          <input type="text" class="form-control"  name="work_order_extrusion_dyne_value" placeholder="DYNE Value">
        </div>
        
        
    </div>
    
    <div class="row">
        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
          <label>Single Coil Width</label>
          <input type="text" class="form-control"  name="work_order_extrusion_single_coil_width" placeholder="Single Coil Width">
        </div>
        
        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
          <label>No. of UPS</label>
          <input type="text" class="form-control"  name="work_order_extrusion_no_of_ups" placeholder="No. of UPS">
        </div>

        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
          <label>Jumbo Film Width</label>
          <input type="text" class="form-control"  name="work_order_extrusion_jumbo_coil" placeholder="Jumbo Film Width">
        </div>
        
        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
          <label>Recycle Percentage</label>
          <input type="text" class="form-control"  name="work_order_extrusion_recycle_percentage" placeholder="Recycle Percentage">
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
                    $getOverallRem = mysqlSelect("SELECT r.*,m.lum_code,m.lum_name FROM `remarks_wo` r
                left join user_main m on remark_lum_id = m.lum_id
                where remark_status = 1
                and remark_type = 2
                and remark_master_wo_id = ".$_GET['id']);
                
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

          <textarea name="work_order_remarks_extrusion" class="form-control" placeholder="Remarks" style="height:150px"></textarea>
        </div>
    </div>
    <HR>
</div>

<div id="workOrderPrintingProcess">
	<div class="section-title">Printing Process (Only for jobs without unprinted in job names)</div>
  
    <div class="row">
        <div class="form-group col-sm-12 col-lg-4 ">
          <label>Design Name</label>
          <input type="text" class="form-control"  name="work_order_printing_design" placeholder="Design Name">
        </div>
        
        <div class="form-group col-sm-12 col-lg-4 ">
          <label>Cylinder Supplier</label>
          
          <div class="selectgroup w-100">
                <?php
                 $get_cylinder_supplier= mysqlSelect("SELECT * FROM `work_order_ui_print_cylinder_supplier` where cylinder_supplier_show = 1 ");
                 if(is_array($get_cylinder_supplier)){
                     foreach($get_cylinder_supplier as $cylinder_supplier){
                         echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_printing_cylinder_supplier" value="'.$cylinder_supplier['cylinder_supplier_id'].'" class="selectgroup-input" '.($cylinder_supplier['cylinder_supplier_id'] == 1 ? 'checked':'').'>
              <span class="selectgroup-button">'.$cylinder_supplier['cylinder_supplier_value'].'</span>
            </label>
    ';				 }
                 }
                ?>
          
          </div>
        </div>

		<div class="form-group col-sm-12 col-lg-6 col-xl-4">
          <label>Printing Method</label>
          <div class="selectgroup w-100">
                <?php
                 $getSurfRev= mysqlSelect("SELECT * FROM `work_order_ui_print_surfrev` where surfrev_show = 1 ");
                 if(is_array($getSurfRev)){
                     foreach($getSurfRev as $SurfRev){
                         echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_printing_surface_reverse" value="'.$SurfRev['surfrev_id'].'" class="selectgroup-input" '.($SurfRev['surfrev_id'] == 1 ? 'checked':'').'>
              <span class="selectgroup-button">'.$SurfRev['surfrev_value'].'</span>  
            </label>
    ';				 }
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
                 if(is_array($getUnits)){
                     foreach($getUnits as $Unit){
                         echo '<option value="'.$Unit['unit_id'].'">'.$Unit['unit_value'].'</option>';
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
          <input onChange="setUpTubeLength()"  type="number" class="form-control" name="work_order_printing_single_coil_width" step=".01" value="0" min="0" max="999999999" placeholder="Single Coil Width">
        </div>
    
        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
          <label>UPS</label>
          <input onChange="setUpTubeLength()"  type="number" class="form-control" name="work_order_printing_ups_val" step=".01" value="0" min="0" max="999999999" placeholder="UPS">
        </div>
        
        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
          <label>Trim</label>
          <input onChange="setUpTubeLength()"  type="number" class="form-control" name="work_order_printing_trim_val" step=".01" value="0" min="0" max="999999999" placeholder="Trim">
        </div>
        
        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
          <label>Total Jumbo Film Width</label>
          <p id="cylinderLengthCalculation">0 x 0 + 0 = 0</p>
        </div>
        
    
    
    </div>                                        

    <div class="row">
    
    
        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
          <label>Single Coil Circumference  </label>
          <input onChange="setUpTubeCircum()" type="number" class="form-control" name="work_order_printing_single_coil_circ" step=".01" value="0" min="0" max="999999999" placeholder="Single Coil Circumference">
        </div>
    
        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
          <label>No. Of Across</label>
          <input onChange="setUpTubeCircum()"  type="number" class="form-control" name="work_order_printing_accross_val" step=".01" value="0" min="0" max="999999999" placeholder="Accross">
        </div>
        
        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
          <label>Bleed </label>
          <input onChange="setUpTubeCircum()"  type="number" class="form-control" name="work_order_printing_bleed_val" step=".01" value="0" min="0" max="999999999" placeholder="Bleed">
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
                 $getShadeCardsReq= mysqlSelect("SELECT * FROM `work_order_ui_print_shadecardreq` where shadecardreq_show = 1 ");
                 if(is_array($getShadeCardsReq)){
                     foreach($getShadeCardsReq as $ShadeCardsReq){
                         echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_printing_shade_card_needed" value="'.$ShadeCardsReq['shadecardreq_id'].'" class="selectgroup-input" '.($ShadeCardsReq['shadecardreq_id'] == 1 ? 'checked':'').'>
              <span class="selectgroup-button">'.$ShadeCardsReq['shadecardreq_value'].'</span>
            </label>
    ';				 }
                 }
                ?>
          
          </div>
        </div>
    
    
        <div class="form-group col-sm-12 col-lg-8 ">
          <label>Color Reference Type </label>
          <div class="selectgroup w-100">
                <?php
                 $getColRef= mysqlSelect("SELECT * FROM `work_order_ui_print_shadecard_ref_type` where shadecard_ref_type_show = 1 ");
                 if(is_array($getColRef)){
                     foreach($getColRef as $ColRef){
                         echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_printing_color_ref_type" value="'.$ColRef['shadecard_ref_type_id'].'" class="selectgroup-input" '.($ColRef['shadecard_ref_type_id'] == 1 ? 'checked':'').'>
              <span class="selectgroup-button">'.$ColRef['shadecard_ref_type_value'].'</span>  
            </label>
    ';				 }
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
                 $geteyemark_path= mysqlSelect("SELECT * FROM `work_order_ui_print_eyemark_path` where eyemark_path_show = 1 ");
                 if(is_array($geteyemark_path)){
                     foreach($geteyemark_path as $eyemark_path){
                         echo '
		<label class="selectgroup-item">
		  <input type="radio" name="work_order_3_printing_eyemark_path" value="'.$eyemark_path['eyemark_path_id'].'" class="selectgroup-input" '.($eyemark_path['eyemark_path_id'] == 1 ? 'checked':'').'>
		  <span class="selectgroup-button">'.$eyemark_path['eyemark_path_value'].'</span>  
		</label>
    ';				 }
                 }
                ?>
          
          </div>
        </div>    
    
        <div class="form-group col-sm-12 col-lg-6 col-xl-3">
          <label>Eyemark Side (in D.A) </label>
          <div class="selectgroup selectgroup-pills">
                <?php
                 $getPrintEye= mysqlSelect("SELECT * FROM `work_order_ui_print_eyemark_da` where eyemark_da_show = 1 ");
                 if(is_array($getPrintEye)){
                     foreach($getPrintEye as $PrintEye){
                         echo '
			<label class="selectgroup-item">
              <input type="checkbox" name="work_order_4_printing_eyemark_side[]" value="'.$PrintEye['eyemark_da_id'].'" class="selectgroup-input" '.($PrintEye['eyemark_da_id'] == 1 ? 'checked':'').'>
              <span class="selectgroup-button">'.$PrintEye['eyemark_da_value'].'</span>
            </label>
    ';				 }
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
                 $getPrintOp= mysqlSelect("SELECT * FROM `work_order_ui_print_options` where print_options_show = 1 ");
                 if(is_array($getPrintOp)){
                     foreach($getPrintOp as $PrintOp){
                         echo '

		<label class="selectgroup-item">
		  <input type="radio" name="work_order_3_printing_approvalby" value="'.$PrintOp['print_options_id'].'" class="selectgroup-input" '.($PrintOp['print_options_id'] == 1 ? 'checked':'').'>
		  <span class="selectgroup-button">'.$PrintOp['print_options_value'].'</span>  
		</label>
    ';				 }
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
                 $getink_sys= mysqlSelect("SELECT * FROM `work_order_ui_print_ink_sys` where ink_sys_show = 1 ");
                 if(is_array($getink_sys)){
                     foreach($getink_sys as $ink_sys){
                         echo '
		<label class="selectgroup-item">
		  <input type="radio" name="work_order_3_printing_ink_system" value="'.$ink_sys['ink_sys_id'].'" class="selectgroup-input" '.($ink_sys['ink_sys_id'] == 1 ? 'checked':'').'>
		  <span class="selectgroup-button">'.$ink_sys['ink_sys_value'].'</span>  
		</label>
    ';				 }
                 }
                ?>
          
          </div>
        </div>    

    
    </div>
                                            
    <div class="row">
    
        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Baseshel</label>
          <div class="selectgroup w-100">
                <?php
                 $big= mysqlSelect("SELECT * FROM `work_order_ui_print_baseshel` where print_baseshel_show = 1 ");
                 if(is_array($big)){
                     foreach($big as $small){
                         echo '
		<label class="selectgroup-item">
		  <input type="radio" name="work_order_3_printing_baseshel" value="'.$small['print_baseshel_id'].'" class="selectgroup-input" '.($small['print_baseshel_id'] == 1 ? 'checked':'').'>
		  <span class="selectgroup-button">'.$small['print_baseshel_value'].'</span>  
		</label>
    ';				 }
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
          <label>1</label>
          <input type="text" class="form-control" name="work_order_printing_pantone_1" placeholder="Pantone 1">
        </div>
    
        <div class="form-group col-12 col-sm-6 col-lg-4 col-xl-3">
          <label>2</label>
          <input type="text" class="form-control" name="work_order_printing_pantone_2" placeholder="Pantone 2">
        </div>
    
        <div class="form-group col-12 col-sm-6 col-lg-4 col-xl-3">
          <label>3</label>
          <input type="text" class="form-control" name="work_order_printing_pantone_3" placeholder="Pantone 3">
        </div>
        
        <div class="form-group col-12 col-sm-6 col-lg-4 col-xl-3">
          <label>4</label>
          <input type="text" class="form-control" name="work_order_printing_pantone_4" placeholder="Pantone 4">
        </div>
    
        <div class="form-group col-12 col-sm-6 col-lg-4 col-xl-3">
          <label>5</label>
          <input type="text" class="form-control" name="work_order_printing_pantone_5" placeholder="Pantone 5">
        </div>
    
        <div class="form-group col-12 col-sm-6 col-lg-4 col-xl-3">
          <label>6</label>
          <input type="text" class="form-control" name="work_order_printing_pantone_6" placeholder="Pantone 6">
        </div>
    
        <div class="form-group col-12 col-sm-6 col-lg-4 col-xl-3">
          <label>7</label>
          <input type="text" class="form-control" name="work_order_printing_pantone_7" placeholder="Pantone 7">
        </div>
        
        <div class="form-group col-12 col-sm-6 col-lg-4 col-xl-3">
          <label>8</label>
          <input type="text" class="form-control" name="work_order_printing_pantone_8" placeholder="Pantone 8">
        </div>
    
    
    
    </div>
    
    <div class="row">
        <div class="form-group col-12">
          <div class="selectgroup selectgroup-pills">
                <?php
                 $getPrintPant= mysqlSelect("SELECT * FROM `work_order_ui_print_end_options` where print_end_options_show = 1 ");
                 if(is_array($getPrintPant)){
                     foreach($getPrintPant as $PrintPant){
                         echo '
			<label class="selectgroup-item">
              <input type="checkbox" name="work_order_4_printing_end_options[]" value="'.$PrintPant['print_end_options_id'].'" class="selectgroup-input" '.($PrintPant['print_end_options_id'] == 1 ? 'checked':'').'>
              <span class="selectgroup-button">'.$PrintPant['print_end_options_value'].'</span>
            </label>
    ';				 }
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
                    $getOverallRem = mysqlSelect("SELECT r.*,m.lum_code,m.lum_name FROM `remarks_wo` r
                left join user_main m on remark_lum_id = m.lum_id
                where remark_status = 1
                and remark_type = 3
                and remark_master_wo_id = ".$_GET['id']);
                
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

              <textarea name="work_order_remarks_printing" class="form-control" placeholder="Remarks" style="height:90px"></textarea>
        </div>
    </div>

    <HR>
</div>

<div id="workOrderLaminationProcess">

	<div class="section-title">Lamination (Only for 2ply or more)</div>


    <div class="row">
    
        <div class="form-group col-12 col-sm-6 ">
          <label>Lam Sleeve (mm)</label>
          <input type="text" class="form-control"  placeholder="Laminate Sleeve" name="work_order_lamination_lam_sleeve">
        </div>
    
        <div class="form-group col-12 col-sm-6 ">
        <label>Options</label>
          <div class="selectgroup selectgroup-pills">
                <?php
                 $getLamOp= mysqlSelect("SELECT * FROM `work_order_ui_lam_end_options` where lam_end_options_show = 1 ");
                 if(is_array($getLamOp)){
                     foreach($getLamOp as $LamOp){
                         echo '
			<label class="selectgroup-item">
              <input type="checkbox" name="work_order_4_lamination_options[]" value="'.$LamOp['lam_end_options_id'].'" class="selectgroup-input" '.($LamOp['lam_end_options_id'] == 1 ? 'checked':'').'>
              <span class="selectgroup-button">'.$LamOp['lam_end_options_value'].'</span>
            </label>
    ';				 }
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
                    $getOverallRem = mysqlSelect("SELECT r.*,m.lum_code,m.lum_name FROM `remarks_wo` r
                left join user_main m on remark_lum_id = m.lum_id
                where remark_status = 1
                and remark_type = 4
                and remark_master_wo_id = ".$_GET['id']);
                
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
          <textarea name="work_order_remarks_lamination" class="form-control" placeholder="Remarks" style="height:150px"></textarea>
        </div>
    </div>
        
    <HR>
</div>



        <div class="form-group" align="center">
            <button type="submit" class="btn btn-success">Save Changes</button>
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
		if(isset($_GET['id'])){
			if(is_array($WorkOrderMain)){
		?>
		
		<script>
			$(document).ready(function (e) {
				<?php
				foreach($master_wo_straightArrays as $k=>$v){
					if($k == 'work_order_delivery_date'){
						echo '$(\'input[name="'.$k.'"]\').val("'.date('d-m-Y',$WorkOrderMain[$v]).'");
						';
						
					}else{
						echo '$(\'input[name="'.$k.'"]\').val("'.$WorkOrderMain[$v].'");
						';
					}
				}
				?>
		
				<?php
				foreach($master_wo_radioArrays as $k=>$v){
					echo '$(\'input:radio[name="'.$k.'"]\').filter(\'[value="'.$WorkOrderMain[$v].'"]\').attr(\'checked\', true);
					';
				}
				?>
		
				<?php 
				foreach($master_wo_checkboxArrays as $k=>$v){
			
					echo '$(\'input[name="'.$k.'[]"]\').each(function() {
						this.checked = false;
					});
					';
					if($WorkOrderMain[$v] != ''){
						$s = explode(',',$WorkOrderMain[$v]);
						foreach($s as $val){
							echo '$(\'input:checkbox[name="'.$k.'[]"]\').filter("[value=\''.$val.'\']").prop(\'checked\', true);
							';
						}
					}
				} 
				?>
		
				<?php
				foreach($master_wo_selectArrays as $k=>$v){
					echo '$(\'select[name="'.$k.'"]\').val("'.$WorkOrderMain[$v].'").change();
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
		if($('#plyValueInput').val() >0 && $('#plyValueInput').val() < 6){
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
	
	for(l = 1; l <= ($('#plyValueInput').val()); l++){
		$('input[name="work_order_layer_' + l  + '_micron"]').change(function(e) {
			setUpFilmToLaminate();
			fillSubstrate();
		});
	
		$('select[name="work_order_5_layer_' + l  + '_material"]').change(function(e) {
			setUpFilmToLaminate();
			fillSubstrate();
		});
	
	}

	$('#plyValueInput').change(function(e) {
		if($('#plyValueInput').val() >0 && $('#plyValueInput').val() < 6){

				for(l = 1; l <= ($('#plyValueInput').val()); l++){
					$('input[name="work_order_layer_' + l  + '_micron"]').change(function(e) {
						setUpFilmToLaminate();
						fillSubstrate();
					});
				
					$('select[name="work_order_5_layer_' + l  + '_material"]').change(function(e) {
						setUpFilmToLaminate();
						fillSubstrate();
					});
				
				}
			

		}
    });

	$("#formLoading").hide();
});

function setSplHoleDia(){
	var splHoleDiaCont = $("#splHoleDiaContainer");
	var optionsVal = $("#splHoleInputCheck");
	if (optionsVal.is(":checked")){
		splHoleDiaCont.fadeIn();
	}else{
		splHoleDiaCont.fadeOut();
	}

}

function setBagPouchSetup(){
	bagPouchRoll = $("input[name=work_order_3_structure]:checked").val();
	
	if(bagPouchRoll == 1){
		$("#workOrderBagProcess").fadeIn();
		$("#workOrderPouchProcess").fadeOut();
	}else if(bagPouchRoll == 2){
		$("#workOrderBagProcess").fadeOut();
		$("#workOrderPouchProcess").fadeIn();
	}else if(bagPouchRoll == 3){
		$("#workOrderBagProcess").fadeOut();
		$("#workOrderPouchProcess").fadeOut();
	} 
}

function setPrintedSetup(){
	printedVal = $("input[name=work_order_3_essentials_printed]:checked").val();
	if(printedVal == 0){
		$("#workOrderPrintingProcess").fadeOut();
	}else{
		$("#workOrderPrintingProcess").fadeIn();
	}
}

function setUpSelect2s(){
    $('.select_client').select2();
    $('.select_sales').select2();
    $('.select_qty_unit').select2();
    $('.select_application').select2(); 
    $('.select_wind_dir').select2();
	$('.select_material').select2();
	$('.select_pack_qty_unit').select2();
}

function setUpLaminationSection(){
	var layers = $('#plyValueInput').val();
	var containerLayer = $('#workOrderLaminationProcess');
	if(layers > 1){
		containerLayer.fadeIn();
	}else{
		containerLayer.fadeOut();
	}
}

function setUpLaminateEntryLayers(){
	var layers = $('#plyValueInput').val();
	var containerLayer = $('#containerLaminateLayers');
	var lamPrefix = 'laminateRowId';
	var stringOutput = "";
	var l;

	for(l = 1; l <= (layers); l++){
		stringOutput = stringOutput.concat(""+
		"<div id=\"laminateRowId" + l + "\" class=\"row\">"+
		"    <div class=\"col-12\">"+
		"        <div class=\"row\">"+
		"           <div class=\"col-12\">"+
		"               <p align=\"left\" style=\"margin-left:10px\">Film/Laminate Layer " + l + "</p>"+
		"            </div>"+
		"        </div>"+
		"       <div class=\"row\">"+
		"           <div class=\"form-group col-6\">"+
		"            <label>Micron</label>"+
		"             <input type=\"number\" class=\"form-control\" min='0' step='0.01' required name=\"work_order_layer_" + l + "_micron\" placeholder=\"Film Micron\">" +
		"           </div>"+
		"           <div class=\"form-group col-6\">"+
		"             <label>Film</label>"+
		"             <select class=\"form-control select_material\" required name=\"work_order_5_layer_" + l + "_material\">                        <?php
							 $getMaterials= mysqlSelect("SELECT * FROM `materials_main` order by material_value asc");
							 if(is_array($getMaterials)){
								 foreach($getMaterials as $Material){
									 echo '<option value=\"'.$Material['material_id'].'\">'.$Material['material_value'].'</option>';
								 }
							 }
							?>
	</select>"+
		"           </div>"+
		"        </div>"+
		"   </div>"+
		"</div>");
	}
	
	containerLayer.html(stringOutput);
	stringOutput = "";

}

function setUpFilmStructureLayers(){
	var layers = $('#plyValueInput').val();
	var containerLayer = $('#workOrderLaminationFilmLayerContainer');
	var stringOutput = "";
	var l;

	for(l = 1; l <= (layers); l++){

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
					 
		 if((l+1) <= (layers)){
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

function setUpFilmToLaminate(){
	var layers = $('#plyValueInput').val();
	var stringOutput = "";
	var l;
	var checker = 0;

	for(l = 1; l <= (layers); l++){
		var valMicron = $('input[name="work_order_layer_' + l + '_micron"]').val();
		var valFilm = $('select[name="work_order_5_layer_' + l + '_material"] option:selected').text();
		var valFilmID = $('select[name="work_order_5_layer_' + l + '_material"] option:selected').val();
		
		if(valFilmID ==4 || valFilmID ==5 || valFilmID ==36 ){
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
	
	if(checker == 0){
		$("#workOrderExtrusionProcess").fadeOut();
	}else{
		$("#workOrderExtrusionProcess").fadeIn();
	}
	
}

function setUpTubeLength(){
	var a = parseFloat($('input[name="work_order_printing_single_coil_width"]').val());
	var b = parseFloat($('input[name="work_order_printing_ups_val"]').val());
	var c = parseFloat($('input[name="work_order_printing_trim_val"]').val());
	var holder = $('#cylinderLengthCalculation');
	
	holder.html(a + " x " + b + " + " + c + " = " + ((a*b)+c));
}

function setUpTubeCircum(){
	var a = parseFloat($('input[name="work_order_printing_single_coil_circ"]').val());
	var b = parseFloat($('input[name="work_order_printing_accross_val"]').val());
	var c = parseFloat($('input[name="work_order_printing_bleed_val"]').val());
	var holder = $('#cylinderCircumferenceCalculation');
	
	holder.html(a + " x " + b + " + " + c + " = " + ((a*b)+c));
}

function fillSubstrate(){
	var micronLevel = $('input[name="work_order_layer_1_micron"]').val();
	var FilmLevel = $('select[name="work_order_5_layer_1_material"] option:selected').text();
	
	$("#inputSubstrate").val(micronLevel + "u, " + FilmLevel);
}
</script>


<script>
	$(document).ready(function(e) {
	<?php
			if(isset($_GET['id'])){
				if(is_array($WorkOrderMain)){
					if(is_numeric($WorkOrderMain['master_wo_ply'])){
					
		for($counterL = 1; $counterL <= $WorkOrderMain['master_wo_ply']; $counterL++){
			echo '$(\'input[name="work_order_layer_'.$counterL.'_micron"]\').val("'.$WorkOrderMain['master_wo_layer_'.$counterL.'_micron'].'");';
			echo '$(\'select[name="work_order_5_layer_'.$counterL.'_material"]\').val("'.$WorkOrderMain['master_wo_layer_'.$counterL.'_structure'].'").change();';
	
			echo '$(\'input[name="work_order_lamination_layer_'.$counterL.'_film_width"]\').val("'.$WorkOrderMain['master_wo_lam_f'.$counterL.'_width'].'");';
			echo '$(\'input[name="work_order_lamination_layer_'.$counterL.'_kgs"]\').val("'.$WorkOrderMain['master_wo_lam_f'.$counterL.'_kgs'].'");';
			echo '$(\'input[name="work_order_lamination_layer_'.$counterL.'_mtr"]\').val("'.$WorkOrderMain['master_wo_lam_f'.$counterL.'_mtr'].'");';
			
			if(($counterL+1) <= $WorkOrderMain['master_wo_ply']){
	
				echo '$(\'input[name="work_order_lamination_pass_'.$counterL.'_desc_1"]\').val("'.$WorkOrderMain['master_wo_lam_p'.$counterL.'_desc_1'].'");';
				echo '$(\'input[name="work_order_lamination_pass_'.$counterL.'_desc_2"]\').val("'.$WorkOrderMain['master_wo_lam_p'.$counterL.'_desc_2'].'");';
	
			}
		
		}
	
					}
				}
			}
	?>

		
	});
</script>

<script>
	$(document).ready(function (e) {
		$('#formContainer').on('submit',(function(e) {
			var formCont  = $(this)[0];
			
			e.preventDefault();
			
			bootbox.confirm("Are you sure you want to edit this Work Order?", function(result){ 
				if(result){
					$('#formContainer').fadeOut();
			var formData = new FormData(formCont);
			$.ajax({
				type:'POST',
				url: $(formCont).attr('action'),
				data:formData,
				cache:false,
				contentType: false,
				processData: false,
				success:function(data){
					
					if(data.trim() == ""){
						$('#formContainer').html("");
						$("#formSuccess").fadeIn();
						$("#formFail").fadeOut();
						$('html,body').animate({
							scrollTop: $("html").offset().top
						}, 'slow');
					}else{
						$("#formFail").html(data);
						$('#formContainer').fadeIn();
						$("#formSuccess").fadeOut();
						$("#formFail").fadeIn();
						$('html,body').animate({
							scrollTop: $("#formFail").offset().top
						}, 'slow');
					}
				},
				error: function(data){
					alert("Contact Admin.");
				}
			});
	
				}
			});
	
			
		}));
	
	});
</script> 

<?php 
		if(isset($_GET['id'])){
			if(is_array($WorkOrderMain)){
				$trackChanges = true;


				$getAllVersions = mysqlSelect("SELECT * FROM `master_work_order_main` 
				left join master_work_order_reference_number on mwo_ref_id = master_wo_ref
				left join master_work_order_main_identitiy on mwoid_id = master_wo_status 
				where master_wo_ref = ".$WorkOrderMain['master_wo_ref']."
				order by master_wo_id desc
				limit 3
				");
				
				if(count($getAllVersions) == 3){
////////////////////////////////// 0,1,2 (2 and 1) = What you have made, (1 and 0) is what they have made from old

//////////////////////////////////					
				}else if(count($getAllVersions) == 2){
//////////////////////////////////
					$getDraftBacklink = mysqlSelect("select * from sales_work_order_main where s_wo_id = ".$WorkOrderMain['mwo_sales_wo_id']." and s_wo_status = 3");
					if(!is_array($getDraftBacklink)){
						$trackChanges = false;
					}
					$getDraftBacklink = $getDraftBacklink[0];
					$fill = array();
					foreach($getDraftBacklink as $k=>$v){
						$nk =str_replace("s_wo_","master_wo_",$k);
						$fill[$nk] = $v;
					}
					$getAllVersions[] = $fill;
					
	
//////////////////////////////////
				}else if(count($getAllVersions) == 1){
					$getDraftBacklink = mysqlSelect("select * from sales_work_order_main where s_wo_id = ".$WorkOrderMain['mwo_sales_wo_id']." and s_wo_status = 3");
					if(!is_array($getDraftBacklink)){
						$trackChanges = false;
					}
					$getDraftBacklink = $getDraftBacklink[0];
					$fill = array();
					foreach($getDraftBacklink as $k=>$v){
						$nk =str_replace("s_wo_","master_wo_",$k);
						$fill[$nk] = $v;
					}
					$getAllVersions[] = $fill;
					$getAllVersions[] = $fill;

				}else{
					//DO NOthing
					$trackChanges = false;
				}
				
		if($trackChanges){ 		
		?>
		
		<script>
			$(document).ready(function (e) {
				
				<?php
				foreach($master_wo_straightArrays as $k=>$v){
					getValueComparer('$(\'input[name="'.$k.'"]\')',$getAllVersions[0][$v],$getAllVersions[1][$v],$getAllVersions[2][$v]);
				}

				foreach($master_wo_radioArrays as $k=>$v){
					getValueComparer('$(\'input:radio[name="'.$k.'"]\').parent()',$getAllVersions[0][$v],$getAllVersions[1][$v],$getAllVersions[2][$v]);
				}

				foreach($master_wo_checkboxArrays as $k=>$v){
					getValueComparer('$(\'input:checkbox[name="'.$k.'[]"]\').parent()',$getAllVersions[0][$v],$getAllVersions[1][$v],$getAllVersions[2][$v]);
				} 

				foreach($master_wo_selectArrays as $k=>$v){
					getValueComparer('$(\'select[name="'.$k.'"]\')',$getAllVersions[0][$v],$getAllVersions[1][$v],$getAllVersions[2][$v]);
				}
				
				
				
				if(is_numeric($WorkOrderMain['master_wo_ply'])){
								
					for($counterL = 1; $counterL <= $WorkOrderMain['master_wo_ply']; $counterL++){
				
						getValueComparer('$(\'input[name="work_order_layer_'.$counterL.'_micron"]\')',
						$getAllVersions[0]['master_wo_layer_'.$counterL.'_micron'],
						$getAllVersions[1]['master_wo_layer_'.$counterL.'_micron'],
						$getAllVersions[2]['master_wo_layer_'.$counterL.'_micron']);
				
						getValueComparer('$(\'select[name="work_order_layer_'.$counterL.'_material"]\')',
						$getAllVersions[0]['master_wo_layer_'.$counterL.'_structure'],
						$getAllVersions[1]['master_wo_layer_'.$counterL.'_structure'],
						$getAllVersions[2]['master_wo_layer_'.$counterL.'_structure']);
				
						getValueComparer('$(\'input[name="work_order_lamination_layer_'.$counterL.'_film_width"]\')',
						$getAllVersions[0]['master_wo_lam_f'.$counterL.'_width'],
						$getAllVersions[1]['master_wo_lam_f'.$counterL.'_width'],
						$getAllVersions[2]['master_wo_lam_f'.$counterL.'_width']);
				
						getValueComparer('$(\'input[name="work_order_lamination_layer_'.$counterL.'_kgs"]\')',
						$getAllVersions[0]['master_wo_lam_f'.$counterL.'_kgs'],
						$getAllVersions[1]['master_wo_lam_f'.$counterL.'_kgs'],
						$getAllVersions[2]['master_wo_lam_f'.$counterL.'_kgs']);
				
						getValueComparer('$(\'input[name="work_order_lamination_layer_'.$counterL.'_mtr"]\')',
						$getAllVersions[0]['master_wo_lam_f'.$counterL.'_mtr'],
						$getAllVersions[1]['master_wo_lam_f'.$counterL.'_mtr'],
						$getAllVersions[2]['master_wo_lam_f'.$counterL.'_mtr']);
				
						
						if(($counterL+1) <= $WorkOrderMain['master_wo_ply']){
						getValueComparer('$(\'input[name="work_order_lamination_pass_'.$counterL.'_desc_1"]\')',
						$getAllVersions[0]['master_wo_lam_p'.$counterL.'_desc_1'],
						$getAllVersions[1]['master_wo_lam_p'.$counterL.'_desc_1'],
						$getAllVersions[2]['master_wo_lam_p'.$counterL.'_desc_1']);
				
						getValueComparer('$(\'input[name="work_order_lamination_pass_'.$counterL.'_desc_2"]\')',
						$getAllVersions[0]['master_wo_lam_p'.$counterL.'_desc_2'],
						$getAllVersions[1]['master_wo_lam_p'.$counterL.'_desc_2'],
						$getAllVersions[2]['master_wo_lam_p'.$counterL.'_desc_2']);
				
				
						}
					
					}
				
				}

				?>
			
			});
		</script>
		
		<?php
				}
			}
		}

?>
</body>
</html>
