<?php
require_once("server_fundamentals/SessionHandler.php");

getHead("WO Accounts");
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
          <?php getPageTitle("Work Order - Accounts"); ?>
          <!-- TOP CONTENT BLOCKS -->
          <div class="row">
            <?php
            // $pendingCount = mysqlSelect("select ifnull(count(m.master_wo_id),0) as ans from (select *
            // from `master_work_order_reference_number` r 
            // left join master_work_order_main on (		SELECT master_wo_id FROM `master_work_order_main`
            //                                         where master_wo_ref = r.mwo_ref_id
            //                                         order by master_wo_id desc 
            //                                         limit 1) = master_wo_id ) m
            //  where m.master_wo_status = 4");
            ?>
            <?php 
            // getTopCard("col-lg-4 col-md-6 col-sm-6 col-12", "far fa-user", "Pending", $pendingCount[0]['ans']);
            // getTopCard("col-lg-4 col-md-6 col-sm-6 col-12", "far fa-user", "Conditional Release Pending", "0000"); 
            // getTopCard("col-lg-4 col-md-6 col-sm-6 col-12", "far fa-user", "Published", "0000");
             ?>
            <?php //getTopCard("col-lg-3 col-md-6 col-sm-6 col-12", "far fa-user", "Dummy Head", "0000")
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
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $getDrafts = mysqlSelect(workOrderPagesQuery("4"));

                      if (is_array($getDrafts)) {
                        foreach ($getDrafts as $Draft) {
                      ?>
                          <tr>
                            <td><?php echo $Draft['master_wo_ref'] ?></td>
                            <td><?php echo $Draft['client_code'] . " - " . $Draft['client_name']; ?></td>
                            <td><?php echo $Draft['master_wo_design_id']; ?></td>
                            <td>
                              <?php
                              $getBy = mysqlSelect("select * from user_main where lum_id = " . $Draft['mwo_gen_lum_id'] . " and lum_valid =1");
                              $getFor = mysqlSelect("select * from user_main where lum_id = " . $Draft['mwo_gen_on_behalf_lum_id'] . " and lum_valid =1");

                              echo getByForFromWO($getBy, $getFor);
                              ?>
                            </td>
                            <td><?php echo date('d-m-Y @ h:i:s a', $Draft['master_wo_gen_dnt']); ?></td>
                            <?php
                            $getCondRel = mysqlSelect("SELECT * FROM `conditional_release_wo` where
                            crw_wo_ref = " . $Draft['master_wo_ref'] . " order by crw_id desc limit 1");

                            if (!is_array($getCondRel)) {
                            ?>
                              <td>
                                <button class="publishDraft btn btn-success mt-1" data-id="<?php echo ($Draft['master_wo_ref']); ?>">Release</button>
                                <button class="publishConditionalDraft btn btn-warning mt-1" data-id="<?php echo ($Draft['master_wo_ref']); ?>">Conditional Release</button>
                                <a target="_blank" href="work_order_view_print?id=<?php echo $Draft['master_wo_ref'] ?>">
                                  <button class="btn btn-primary mt-1">View</button>
                                </a>
                              </td>
                            <?php
                            } else if ($getCondRel[0]['crw_status'] == 1) {
                              echo '<td>Requested Conditional Release</td>';
                            } else if ($getCondRel[0]['crw_status'] == 3) {
                              //Rejected
                            ?>
                              <td>
                                <?php echo "<strong>Release Rejected</strong>" ?>
                                <br>
                                <?php echo $getCondRel[0]['crw_reason'] ?>
                                <hr>
                                <button class="publishDraft btn btn-success mt-1" data-id="<?php echo ($Draft['master_wo_ref']); ?>">Release</button>
                                <button class="publishConditionalDraft btn btn-warning mt-1" data-id="<?php echo ($Draft['master_wo_ref']); ?>">Conditional Release</button>
                                <a target="_blank" href="work_order_view_print?id=<?php echo $Draft['master_wo_ref'] ?>">
                                  <button class="btn btn-primary mt-1">View</button>
                                </a>
                              </td>
                            <?php
                            }
                            ?>

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
              <div class="card card-success">
                <div class="card-header">
                  <h4>Approved </h4>
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
                      $getDiscards = mysqlSelect(workOrderPagesQuery("6,5"));

                      if (is_array($getDiscards)) {
                        foreach ($getDiscards as $Discard) {
                      ?>
                          <tr>
                            <td><?php echo $Discard['master_wo_ref'] ?></td>
                            <td><?php echo $Discard['client_code'] . " - " . $Discard['client_name']; ?></td>
                            <td><?php echo $Discard['master_wo_design_id'] ?></td>
                            <td>
                              <?php
                              $getBy = mysqlSelect("select * from user_main where lum_id = " . $Discard['mwo_gen_lum_id'] . " and lum_valid =1");
                              $getFor = mysqlSelect("select * from user_main where lum_id = " . $Discard['mwo_gen_on_behalf_lum_id'] . " and lum_valid =1");

                              echo getByForFromWO($getBy, $getFor);
                              ?>
                            </td>
                            <td><?php echo date('d-m-Y @ h:i:s a', $Discard['master_wo_gen_dnt']); ?></td>
                            <td><?php echo $Discard['mwoid_desc2'] ?></td>
                            <td>
                              <a href="work_order_view_print?id=<?php echo $Discard['master_wo_ref'] ?>" target="_blank">
                                <button class="btn btn-warning mt-1">View</button>
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
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg ">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  <script>
    $("#DraftsContainerTable").DataTable();
    $("#PublishedContainerTable").DataTable();
    $("#ReturnedContainerTable").DataTable();
  </script>

  <script>
    $(document).ready(function(e) {
      $('.publishDraft').click(function(e) {
        var dataId = ($(this).data("id"));

        bootbox.confirm("Are you sure you want to Publish this Work Order: " + dataId + "  to Accounts?<br>Action Can <strong>not</strong> be undone.", function(result) {
          if (result) {


            $.post("server_fundamentals/MainWorkOrderSubmit", {
                AccountsToTechnical: dataId,
              },
              function(data, status) {
                bootbox.alert(data);
              });


          }
        });
      }); /* .pubslishDraft Click*/
    }); /*Doc Ready*/

    $(document).ready(function(e) {
      $('.publishConditionalDraft').click(function(e) {
        var dataId = ($(this).data("id"));

        $.post("server_fundamentals/AccountsController", {
            WorkOrderGetDetails: dataId,
          },
          function(data, status) {
            $(".modal-body").html(data);

            $('#myModal').modal('show');
          });

      }); /* .pubslishDraft Click*/
    }); /*Doc Ready*/
  </script>

<?php $getDraftsH = mysqlSelect(workOrderPagesQuery("4")); ?>
<input type="hidden" id="rowDiff" value="<?php echo (is_array($getDraftsH) ? count($getDraftsH): "0"); ?>" />

<script src="assets/modules/iZiToast.js"></script>

<script>
    function fetchdata() {
      var rowD = $("#rowDiff").val();
      $.ajax({
        url: 'WorkOrderControllers/AllController',
        type: 'post',
        data: {
          rowDiffChecker: rowD,
          ids: "4",
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

</body>

</html>