<?php
#57,58,59,60,61,62,63,64,65,66,67
require_once("server_fundamentals/SessionHandler.php");
require_once("AmendmentController/AmendmentHelper.php");

getHead("Amendment Form - Sales");


$pubQuery = getWOSales($USER_ARRAY);
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
          <?php getPageTitle("Amendments Form - Sales"); ?>
          <hr id="Splitter" />

          <div class="row">
            <div class="col-12 ">
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Drafts</h4>
                </div>
                <div class="card-body text-justify">
                  <table class="table table-striped table-bordered " id="TableZero">
                    <thead>
                      <tr>
                        <th>WO#</th>
                        <th>Client</th>
                        <th>Design ID</th>
                        <th>User</th>
                        <th>WO Status</th>
                        <th>Amendment #</th>
                        <th>Amendment Status</th>
                        <th>TimeStamp</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $finalWrap = getAmendmentWrapped($pubQuery, "1");
                      $getDrafts = mysqlSelect($finalWrap);

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
                            <td><?php echo $Draft['mwoid_desc2']; ?></td>
                            <td>
                              <?php
                              echo 1 + getNumberAmendments($Draft["master_wo_ref"]);
                              ?>
                            </td>
                            <td><?php echo $Draft['afi_text']; ?></td>
                            <td><?php echo date(getDateTimeFormat(), $Draft['afm_gen_dnt']); ?></td>
                            <td>

                              <button data-id="<?php echo $Draft['master_wo_ref'] ?>" class="sendSalesVerify btn btn-success mt-1">Publish</button><br>
                              <button onclick="openWindowAmendRaw(<?php echo $Draft['master_wo_ref'] ?>)" class="btn btn-primary mt-1">Edit Form</button><br>
                              <button onclick="openWindow(<?php echo $Draft['master_wo_ref'] ?>)" class="btn btn-warning mt-1">View WO</button><br>
                              <button data-id="<?php echo $Draft['master_wo_ref'] ?>" class="discardDraft btn btn-danger mt-1">Discard</button>

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
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Open Forms - Currently being requested for verification</h4>
                </div>
                <div class="card-body text-justify">
                  <table class="table table-striped table-bordered " id="TableOne">
                    <thead>
                      <tr>
                        <th>WO#</th>
                        <th>Client</th>
                        <th>Design ID</th>
                        <th>User</th>
                        <th>WO Status</th>
                        <th>Amendment #</th>
                        <th>Amendment Status</th>
                        <th>TimeStamp</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $finalWrap = getAmendmentWrapped($pubQuery, "2,4,6,8");
                      $getDrafts = mysqlSelect($finalWrap);

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
                            <td><?php echo $Draft['mwoid_desc2']; ?></td>
                            <td>
                              <?php
                              echo 1 + getNumberAmendments($Draft["master_wo_ref"]);
                              ?>
                            </td>
                            <td><?php echo $Draft['afi_text']; ?></td>
                            <td><?php echo date(getDateTimeFormat(), $Draft['afm_gen_dnt']); ?></td>
                            <td>

                              <button onclick="openWindowAmendRaw(<?php echo $Draft['master_wo_ref'] ?>)" class="btn btn-primary mt-1">View Form</button><br>
                              <button onclick="openWindow(<?php echo $Draft['master_wo_ref'] ?>)" class="btn btn-warning mt-1">View WO</button><br>

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
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Rejected Forms</h4>
                </div>
                <div class="card-body text-justify">
                  <table class="table table-striped table-bordered " id="TableTwo">
                    <thead>
                      <tr>
                        <th>WO#</th>
                        <th>Client</th>
                        <th>Rejection User</th>
                        <th>Rejection Notes</th>
                        <th>Amendment #</th>
                        <th>Amendment Status</th>
                        <th>TimeStamp</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $finalWrap = getAmendmentWrapped($pubQuery, "3,5,7,9");
                      $getDrafts = mysqlSelect($finalWrap);

                      if (is_array($getDrafts)) {
                        foreach ($getDrafts as $Draft) {
                      ?>
                          <tr>
                            <td><?php echo $Draft['master_wo_ref'] ?></td>
                            <td><?php echo $Draft['client_code'] . " - " . $Draft['client_name']; ?></td>
                            <td>
                              <?php $lum = getLum($Draft['afm_reject_lum_id']);
                              echo $lum['lum_code'] . " - " . $lum['lum_name']; ?>
                            </td>
                            <td><?php echo $Draft['afm_reject_text']; ?></td>
                            <td>
                              <?php
                              echo getNumberAmendments($Draft["master_wo_ref"]);
                              ?>
                            </td>
                            <td><?php echo $Draft['afi_text']; ?></td>
                            <td><?php echo date(getDateTimeFormat(), $Draft['afm_gen_dnt']); ?></td>
                            <td>

                              <button data-from="<?php echo $Draft['afm_status'] ?>" data-id="<?php echo $Draft['master_wo_ref'] ?>" class="sendRejSalesVerify btn btn-success mt-1">Re-Publish</button><br>
                              <button onclick="openWindowAmendRaw(<?php echo $Draft['master_wo_ref'] ?>)" class="btn btn-primary mt-1">Edit Form</button><br>
                              <button onclick="openWindow(<?php echo $Draft['master_wo_ref'] ?>)" class="btn btn-warning mt-1">View WO</button><br>
                              <button data-from="<?php echo $Draft['afm_status'] ?>" data-id="<?php echo $Draft['master_wo_ref'] ?>" class="discardRej btn btn-danger mt-1">Discard</button>

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
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Current Orders - (All work orders for which amendment forms have not been requested)</h4>
                </div>
                <div class="card-body text-justify">
                  <table class="table table-striped table-bordered " id="TableFour">
                    <thead>
                      <tr>
                        <th>WO#</th>
                        <th>Client</th>
                        <th>Design ID</th>
                        <th>User</th>
                        <th>TimeStamp</th>
                        <th>WO Status</th>
                        <th>Amendments</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $finalWrap = getAmendmentWrapped($pubQuery, "10,99", true, true);
                      $getDrafts = mysqlSelect($finalWrap);

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
                            <td><?php echo $Draft['mwoid_desc2']; ?></td>
                            <td>
                              <?php
                              echo getNumberAmendments($Draft["master_wo_ref"]);
                              ?>
                            </td>
                            <td><?php echo $Draft['afi_text']; ?></td>

                            <td>

                              <button class="publishDraft btn btn-success mt-1" onclick="openWindowAmend(<?php echo $Draft['master_wo_ref'] ?>)">Amendment Form</button>
                              <button onclick="openWindow(<?php echo $Draft['master_wo_ref'] ?>)" class="btn btn-primary mt-1">View</button>

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
  getBootboxScript("sendSalesVerify", "Are you sure you want to Publish this Amendment Form", 1, 2);
  getBootboxScript("discardDraft", "Are you sure you want to discard this Amendment Form ", 1, 99);
  getBootboxScript("discardRej", "Are you sure you want to discard this Amendment Form ", 'datafrom', 99, true);
  getBootboxScript("sendRejSalesVerify", "Are you sure you want to Re-Publish this Amendment Form for verification ? ", 'datafrom', 2, true);
  getPrintJS();
  getDataTableDefiner("TableZero", 7);
  getDataTableDefiner("TableOne", 7);
  getDataTableDefiner("TableTwo");
  getDataTableDefiner("TableThree");
  getDataTableDefiner("TableFour");
  ?>


</body>

</html>