<?php 
require_once("server_fundamentals/SessionHandler.php");

getHead("Form Controller");
?>

<link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      
      <?php
	  	getTopBar();
	  	getNavbar($USER_ARRAY['user_type_mod_id']);
		
	  ?>

<?php 
$arrayHolder = array(
array("Qty Units","work_order_qty_units","unit"),
array("Application","work_order_applications","application"),
array("Material","materials_main","material"),
array("Winding Direction","work_order_wind_dir","wind"),
array("work_order_ui_customer_location","work_order_ui_customer_location","customer_location"),
array("work_order_ui_structure","work_order_ui_structure","structure"),

array("Bag Gusset Bottom","work_order_ui_bag_gusset_bottom","gusset_bottom"),
array("Bag Busset Side","work_order_ui_bag_gusset_side","gusset_side"),
array("Bag Handle","work_order_ui_bag_handle","bag_handle"),
array("Bag Punch Options","work_order_ui_bag_punch_opts","bag_punch_opts"),
array("work_order_ui_bag_sealing_opts","work_order_ui_bag_sealing_opts","bag_sealing_opts"),
array("work_order_ui_bag_vest_handle","work_order_ui_bag_vest_handle","bag_vest_handle"),

array("work_order_ui_ext_antistatic","work_order_ui_ext_antistatic","anti"),
array("work_order_ui_ext_cof","work_order_ui_ext_cof","cof"),
array("work_order_ui_ext_extrude_in","work_order_ui_ext_extrude_in","extrude_in"),
array("work_order_ui_ext_layer_type","work_order_ui_ext_layer_type","layer_type"),
array("work_order_ui_ext_options","work_order_ui_ext_options","ext_options"),
array("work_order_ui_ext_treatment","work_order_ui_ext_treatment","treat"),

array("work_order_ui_lam_end_options","work_order_ui_lam_end_options","lam_end_options"),
array("work_order_ui_pe_film_feature","work_order_ui_pe_film_feature","pe_film_feature"),

array("work_order_ui_pouch_closure_type","work_order_ui_pouch_closure_type","pouch_closure_type"),
array("work_order_ui_pouch_corner_type","work_order_ui_pouch_corner_type","pouch_corner_type"),
array("work_order_ui_pouch_euro_punch","work_order_ui_pouch_euro_punch","pouch_euro_punch"),
array("work_order_ui_pouch_gusset_bottom","work_order_ui_pouch_gusset_bottom","pouch_gusset_bottom"),
array("work_order_ui_pouch_gusset_side","work_order_ui_pouch_gusset_side","pouch_gusset_side"),
array("work_order_ui_pouch_hole_punch","work_order_ui_pouch_hole_punch","pouch_hole_punch"),
array("work_order_ui_pouch_notch_side","work_order_ui_pouch_notch_side","pouch_notch_side"),
array("work_order_ui_pouch_pouch_open","work_order_ui_pouch_pouch_open","pouch_open"),
array("work_order_ui_pouch_seal","work_order_ui_pouch_seal","pouch_seal"),
array("work_order_ui_pouch_sealing","work_order_ui_pouch_sealing","pouch_sealing"),
array("work_order_ui_pouch_special_tooling","work_order_ui_pouch_special_tooling","pouch_special_tooling"),
array("work_order_ui_pouch_type","work_order_ui_pouch_type","pouch_type"),

array("work_order_ui_print_baseshel","work_order_ui_print_baseshel","print_baseshel"),
array("work_order_ui_print_cylinder_supplier","work_order_ui_print_cylinder_supplier","cylinder_supplier"),
array("work_order_ui_print_end_options","work_order_ui_print_end_options","print_end_options"),
array("work_order_ui_print_eyemark_da","work_order_ui_print_eyemark_da","eyemark_da"),
array("work_order_ui_print_eyemark_path","work_order_ui_print_eyemark_path","eyemark_path"),
array("work_order_ui_print_ink_sys","work_order_ui_print_ink_sys","ink_sys"),
array("work_order_ui_print_options","work_order_ui_print_options","print_options"),
array("work_order_ui_print_shadecard_ref_type","work_order_ui_print_shadecard_ref_type","shadecard_ref_type"),
array("work_order_ui_print_shadecardreq","work_order_ui_print_shadecardreq","shadecardreq"),
array("work_order_ui_print_surfrev","work_order_ui_print_surfrev","surfrev"),

array("work_order_ui_slitting_core_id_length","work_order_ui_slitting_core_id_length","slitting_core_id_length"),
array("work_order_ui_slitting_core_id_type","work_order_ui_slitting_core_id_type","slitting_core_id_type"),
array("work_order_ui_slitting_core_plugs","work_order_ui_slitting_core_plugs","core_plugs"),
array("work_order_ui_slitting_packing_opts","work_order_ui_slitting_packing_opts","slitting_packing_opts"),
array("work_order_ui_slitting_pallet","work_order_ui_slitting_pallet","slitting_pallet"),
array("work_order_ui_slitting_pallet_instructions","work_order_ui_slitting_pallet_instructions","pallet_instructions"),
array("work_order_ui_slitting_qc_ins","work_order_ui_slitting_qc_ins","slitting_qc_ins"),
array("work_order_ui_slitting_sticker","work_order_ui_slitting_sticker","slitting_sticker"),

);
?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Form Manager - Admin</h1>
          </div>
          
            <div class="row">
                <div class="col-12 ">
                                <div class="card card-warning">
                                  <div class="card-header">
                                    <h4>Clients </h4>
                                  </div>
                                  <div class="card-body text-justify">
                                      <table class="table table-striped table-bordered " id="DraftsContainerTable">
	<thead>
    	<tr>
            <th>Client ID</th>
            <th>Client Code</th>
            <th>Client Name</th>
            <th>Client Since</th>
        </tr>
        </thead>

        <tbody>
        <?php
		$getDrafts = mysqlSelect("SELECT * FROM `clients_main` order by client_id asc ");
		
		if(is_array($getDrafts)){
			foreach($getDrafts as $Draft){
				?>
                <tr>
                	<td><?php echo $Draft['client_id'] ?></td>
                	<td><?php echo $Draft['client_code'] ?></td>
                	<td><?php echo $Draft['client_name'] ?></td>
                	<td><?php echo date('d-m-Y @ h:i:s a',$Draft['client_dnt']); ?></td>
                </tr>
                <?php
			}
		}
		?>
        <form id="ClientAddForm" action="server_fundamentals/FormManagerController" method="post">
            <tr>
            	<td></td>
                <td><input id="clientCode" required type="text" class="form-control" name="client_code" placeholder="Client Code" /></td>
                <td><input id="clientName" required type="text" class="form-control" name="client_name"  placeholder="Client Name" /></td>
                <td><input type="submit" class="form-control btn btn-success" value="Add"/>
                </td>
            </tr>
           
        </form>
        </tbody>
        
    </table>

                                  </div>
                                </div>
                              </div>
            </div>

