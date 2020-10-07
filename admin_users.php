<?php 
require_once("server_fundamentals/SessionHandler.php");

getHead("ADMIN - Users");
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
            <h1>System Users</h1>
          </div>
          
            <div class="row">
                <div class="col-12 ">
                                <div class="card card-warning">
                                  <div class="card-header">
                                    <h4>Main Users</h4>
                                  </div>
                                  <div class="card-body text-justify">
                                      <table class="table table-striped table-bordered " id="DraftsContainerTable">
	<thead>
    	<tr>
            <th>Code</th>
            <th>Name</th>
            <th>Type</th>
            <th>Email</th>
            <th>DNT</th>
            <th>Status</th>
        </tr>
        </thead>

        <tbody>
        <?php
		$getUsers= mysqlSelect("SELECT * FROM `user_main` 
		left join user_types on lum_user_type = user_type_id 
		".($USER_ARRAY['lum_user_type'] == 2 ? "": " where lum_user_type not in(1,2,3)")."
		order by lum_name asc");
		
		if(is_array($getUsers)){
			foreach($getUsers as $Users){
				?>
                <tr>
                	<td><?php echo $Users['lum_code'] ?></td>
                	<td><?php echo $Users['lum_name'] ?></td>
                	<td><?php echo $Users['user_type_name'] ?></td>
                	<td><?php echo $Users['lum_email'] ?></td>
                	<td><?php echo date('d-m-Y @ h:i:s a',$Users['lum_dnt']); ?></td>
                	<td><?php echo ($Users['lum_valid'] == 1? "Active":"Inactive") ?></td>
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
                                <div class="card card-warning">
                                  <div class="card-header">
                                    <h4>Change User Password</h4>
                                  </div>
                                  <div class="card-body text-justify">
                                      <table class="table table-striped table-bordered " id="DraftsContainerTable">
	<thead>
    	<tr>
			<th>User</th>
            <th>New Password</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
		<?php
		if(is_array($getUsers)){
			?>
                <form id="Pass" action="server_fundamentals/AdminController" method="post">
                <tr>
                    <td>
                  <select class="form-control select_s" required name="admin_new_password_user">
					<?php
                    foreach($getUsers as $Users){
                         echo '<option value="'.$Users['lum_id'].'">'.$Users['lum_code'].' - '.$Users['lum_name'].'</option>';
                    }
                    ?>
                  </select>
        
                    </td>
                    <td><input type="text" class="form-control" placeholder="New Password" name="admin_new_password_text" /></td>
                <td><button type="submit" class="btn btn-success">Change Password</button></td>
                </tr>
                </form>
            
            <?php
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
                                <div class="card card-warning">
                                  <div class="card-header">
                                    <h4>De-Activate User</h4>
                                  </div>
                                  <div class="card-body text-justify">
                                      <table class="table table-striped table-bordered " id="DraftsContainerTable">
	<thead>
    	<tr>
			<th>User</th>
            <th>Reason for De-Activation</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
		<?php
		if(is_array($getUsers)){
			?>
                <form id="deAct" action="server_fundamentals/AdminController" method="post">
                <tr>
                    <td>
                  <select class="form-control select_s" required name="admin_deactivate_user">
					<?php
                    foreach($getUsers as $Users){
                         echo '<option value="'.$Users['lum_id'].'">'.$Users['lum_code'].' - '.$Users['lum_name'].'</option>';
                    }
                    ?>
                  </select>
        
                    </td>
                    <td><input type="text" class="form-control" placeholder="Reason - " name="admin_deactivate_reason" /></td>
                <td><button type="submit" class="btn btn-danger">De-Activate</button></td>
                </tr>
                </form>
            
            <?php
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
                                <div class="card card-warning">
                                  <div class="card-header">
                                    <h4>Make New User</h4>
                                  </div>
                                  <div class="card-body text-justify">

    <form id="AddUser" action="server_fundamentals/AdminController" method="post">
    <div class="row">
        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Name</label>
          <input type="text" class="form-control" name="user_add_name" placeholder="John Doe" required>
        </div>
    
        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Email</label>
          <input type="email" class="form-control" name="user_add_email" placeholder="example@example.com" required>
        </div>

        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
          <label>User Type</label>
          <select class="form-control select_s" required name="user_add_type" required>
                <?php
                 $getClients = mysqlSelect("SELECT * FROM `user_types` 
				 where user_type_id not in (1,2,3)
				 order by user_type_name");
                 if(is_array($getClients)){
                     foreach($getClients as $Client){
                         echo '<option value="'.$Client['user_type_id'].'">'.$Client['user_type_name'].'</option>';
                     }
                 }
                ?>
          </select>
        </div>

        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
          <label>Code</label>
          <input type="text" class="form-control" name="user_add_code" placeholder="018" required>
        </div>

        <div class="form-group col-sm-12 col-lg-6 col-xl-4">
          <label>Password</label>
          <input type="text" class="form-control" name="user_add_pw" placeholder="*****" required>
        </div>
        
        
    </div>
	
    <div class="row">
        <div class="form-group col-12" align="center">
        	<button class="btn btn-success">Add User</button>
        </div>
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

<script>
$(document).ready(function (e) {
	$('.select_s').select2();
});
</script>
<script>
$(document).ready(function (e) {
		$('#Pass').on('submit',(function(e) {
		var formHolder = $('#Pass')[0];
		e.preventDefault();

		bootbox.confirm("Are you sure you want to change the password for this user?", function(result){ 
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
$(document).ready(function (e) {
		$('#AddUser').on('submit',(function(e) {
		var formHolder = $('#AddUser')[0];
		e.preventDefault();

		bootbox.confirm("Are you sure you want Add this User??", function(result){ 
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
$(document).ready(function (e) {
		$('#deAct').on('submit',(function(e) {
		var formHolder = $('#deAct')[0];
		e.preventDefault();

		bootbox.confirm("Are you sure you want to De Activate this User?", function(result){ 
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
