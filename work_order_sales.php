<?php
require_once("server_fundamentals/SessionHandler.php");
require_once("WorkOrderControllers/WorkOrderHelper.php");

getHead("WO Sales");

$salesGroups = mysqlSelect("select sgp_sgm_id from sales_groups_people where sgp_lum_id = " . $USER_ARRAY['lum_id']);



if ($USER_ARRAY['lum_user_type'] == 1 || $USER_ARRAY['lum_user_type'] == 2) {
  #Master Admin and MD
  $genQuery = workOrderPagesQuery("1");
  $retQuery = workOrderPagesQuery("3");
  $pubQuery = workOrderPagesQuery("1,3", true);
} else if ($USER_ARRAY['lum_user_type'] == 4) {
  #Sales Coordinator
  if (!is_array($salesGroups)) {
    die("User not assigned to any sales group");
  }
  $containerLeft = "select * from ( ";
  $containerRight = " ) sb where (sb.mwo_gen_lum_id = " . $USER_ARRAY['lum_id'] . " or sb.mwo_gen_on_behalf_lum_id = " . $USER_ARRAY['lum_id'] . ")";

  $genQuery = $containerLeft . workOrderPagesQuery("1") . $containerRight;
  $retQuery = $containerLeft . workOrderPagesQuery("3") . $containerRight;
  $pubQuery = $containerLeft . workOrderPagesQuery("1,3", true) . $containerRight;
} else if ($USER_ARRAY['lum_user_type'] == 18) {
  #Assistant Sales Manager
  if (!is_array($salesGroups)) {
    die("User not assigned to any sales group");
  }


  $containerLeft = "select * from ( ";
  $containerRight = " ) sb where (sb.mwo_gen_lum_id = " . $USER_ARRAY['lum_id'] . " or sb.mwo_gen_on_behalf_lum_id = " . $USER_ARRAY['lum_id'] . ")";

  $genQuery = $containerLeft . workOrderPagesQuery("1") . $containerRight;
  $retQuery = $containerLeft . workOrderPagesQuery("3") . $containerRight;
  $pubQuery = $containerLeft . workOrderPagesQuery("1,3", true) . $containerRight;
} else if ($USER_ARRAY['lum_user_type'] == 16) {
  #Sales Manager
  if (!is_array($salesGroups)) {
    die("User not assigned to any sales group");
  }

  $allLowerUsers = ("select p.sgp_lum_id from sales_groups_people p 
  left join user_main on p.sgp_lum_id = lum_id
  where 
  lum_user_type in (18,4) and
  p.sgp_sgm_id in (select s.sgp_sgm_id from sales_groups_people s where s.sgp_lum_id = " . $USER_ARRAY['lum_id'] . ")");


  $containerLeft = "select * from ( ";
  $containerRight = " ) sb 
  where (sb.mwo_gen_lum_id = " . $USER_ARRAY['lum_id'] . " or sb.mwo_gen_on_behalf_lum_id = " . $USER_ARRAY['lum_id'] . " or 
  sb.mwo_gen_lum_id in (" . $allLowerUsers . ") 
  or sb.mwo_gen_on_behalf_lum_id in (" . $allLowerUsers . ") )";

  $genQuery = $containerLeft . workOrderPagesQuery("1") . $containerRight;
  $retQuery = $containerLeft . workOrderPagesQuery("3") . $containerRight;
  $pubQuery = $containerLeft . workOrderPagesQuery("1,3", true) . $containerRight;
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
          <?php getPageTitle("Sales Order - Sales"); ?>
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
                  <h4>Generated (Not Verified) </h4>
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
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $getDrafts = mysqlSelect($genQuery);

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
                              echo getByForFromWO($Draft['mwo_gen_lum_id'], $Draft['mwo_gen_on_behalf_lum_id']);
                              ?>
                            </td>
                            <td><?php echo date(getDateTimeFormat(), $Draft['master_wo_gen_dnt']); ?></td>
                            <td>
                              <a target="_blank" href="work_order_sales_generate?editId=<?php echo $Draft['master_wo_ref'] ?>">
                                <button class="btn btn-warning mt-1">View/Edit</button>
                              </a>
                              <button class="publishDraft btn btn-success mt-1" data-id="<?php echo ($Draft['master_wo_ref']); ?>">Send to Verify</button>
                              <button onclick="openWindow(<?php echo $Draft['master_wo_ref'] ?>)" class="btn btn-primary mt-1">Print</button>
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
                  <h4>Returned </h4>
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
                      $getDiscards = mysqlSelect($retQuery);

                      if (is_array($getDiscards)) {
                        foreach ($getDiscards as $Discard) {
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
                            <td><?php echo $Discard['mwoid_desc2'] ?><br>
                              <hr><?php echo $Discard['master_reject_text'] ?>
                            </td>
                            <td>
                              <a href="work_order_sales_generate?editId=<?php echo $Discard['master_wo_ref'] ?>" target="_blank">
                                <button class="btn btn-warning mt-1">View/Edit</button>
                              </a>
                              <button class="rePublish btn btn-success mt-1" data-id="<?php echo ($Discard['master_wo_ref']); ?>">Re-Publish</button>
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
                  <h4>Published </h4>
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
                      $getDiscards = mysqlSelect($pubQuery);

                      if (is_array($getDiscards)) {
                        foreach ($getDiscards as $Discard) {
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

                              <?php if ($Discard['master_wo_status'] == 9) { ?>
                                <a target="_blank" href="work_order_sales_repeat?repeatFromPublished=<?php echo $Discard['master_wo_ref'] ?>">
                                  <button class="btn btn-primary mt-1">Repeat</button>
                                </a>
                              <?php } ?>
                              <?php if ($Discard['master_wo_status'] == 9) { ?>
                                <a target="_blank" href="work_order_sales_repeat_change?repeatChange=<?php echo $Discard['master_wo_ref'] ?>">
                                  <button class="btn btn-info mt-1">Repeat - Change</button>
                                </a>
                              <?php } ?>

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
  getDataTableDefiner("PublishedContainerTable");
  getDataTableDefiner("ReturnedContainerTable");
  getPrintJS();

  getBootboxScript(
    "publishDraft",
    "Are you sure you want to send this Sales Order for Verification?<br>Action Can <strong>not</strong> be undone",
    "draftToMain",
    "DraftsContainerTable"
  );
  getBootboxScript(
    "discardDraft",
    "Are you sure you want to DISCARD Draft",
    "draftDiscard",
    "DraftsContainerTable"
  );
  getBootboxScript(
    "rePublish",
    "Are you sure you want to Re-Publish",
    "rePublishSales",
    "ReturnedContainerTable"
  );
  getUpdater("1,3");
  getDataTableDrawScript("DraftsContainerTable");
  getDataTableDrawScript("ReturnedContainerTable");


  ?>

</body>

</html>