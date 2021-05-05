<?php
#57,58,59
require_once("server_fundamentals/SessionHandler.php");

getHead("Amendment Form");


?>

<link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
<link rel="stylesheet" href="assets/modules/izit.css">

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
          <?php getPageTitle("Amendments - Work Order"); ?>
          <!-- TOP CONTENT BLOCKS -->
          <div class="row">
            <?php
            // getTopCard("col-lg-3 col-md-6 col-sm-6 col-12", "far fa-user", "Dummy Head", "0000");
            // getTopCard("col-lg-3 col-md-6 col-sm-6 col-12", "far fa-user", "Dummy Head", "0000");
            // getTopCard("col-lg-3 col-md-6 col-sm-6 col-12", "far fa-user", "Dummy Head", "0000");
            ?>
          </div>

          <hr id="Splitter" />

          <div class="row">
            <div class="col-12 ">
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Sales Approved</h4>
                </div>
                <div class="card-body text-justify">
                  <table class="table table-striped table-bordered " id="DraftsContainerTable">
                    <thead>
                      <tr>
                        <th>WO#</th>
                        <th>SUB#</th>
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
                      $getDrafts = mysqlSelect(workOrderPagesQuery("1,2,3,10", true));

                      if (is_array($getDrafts)) {
                        foreach ($getDrafts as $Draft) {
                      ?>
                          <tr>
                            <td><?php echo $Draft['master_wo_ref'] ?></td>
                            <td><?php echo $Draft['master_wo_id'] ?></td>
                            <td><?php echo $Draft['client_code'] . " - " . $Draft['client_name']; ?></td>
                            <td><?php echo $Draft['master_wo_design_id']; ?></td>
                            <td>
                              <?php
                              $getBy = mysqlSelect("select * from user_main where lum_id = " . $Draft['mwo_gen_lum_id'] . " and lum_valid =1");
                              $getFor = mysqlSelect("select * from user_main where lum_id = " . $Draft['mwo_gen_on_behalf_lum_id'] . " and lum_valid =1");

                              echo getByForFromWO($getBy, $getFor);
                              ?>
                            </td>
                            <td><?php echo date(getDateTimeFormat(), $Draft['master_wo_gen_dnt']); ?></td>
                            <td><?php echo $Draft['mwoid_desc2']; ?></td>
                            <td>

                              <button class="publishDraft btn btn-success mt-1" onclick="openWindow(<?php echo $Draft['master_wo_ref'] ?>)">Amendment Form</button>
                              <a target="_blank" href="work_order_view_print?id=<?php echo $Draft['master_wo_ref'] ?>">
                                <button class="btn btn-primary mt-1">View</button>
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

  <script src="assets/js/bootbox.min.js"></script>

  <script type="text/javascript" src="assets/Datatables/datatables.min.js"></script>

  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $("#DraftsContainerTable").DataTable();
  </script>



  <script>
    function openWindow(woID) {
      var newWin = window.open(`amendment_form_new?id=${woID}`, `New Amendment Form ${woID}`, 'width=800,height=750');
    }
  </script>


</body>

</html>