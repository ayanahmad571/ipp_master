<?php
#57,58,59,60,61,62,63,64,65,66,67
require_once("server_fundamentals/SessionHandler.php");

getHead("Amendment Form - Technical");
$pubQuery = workOrderPagesQuery("1,2,3,10", true);

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
          <?php getPageTitle("Amendment Form - Technical Verify"); ?>
          <!-- TOP CONTENT BLOCKS -->

          <hr id="Splitter" />

          <div class="row">
            <div class="col-12 ">
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Received</h4>
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
                      $finalWrap = getAmendmentWrapped($pubQuery, "6");
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
                              $getBy = mysqlSelect("select * from user_main where lum_id = " . $Draft['mwo_gen_lum_id'] . " and lum_valid =1");
                              $getFor = mysqlSelect("select * from user_main where lum_id = " . $Draft['mwo_gen_on_behalf_lum_id'] . " and lum_valid =1");

                              echo getByForFromWO($getBy, $getFor);
                              ?>
                            </td>
                            <td><?php echo $Draft['mwoid_desc2']; ?></td>
                            <td>
                              <?php
                              $getNumberAmendment = mysqlSelect("select count(afm_id) as total 
                              from amendment_form_main 
                              where afm_rel_wo_ref = " . $Draft["master_wo_ref"] . " and afm_status = 10 ");

                              $totPrint = 1;
                              if (is_array($getNumberAmendment)) {
                                $totPrint = 1 + $getNumberAmendment[0]["total"];
                              }
                              echo $totPrint;
                              ?>
                            </td>
                            <td><?php echo $Draft['afi_text']; ?></td>
                            <td><?php echo date(getDateTimeFormat(), $Draft['afm_gen_dnt']); ?></td>
                            <td>

                              <button data-id="<?php echo $Draft['master_wo_ref'] ?>" class="sendAmendment btn btn-success mt-1">Approve</button><br>
                              <button onclick="openWindowAmendRaw(<?php echo $Draft['master_wo_ref'] ?>)" class="btn btn-primary mt-1">View Form</button><br>
                              <button onclick="openWindow(<?php echo $Draft['master_wo_ref'] ?>)" class="btn btn-warning mt-1">View WO</button><br>
                              <button data-id="<?php echo $Draft['master_wo_ref'] ?>" class="discardDraft btn btn-danger mt-1">Reject</button>

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
                  <h4>Sent Back</h4>
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
                      $finalWrap = getAmendmentWrapped($pubQuery, "7");
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
                              $getBy = mysqlSelect("select * from user_main where lum_id = " . $Draft['mwo_gen_lum_id'] . " and lum_valid =1");
                              $getFor = mysqlSelect("select * from user_main where lum_id = " . $Draft['mwo_gen_on_behalf_lum_id'] . " and lum_valid =1");

                              echo getByForFromWO($getBy, $getFor);
                              ?>
                            </td>
                            <td><?php echo $Draft['mwoid_desc2']; ?></td>
                            <td>
                              <?php
                              $getNumberAmendment = mysqlSelect("select count(afm_id) as total 
                              from amendment_form_main 
                              where afm_rel_wo_ref = " . $Draft["master_wo_ref"] . " and afm_status = 10 ");

                              $totPrint = 1;
                              if (is_array($getNumberAmendment)) {
                                $totPrint = 1 + $getNumberAmendment[0]["total"];
                              }
                              echo $totPrint;
                              ?>
                            </td>
                            <td><?php echo $Draft['afi_text']; ?></td>
                            <td><?php echo date(getDateTimeFormat(), $Draft['afm_gen_dnt']); ?></td>
                            <td>
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



        </section>



      </div><!-- Main Content  -->

      <?php
      getFooter();
      ?>

    </div><!-- Main Wrapper  -->
  </div><!-- App -->

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

  <?php
  getScripts();
  ?>


  <script src="assets/js/bootbox.min.js"></script>

  <script type="text/javascript" src="assets/Datatables/datatables.min.js"></script>

  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

  <script>
    $(document).ready(function(e) {
      $('.sendAmendment').click(function(e) {
        var dataId = ($(this).data("id"));

        bootbox.confirm("Are you sure you want to Approve this Amendment Form  -  Work Order Number " + dataId + " ?", function(result) {
          if (result) {


            $.post("AmendmentController/AmendmentFormController", {
                afm_ref: dataId,
                from: 6,
                to: 8
              },
              function(data, status) {
                if (data.includes("This action has been successfully completed")) {
                  bootbox.alert(data);
                  setTimeout(function() {
                    window.location.reload();
                  }, 1000);

                } else {
                  bootbox.alert(data);
                }
              });


          }
        });
      });
    }); /*Doc Ready*/

    $(document).ready(function(e) {
      $('.discardDraft').click(function(e) {
        var dataId = ($(this).data("id"));

        $.post("AmendmentController/AmendmentTechnicalController", {
            WorkOrderGetDetails: dataId,
          },
          function(data, status) {
            $(".modal-body").html(data);

            $('#myModal').modal('show');
          });

      });
    }); /*Doc Ready*/
  </script>
  <?php


  getPrintJS();
  getDataTableDefiner("TableZero", 7);
  getDataTableDefiner("TableOne", 7);
  ?>


</body>

</html>