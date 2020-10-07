<?php 
require_once("server_fundamentals/SessionHandler.php");

getHead("WO Sales");
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
            <h1>Work Order - Sales <?php if($inColsWO == ""){echo "Full View";}else{echo "Limited View";} ?></h1>
          </div>
          <!-- TOP CONTENT BLOCKS -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                      <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Drafts</h4>
                      </div>
                      <div class="card-body">
                        <?php  
		$getD = mysqlSelect("SELECT count(s_wo_id) as ccc FROM `sales_work_order_main` 
		left join clients_main on s_wo_client_id = client_id
		where s_wo_status = 1 order by s_wo_id desc");
			echo $getD[0]['ccc'];
						?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                      <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Discards</h4>
                      </div>
                      <div class="card-body">
<?php
		$getDs= mysqlSelect("SELECT count(s_wo_id) as ccc FROM `sales_work_order_main` 
		left join clients_main on s_wo_client_id = client_id
		where s_wo_status = 2 order by s_wo_id desc");
			echo $getDs[0]['ccc'];
						?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                      <i class="far fa-money-bill-alt"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Published</h4>
                      </div>
                      <div class="card-body">
<?php
		$getPs= mysqlSelect($UpdatedStatusQuery."
       
        
		left join clients_main on master_wo_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id

        where master_wo_status not in (2) order by master_wo_id desc
		");
			echo (!is_array($getPs) ? "0":count($getPs));
						?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                      <i class="fas fa-calendar-week"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Returned</h4>
                      </div>
                      <div class="card-body">
<?php
		$getrets= mysqlSelect($UpdatedStatusQuery."
       
        
		left join clients_main on master_wo_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id

        where master_wo_status = 2 order by master_wo_id desc
		");
			echo (!is_array($getrets) ? "0":count($getrets));
						?>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            

<hr id="Splitter" />
          
            <div class="row">
                <div class="col-12 ">
                                <div class="card card-primary">
                                  <div class="card-header">
                                    <h4>Drafts </h4>
                                  </div>
                                  <div class="card-body text-justify">
                                      <table class="table table-striped table-bordered " id="DraftsContainerTable">
	<thead>
    	<tr>
            <th>Draft ID</th>
            <th>Client</th>
            <th>Design ID</th>
            <th>User</th>
            <th>TimeStamp</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        <?php
		$getDrafts = mysqlSelect("SELECT s_wo_gen_lum_id, s_wo_lum_id,s_wo_id,s_wo_client_id, s_wo_gen_dnt, client_code, client_name,s_wo_design_id FROM `sales_work_order_main` 
		left join clients_main on s_wo_client_id = client_id
		where s_wo_status = 1 
		".$inColsDRAFT."
		order by s_wo_id desc");
		
		if(is_array($getDrafts)){
			foreach($getDrafts as $Draft){
				?>
                <tr>
                	<td><?php echo $Draft['s_wo_id'] ?></td>
                	<td><?php echo $Draft['client_code']." - ".$Draft['client_name']; ?></td>
                	<td><?php echo $Draft['s_wo_design_id']; ?></td>
                    <td>
                    <?php
					$getBy = mysqlSelect("select * from user_main where lum_id = ".$Draft['s_wo_gen_lum_id']." and lum_valid =1");
					$getFor = mysqlSelect("select * from user_main where lum_id = ".$Draft['s_wo_lum_id']." and lum_valid =1");
					
					echo (is_array($getBy)? $getBy[0]['lum_code']."-".$getBy[0]['lum_name']:" - ").' for '.(is_array($getFor)? $getFor[0]['lum_code']."-".$getFor[0]['lum_name']:" - ");
					?>
                    </td>
                	<td><?php echo date('d-m-Y @ h:i:s a',$Draft['s_wo_gen_dnt']); ?></td>
                	<td>
                    <a target="_blank" href="work_order_sales_generate?repeatFromDraft=<?php echo $Draft['s_wo_id'] ?>&draftID=<?php echo $Draft['s_wo_id'] ?>">
                    <button class="btn btn-warning mt-1">View/Edit</button>
                    </a>
                    <button class="publishDraft btn btn-success mt-1" data-id="<?php echo ($Draft['s_wo_id']); ?>">Publish</button>
                    <a target="_blank" href="work_order_sales_generate?repeatFromDraft=<?php echo $Draft['s_wo_id'] ?>"><button class="btn btn-primary mt-1">Repeat</button></a>
                    <button class="discardDraft btn btn-danger mt-1" data-id="<?php echo ($Draft['s_wo_id']); ?>">Discard</button>
                    </td>
                </tr>
                <?php
			}
		}
		?>
        </tbody>
        
    </table>

                                    <p>
                                    </p>
                                  </div>
                                </div>
                              </div>
            </div>

            <div class="row">
                <div class="col-12 ">
                                <div class="card card-warning">
                                  <div class="card-header">
                                    <h4>Returned </h4>
                                  </div>
                                  <div class="card-body text-justify">
                                      <table class="table table-striped table-bordered " id="ReturnedContainerTable">
	<thead>
    	<tr>
            <th>WO#</th>
            <th>Client</th>
            <th>Design ID</th>
            <th>User</th>
            <th>TimeStamp</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        <?php
		$getDiscards= mysqlSelect($UpdatedStatusQuery."
       
        
		left join clients_main on master_wo_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id

        where master_wo_status = 2 
		".$inColsWO."
		order by master_wo_id desc
		");
		
		if(is_array($getDiscards)){
			foreach($getDiscards as $Discard){
				?>
                <tr>
                	<td><?php echo $Discard['master_wo_ref'] ?></td>
                	<td><?php echo $Discard['client_code']." - ".$Discard['client_name']; ?></td>
                	<td><?php echo $Discard['master_wo_design_id'] ?></td>
                    <td>
                    <?php
					$getBy = mysqlSelect("select * from user_main where lum_id = ".$Discard['mwo_gen_lum_id']." and lum_valid =1");
					$getFor = mysqlSelect("select * from user_main where lum_id = ".$Discard['mwo_gen_on_behalf_lum_id']." and lum_valid =1");
					
					echo (is_array($getBy)? $getBy[0]['lum_code']."-".$getBy[0]['lum_name']:" - ").' for '.(is_array($getFor)? $getFor[0]['lum_code']."-".$getFor[0]['lum_name']:" - ");
					?>
                    </td>
                	<td><?php echo date('d-m-Y @ h:i:s a',$Discard['master_wo_gen_dnt']); ?></td>
                	<td><?php echo $Discard['mwoid_desc2'] ?></td>
                	<td>
                    <a href="work_order_main_edit?id=<?php echo $Discard['master_wo_ref'] ?>" target="_blank">
                    <button class="btn btn-warning mt-1">View/Edit</button>
                    </a>
                    <button class="rePublish btn btn-success mt-1" data-id="<?php echo ($Discard['master_wo_ref']); ?>">Re-Publish</button>
                    </td>
                </tr>
                <?php
			}
		}
		?>
        </tbody>
        
    </table>

                                  </div>
                                </div>
                              </div>
            </div>
 
            <div class="row">
                <div class="col-12 ">
                                <div class="card card-success">
                                  <div class="card-header">
                                    <h4>Published </h4>
                                  </div>
                                  <div class="card-body text-justify">
<table class="table table-striped table-bordered" id="PublishedContainerTable">
	<thead>
    	<tr>
            <th>WO#</th>
            <th>Client</th>
            <th>Design ID</th>
            <th>User</th>
            <th>TimeStamp</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        <?php
		$getDiscards= mysqlSelect($UpdatedStatusQuery."
       
        
		left join clients_main on master_wo_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id

        where master_wo_status not in (2) 
		".$inColsWO."
		order by master_wo_id desc
		");
		
		if(is_array($getDiscards)){
			foreach($getDiscards as $Discard){
				?>
                <tr>
                	<td><?php echo $Discard['master_wo_ref'] ?></td>
                	<td><?php echo $Discard['client_code']." - ".$Discard['client_name']; ?></td>
                	<td><?php echo $Discard['master_wo_design_id'] ?></td>
                    <td>
                    <?php
					$getBy = mysqlSelect("select * from user_main where lum_id = ".$Discard['mwo_gen_lum_id']." and lum_valid =1");
					$getFor = mysqlSelect("select * from user_main where lum_id = ".$Discard['mwo_gen_on_behalf_lum_id']." and lum_valid =1");
					
					echo (is_array($getBy)? $getBy[0]['lum_code']."-".$getBy[0]['lum_name']:" - ").' for '.(is_array($getFor)? $getFor[0]['lum_code']."-".$getFor[0]['lum_name']:" - ");
					?>
                    </td>
                	<td><?php echo date('d-m-Y @ h:i:s a', $Discard['master_wo_gen_dnt']); ?></td>
                	<td><?php echo $Discard['mwoid_desc2'] ?></td>
                	<td>
                    <a href="work_order_view_print?id=<?php echo $Discard['master_wo_ref'] ?>" target="_blank">
						<button class="btn btn-warning mt-1" data-id="<?php echo md5($Discard['master_wo_id']); ?>">View</button>
					</a>
                    <?php if($Discard['master_wo_status'] == 9){ ?>
                        <a target="_blank" href="work_order_sales_generate?repeatFromPublished=<?php echo $Discard['master_wo_ref'] ?>">
                            <button class="btn btn-primary mt-1">Repeat</button>
                        </a>
					<?php } ?>
                    </td>
                </tr>
                <?php
			}
		}
		?>
        </tbody>
</table>

                                    <p>
                                    </p>
                                  </div>
                                </div>
                              </div>
            </div>



            <div class="row">
                <div class="col-12 ">
                                <div class="card card-danger">
                                  <div class="card-header">
                                    <h4>Discards </h4>
                                  </div>
                                  <div class="card-body text-justify">
                                      <table class="table table-striped table-bordered " id="DiscardsContainerTable">
	<thead>
    	<tr>
            <th>Draft ID</th>
            <th>Client</th>
            <th>Design ID</th>
            <th>User</th>
            <th>TimeStamp</th>
            <th style="display:none">Action</th>
        </tr>
        </thead>

        <tbody>
        <?php
		$getDiscards= mysqlSelect("SELECT s_wo_gen_lum_id, s_wo_design_id, s_wo_lum_id, s_wo_id,s_wo_client_id, s_wo_gen_dnt, client_code, client_name FROM `sales_work_order_main` 
		left join clients_main on s_wo_client_id = client_id
		where s_wo_status = 2 
		".$inColsDRAFT."
		order by s_wo_id desc");
		
		if(is_array($getDiscards)){
			foreach($getDiscards as $Discard){
				?>
                <tr>
                	<td><?php echo $Discard['s_wo_id'] ?></td>
                	<td><?php echo $Discard['client_code']." - ".$Discard['client_name']; ?></td>
                	<td><?php echo $Discard['s_wo_design_id']; ?></td>
                	<td><?php echo date('d-m-Y @ h:i:s a',$Discard['s_wo_gen_dnt']); ?></td>
                    <td>
                    <?php
					$getBy = mysqlSelect("select * from user_main where lum_id = ".$Discard['s_wo_gen_lum_id']." and lum_valid =1");
					$getFor = mysqlSelect("select * from user_main where lum_id = ".$Discard['s_wo_lum_id']." and lum_valid =1");
					
					echo (is_array($getBy)? $getBy[0]['lum_code']."-".$getBy[0]['lum_name']:" - ").' for '.(is_array($getFor)? $getFor[0]['lum_code']."-".$getFor[0]['lum_name']:" - ");
					?>
                    </td>
                	<td style="display:none">
                    <a href="work_order_view_print?Draftid=<?php echo $Discard['s_wo_id'] ?>" target="_blank">
                    <button class="btn btn-warning mt-1">View</button>
                    </a>
                    <a target="_blank" href="work_order_sales_generate?repeatFromDraft=<?php echo $Discard['s_wo_id'] ?>"><button class="btn btn-primary mt-1">Repeat</button></a>
                    </td>
                </tr>
                <?php
			}
		}
		?>
        </tbody>
        
    </table>

                                    <p>
                                    </p>
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

<script type="text/javascript" src="assets/Datatables/datatables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
$("#DraftsContainerTable").DataTable();
$("#DiscardsContainerTable").DataTable();
$("#PublishedContainerTable").DataTable();
$("#ReturnedContainerTable").DataTable();

</script>

<script>



	$(document).ready(function(e) {
		$('.publishDraft').click(function(e) {
			var dataId = ($(this).data("id"));
	
			bootbox.confirm("Are you sure you want to publish Draft Number " + dataId + " ?<br>Action Can <strong>not</strong> be undone.", function(result){ 
				if(result){
					
					
					$.post("server_fundamentals/MainWorkOrderSubmit",
					{
						draftToMain: dataId,
					},
					function(data, status){
						bootbox.alert(data);
					});
	
	
				}
			});
		}); /* .pubslishDraft Click*/
	}); /*Doc Ready*/

	$(document).ready(function(e) {
		$('.discardDraft').click(function(e) {
			var dataId = ($(this).data("id"));
	
			bootbox.confirm("Are you sure you want to DISCARD Draft Number " + dataId + " ? <br> This action can not be undone", function(result){ 
				if(result){
					
					
					$.post("server_fundamentals/SalesWorkOrderController",
					{
						draftDiscard: dataId,
					},
					function(data, status){
						bootbox.alert(data);
					});
	
	
				}
			});
		}); /* .pubslishDraft Click*/
	}); /*Doc Ready*/

	$(document).ready(function(e) {
		$('.rePublish').click(function(e) {
			var dataId = ($(this).data("id"));
	
			bootbox.confirm("Are you sure you want to Re-Publish Work Order Number " + dataId + " ?", function(result){ 
				if(result){
					
					
					$.post("server_fundamentals/MainWorkOrderSubmitAll",
					{
						rePublishSales: dataId,
					},
					function(data, status){
						bootbox.alert(data);
					});
	
	
				}
			});
		}); /* .pubslishDraft Click*/
	}); /*Doc Ready*/

</script>
</body>
</html>