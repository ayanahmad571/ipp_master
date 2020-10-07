<?php 
require_once("server_fundamentals/SessionHandler.php");

getHead("WO Pre Costing");
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
            <h1>Work Order - Pre Costing</h1>
          </div>

<hr id="Splitter" />
          
            <div class="row">
                <div class="col-12 ">
                                <div class="card card-success">
                                  <div class="card-header">
                                    <h4>Recieved </h4>
                                  </div>
                                  <div class="card-body text-justify">
                                      <table class="table table-striped table-bordered " id="RecievedContainerTable">
	<thead>
    	<tr>
            <th>WO#</th>
            <th>Client</th>
            <th>TimeStamp</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        <?php
		$getRecieved= mysqlSelect($UpdatedStatusQuery."
		 
		left join clients_main on master_wo_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id
		where master_wo_status = 5 order by master_wo_id desc");
		
		if(is_array($getRecieved)){
			foreach($getRecieved as $Recieved){
				?>
                <tr>
                	<td><?php echo $Recieved['master_wo_ref'] ?></td>
                	<td><?php echo $Recieved['client_code']." - ".$Recieved['client_name']; ?></td>
                	<td><?php echo date('d-m-Y @ h:i:s a',$Recieved['master_wo_gen_dnt']); ?></td>
                	<td><?php echo $Recieved['mwoid_desc2'] ?></td>
                	<td>
                    <a href="work_order_view_print?id=<?php echo $Recieved['master_wo_ref'] ?>" target="_blank">
                    <button class="btn btn-warning mt-1">View</button>
                    </a>
	                <button class="loadData btn btn-primary mt-1" data-id="<?php echo ($Recieved['master_wo_ref']); ?>">Check/Update PO</button>
                    <button class="publish btn btn-success mt-1" data-id="<?php echo ($Recieved['master_wo_ref']); ?>">Publish</button>
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
                                    <h4>Published</h4>
                                  </div>
                                  <div class="card-body text-justify">
<table class="table table-striped table-bordered " id="PublishedContainerTable">
	<thead>
    	<tr>
            <th>WO#</th>
            <th>Client</th>
            <th>TimeStamp</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        <?php
		$getPublished= mysqlSelect($UpdatedStatusQuery."
		 
		left join clients_main on master_wo_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id
		where master_wo_status = 6 order by master_wo_id desc");
		
		if(is_array($getPublished)){
			foreach($getPublished as $Published){
				?>
                <tr>
                	<td><?php echo $Published['master_wo_ref'] ?></td>
                	<td><?php echo $Published['client_code']." - ".$Published['client_name']; ?></td>
                	<td><?php echo date('d-m-Y @ h:i:s a',$Published['master_wo_gen_dnt']); ?></td>
                	<td><?php echo $Published['mwoid_desc2'] ?></td>
                	<td>
                    <a href="work_order_view_print?id=<?php echo $Published['master_wo_ref'] ?>" target="_blank">
                    <button class="btn btn-warning mt-1">View</button>
                    </a>
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

 <script src="assets/js/bootbox.min.js"></script>

<script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
$("#RecievedContainerTable").DataTable();
$("#PublishedContainerTable").DataTable();

</script>

<script>

$(document).ready(function(e) {
	$('.loadData').click(function(e) {
		var dataId = ($(this).data("id"));
				
		$.post("server_fundamentals/PreCostController",
		{
			WorkOrderGetDetails: dataId,
		},
		function(data, status){
			$(".modal-body").html(data);
			
			$('#myModal').modal('show');
		});

	}); /* .pubslishDraft Click*/
}); /*Doc Ready*/

$(document).ready(function(e) {
	$('.publish').click(function(e) {
		var dataId = ($(this).data("id"));

		bootbox.confirm("Are you sure you want to publish WO Number " + dataId + " ?", function(result){ 
			if(result){
				
				
				$.post("server_fundamentals/MainWorkOrderSubmitAll",
				{
					PreCostingToAccounts: dataId,
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
