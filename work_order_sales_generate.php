<?php
require_once("server_fundamentals/SessionHandler.php");
require_once("server_fundamentals/PostDataHeadChecker.php");
require_once("WorkOrderControllers/FormController.php");

$WorkOrderMain = array();
if (isset($_GET['editId']) && is_numeric($_GET['editId'])) {
  $WorkOrderMain = mysqlSelect($UpdatedStatusQuery . "
       
        
  left join clients_main on master_wo_2_client_id = client_id
  left join master_work_order_main_identitiy on master_wo_status = mwoid_id
  
      where master_wo_status in (1,3) and master_wo_ref= " . $_GET['editId'] . " 
  " . $inColsWO . "
  order by master_wo_id desc
  ");


  if (is_array($WorkOrderMain)) {
    $WorkOrderMain = $WorkOrderMain[0];
  } else {
    die('Invalid Work Order Supplied');
  }
  $itisEdit = true;
  # code...
} else {
  $itisEdit = false;
}
getHead("Sales Order - " . ($itisEdit ? "Edit Sales Order" : "Make New Sales Order"));

?>
<style>
  hr {
    border-bottom: 2px solid black;
  }
</style>
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
            <h1> <?php echo ($itisEdit ? "Edit Sales Order" : "New Sales Order") ?></h1>
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
                  <h4><?php echo ($itisEdit ? "Edit Sales Order" : "New Sales Order") ?></h4>
                </div>

                <div class="card-body text-justify">
                  <div id="formFail" class="alert alert-danger" style="display:none">
                  </div>
                  <div id="formLoading" class="alert alert-warning">
                    Form Is Loading....
                  </div>

                  <div id="formSuccess" class="alert alert-success" style="display:none">
                    <?php echo ($itisEdit ? "This Sales Order has successfully been edited." :
                      "This form has successfully been saved as a Sales Order, in order to send it for verification please click Request Verification.") ?>

                  </div>

                  <form id="formContainer" action="server_fundamentals/SalesWorkOrderSubmit" method="post">
                    <!-- <form id="formContainer" action="PostDumper" method="post"> -->
                    <?php if ($itisEdit) { ?>
                      <input type="hidden" name="work_order_edit_id" value="<?php echo $_GET['editId'] ?>" />
                    <?php } ?>
                    <?php
                    if ($itisEdit && $WorkOrderMain['mwo_type'] != 1) {
                      getFormRepHead($WorkOrderMain['mwo_repeat_wo_id']);
                    }

                    getRow($getAttachedTreeSql);

                    getPrintedSection();

                    getCoatingSection();

                    getFill();

                    getLayer();

                    getRoll($itisEdit,$_GET['editId']);

                    getPouch($itisEdit,$_GET['editId']);

                    getBag($itisEdit,$_GET['editId']);

                    getSlit($itisEdit,$_GET['editId']);
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
  if (isset($_GET['editId'])) {
    getEditTrueBody($WorkOrderMain, $WOstraightArrays, $WOcheckboxArrays, $WOselectArrays);
  }

  ?>

  <?php getScriptInitializer(); ?>

  <?php getScriptTriggers(); ?>

  <?php getScriptFunctionalSetup(); ?>
  
  <script>
    $(document).ready(function(e) {
      <?php
      if (isset($_GET['editId'])) {
        getEditTrueLayers($WorkOrderMain);
      }
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
  <!-- <script>
    $(window).bind('beforeunload', function() {
      return 'Are you sure you want to leave?';
    });
  </script> -->
</body>

</html>