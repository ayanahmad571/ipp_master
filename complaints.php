<?php 
require_once("server_fundamentals/SessionHandler.php");

getHead("Complaints");
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
            <h1>Work Order Complaints Manager</h1>
          </div>
          
            <div class="row">
                <div class="col-12 ">
                                <div class="card card-warning">
                                  <div class="card-header">
                                    <h4>Complaints on WO <?php echo (isset($_GET['id'])? ($_GET['id']): "") ?> </h4>
                                  </div>
                                  <div class="card-body text-justify">
                                  <?php 
								  
								  if(isset($_GET['id'])){
									  ?>
                                                                            <table class="table table-striped table-bordered " id="DraftsContainerTable">
	<thead>
    	<tr>
            <th>Complaint ID</th>
            <th>Text</th>
            <th>Time</th>
            
        </tr>
        </thead>

        <tbody>
        <?php
		$getDrafts = mysqlSelect("SELECT * FROM `complaints_main` 
		where complaint_wo_ref = ".$_GET['id']." 
		and complaint_status =1
		order by complaint_dnt desc
				");
		
		if(is_array($getDrafts)){
			$x = 1;
			foreach($getDrafts as $Draft){
				?>
                <tr>
                	<td><?php echo $Draft['complaint_id']; ?></td>
                	<td><?php echo $Draft['complaint_text']; ?></td>
                	<td><?php echo date('d-m-Y @ h:i:s a',$Draft['complaint_dnt']) ?></td>
                </tr>
                <?php
				$x++;
			}
		}
		?>
        <tr>
        	<form id="CompSub" action="server_fundamentals/ComplaintsController.php" method="post">
                <td><input type="hidden" name="complaint_ref" value="<?php echo $_GET['id'] ?>" /></td>
                <td><input type="text" class="form-control" placeholder="Text" name="complaint_text" /></td>
                <td><button type="submit" class="btn btn-success" >Add</button></td>
            </form>
        </tr>
        </tbody>
        
    </table>
                                      <?php
								  }else{
									  
									  ?>
                                      
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
		$getDrafts = mysqlSelect($UpdatedStatusQuery."

		left join master_work_order_main_identitiy on master_wo_status = mwoid_id
		where master_wo_status = 9
        order by master_wo_id desc
		");
		
		if(is_array($getDrafts)){
			$x = 1;
			foreach($getDrafts as $Draft){
				?>
                <tr>
                	<td><?php echo $Draft['master_wo_ref'] ; ?></td>
                	<td><?php echo $Draft['mwoid_desc1'] ?></td>
<td><a href="complaints?id=<?php echo $Draft['master_wo_ref'] ?>"><button class="btn btn-primary">View</button></a></td>
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
<script>
$(document).ready(function (e) {
    $('#CompSub').on('submit',(function(e) {
		var formCont  = $(this)[0];
		
        e.preventDefault();
		
		bootbox.confirm("Are you sure you want to add this Complaint ?", function(result){ 
			if(result){
				$('#CompSub').fadeOut();
        var formData = new FormData(formCont);
        $.ajax({
            type:'POST',
            url: $(formCont).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
				bootbox.alert(data);			
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


</body>
</html>
