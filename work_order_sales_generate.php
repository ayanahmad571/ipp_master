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

                    getRoll($itisEdit);

                    getPouch($itisEdit);

                    getBag($itisEdit);
                    

                    getSlit($itisEdit);
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
    if (is_array($WorkOrderMain)) {
  ?>
      <script>
        $(document).ready(function(e) {
          <?php
          foreach ($WOstraightArrays as $k => $v) {
            if (!is_null($WorkOrderMain[$v])) {
              if ($k == 'work_order_delivery_date' || $k == "work_order_po_date") {
                echo '$(\'input[name="' . $k . '"]\').val("' . date('d-m-Y', $WorkOrderMain[$v]) . '");
						';
              } else {
                echo '$(\'input[name="' . $k . '"]\').val("' . $WorkOrderMain[$v] . '");
						';
              }
            }
          }
          ?>

          <?php
          foreach ($WOcheckboxArrays as $k => $v) {

            echo '$(\'input[name="' . $k . '[]"]\').each(function() {
						this.checked = false;
					});
					';
            if ($WorkOrderMain[$v] != '') {
              $s = explode(',', $WorkOrderMain[$v]);
              foreach ($s as $val) {
                echo '$(\'input:checkbox[name="' . $k . '[]"]\').filter("[value=\'' . $val . '\']").prop(\'checked\', true);
							';
              }
            }
          }
          ?>

          <?php
          foreach ($WOselectArrays as $k => $v) {
            if (!is_null($WorkOrderMain[$v])) {
              echo '$(\'select[name="' . $k . '"]\').val("' . $WorkOrderMain[$v] . '").change();
          ';
            }
          }
          ?>




        });
      </script>

  <?php
    }
  }

  ?>

  <script>
    $(document).ready(function() {

      //Initial Setup
      setUpLaminateEntryLayers();

      setPrintedSetup();
      setBagPouchSetup();
      setUpSelect2s();
      setUpFilmToLaminate();
      getDif();
      setUpPouchImage();
      setUpBagImage();
      setUpRollImage();
      setCustName();
      setUpMaxPouch();
      setUpPrintingOption();
      setLamGSM();
      setUpInkGsmCalc();
      setPastRet()
      setCartonPly();
      $(".remarksEdit").wysihtml5();

      //Listeners	

      //Trigger Functions for Ply Value Change
      $('#plyValueInput').change(function(e) {
        if ($('#plyValueInput').val() > 0 && $('#plyValueInput').val() < 6) {
          setUpLaminateEntryLayers();

          setUpFilmToLaminate();
          setUpSelect2s();
        }
      });

      //Trigger Functions for Essentials Printed Change
      $("input[name=work_order_3_essentials_printed]").change(function(e) {
        setPrintedSetup();
      });

      //Trigger Functions for Structure
      $("select[name=work_order_2_structure]").change(function(e) {
        setBagPouchSetup();
        setCartonPly();
      });


      $("select[name=work_order_2_client_id]").change(function(e) {
        setCustName();
      });


      for (l = 1; l <= ($('#plyValueInput').val()); l++) {

        $('select[name="work_order_5_layer_' + l + '_material"]').change(function(e) {
          setUpFilmToLaminate();
          setLamGSM();
        });

      }

      for (l = 1; l <= ($('#plyValueInput').val()); l++) {

        $('input[name="work_order_layer_' + l + '_micron"]').change(function(e) {
          setUpFilmToLaminate();
          setLamGSM();
        });

      }
      for (l = 1; l < ($('#plyValueInput').val()); l++) {

        $('input[name="work_order_adh' + l + '"]').change(function(e) {
          setAdhesiveGsm();
        });

      }




      $('#plyValueInput').change(function(e) {
        if ($('#plyValueInput').val() > 0 && $('#plyValueInput').val() < 6) {

          for (l = 1; l <= ($('#plyValueInput').val()); l++) {
            $('input[name="work_order_layer_' + l + '_micron"]').change(function(e) {
              setUpFilmToLaminate();
              setLamGSM();
            });

            $('select[name="work_order_5_layer_' + l + '_material"]').change(function(e) {
              setUpFilmToLaminate();
              setLamGSM();

            });

          }
          for (l2 = 1; l2 < ($('#plyValueInput').val()); l2++) {

            $('input[name="work_order_adh' + l2 + '"]').change(function(e) {
              setAdhesiveGsm();

            });

          }


        }
      });


      $("#pouch_switcher").change(function(e) {
        setUpPouchImage();
      });

      $("#bag_switcher").change(function(e) {
        setUpBagImage();
      });

      $("select[name=work_order_2_wind_dir]").change(function(e) {
        setUpRollImage();
      });

      $("#pouchPerBundle").change(function(e) {
        setUpMaxPouch();
      });

      $("#bundlePerBox").change(function(e) {
        setUpMaxPouch();
      });

      $("select[name=work_order_2_type_printed]").change(function(e) {
        setUpPrintingOption();
      });

      $('input[name="work_order_ink_gsm_pre_c"]').change(function(e) {
        setUpInkGsmCalc();
      });

      $("select[name=work_order_2_fill_temp]").change(function(e) {
        setPastRet();
      });

      $("select[name=work_order_2_roll_pack_ins]").change(function(e) {
        setCartonPly();
      });

      $("#formLoading").hide();
    });

    function setCartonPly() {
      let struct = $('select[name=work_order_2_structure]').find(':selected').val();
      let bagPouchCont = $('select[name=work_order_2_roll_pack_ins]').find(':selected').val();
      let rollCont = $('select[name=work_order_2_carton_pack_ins]').find(':selected').val();

      if (struct == 1 || struct == 2) {
        //Bag/Pouch
        $("#cartonPly").show();
      } else {
        //ROll

        if (bagPouchCont == 1) {
          $("#cartonPly").hide();
        } else {
          $("#cartonPly").show();
        }
      }
    }

    function setPastRet() {
      var selectedItem = $("select[name=work_order_2_fill_temp] :selected").val();
      if (selectedItem == 4 || selectedItem == 5) {
        $(".pastRetShow").show();
        $(".nonPastRetShow").hide();
      } else {
        $(".pastRetShow").hide();
        $(".nonPastRetShow").show();
      }
    }

    function setUpInkGsmCalc() {
      let vals = $('input[name="work_order_ink_gsm_pre_c"]').val();
      if (vals === '') {
        $("#calcInkGSM").val(0);
      } else {
        $("#calcInkGSM").val(vals);
      }
      totalGSM();

    }

    function setLamGSM() {

      var layers = $('#plyValueInput').val();
      var l;
      var c = 0;

      for (l = 1; l <= (layers); l++) {
        var den = $('select[name=work_order_5_layer_' + l + '_material]').find(':selected').data('density');
        var gsm = $('input[name=work_order_layer_' + l + '_micron]').val();
        c += den * gsm;
      }

      $("#calcLamGSM").val(c);
      totalGSM();

    }

    function setAdhesiveGsm() {
      var layers = $('#plyValueInput').val();
      var l = 1;
      var c = 0;


      for (l; l < (layers); l++) {
        var adh = new Number($('input[name=work_order_adh' + l + ']').val());
        if ((adh) == '') {
          adh = 0;
        }
        c += (adh);
      }
      $("#calcAdhGSM").val(c);
      totalGSM();

    }

    function totalGSM() {
      var a = new Number($('#calcLamGSM').val());
      var b = new Number($('#calcInkGSM').val());
      var c = new Number($('#calcAdhGSM').val());

      $("#calcTotGSM").val(a + b + c);
    }

    function setUpPrintingOption() {
      var a = $("select[name=work_order_2_type_printed] :selected").val();
      if (a == 1) {
        $('.whenPrintedClickedGO').show();
      } else {
        $('.whenPrintedClickedGO').hide();
      }


    }

    function setUpMaxPouch() {
      var a = $("#pouchPerBundle").val();
      var b = $("#bundlePerBox").val();

      if (isNaN(a)) {
        a = 0;
      }

      if (isNaN(b)) {
        b = 0;
      }

      $("#piecePerBox").val(a * b)

    }

    function setCustName() {
      var custNameVar = $("select[name=work_order_2_client_id]").children("option:selected").data("name");
      $("input[id=custNameGetter]").val(custNameVar);
    }

    function setBagPouchSetup() {
      bagPouchRoll = $("select[name=work_order_2_structure]").children("option:selected").val();

      if (bagPouchRoll == 1) {
        $(".classOnlyBag").fadeIn();
        $(".classBagPouch").fadeIn();
        $(".classBagRoll").fadeIn();

        $(".classOnlyPouch").fadeOut();
        $(".classPouchRoll").fadeOut();

        $(".classOnlyRoll").fadeOut();
        $(".classPouchRoll").fadeOut();

      } else if (bagPouchRoll == 2) {
        $(".classOnlyBag").fadeOut();
        $(".classBagRoll").fadeOut();

        $(".classOnlyPouch").fadeIn();
        $(".classBagPouch").fadeIn();
        $(".classPouchRoll").fadeIn();

        $(".classOnlyRoll").fadeOut();
        $(".classBagRoll").fadeOut();

      } else if (bagPouchRoll == 3) {
        $(".classOnlyBag").fadeOut();
        $(".classBagPouch").fadeOut();

        $(".classOnlyPouch").fadeOut();
        $(".classBagPouch").fadeOut();

        $(".classOnlyRoll").fadeIn();
        $(".classPouchRoll").fadeIn();
        $(".classBagRoll").fadeIn();
      }


    }

    function setPrintedSetup() {
      printedVal = $("input[name=work_order_3_essentials_printed]:checked").val();
      if (printedVal == 0) {
        $("#workOrderPrintingProcess").fadeOut();
      } else {
        $("#workOrderPrintingProcess").fadeIn();
      }
    }

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

    function setUpLaminateEntryLayers() {
      var layers = $('#plyValueInput').val();
      var containerLayer = $('#containerLaminateLayers');

      var lamPrefix = 'laminateRowId';
      var stringOutput = "";
      var l;
      var colW = 12;

      if (layers == 2) {
        colW = 6;
      } else if (layers == 3) {
        colW = 4;
      } else if (layers == 4) {
        colW = 6;
      } else if (layers == 5) {
        colW = 6;
      }
      for (l = 1; l <= (layers); l++) {

        stringOutput = stringOutput.concat("",
          "<div id=\"laminateRowId" + l + "\" class=\"col-12 col-lg-6 col-xl-" + colW + "\">",
          "    <div >",
          "        <div class=\"row\">",
          "           <div class=\"col-12\">",
          "               <p align=\"left\" style=\"margin-left:10px\">Film/Laminate Layer " + l + "</p>",
          "            </div>",
          "        </div>",
          "       <div class=\"row\">",
          "           <div class=\"form-group col-6\">",
          "            <label>Micron</label>",
          "             <input type=\"number\" class=\"form-control\" min='0' step='0.01' required name=\"work_order_layer_" + l + "_micron\" placeholder=\"Film Micron\">",
          "           </div>",
          "           <div class=\"form-group col-6\">",
          "             <label>Film</label>",
          "             <select class=\"form-control select_a\" required name=\"work_order_5_layer_" + l + "_material\">",
          <?php
          $getMaterials = mysqlSelect("SELECT * FROM `materials_main` order by material_value asc");
          if (is_array($getMaterials)) {
            foreach ($getMaterials as $Material) {
              echo '"<option data-density=\"' . $Material['material_density'] . '\" value=\"' . $Material['material_id'] . '\">' . $Material['material_value'] . '</option>",';
            }
          }
          ?> "            </select> ",
          "           </div>",
          "        </div>",
          "   </div>",
          "</div>");


      }
      containerLayer.html(stringOutput);
      stringOutput = "";


      var adhesiveSection = $('#adhesiveSection');
      varOutString = "";

      for (l2 = 1; l2 <= (layers - 1); l2++) {
        varOutString = varOutString.concat("",
          '<div class="form-group  col-12 col-md-6 col-xl-3">',
          "<label>Adhesive Pass " + l2 + " GSM</label>",
          '<input type="number" class="form-control" name="work_order_adh' + l2 + '" placeholder="Adhesive ' + l2 + ' GSM">',
          "</div>");

      }
      adhesiveSection.html(varOutString);
      varOutString = "";




      setLamGSM();

    }

    function setUpFilmToLaminate() {
      var layers = $('#plyValueInput').val();
      var l;

      var foilPrint = false;


      for (l = 1; l <= (layers); l++) {
        var valFilmID = $('select[name="work_order_5_layer_' + l + '_material"] option:selected').val();


        if ((l == 1) && (valFilmID == 3 || valFilmID == 17 || valFilmID == 52)) {
          foilPrint = true;
        }

      }

      if (!foilPrint) {
        $("#workOrderFoilPrint").fadeOut();
      } else {
        $("#workOrderFoilPrint").fadeIn();
      }

    }

    function setUpPouchImage() {
      $("#pouchSwHolder").html('<img class="img-thumbnail" src="' + $("#pouch_switcher").find(':selected').data('id') + '" />');

    }

    function setUpBagImage() {
      $("#bagSwHolder").html('<img class="img-thumbnail" src="' + $("#bag_switcher").find(':selected').data('id') + '" />');

    }

    function setUpRollImage() {
      $("#imgRollPut").html('<img class="img-thumbnail" src="assets/slitting/' + $("select[name=work_order_2_wind_dir]").find(':selected').data('id') + '.jpg" />');

    }
  </script>

  <script>
    $(document).ready(function(e) {
      <?php
      if (isset($_GET['editId'])) {
        if (is_array($WorkOrderMain)) {
          if (is_numeric($WorkOrderMain['master_wo_ply'])) {

            for ($counterL = 1; $counterL <= $WorkOrderMain['master_wo_ply']; $counterL++) {
              echo '$(\'input[name="work_order_layer_' . $counterL . '_micron"]\').val("' . $WorkOrderMain['master_wo_layer_' . $counterL . '_micron'] . '");';
              echo '$(\'select[name="work_order_5_layer_' . $counterL . '_material"]\').val("' . $WorkOrderMain['master_wo_layer_' . $counterL . '_structure'] . '").change();';
            }
            for ($counterL = 1; $counterL < $WorkOrderMain['master_wo_ply']; $counterL++) {
              echo '$(\'input[name="work_order_adh' . $counterL . '"]\').val("' . $WorkOrderMain['master_wo_adh' . $counterL ] . '");';
            }
          }
        }
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