<?php 
$arrayChildCapture = array();
foreach($arrayHolder as $asset){
	
?>
            <div class="row">
                <div class="col-12 ">
                                <div class="card card-warning">
                                  <div class="card-header">
                                    <h4><?php echo $asset[0] ?> - <?php echo $asset[1] ?> </h4>
                                  </div>
                                  <div class="card-body text-justify">
      <table class="table table-striped table-bordered ">
        <thead>
            <tr>
                <th><?php echo  $asset[0] ?> ID</th>
                <th><?php echo  $asset[0] ?> Value</th>
                <th><?php echo  $asset[0] ?> Show</th>
            </tr>
        </thead>

        <tbody>
        <?php
		$getFormVal = mysqlSelect("SELECT * FROM `".$asset[1]."` order by ".$asset[2]."_id asc ");
		
		if(is_array($getFormVal)){
			foreach($getFormVal as $FormVal){
				$h = sha1($asset[1].$FormVal[$asset[2].'_id']).uniqid();
				$arrayChildCapture[] = $h;
				?>
                <tr>
                	<td><?php echo $FormVal[$asset[2].'_id'] ?></td>
                	<td><?php echo $FormVal[$asset[2].'_value'] ?></td>
            <td>
                <form id="<?php echo $h ?>" action="server_fundamentals/FormManagerController.php" method="post">
                	<input type="hidden" value="<?php echo $FormVal[$asset[2].'_id'] ?>" name="<?php echo $asset[2]."_toggle" ?>" />
                    <?php echo ($FormVal[$asset[2].'_show'] == 1? '<button class="btn btn-danger">Hide</button>':'<button class="btn btn-success">Show</button>') ?>
                </form>
                
            </td>
                </tr>
                <?php
			}
		}
		?>
        <form id="SH<?php echo md5($asset[1].$asset[2]) ?>" action="server_fundamentals/FormManagerController.php" method="post">
            <tr>
            	<td></td>
                <td><input required type="text" class="form-control" name="<?php echo  $asset[2] ?>_value" placeholder="<?php echo  $asset[0] ?> Value" /></td>
                <td><input type="submit" class="form-control btn btn-success" value="Add"/></td>
            </tr>
           
        </form>
        </tbody>
        
    </table>

                                  </div>
                                </div>
                              </div>
            </div>
<?php
}
?>


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

 <!-- Modal -->
