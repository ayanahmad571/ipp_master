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
          <?php getPageTitle("Work Order - General View"); ?>
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
                  <h4>Published</h4>
                </div>
                <div class="card-body text-justify">
                  <table class="table table-striped table-bordered " id="DraftsContainerTable">
                    <thead>
                      <tr>
                        <th>WO#</th>
                        <th>Client</th>
                        <th>Design ID</th>
                        <th>Sales Code</th>
                        <th>Generated By</th>
                        <th>TimeStamp</th>
                        <th>Action</th>
                      </tr>
                    </thead>


                    <tbody>

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

  <script type="text/javascript" src="assets/Datatables/datatables.min.js"></script>

  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

  <script>
    $("#DraftsContainerTable").DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "WorkOrderControllers/AllControllerTable.php"
    });
  </script>

  <?php $getDraftsH = mysqlSelect(workOrderPagesQuery("9")); ?>
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
          ids: "9",
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