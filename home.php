<?php
require_once("server_fundamentals/SessionHandler.php");

getHead("Home");
?>

<style>
.nav-list-item {
  text-align: left;
}
</style>
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
            <h1>Dashboard</h1>
          </div>
          <!-- TOP CONTENT BLOCKS -->

          <div class="row">
            <div class="col-12 ">
              <div class="card card-warning">
                <div class="card-header">
                  <h4>Navigation for <?php echo $USER_ARRAY['lum_name'] ?> </h4>
                </div>
                <div class="card-body text-justify">
                  <div class="row">

                    <?php

                    $si = "in (" . $USER_ARRAY['user_type_mod_id'] . ")";
                    if (trim($USER_ARRAY['user_type_mod_id']) == "*") {
                      $si = "not in (0)";
                    }
                    $getModules  = mysqlSelect("SELECT * FROM `modules_main` m 
            left join modules_groups g on m.mod_mg_id = g.mg_id 
            WHERE mod_id " . $si . "
            and mod_valid =1 
            and mod_visible = 1
            order by mg_id,mod_name asc");
                    if (is_array($getModules)) {
                      #active check
                      $prevHeader = '';
                      foreach ($getModules as $module) {
                        $active = '';
                        if (trim(pathinfo(basename($_SERVER['PHP_SELF']), PATHINFO_FILENAME)) == trim($module['mod_href'])) {
                          $active = 'active';
                        }

                        if ($prevHeader != $module['mg_name']) {
                          if ($prevHeader != '') {
                            echo '</ul>
                              </div>';
                          }
                          $prevHeader = $module['mg_name'];


                          echo '
                          <div class="nav-master border col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                  <h5 class="nav-heading">' . $prevHeader . '</h5><ul>';
                        }
                        echo '<li class="nav-list-item ' . $active . '"><a class="nav-link" href="' . $module['mod_href'] . '"><i class="' . $module['mod_icon'] . '"></i> <span>' . $module['mod_name'] . '</span></a></li>';
                      }
                    } else {
                    ?>
                      <li class="menu-header">Please Contact Administrator</li>
                    <?php
                    }

                    ?>


                  </div>

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