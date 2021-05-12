<?php
require_once("server_fundamentals/SessionHandler.php");

$WorkOrderMain = array();
if (!isset($_GET['id'])) {
    die("Work Order ID Not Provided");
}
if (!is_numeric($_GET['id'])) {
    die("Invalid Work Order ID Provided");
}


# PRE FORM CREATION CHECKS

## Check if work orders exists

$WorkOrderMain = mysqlSelect($UpdatedStatusQuery . "
       
        
  left join clients_main on master_wo_2_client_id = client_id
  left join master_work_order_main_identitiy on master_wo_status = mwoid_id
  
      where master_wo_status not in (1,2,3,10) and master_wo_ref= " . $_GET['id'] . " 
  " . $inColsWO . "
  order by master_wo_id desc
  ");


if (is_array($WorkOrderMain)) {
    $WorkOrderMain = $WorkOrderMain[0];
} else {
    die('Invalid Work Order Supplied');
}

## If this amendment is currently being verified or open

$checkIn = mysqlSelect("select * from (
    select * from amendment_form_main a where a.afm_id = 
    (SELECT c.afm_id FROM `amendment_form_main` c 
    where c.afm_rel_wo_ref = a.afm_rel_wo_ref
    order by c.afm_id desc 
    limit 1) ) ap 
    left join amendment_form_identity ai on ap.afm_status = ai.afi_id
    where 
    ap.afm_status not in (99) and ap.afm_rel_wo_ref = " . $_GET['id']);

if (!is_array($checkIn)) {
    die("This amendment form doesn't exist for this status");
}


# PRE FORM CREATION CHECKS END


$getNumberAmendment = mysqlSelect("select count(afm_id) as total 
from amendment_form_main 
where afm_rel_wo_ref = " . $_GET["id"] . " and afm_status = 10 ");

$totPrint = 1;
if (is_array($getNumberAmendment)) {
    $totPrint = 1 + $getNumberAmendment[0]["total"];
}

$viewOnly = !($checkIn[0]["afm_status"] == 1 || 
$checkIn[0]["afm_status"] == 3 || 
$checkIn[0]["afm_status"] == 5 || 
$checkIn[0]["afm_status"] == 7 || 
$checkIn[0]["afm_status"] == 9);

getHead("Amendment Form - WO#" . $WorkOrderMain['master_wo_ref']);

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


            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Amendment Form - WO#<?php echo $WorkOrderMain['master_wo_ref'] ?></h1>
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

                                <div class="card-body text-justify">
                                    <div id="formFail" class="alert alert-danger" style="display:none">
                                    </div>

                                    <div id="formSuccess" class="alert alert-success" style="display:none">
                                        The amendment form has been saved.
                                    </div>
                                    <h5 align="center">WO Details</h5>
                                    <div class=" col-12">
                                        <table class="table  table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><strong>PO:</strong> <?php echo $WorkOrderMain['master_wo_customer_po'] ?></td>
                                                    <td><strong>Customer:</strong> <?php echo $WorkOrderMain['client_code'] . " - " . $WorkOrderMain['client_name']  ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Design Name:</strong> <?php echo $WorkOrderMain['master_wo_customer_design_name'] ?></td>
                                                    <td><strong>Design ID:</strong> <?php echo $WorkOrderMain['master_wo_design_id'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h5 align="center">Form Details</h5>
                                    <div class=" col-12">
                                        <table class="table  table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Amendment #:</strong> <?php echo $totPrint; ?></td>
                                                    <td><strong>Status:</strong> <?php echo $checkIn[0]['afi_text'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Generated By:</strong>
                                                        <?php $lum = getLum($checkIn[0]['afm_gen_lum_id']);
                                                        echo $lum['lum_code'] . " - " . $lum['lum_name']; ?>
                                                    </td>
                                                    <td><strong>Timestamp:</strong> <?php echo date(getDateTimeFormat(), $checkIn[0]['afm_gen_dnt']); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <form id="formContainer" action="AmendmentController/AmendmentSalesController" method="post">
                                        <!-- <form id="formContainer" action="PostDumper" method="post"> -->
                                        <input type="hidden" name="edit_amend_work_order_id" value="<?php echo $_GET['id'] ?>" />


                                        <div class="form-group col-12">
                                            <label>Reason to Modify</label>
                                            <input <?php echo ($viewOnly ? "disabled" : " ") ?> value="<?php echo $checkIn[0]['afm_reason'] ?>" type="text" required class="form-control" name="edit_amend_reason" placeholder="Reason ...">
                                        </div>


                                        <div class="form-group col-12">
                                            <label>Modification 1</label>
                                            <input <?php echo ($viewOnly ? "disabled" : " ") ?> value="<?php echo $checkIn[0]['afm_mod_1'] ?>" type="text" required class="form-control" name="edit_amend_mod_1" placeholder="Modification Details ... ">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Modification 2</label>
                                            <input <?php echo ($viewOnly ? "disabled" : " ") ?> value="<?php echo $checkIn[0]['afm_mod_2'] ?>" type="text" class="form-control" name="edit_amend_mod_2" placeholder="Modification Details ... ">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Modification 3</label>
                                            <input <?php echo ($viewOnly ? "disabled" : " ") ?> value="<?php echo $checkIn[0]['afm_mod_3'] ?>" type="text" class="form-control" name="edit_amend_mod_3" placeholder="Modification Details ... ">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Notes</label>
                                            <textarea <?php echo ($viewOnly ? "disabled" : " ") ?> name="edit_amend_notes" class="form-control remarksEdit" placeholder="Remarks" style="height:200px"><?php echo $checkIn[0]['afm_notes'] ?></textarea>
                                        </div>

                                        <?php if (!$viewOnly) { ?>
                                            <div class="form-group" align="center">
                                                <button type="submit" class="btn btn-success">Save</button>
                                            </div>
                                        <?php } ?>


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
    <script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
    <script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
    <script src="assets/js/bootbox.min.js"></script>

    <script>
        $(".remarksEdit").wysihtml5();
    </script>
    <?php if (!$viewOnly) { ?>
        <script>
            $(document).ready(function(e) {

                $('#formContainer').on('submit', (function(e) {
                    var formCont = $(this)[0];

                    e.preventDefault();

                    bootbox.confirm("Are you sure you want to add this Amendment Form ?", function(result) {
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
                                        setTimeout(function() {
                                            window.location.reload();
                                        }, 3000);
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
    <?php } ?>
    <!-- <script>
    $(window).bind('beforeunload', function() {
      return 'Are you sure you want to leave?';
    });
  </script> -->

</body>

</html>