<?php
require_once("server_fundamentals/SessionHandler.php");
require_once("WorkOrderControllers/WorkOrderHelper.php");

getHead("WO Sales Verification");

$salesGroups = mysqlSelect("select sgp_sgm_id from sales_groups_people where sgp_lum_id = " . $USER_ARRAY['lum_id']);



if ($USER_ARRAY['lum_user_type'] == 1 || $USER_ARRAY['lum_user_type'] == 2) {
  #Master Admin and MD
  $recQuery = workOrderPagesQuery("2");
  $sentQuery = workOrderPagesQuery("3");
  $backQuery = workOrderPagesQuery("4");
} else if ($USER_ARRAY['lum_user_type'] == 4) {
  #Sales Coordinator
  if (!is_array($salesGroups)) {
    die("User not assigned to any sales group");
  }
  // $containerLeft = "select * from ( ";
  // $containerRight = " ) sb where (sb.mwo_gen_lum_id = ".$USER_ARRAY['lum_id']." or sb.mwo_gen_on_behalf_lum_id = ".$USER_ARRAY['lum_id'].")";

  // $recQuery = $containerLeft.workOrderPagesQuery("2").$containerRight;
  // $sentQuery = $containerLeft.workOrderPagesQuery("3").$containerRight;
  // $backQuery = $containerLeft.workOrderPagesQuery("4").$containerRight;

  die("User not allowed!!");
} else if ($USER_ARRAY['lum_user_type'] == 18) {
  #Assistant Sales Manager
  if (!is_array($salesGroups)) {
    die("User not assigned to any sales group");
  }


  $containerLeft = "select * from ( ";
  $containerRight = " ) sb where (sb.mwo_gen_on_behalf_lum_id = " . $USER_ARRAY['lum_id'] . ")";

  $recQuery = $containerLeft . workOrderPagesQuery("2") . $containerRight;
  $sentQuery = $containerLeft . workOrderPagesQuery("3") . $containerRight;
  $backQuery = $containerLeft . workOrderPagesQuery("4") . $containerRight;
} else if ($USER_ARRAY['lum_user_type'] == 16) {
  #Sales Manager
  if (!is_array($salesGroups)) {
    die("User not assigned to any sales group");
  }

  $allLowerUsers = ("select sgp_lum_id from sales_groups_people p
  left join user_main on p.sgp_lum_id = lum_id
  where 
  lum_user_type in (18,4,16) and
  p.sgp_sgm_id in (select s.sgp_sgm_id from sales_groups_people s where s.sgp_lum_id = " . $USER_ARRAY['lum_id'] . ")");


  $containerLeft = "select * from ( ";
  $containerRight = " ) sb 
  where (
    sb.mwo_gen_lum_id in (" . $allLowerUsers . ") or
    sb.mwo_gen_on_behalf_lum_id in (" . $allLowerUsers . ")
    )
    ";

  $recQuery = $containerLeft . workOrderPagesQuery("2") . $containerRight;
  $sentQuery = $containerLeft . workOrderPagesQuery("3") . $containerRight;
  $backQuery = $containerLeft . workOrderPagesQuery("4") . $containerRight;
} else {
  die("Un-Authorized User");
}


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
          <?php getPageTitle("Sales Order - Sales Verifier"); ?>
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
                  <h4>Received (Pending) </h4>
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
                        <th>Flag</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $getDrafts =  mysqlSelect($recQuery);

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
                              <button class="publishDraft btn btn-success mt-1" data-id="<?php echo ($Draft['master_wo_ref']); ?>">Publish</button>
                              <button class="discardDraft btn btn-danger mt-1" data-id="<?php echo ($Draft['master_wo_ref']); ?>">Return</button>
                              <button onclick="openWindow(<?php echo $Draft['master_wo_ref'] ?>)" class="btn btn-primary mt-1">View</button>

                            </td>
                            <td>
                              <?php


                              $checkSQL = mysqlSelect("SELECT * FROM `master_work_order_main` WHERE `master_wo_status` = 3 and `master_wo_ref` = " . $Draft['master_wo_ref'] . " order by `master_wo_gen_dnt` desc limit 1");
                              $flag = is_array($checkSQL);
                              if ($flag) {
                                echo "<strong>Previously Rejected</strong> <br><hr> " . $checkSQL[0]['master_reject_text'];
                              }
                              ?>
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
                  <h4>Sent Back </h4>
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
                      $getSentAll = mysqlSelect($sentQuery);

                      if (is_array($getSentAll)) {
                        foreach ($getSentAll as $Discard) {
                      ?>
                          <tr>
                            <td><?php echo $Discard['master_wo_ref'] ?></td>
                            <td><?php echo $Discard['client_code'] . " - " . $Discard['client_name']; ?></td>
                            <td><?php echo $Discard['master_wo_design_id'] ?></td>
                            <td>
                              <?php
                              echo getByForFromWO($Discard['mwo_gen_lum_id'], $Discard['mwo_gen_on_behalf_lum_id']);

                              ?>
                            </td>
                            <td><?php echo date(getDateTimeFormat(), $Discard['master_wo_gen_dnt']); ?></td>
                            <td><?php echo $Discard['mwoid_desc2'] ?></td>
                            <td>
                              <button onclick="openWindow(<?php echo $Discard['master_wo_ref'] ?>)" class="btn btn-primary mt-1">View</button>
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
                  <h4>Sent Forward (Accounts Stage) </h4>
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
                      $getBackAll = mysqlSelect($backQuery);

                      if (is_array($getBackAll)) {
                        foreach ($getBackAll as $Discard) {
                      ?>
                          <tr>
                            <td><?php echo $Discard['master_wo_ref'] ?></td>
                            <td><?php echo $Discard['client_code'] . " - " . $Discard['client_name']; ?></td>
                            <td><?php echo $Discard['master_wo_design_id'] ?></td>
                            <td>
                              <?php

                              echo getByForFromWO($Discard['mwo_gen_lum_id'], $Discard['mwo_gen_on_behalf_lum_id']);
                              ?>
                            </td>
                            <td><?php echo date(getDateTimeFormat(), $Discard['master_wo_gen_dnt']); ?></td>
                            <td><?php echo $Discard['mwoid_desc2'] ?></td>
                            <td>
                              <button onclick="openWindow(<?php echo $Discard['master_wo_ref'] ?>)" class="btn btn-warning mt-1">View</button>
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
  getModal();
  getDataTableDefiner("DraftsContainerTable");
  getDataTableDefiner("PublishedContainerTable");
  getDataTableDefiner("ReturnedContainerTable");
  getBootboxScript(
    "publishDraft",
    "Are you sure you want to Publish this Sales Order?<br>Action Can <strong>not</strong> be undone",
    "salesToAccounts"
  );
  getDiscardScript("discardDraft", "SalesWorkOrderController");
  getUpdater("2");
  getPrintJS();
  ?>
</body>

</html>