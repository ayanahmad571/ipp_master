<?php
require_once("server_fundamentals/SessionHandler.php");

getHead("Version Control");
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

			<!-- Main Content -->
			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>Work Order Version Manager</h1>
					</div>

					<div class="row">
						<div class="col-12 ">
							<div class="card card-warning">
								<div class="card-header">
									<h4>Versions of WO <?php echo (isset($_GET['id']) ? $_GET['id'] : "") ?> </h4>
								</div>
								<div class="card-body text-justify">
									<?php

									if (isset($_GET['id'])) {
									?>
										<table class="table table-striped table-bordered " id="DraftsContainerTable">
											<thead>
												<tr>
													<th>Version Number</th>
													<th>Status</th>
													<th>Generated</th>
													<th>Action</th>

												</tr>
											</thead>

											<tbody>
												<?php
												$getDrafts = mysqlSelect("SELECT * FROM `master_work_order_main` 
		left join master_work_order_reference_number on mwo_ref_id = master_wo_ref
		left join master_work_order_main_identitiy on mwoid_id = master_wo_status 
		where master_wo_ref = " . $_GET['id'] . "
		order by master_wo_id asc");

												if (is_array($getDrafts)) {
													$x = 1;
													foreach ($getDrafts as $Draft) {


														$os = array(1, 2, 3, 4);
														if (!in_array($USER_ARRAY['lum_user_type'], $os)) {
															$action = '<a href="work_order_view_print?id=' . $_GET['id'] . '"><button class="btn btn-primary">View Final</button></a>';
														} else {
															$action = '<a href="work_order_view_print?pid=' . $Draft['master_wo_id'] . '"><button class="btn btn-primary">View</button></a>';
														}

												?>
														<tr>
															<td><?php echo $Draft['master_wo_id']; ?></td>
															<td><?php echo ($Draft['mwoid_desc1']) ?></td>
															<td><?php echo date('d-m-Y @ h:i:s a', $Draft['master_wo_gen_dnt']) ?></td>
															<td><?php echo $action; ?></td>
														</tr>
												<?php
														$x++;
													}
												}
												?>
											</tbody>
										</table>
									<?php
									} else {  ?>

										<table class="table table-striped table-bordered " id="DraftsContainerTable">
											<thead>
												<tr>
													<th>WO#</th>
													<th>Status</th>
													<th>Action</th>

												</tr>
											</thead>

											<tbody>
												<?php
												$getDrafts = mysqlSelect($UpdatedStatusQuery . "
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id
        order by mwo_ref_id desc");

												if (is_array($getDrafts)) {
													$x = 1;
													foreach ($getDrafts as $Draft) {
												?>
														<tr>
															<td><?php echo $Draft['master_wo_ref']; ?></td>
															<td><?php echo $Draft['mwoid_desc1'] ?></td>
															<td><a href="work_order_tracker?id=<?php echo $Draft['master_wo_ref'] ?>"><button class="btn btn-primary">View</button></a></td>
														</tr>
												<?php
														$x++;
													}
												}
												?>
											</tbody>

										</table>
									<?php
									}
									?>


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


</body>

</html>