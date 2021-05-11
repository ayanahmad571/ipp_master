<?php
#57,58,59,60,61,62,63,64,65,66,67
require_once("server_fundamentals/SessionHandler.php");
require_once("AmendmentController/AmendmentHelper.php");

getEssentials("Amendment Form - Planning");

$pubQuery = getPubQuery();

?>

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
          <?php getPageTitle("Amendment Form - Planning Verify"); ?>
          <!-- TOP CONTENT BLOCKS -->

          <hr id="Splitter" />

          <?php
          getSentBody($pubQuery, "TableZero", "8");

          getReturnBody($pubQuery, "TableOne", "9");
          ?>

        </section>


      </div><!-- Main Content  -->

      <?php
      getFooter();
      ?>

    </div><!-- Main Wrapper  -->
  </div><!-- App -->



  <?php
  getModal();
  getScripts();
  ?>


  <script src="assets/js/bootbox.min.js"></script>

  <script type="text/javascript" src="assets/Datatables/datatables.min.js"></script>

  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

  <?php
  getBootboxScript("sendAmendment", "Are you sure you want to Approve this Amendment Form ", 8, 10);
  getDiscardScript("discardDraft", "AmendmentPlanningController");
  getPrintJS();
  getDataTableDefiner("TableZero", 7);
  getDataTableDefiner("TableOne", 7);
  ?>


</body>

</html>