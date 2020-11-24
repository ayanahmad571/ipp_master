<?php
require_once("server_fundamentals/SessionHandler.php");
require_once("server_fundamentals/PostDataHeadChecker.php");


//If Rep from Pub and Rep From Draft are both in the URL, Redirect Back
if (!isset($_GET['repeatFromPublished'])) {
  header('Location: work_order_sales');
  die();
}
//If Repreat from Published is present then pull all the data of this MAIN WORK ORDER
if (!is_numeric($_GET['repeatFromPublished'])) {
  header('Location: work_order_sales');
  die();
}

getHead("Repeat #" . $_GET['repeatFromPublished']);

$getWo = mysqlSelect($UpdatedStatusQuery . "
       
        
left join clients_main on master_wo_2_client_id = client_id
left join master_work_order_main_identitiy on master_wo_status = mwoid_id

    where master_wo_status = 7 and master_wo_ref = " . $_GET['repeatFromPublished'] . " 
" . $inColsWO . "
order by master_wo_id desc
");

if (!is_array($getWo)) {
  header('Location: work_order_sales');
  die();
}

$WorkOrderRepPub =  $getWo[0];


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
            <h1>Repeat WO#<?php echo $_GET['repeatFromPublished'] ?></h1>
          </div>
          <!-- TOP CONTENT BLOCKS -->

          <div class="row">
            <div class="col-12 ">
              <div class="card card-warning">
                <div class="card-header">
                  <h4>Sales Work Order Repeat</h4>
                </div>

                <div class="card-body text-justify">
                  <div id="formFail" class="alert alert-danger" style="display:none">
                  </div>
                  <div id="formLoading" class="alert alert-warning">
                    Form Is Loading
                  </div>

                  <div id="formSuccess" class="alert alert-success" style="display:none">
                    A new Sales order has been created. Data from the Last Work Order has been auto populated.
                  </div>

                  <form id="formContainer" action="server_fundamentals/SalesWorkOrderRepeat" method="post">

                    <input type="hidden" name="work_order_repeat_publish_id" value="<?php echo $_GET['repeatFromPublished'] ?>" />

                    <div id="workOrderHeaderDetails">

                      <div class="row">
                        <div class="form-group col-sm-12 col-md-6 col-xl-2 ">
                          <label>LWO</label>
                          <input type="text" class="form-control" disabled value="#<?php echo $_GET['repeatFromPublished'] ?>">
                        </div>

                        <div class="form-group col-sm-12 col-md-6 col-xl-2 ">
                          <label>Customer P.O Date</label>
                          <input onchange="getDif()" type="text" class="form-control" name="work_order_po_date" placeholder="DD-MM-YYYY">
                        </div>

                        <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                          <label>Required Delivery Date</label>
                          <input onchange="getDif()" type="text" class="form-control" name="work_order_delivery_date" placeholder="DD-MM-YYYY">
                        </div>


                        <div class="form-group col-sm-12 col-md-6 col-xl-2 ">
                          <label>Delivery Required In</label>
                          <input id="numberOfDays" type="text" disabled class="form-control" name="">
                        </div>

                        <div class="form-group col-sm-12 col-md-6 col-xl-2 ">
                          <label>Customer P.O#</label>
                          <input type="text" class="form-control" name="work_order_add_po" placeholder="Purchase Order Reference">
                        </div>

                        <div class="form-group col-sm-12 col-md-6 col-xl-2 ">
                          <label>Previous CCR #</label>
                          <input type="text" class="form-control" name="work_order_ccr_no" placeholder="CCR Number">
                        </div>

                        <div class="form-group col-sm-12 col-md-6 col-xl-2 ">
                          <label>Previous NCR #</label>
                          <input type="text" class="form-control" name="work_order_ncr_no" placeholder="NCR Number">
                        </div>

                      </div>



                      <div class="row">
                        <div class="form-group col-12 col-md-6 col-xl-3">
                          <label>Sales Code</label>
                          <select class="form-control select_a" required name="work_order_2_sales_id">
                            <?php
                            $getDrafts = mysqlSelect($getAttachedTreeSql);

                            if (is_array($getDrafts)) {
                              foreach ($getDrafts as $Draft) {
                                echo '<option value="' . $Draft['lum_id'] . '">' . $Draft['lum_code'] . ' - ' . $Draft['lum_name'] . '</option>';
                              }
                            }
                            ?>
                          </select>


                        </div>

                        <div class="form-group col-12 col-xl-3 ">
                          <label>Order Qty</label>
                          <input placeholder="Order Quantity" name="work_order_repeat_quantity" type="number" step="0.01" class="form-control" min="0.10">
                        </div>

                        <?php
                        getSelectBox(
                          "form-group col-12 col-md-6 col-xl-3 ",
                          "Qty Unit",
                          "work_order_repeat_2_units",
                          "SELECT * FROM `work_order_qty_units` where unit_show =1 ",
                          'unit_id',
                          'unit_value'
                        );
                        ?>



                        <div class="form-group col-12 col-md-6 col-xl-3">
                          <label>Tolerance +/-</label>
                          <input placeholder="Tolerance Min" name="work_order_repeat_quantity_tolerance" type="number" step="0.01" class="form-control" min="0">
                        </div>

                      </div>


                      <hr>

                      <div class="row">


                      </div>
                      <div class="row">
                        <div class="form-group col-12">
                          <label>Overall Remarks</label>
                          <textarea onkeyup="textAreaAdjust(this)" name="work_order_remarks_overall" class="remarksEdit form-control" placeholder="Remarks" style="min-height:200px;"></textarea>
                        </div>
                      </div>



                      <HR>

                    </div>


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

  <script>
    $(document).ready(function() {
      setUpSelect2s();
      getDif();
      $(".remarksEdit").wysihtml5();
      $("#formLoading").hide();

    });

    function setUpSelect2s() {
      $('.select_a').select2();
    }

    function getDif() {
      // To set two dates to two variables 
      var a = $("input[name=work_order_po_date]").val();
      var s = a.split("-");
      var d1 = s[2] + "-" + s[1] + "-" + s[0];

      var b = $("input[name=work_order_delivery_date]").val();
      var s1 = b.split("-");
      var d2 = s1[2] + "-" + s1[1] + "-" + s1[0];

      var date1 = new Date(d1);

      var date2 = new Date(d2);


      // To calculate the time difference of two dates 
      var Difference_In_Time = date2.getTime() - date1.getTime();

      // To calculate the no. of days between two dates 
      var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);


      $("input[id=numberOfDays]").val(Difference_In_Days + " days");


    }
  </script>



  <script>
    $(document).ready(function(e) {

      $('#formContainer').on('submit', (function(e) {
        var formCont = $(this)[0];

        e.preventDefault();

        bootbox.confirm("<?php echo (isset($_GET['draftID']) ? 'Are you sure you want to edit this Work Order?' : 'Are you sure you want to add this Work Order to drafts ?') ?>", function(result) {
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