<div id="ConfirmationModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirmation Box</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script src="assets/js/bootbox.min.js"></script>
<script>
$(document).ready(function (e) {
		$('#ClientAddForm').on('submit',(function(e) {
		var formHolder = $('#ClientAddForm')[0];
		e.preventDefault();

		bootbox.confirm("Are you sure you want to add this client with Code: " + $("#clientCode").val() + " and Name: " + $("#clientName").val() + " ?", function(result){ 
			if(result){
					var formData = new FormData(formHolder);
				
					$.ajax({
						type:'POST',
						url: $(formHolder).attr('action'),
						data:formData,
						cache:false,
						contentType: false,
						processData: false,
						success:function(data){
							
							if(data.trim() == "ok"){
								$(formHolder).trigger("reset");
								bootbox.alert("Please refresh the page to see changes.");
							}else{
								alert(data);
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
	foreach($arrayHolder as $asset){
		?>
		<script>
		$(document).ready(function (e) {
				$('#SH<?php echo md5($asset[1].$asset[2]) ?>').on('submit',(function(e) {
				var formHolder = $('#SH<?php echo md5($asset[1].$asset[2]) ?>')[0];
				e.preventDefault();
		
				bootbox.confirm("Are you sure you want to add a value to <?php echo $asset[0] ?> ?", function(result){ 
					if(result){
							var formData = new FormData(formHolder);
						
							$.ajax({
								type:'POST',
								url: $(formHolder).attr('action'),
								data:formData,
								cache:false,
								contentType: false,
								processData: false,
								success:function(data){
									
									if(data.trim() == "ok"){
										location.reload(); 
										bootbox.alert("Please refresh the page to see changes.");
									}else{
										alert(data);
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
	}
?>

<?php
	foreach($arrayChildCapture as $children){
		?>
		<script>
		$(document).ready(function (e) {
				$('#<?php echo ($children) ?>').on('submit',(function(e) {
				var formHolder = $('#<?php echo ($children) ?>')[0];
				e.preventDefault();
		
				bootbox.confirm("Are you sure you want to add hide/show the value?  ?", function(result){ 
					if(result){
							var formData = new FormData(formHolder);
						
							$.ajax({
								type:'POST',
								url: $(formHolder).attr('action'),
								data:formData,
								cache:false,
								contentType: false,
								processData: false,
								success:function(data){
									
									if(data.trim() == "ok"){
										location.reload(); 
									}else{
										alert(data);
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
	}
?>


</body>
</html>
