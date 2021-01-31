<?php
require_once("server_fundamentals/SessionHandler.php");
require_once("server_fundamentals/PostDataHeadChecker.php");
require_once("WorkOrderControllers/FormController.php");

//If Rep from Pub and Rep From Draft are both in the URL, Redirect Back
if (!isset($_GET['techID'])) {
  header('Location: work_order_technical');
  die();
}
//If Repreat from Published is present then pull all the data of this MAIN WORK ORDER
if (!is_numeric($_GET['techID'])) {
  header('Location: work_order_sales');
  die();
}

getHead("Work Order #" . $_GET['techID']);

$getWo = mysqlSelect($UpdatedStatusQuery . "
       
        
		left join clients_main on master_wo_2_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id

        where master_wo_status in (6,5,8) and master_wo_ref= " . $_GET['techID'] . " 
		" . $inColsWO . "
		order by master_wo_id desc
    ");


if (!is_array($getWo)) {
  header('Location: work_order_technical');
  die();
}

$WorkOrderRepPub =  $getWo[0];

$typeWO = ($WorkOrderRepPub['mwo_type']);

?>
<link href="assets/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />

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
            <h1>Work Order #<?php echo $_GET['techID'] ?></h1>
          </div>
          <!-- TOP CONTENT BLOCKS -->
          <?php
          /*
          2 = dropdown
          3 = multiple
          */
          ?>

          <div class="row">
            <div class="col-12 ">
              <div class="card card-warning">
                <div class="card-header">
                  <h4><?php echo (isset($_GET['techID']) ? "Techincal - " : "") ?><?php echo ($WorkOrderRepPub['mwo_type'] == 1 ? "New Work Order" : ($WorkOrderRepPub['mwo_type'] == 2 ? "Repeat Work Order":"Repeat with Change Work Order")) ?></h4>
                </div>

                <div class="card-body text-justify">
                  <div id="formFail" class="alert alert-danger" style="display:none">
                  </div>
                  <div id="formLoading" class="alert alert-warning">
                    Form Is Loading....
                  </div>

                  <div id="formSuccess" class="alert alert-success" style="display:none">
                    This work order has been saved successfully!!
                  </div>

                  <!-- <form id="formContainer" action="server_fundamentals/SalesWorkOrderSubmit" method="post"> -->
                  <form id="formContainer" action="server_fundamentals/WorkOrderControllerEdit" method="post">
                    <input type="hidden" name="work_order_repeat_publish_id" value="<?php echo $_GET['techID'] ?>" />

                    <?php
                    if ($WorkOrderRepPub['mwo_type'] != 1) {
                      getChangeTypePills();

                      getFormRepHead($WorkOrderRepPub['mwo_repeat_wo_id']);
                    }

                    getRow("select * from user_main where lum_valid =1");

                    getPrintedSection(true);

                    getCoatingSection();

                    getFill();

                    getLayer();

                    getRoll(true,$_GET['techID']);

                    getPouch(true,$_GET['techID']);

                    getBag(true,$_GET['techID']);

                    getSlit(true,$_GET['techID']);
                    ?>


                  <div class="form-group" align="center">
                    <button type="submit" class="btn btn-success">Save</button>
                  </div>


                </form>
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
  <script src="assets/js/select2.full.min.js"></script>
  <script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
  <script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>


  <?php
  getEditTrueBody($WorkOrderRepPub, $WOstraightArrays, $WOcheckboxArrays, $WOselectArrays);
  ?>


  <?php getScriptInitializer(); ?>

  <?php getScriptTriggers(); ?>

  <?php getScriptFunctionalSetup(); ?>

  <script>
    $(document).ready(async function(e) {
      <?php
      getEditTrueLayers($WorkOrderRepPub);
      getEditBagPouchScript($WorkOrderRepPub);
      ?>

    });
  </script>

  <script>
    $(document).ready(function(e) {

      $('#formContainer').on('submit', (function(e) {
        var formCont = $(this)[0];

        e.preventDefault();

        bootbox.confirm("Are you sure you want to add this Work Order to drafts ?", function(result) {
          if (result) {
            $('#formContainer').fadeOut();
            var formData = new FormData(formCont);
            $.ajax({
              type: 'POST',
              url: $(formCont).attr('action'),
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success: function(data) {

                if (data.trim() == "") {
                  $('#formContainer').html("");
                  $("#formSuccess").fadeIn();
                  $("#formFail").fadeOut();
                  $('html,body').animate({
                    scrollTop: $("html").offset().top
                  }, 'slow');
                } else {
                  $("#formFail").html(data);
                  $('#formContainer').fadeIn();
                  $("#formSuccess").fadeOut();
                  $("#formFail").fadeIn();
                  $('html,body').animate({
                    scrollTop: $("#formFail").offset().top
                  }, 'slow');
                }
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