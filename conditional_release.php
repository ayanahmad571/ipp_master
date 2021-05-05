<?php
require_once("server_fundamentals/SessionHandler.php");

getHead("Conditional Release");
?>

<link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />

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
            <h1>Work Order Conditional Release Manager <?php echo (isset($_GET['id']) ? "#" . $_GET['id'] : ""); ?></h1>
          </div>

          <div class="row">
            <div class="col-12 ">
              <div class="card card-warning">
                <div class="card-header">
                  <h4>Requests for Conditional Release</h4>
                </div>
                <div class="card-body text-justify">
                  <?php

                  if (isset($_GET['id'])) {
                  ?>
                    <table class="table table-striped table-bordered " id="DraftsContainerTable">
                      <thead>
                        <tr>
                          <th>Reason</th>
                          <th>Text</th>
                          <th>NCR</th>
                          <th>Status</th>
                          <th>Time</th>

                        </tr>
                      </thead>

                      <tbody>
                        <?php
                        $getDrafts = mysqlSelect("SELECT * FROM `conditional_release_wo` c 
                        left join conditional_release_reason on crr_id = crw_crr_id
                        left join conditional_release_identity on  crd_id = crw_status
                        where c.crw_wo_ref = " . $_GET['id'] . " 
                        order by c.crw_id desc 
                        ");
                        $toAcc = false;

                        if (is_array($getDrafts)) {
                          $x = 1;
                          if ($getDrafts[0]['crw_status'] == 1) {
                            $toAcc = true;
                          }
                          foreach ($getDrafts as $Draft) {

                        ?>
                            <tr>
                              <td><?php echo $Draft['crr_value']; ?></td>
                              <td><?php echo $Draft['crw_reason']; ?></td>
                              <td><?php echo $Draft['crw_ncr']; ?></td>
                              <td><?php echo $Draft['crd_text']; ?></td>
                              <td><?php echo date(getDateTimeFormat(), $Draft['crw_dnt']) ?></td>
                            </tr>
                        <?php
                            $x++;
                          }
                        }
                        ?>
                      </tbody>

                    </table>

                    <?php
                    if ($toAcc) {
                    ?>
                      <div class="row">
                        <div align="center" class="col-sm-6">
                          <br>
                          <form id="CompSub" action="server_fundamentals/MainWorkOrderSubmit" method="POST">
                            <input name="AccountsCondToTechnical" type="hidden" value="<?php echo $_GET['id']; ?>" />
                            <button type="submit" class="btn btn-success">Accept</button>

                          </form>
                        </div>
                        <div class="col-sm-6">
                          <form id="CompSub2" action="server_fundamentals/AccountsController" method="POST">
                            <input name="AccountsCondToTechnicalRejectCond" type="hidden" value="<?php echo $_GET['id'] ?>" />
                            <input name="rejCond" type="text" class="form-control" /><br>
                            <button type="submit" class="btn btn-danger">Reject</button>

                          </form>
                        </div>
                      </div>


                    <?php
                    }
                    ?>
                  <?php
                  } else {

                  ?>

                    <table class="table table-striped table-bordered " id="DraftsContainerTable">
                      <thead>
                        <tr>
                          <th>WO#</th>
                          <th>Status</th>
                          <th>Action</th>

                        </tr>
                      </thead>

                      <tbody>
                        <?php
                        $getDrafts = mysqlSelect("select * from conditional_release_wo r where r.crw_id = (SELECT c.crw_id FROM `conditional_release_wo` c 
                        where c.crw_wo_ref = r.crw_wo_ref
                        order by c.crw_id desc 
                        limit 1)");

                        if (is_array($getDrafts)) {
                          $x = 1;
                          foreach ($getDrafts as $Draft) {
                            $getIdentity = mysqlSelect("SELECT * FROM `conditional_release_identity` where crd_id = " . $Draft['crw_status']);
                        ?>
                            <tr>
                              <td><?php echo $Draft['crw_wo_ref']; ?></td>
                              <td><?php echo $getIdentity[0]['crd_text'] ?></td>
                              <td><a href="conditional_release?id=<?php echo $Draft['crw_wo_ref'] ?>"><button class="btn btn-primary">View</button></a></td>
                            </tr>
                        <?php
                            $x++;
                          }
                        }
                        ?>
                      </tbody>

                    </table>
                  <?php
                  }
                  ?>


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
  <script>
    $(document).ready(function(e) {
      $('#CompSub').on('submit', (function(e) {
        var formCont = $(this)[0];

        e.preventDefault();

        bootbox.confirm("Are you sure you Approve this Work Order?", function(result) {
          if (result) {
            $('#CompSub').fadeOut();
            var formData = new FormData(formCont);
            $.ajax({
              type: 'POST',
              url: $(formCont).attr('action'),
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success: function(data) {
                bootbox.alert(data);
              },
              error: function(data) {
                alert("Contact Admin.");
              }
            });

          }
        });


      }));

    });

    $(document).ready(function(e) {
      $('#CompSub2').on('submit', (function(e) {
        var formCont = $(this)[0];

        e.preventDefault();

        bootbox.confirm("Are you sure you Reject this conditional request?", function(result) {
          if (result) {
            $('#CompSub2').fadeOut();
            var formData = new FormData(formCont);
            $.ajax({
              type: 'POST',
              url: $(formCont).attr('action'),
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success: function(data) {
                bootbox.alert(data);
              },
              error: function(data) {
                alert("Contact Admin.");
              }
            });

          }
        });


      }));

    });
  </script>


</body>

</html>