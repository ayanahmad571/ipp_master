<?php 
require_once("server_fundamentals/SessionHandler.php");

getHead("Authorization ");
?>

<link href="assets/css/select2.min.css" rel="stylesheet" />

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
            <h1>Sales Code Attach</h1>
          </div>
          
            <div class="row">
                <div class="col-12 ">
                                <div class="card card-warning">
                                  <div class="card-header">
                                    <h4>What sales codes are you authorized to use?</h4>
                                  </div>
                                  <div class="card-body text-justify">
                                      <table class="table table-striped table-bordered " id="DraftsContainerTable">
	<thead>
    	<tr>
            <th>User Code</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>Authorization Date</th>
        </tr>
        </thead>

        <tbody>
        <?php
		$getDrafts = mysqlSelect($getAttachedTreeSql);
		
		if(is_array($getDrafts)){
			foreach($getDrafts as $Draft){
				?>
                <tr>
                	<td><?php echo $Draft['lum_code'] ?></td>
                	<td><?php echo $Draft['lum_name'] ?></td>
                	<td><?php echo $Draft['lum_email'] ?></td>
                	<td><?php echo date('d-m-Y @ h:i:s a',$Draft['attach_dnt']); ?></td>
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
<?php
if($USER_ARRAY['lum_user_type'] != 10){
?>
            <div class="row">
                <div class="col-12 ">
                                <div class="card card-warning">
                                  <div class="card-header">
                                    <h4>What sales person have you authorized to use your code?</h4>
                                  </div>
                                  <div class="card-body text-justify">
                                      <table class="table table-striped table-bordered " id="DraftsContainerTable">
	<thead>
    	<tr>
            <th>User Code</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>Authorization Date</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <?php
		$getDrafts = mysqlSelect("SELECT * FROM `user_sales_attach` 
		left join user_main on  attach_parent_lum= lum_id
		where attach_valid =1 and attach_child_lum= ".$USER_ARRAY['lum_id']);
		
		if(is_array($getDrafts)){
			foreach($getDrafts as $Draft){
				?>
                <tr>
                	<td><?php echo $Draft['lum_code'] ?></td>
                	<td><?php echo $Draft['lum_name'] ?></td>
                	<td><?php echo $Draft['lum_email'] ?></td>
                	<td><?php echo date('d-m-Y @ h:i:s a',$Draft['attach_dnt']); ?> </td>
                    <td>
                    <form id="RemoveAuth" action="server_fundamentals/AttachController" method="post">
                    	<input type="hidden" name="remove_attach" value="<?php echo $Draft['attach_id'] ?>" />
                        <button class="btn btn-danger">Revoke Authorization</button>
                    </form>
                    </td>
                </tr>
                <?php
			}
		}else{	
				if($USER_ARRAY['lum_user_type'] ==4){
					//Sales Manager -TOP
					$inCols = "16,10";
				}else if($USER_ARRAY['lum_user_type'] == 16){
					//Assistant , middle
					$inCols = "10";
				}else if($USER_ARRAY['lum_user_type'] == 2){
					//Managing Director
					$inCols = "4,10,16";
				}else{
					//Anyone Else (Coord)
					$inCols = "NULL";
				}
				
                 $getAttachees= mysqlSelect("SELECT * FROM `user_main`
				 where lum_valid=1 and lum_user_type in(".$inCols.")
                 order by lum_name asc");
                 if(is_array($getAttachees)){
			?>
        <form id="ClientAddForm" action="server_fundamentals/AttachController" method="post">
            <tr>
                <td colspan="4">
          <select class="form-control select_s" required name="sales_attach">
                <?php
                     foreach($getAttachees as $Attachees){
                         echo '<option value="'.$Attachees['lum_id'].'">'.$Attachees['lum_code'].' - '.$Attachees['lum_name'].'</option>';
					 }
                ?>
          </select>
                <td><input type="submit" class="form-control btn btn-success" value="Authorize"/>
                </td>
            </tr>
           
        </form>

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
<?php }?>
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

<script>
$(document).ready(function (e) {
	$('.select_s').select2();
});
</script>
<script>
$(document).ready(function (e) {
		$('#RemoveAuth').on('submit',(function(e) {
		var formHolder = $('#RemoveAuth')[0];
		e.preventDefault();

		bootbox.confirm("Are you sure you want to remove this authorization ?", function(result){ 
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


<script>
$(document).ready(function (e) {
		$('#ClientAddForm').on('submit',(function(e) {
		var formHolder = $('#ClientAddForm')[0];
		e.preventDefault();

		bootbox.confirm("Are you sure you want to add this authorization ?", function(result){ 
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
</body>
</html>
