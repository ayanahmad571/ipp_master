<?php
require_once("server_fundamentals/SessionHandler.php");
require_once("WorkOrderControllers/WorkOrderHelper.php");

getHead("WO Mark Complete");
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
          <?php getPageTitle("Work Order - Complete"); ?>
          <!-- TOP CONTENT BLOCKS -->


          <hr id="Splitter" />

          <div class="row">
            <div class="col-12 ">
              <div class="card card-primary">
                <div class="card-header">
                  <h4>All </h4>
                </div>
                <div class="card-body text-justify">
                  <table class="table table-striped table-bordered " id="DraftsContainerTable">
                    <thead>
                      <tr>
                        <th>WO#</th>
                        <th>Client</th>
                        <th>Design ID</th>
                        <th>User</th>
                        <th>TimeStamp</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $getDrafts = mysqlSelect(workOrderPagesQuery("9,10"));

                      if (is_array($getDrafts)) {
                        foreach ($getDrafts as $Draft) {
                      ?>
                          <tr>
                            <td><?php echo $Draft['master_wo_ref'] ?></td>
                            <td><?php echo $Draft['client_code'] . " - " . $Draft['client_name']; ?></td>
                            <td><?php echo $Draft['master_wo_design_id']; ?></td>
                            <td>
                              <?php
                              echo getByForFromWO($Draft['mwo_gen_lum_id'], $Draft['mwo_gen_on_behalf_lum_id']);
                              ?>
                            </td>
                            <td><?php echo date(getDateTimeFormat(), $Draft['master_wo_gen_dnt']); ?></td>

                            <td>
                              <button onclick="openWindow(<?php echo $Draft['master_wo_ref'] ?>)" class="btn btn-primary mt-1">View</button>
                              <?php if ($Draft['master_wo_status'] == 9) { ?><button class="publishDraft btn btn-success mt-1" data-id="<?php echo ($Draft['master_wo_ref']); ?>">Mark Complete</button><?php } ?>
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


  <?php
  getDataTableDefiner("DraftsContainerTable");

  getBootboxScript(
    "publishDraft",
    "Are you sure you want to Mark this Work Order as COMPLETED?<br>Action Can <strong>not</strong> be undone",
    "MarkComplete"
  );
  getPrintJS();
  ?>
</body>

</html>