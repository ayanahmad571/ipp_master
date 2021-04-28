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

				array("Work Order Applications", "work_order_applications", "application"),
				array("Work Order Pack Size Unit", "work_order_pack_size_unit", "psu"),
				array("Work Order Product Type Printed", "work_order_product_type_printed", "ptp"),
				array("Work Order Qty Units", "work_order_qty_units", "unit"),
				array("Bag Handle", "work_order_ui_bag_handle", "bag_handle"),
				array("Customer Location", "work_order_ui_customer_location", "customer_location"),
				array("Ext Cof", "work_order_ui_ext_cof", "cof"),
				array("Filling Temp", "work_order_ui_filling_temp", "filling_temp"),
				array("Foil Print Side", "work_order_ui_foil_print_side", "foil_print_side"),
				array("Lam Options", "work_order_ui_lam_options", "lamo"),
				array("Pallet Size", "work_order_ui_pallet_size", "pallet_size"),
				array("Pe Film Feature", "work_order_ui_pe_film_feature", "pe_film_feature"),
				array("Pouch Bag Fill Opts", "work_order_ui_pouch_bag_fill_opts", "pbfo"),
				array("Pouch Euro Punch", "work_order_ui_pouch_euro_punch", "euro"),
				array("Pouch Lap Fin", "work_order_ui_pouch_lap_fin", "lap_fin"),
				array("Pouch Pack Ins", "work_order_ui_pouch_pack_ins", "pouch_pack_ins"),
				array("Pouch Pe Strip", "work_order_ui_pouch_pe_strip", "pestrip"),
				array("Pouch Punch Type", "work_order_ui_pouch_punch_type", "punch"),
				array("Pouch Round Corner", "work_order_ui_pouch_round_corner", "round_corner"),
				array("Pouch Tear Notch", "work_order_ui_pouch_tear_notch", "tear_notch"),
				array("Pouch Tear Notch Qty", "work_order_ui_pouch_tear_notch_qty", "tear_notch_qty"),
				array("Pouch Tear Notch Side", "work_order_ui_pouch_tear_notch_side", "tear_notch_side"),
				array("Pouch Zipper", "work_order_ui_pouch_zipper", "zipper"),
				array("Pouch Zipper Opc", "work_order_ui_pouch_zipper_opc", "zipopc"),
				array("Print End Options", "work_order_ui_print_end_options", "print_end_opts"),
				array("Print Options", "work_order_ui_print_options", "print_options"),
				array("Print Shadecard Ref Type", "work_order_ui_print_shadecard_ref_type", "shadecard_ref_type"),
				array("Print Shadecardreq", "work_order_ui_print_shadecardreq", "shadecardreq"),
				array("Print Surfrev", "work_order_ui_print_surfrev", "surfrev"),
				array("Repeat Types", "work_order_ui_repeat_types", "rept"),
				array("Roll Options", "work_order_ui_roll_options", "rollopts"),
				array("Shipment", "work_order_ui_shipment", "shipment"),
				array("Slitting Core Id Length", "work_order_ui_slitting_core_id_length", "slitting_core_id_length"),
				array("Slitting Core Id Type", "work_order_ui_slitting_core_id_type", "slitting_core_id_type"),
				array("Slitting Core Plugs", "work_order_ui_slitting_core_plugs", "core_plugs"),
				array("Slitting Freight Ins", "work_order_ui_slitting_freight_ins", "freight"),
				array("Slitting Laser Config", "work_order_ui_slitting_laser_config", "laser"),
				array("Slitting Pack Ins", "work_order_ui_slitting_pack_ins", "pack_ins"),
				array("Slitting Packing Opts", "work_order_ui_slitting_packing_opts", "slitting_packing_opts"),
				array("Slitting Pallet", "work_order_ui_slitting_pallet", "slitting_pallet"),
				array("Slitting Pallet Instructions", "work_order_ui_slitting_pallet_instructions", "pallet_instructions"),
				array("Slitting Qc Ins", "work_order_ui_slitting_qc_ins", "slitting_qc_ins"),
				array("Slitting Shipping Dets", "work_order_ui_slitting_shipping_dets", "shipping_dets"),
				array("Structure", "work_order_ui_structure", "structure"),
				array("Work Order Wind Dir", "work_order_wind_dir", "wind")


			);
			?>

			<!-- Main Content -->
			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>Form Manager - Admin</h1>
					</div>

					<?php
					$arrayChildCapture = array();
					foreach ($arrayHolder as $asset) {

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
												$getFormVal = mysqlSelect("SELECT * FROM `" . $asset[1] . "` order by " . $asset[2] . "_id asc ");

												if (is_array($getFormVal)) {
													foreach ($getFormVal as $FormVal) {
														$h = sha1($asset[1] . $FormVal[$asset[2] . '_id']) . uniqid();
														$arrayChildCapture[] = $h;
												?>
														<tr>
															<td><?php echo $FormVal[$asset[2] . '_id'] ?></td>
															<td><?php echo $FormVal[$asset[2] . '_value'] ?></td>
															<td>
																<form id="<?php echo $h ?>" action="server_fundamentals/FormManagerController" method="post">
																	<input type="hidden" value="<?php echo $FormVal[$asset[2] . '_id'] ?>" name="<?php echo $asset[2] . "_toggle" ?>" />
																	<?php echo ($FormVal[$asset[2] . '_show'] == 1 ? '<button class="btn btn-danger">Hide</button>' : '<button class="btn btn-success">Show</button>') ?>
																</form>

															</td>
														</tr>
												<?php
													}
												}
												?>
												<form id="SH<?php echo md5($asset[1] . $asset[2]) ?>" action="server_fundamentals/FormManagerController" method="post">
													<tr>
														<td></td>
														<td><input required type="text" class="form-control" name="<?php echo  $asset[2] ?>_value" placeholder="<?php echo  $asset[0] ?> Value" /></td>
														<td><input type="submit" class="form-control btn btn-success" value="Add" /></td>
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
		$(document).ready(function(e) {
			$('#ClientAddForm').on('submit', (function(e) {
				var formHolder = $('#ClientAddForm')[0];
				e.preventDefault();

				bootbox.confirm("Are you sure you want to add this client with Code: " + $("#clientCode").val() + " and Name: " + $("#clientName").val() + " ?", function(result) {
					if (result) {
						var formData = new FormData(formHolder);

						$.ajax({
							type: 'POST',
							url: $(formHolder).attr('action'),
							data: formData,
							cache: false,
							contentType: false,
							processData: false,
							success: function(data) {

								if (data.trim() == "ok") {
									$(formHolder).trigger("reset");
									bootbox.alert("Please refresh the page to see changes.");
								} else {
									alert(data);
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
	<?php
	foreach ($arrayHolder as $asset) {
	?>
		<script>
			$(document).ready(function(e) {
				$('#SH<?php echo md5($asset[1] . $asset[2]) ?>').on('submit', (function(e) {
					var formHolder = $('#SH<?php echo md5($asset[1] . $asset[2]) ?>')[0];
					e.preventDefault();

					bootbox.confirm("Are you sure you want to add a value to <?php echo $asset[0] ?> ?", function(result) {
						if (result) {
							var formData = new FormData(formHolder);

							$.ajax({
								type: 'POST',
								url: $(formHolder).attr('action'),
								data: formData,
								cache: false,
								contentType: false,
								processData: false,
								success: function(data) {

									if (data.trim() == "ok") {
										location.reload();
										bootbox.alert("Please refresh the page to see changes.");
									} else {
										alert(data);
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
	<?php
	}
	?>

	<?php
	foreach ($arrayChildCapture as $children) {
	?>
		<script>
			$(document).ready(function(e) {
				$('#<?php echo ($children) ?>').on('submit', (function(e) {
					var formHolder = $('#<?php echo ($children) ?>')[0];
					e.preventDefault();

					bootbox.confirm("Are you sure you want to add hide/show the value?  ?", function(result) {
						if (result) {
							var formData = new FormData(formHolder);

							$.ajax({
								type: 'POST',
								url: $(formHolder).attr('action'),
								data: formData,
								cache: false,
								contentType: false,
								processData: false,
								success: function(data) {

									if (data.trim() == "ok") {
										location.reload();
									} else {
										alert(data);
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
	<?php
	}
	?>


</body>

</html>