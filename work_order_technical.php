<?php
require_once("server_fundamentals/SessionHandler.php");

getHead("WO Technical");
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
          <?php getPageTitle("Work Order - Technical"); ?>
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
                  <h4>Pending </h4>
                </div>
                <div class="card-body text-justify">
                  <table class="table table-striped table-bordered " id="pendingTableCont">
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
                      $getDrafts = mysqlSelect(workOrderPagesQuery("6,5"));

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
                              <a target="_blank" href="work_order_main_edit?techID=<?php echo $Draft['master_wo_ref'] ?>">
                                <button class="btn btn-warning mt-1">View/Edit</button>
                              </a>
                              <?php
                              if ($Draft['master_wo_status'] == 5) {
                              ?>
                                <button class="publishDraft  btn btn-success mt-1" data-id="<?php echo ($Draft['master_wo_ref']); ?>">Send to Verify</button>
                              <?php
                              } else {
                              ?>
                                <button class="publishDraftCond btn btn-success mt-1" data-id="<?php echo ($Draft['master_wo_ref']); ?>">Send to Verify.</button>
                              <?php
                              }
                              ?>

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
                      $getDiscards = mysqlSelect(workOrderPagesQuery("8"));

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
                            <td><?php echo $Discard['mwoid_desc2'] ?>
                              <hr><strong><?php echo $Discard['master_reject_text'] ?></strong>
                            </td>
                            <td>
                              <a target="_blank" href="work_order_main_edit?techID=<?php echo $Discard['master_wo_ref'] ?>">
                                <button class="btn btn-warning mt-1">View/Edit</button>
                              </a>
                              <button class="rePublishDraft  btn btn-success mt-1" data-id="<?php echo ($Discard['master_wo_ref']); ?>">Re-Send to Verify</button>

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
                      $getDiscards = mysqlSelect(workOrderPagesQuery("7"));

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
  getDataTableDefiner("pendingTableCont");
  getDataTableDefiner("PublishedContainerTable");
  getDataTableDefiner("ReturnedContainerTable");
  ?>
  <script>
    $(document).ready(function(e) {
      $('.publishDraft').click(function(e) {
        var dataId = ($(this).data("id"));

        bootbox.confirm("Are you sure you want to send this Work Order " + dataId + "  for Verification?<br>Action Can <strong>not</strong> be undone.", function(result) {
          if (result) {


            $.post("server_fundamentals/MainWorkOrderSubmit", {
                technicalToVerify: dataId,
              },
              function(data, status) {
                bootbox.alert(data);
              });


          }
        });
      }); /* .pubslishDraft Click*/
    }); /*Doc Ready*/

    $(document).ready(function(e) {
      $('.rePublishDraft').click(function(e) {
        console.log($(this));
        var dataId = ($(this).data("id"));

        bootbox.confirm("Are you sure you want to re-send this Work Order " + dataId + "  for Verification?<br>Action Can <strong>not</strong> be undone.", function(result) {
          if (result) {


            $.post("server_fundamentals/MainWorkOrderSubmit", {
                techRePub: dataId,
              },
              function(data, status) {
                bootbox.alert(data);
              });


          }
        });
      }); /* .pubslishDraft Click*/
    }); /*Doc Ready*/


    $(document).ready(function(e) {
      $('.publishDraftCond').click(function(e) {
        var dataId = ($(this).data("id"));

        bootbox.confirm("Are you sure you want to send this Work Order " + dataId + "  for Verification?<br>Action Can <strong>not</strong> be undone.", function(result) {
          if (result) {


            $.post("server_fundamentals/MainWorkOrderSubmit", {
                technicalToVerifyCond: dataId,
              },
              function(data, status) {
                bootbox.alert(data);
              });


          }
        });
      }); /* .pubslishDraft Click*/
    }); /*Doc Ready*/
  </script>

  <?php $getDraftsH = mysqlSelect(workOrderPagesQuery("6,5,8")); ?>
  <input type="hidden" id="rowDiff" value="<?php echo (is_array($getDraftsH) ? count($getDraftsH) : "0"); ?>" />

  <script src="assets/modules/iZiToast.js"></script>

  <script>
    function fetchdata() {
      var rowD = $("#rowDiff").val();
      $.ajax({
        url: 'WorkOrderControllers/AllController',
        type: 'post',
        data: {
          rowDiffChecker: rowD,
          ids: "6,5,8",
          not_ski: "0"
        },
        success: function(response) {
          // Perform operation on the return value
          if (response != "0") {
            iziToast.success({
              title: 'Work Order Update!',
              message: 'New Updates, Refresh the page to see them',
              position: 'topRight'
            });
            $("#rowDiff").val(response);
          }
        }
      });
    }

    $(document).ready(function() {
      setInterval(fetchdata, 5000);
    });
  </script>

  <?php getPrintJS(); ?>

</body>

</html>