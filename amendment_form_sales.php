<?php
#57,58,59,60,61,62,63,64,65,66,67
require_once("server_fundamentals/SessionHandler.php");

getHead("Amendment Form - Sales");

$salesGroups = mysqlSelect("select sgp_sgm_id from sales_groups_people where sgp_lum_id = " . $USER_ARRAY['lum_id']);



if ($USER_ARRAY['lum_user_type'] == 1 || $USER_ARRAY['lum_user_type'] == 2) {
  #Master Admin and MD
  $pubQuery = workOrderPagesQuery("1,2,3,10", true);
} else if ($USER_ARRAY['lum_user_type'] == 4) {
  #Sales Coordinator
  if (!is_array($salesGroups)) {
    die("User not assigned to any sales group");
  }
  $containerLeft = "select * from ( ";
  $containerRight = " ) sb where (sb.mwo_gen_lum_id = " . $USER_ARRAY['lum_id'] . " or sb.mwo_gen_on_behalf_lum_id = " . $USER_ARRAY['lum_id'] . ")";

  $pubQuery = $containerLeft . workOrderPagesQuery("1,2,3,10", true) . $containerRight;
} else if ($USER_ARRAY['lum_user_type'] == 18) {
  #Assistant Sales Manager
  if (!is_array($salesGroups)) {
    die("User not assigned to any sales group");
  }


  $containerLeft = "select * from ( ";
  $containerRight = " ) sb where (sb.mwo_gen_lum_id = " . $USER_ARRAY['lum_id'] . " or sb.mwo_gen_on_behalf_lum_id = " . $USER_ARRAY['lum_id'] . ")";

  $pubQuery = $containerLeft . workOrderPagesQuery("1,2,3,10", true) . $containerRight;
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

  $pubQuery = $containerLeft . workOrderPagesQuery("1,2,3,10", true) . $containerRight;
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
          <?php getPageTitle("Amendments Form - Sales"); ?>
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
                              $getNumberAmendment = mysqlSelect("select count(afm_id) as total 
                              from amendment_form_main 
                              where afm_rel_wo_ref = " . $Draft["master_wo_ref"] . " and afm_status = 1 ");

                              $totPrint = 0;
                              if (is_array($getNumberAmendment)) {
                                $totPrint = $getNumberAmendment[0]["total"];
                              }
                              echo $totPrint;
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
                              $getBy = mysqlSelect("select * from user_main where lum_id = " . $Draft['mwo_gen_lum_id'] . " and lum_valid =1");
                              $getFor = mysqlSelect("select * from user_main where lum_id = " . $Draft['mwo_gen_on_behalf_lum_id'] . " and lum_valid =1");

                              echo getByForFromWO($getBy, $getFor);
                              ?>
                            </td>

                            <td><?php echo date(getDateTimeFormat(), $Draft['master_wo_gen_dnt']); ?></td>
                            <td><?php echo $Draft['mwoid_desc2']; ?></td>
                            <td>
                              <?php
                              $getNumberAmendment = mysqlSelect("select count(afm_id) as total 
                              from amendment_form_main 
                              where afm_rel_wo_ref = " . $Draft["master_wo_ref"] . " and afm_status = 10 ");

                              $totPrint = 0;
                              if (is_array($getNumberAmendment)) {
                                $totPrint += $getNumberAmendment[0]["total"];
                              }
                              echo $totPrint;
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

  <script>
    $(document).ready(function(e) {
      $('.sendSalesVerify').click(function(e) {
        var dataId = ($(this).data("id"));

        bootbox.confirm("Are you sure you want to Publish this Amendment Form for Work Order Number " + dataId + " ?", function(result) {
          if (result) {


            $.post("AmendmentController/AmendmentFormController", {
                afm_ref: dataId,
                from: 1,
                to: 2
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

        bootbox.confirm("Are you sure you want to discard this Amendment Form for Work Order Number " + dataId + " ?", function(result) {
          if (result) {

            $.post("AmendmentController/AmendmentFormController", {
                afm_ref: dataId,
                from: 1,
                to: 99
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

      $('.discardRej').click(function(e) {
        var dataId = ($(this).data("id"));
        var datafrom = ($(this).data("from"));

        bootbox.confirm("Are you sure you want to discard this Amendment Form for Work Order Number " + dataId + " ?", function(result) {
          if (result) {

            $.post("AmendmentController/AmendmentFormController", {
                afm_ref: dataId,
                from: datafrom,
                to: 99
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
      $('.sendRejSalesVerify').click(function(e) {
        var dataId = ($(this).data("id"));
        var datafrom = ($(this).data("from"));

        bootbox.confirm("Are you sure you want to Re-Publish this Amendment Form for verification ?  -  Work Order Number " + dataId + " ?", function(result) {
          if (result) {


            $.post("AmendmentController/AmendmentFormController", {
                afm_ref: dataId,
                from: datafrom,
                to: 2
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
  </script>
  <?php


  getPrintJS();
  getDataTableDefiner("TableZero", 7);
  getDataTableDefiner("TableOne", 7);
  getDataTableDefiner("TableTwo");
  getDataTableDefiner("TableThree");
  getDataTableDefiner("TableFour");
  ?>


</body>

</html>