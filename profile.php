<?php 
require_once("server_fundamentals/SessionHandler.php");

getHead("Profile");
?>


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
            <h1>Profile - <?php echo $USER_ARRAY['lum_name'] ?></h1>
          </div>
          <!-- TOP CONTENT BLOCKS -->
          

            <div class="row">
                <div class="col-12 ">
                                <div class="card card-warning">
                                  <div class="card-header">
                                    <h4>Stats</h4>
                                  </div>
                                  <div class="card-body text-justify">
										Text

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
