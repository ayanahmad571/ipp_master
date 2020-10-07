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
                                    <h4>Last 200 Logs</h4>
                                  </div>
                                  <div class="card-body text-justify">
                                      <table class="table table-striped table-bordered " id="DraftsContainerTable">
	<thead>
    	<tr>
            <th>User</th>
            <th>Page</th>
            <th>Session</th>
            <th>IP</th>
            <th>Text</th>
            <th>Timestamp</th>
        </tr>
        </thead>

        <tbody>
        <?php
		$getUsers= mysqlSelect("SELECT * FROM `logcat_main` 
		left join user_main on lum_id = logcat_lum_id
		order by logcat_dnt desc limit 200");
		
		if(is_array($getUsers)){
			foreach($getUsers as $Users){
				?>
                <tr>
                	<td><?php echo $Users['lum_code']." ".$Users['lum_name'] ?></td>
                	<td><?php echo $Users['logcat_page'] ?></td>
                	<td><?php echo $Users['logcat_session_hash'] ?></td>
                	<td><?php echo $Users['logcat_ip'] ?></td>
                	<td><?php echo $Users['logcat_text'] ?></td>
                	<td><?php echo date('d-m-Y @ h:i:s a',$Users['logcat_dnt']); ?></td>
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



</body>
</html>
