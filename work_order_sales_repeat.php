<?php
require_once("server_fundamentals/SessionHandler.php");
require_once("server_fundamentals/PostDataHeadChecker.php");


//If Rep from Pub and Rep From Draft are both in the URL, Redirect Back
if (isset($_GET['repeatFromPublished']) & count($_GET) == 1) {
}else{
    die("A");
}

getHead("Repeat #".$_GET['repeatFromPublished']);

//If Repreat from Published is present then pull all the data of this MAIN WORK ORDER
if (isset($_GET['repeatFromPublished'])) {
  if (!is_numeric($_GET['repeatFromPublished'])) {
    header('Location: work_order_sales');
    die();
  }

  $getWo = mysqlSelect($UpdatedStatusQuery . "
       
        
		left join clients_main on master_wo_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id

        where master_wo_status = 9 and master_wo_ref= " . $_GET['repeatFromPublished'] . " 
		" . $inColsWO . "
		order by master_wo_id desc
		");

  if (!is_array($getWo)) {
    header('Location: work_order_sales');
    die();
  }

  $WorkOrderRepPub =  $getWo[0];
}


?>
<link href="assets/css/select2.min.css" rel="stylesheet" />


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
            <h1>Repeat #<?php echo $_GET['repeatFromPublished'] ?></h1>
          </div>
          <!-- TOP CONTENT BLOCKS -->

          <div class="row">
            <div class="col-12 ">
              <div class="card card-warning">
                <div class="card-header">
                  <h4>Work Order Repeat</h4>
                </div>

                <div class="card-body text-justify">
                  <div id="formFail" class="alert alert-danger" style="display:none">
                  </div>
                  <div id="formLoading" class="alert alert-warning">
                    Form Is Loading
                  </div>

                  <div id="formSuccess" class="alert alert-success" style="display:none">
                    <?php if (isset($_GET['draftID'])) {
                      echo 'Draft has Sucessfully been edited';
                    } else { ?>This FORM has been saved as a NEW draft.<?php } ?>
                  </div>

                  <form id="formContainer" action="server_fundamentals/SalesWorkOrderSubmit" method="post">
                    <?php

                    if (isset($_GET['draftID'])) {  ?>
                      <input type="hidden" name="work_order_edit_draft_id" value="<?php echo $WorkOrderRepDraft['s_wo_id'] ?>" />
                    <?php
                    }
                    ?>

                    <?php

                    if (isset($_GET['repeatFromPublished'])) {  ?>
                      <input type="hidden" name="work_order_repeat_publish_id" value="<?php echo $_GET['repeatFromPublished'] ?>" />
                    <?php
                    }
                    ?>

                    <div id="workOrderHeaderDetails">

                      <div class="row">
                        <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                          <label>LWO</label>
                          <input type="text" class="form-control" name="" placeholder="DD-MM-YYYY" value="<?php echo $_GET['repeatFromPublished'] ?>">
                        </div>

                      

                        <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                          <label>Customer(s) Required Delivery Date</label>
                          <input type="text" class="form-control" name="work_order_delivery_date" placeholder="DD-MM-YYYY">
                        </div>
                        
                        <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                          <label>Customer P.O Date</label>
                          <input type="text" class="form-control" name="work_order_po_date" placeholder="DD-MM-YYYY">
                        </div>

                      
                        
                        <div class="form-group col-sm-12 col-md-6 col-lg-3 col-xl-2">
                          <label>Customer P.O#</label>
                          <input type="text" class="form-control" name="work_order_add_po" placeholder="Purchase Order Reference">
                        </div>


                      </div>

                      <div class="row">

                       <div class="form-group col-12 col-md-6 col-lg-3 col-xl-2">
                          <label>Sales Code</label>
                          <select class="form-control select_a" required name="work_order_5_sales_id">
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

                        

                      </div>

                      <div class="row">
                        <div class="form-group col-8 col-xl-4 ">
                          <label>Order Qty</label>
                          <input placeholder="Order Quantity" name="work_order_quantity" type="number" step="0.01" class="form-control" min="0.10">
                        </div>

                        <?php
                        getSelectBox("form-group col-4 col-xl-2 ",
                        "Qty Unit",
                        "work_order_5_units",
                        "SELECT * FROM `work_order_qty_units` ",
                        'unit_id',
                        'unit_value'
                        );
                        ?>

                        <div class="row col-12 col-xl-6">
                          <div class="form-group col-1 col-xl-1 ">
                            <label>&nbsp;</label>
                            <h6>+</h6>
                          </div>

                          <div class="form-group col-4 col-xl-4">
                            <label>&nbsp;</label>
                            <input placeholder="Tolerance Min" name="work_order_quantity_tolerance_1" type="number" step="0.01" class="form-control" min="0">
                          </div>

                          <div class="form-group col-1 col-xl-1 ">
                            <label>&nbsp;</label>
                            <h6>-</h6>
                          </div>

                          <div class="form-group col-4 col-xl-4 ">
                            <label>&nbsp;</label>
                            <input placeholder="Tolerance Max" name="work_order_quantity_tolerance_2" type="number" step="0.01" class="form-control" min="0">
                          </div>

                          <div class="form-group col-1 col-xl-1 ">
                            <label>&nbsp;</label>
                            <h6>%</h6>
                          </div>

                        </div>
                      </div>

                      
                        <hr>

                        <div class="row">
                        <div class="form-group col-sm-12 col-lg-6 ">
                          <label>Previous CCR #</label>
                          <input type="text" class="form-control" name="work_order_ncr_no" placeholder="CCR Number">
                        </div>
                        <div class="form-group col-sm-12 col-lg-6 ">
                          <label>Previous NCR #</label>
                          <input type="text" class="form-control" name="work_order_ccr_no" placeholder="NCR Number">
                        </div>

                      </div>
                      <div class="row">
                        <div class="form-group col-12">
                          <label>Overall Remarks</label>
                          <textarea name="work_order_remarks_overall" class="form-control" placeholder="Remarks" style="height:90px"></textarea>
                        </div>
                      </div>
                      


                      <HR>

                    </div>


                    <div class="form-group" align="center">
                      <button type="submit" class="btn btn-success">Send for Verification</button>
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
  <?php
  if (isset($_GET['repeatFromPublished'])) {
    #load all contents onto the page
    if (is_array($WorkOrderRepPub)) {
  ?>

      <script>
        $(document).ready(function(e) {

          <?php
          foreach ($master_wo_straightArrays as $k => $v) {
            if ($k == 'work_order_delivery_date') {
              echo '$(\'input[name="' . $k . '"]\').val("' . date('d-m-Y', $WorkOrderRepPub[$v]) . '");';
            } else if ($k == 'work_order_lwo') {
              echo '$(\'input[name="' . $k . '"]\').val("' . $_GET['repeatFromPublished'] . '");';
            } else {
              echo '$(\'input[name="' . $k . '"]\').val("' . $WorkOrderRepPub[$v] . '");';
            }
          }

          foreach ($master_wo_radioArrays as $k => $v) {
            echo '$(\'input:radio[name="' . $k . '"]\').filter(\'[value="' . $WorkOrderRepPub[$v] . '"]\').attr(\'checked\', true);';
          }

          foreach ($master_wo_checkboxArrays as $k => $v) {

            echo '$(\'input[name="' . $k . '[]"]\').each(function() {
						this.checked = false;
					});';
            if ($WorkOrderRepPub[$v] != '') {
              $s = explode(',', $WorkOrderRepPub[$v]);
              foreach ($s as $val) {
                echo '$(\'input:checkbox[name="' . $k . '[]"]\').filter("[value=\'' . $val . '\']").prop(\'checked\', true);';
              }
            }
          }


          foreach ($master_wo_selectArrays as $k => $v) {
            echo '$(\'select[name="' . $k . '"]\').val("' . $WorkOrderRepPub[$v] . '").change();';
          }
          ?>

        });
      </script>

    <?php
    }
  }

  if (isset($_GET['repeatFromDraft'])) {
    #load all contents onto the page
    if (is_array($WorkOrderRepDraft)) {
    ?>

      <script>
        $(document).ready(function(e) {

          <?php
          foreach ($sales_straightArrays as $k => $v) {
            if ($k == 'work_order_delivery_date') {
              echo '$(\'input[name="' . $k . '"]\').val("' . date('d-m-Y', $WorkOrderRepDraft[$v]) . '");	
						';
            } else {
              echo '$(\'input[name="' . $k . '"]\').val("' . $WorkOrderRepDraft[$v] . '");
						';
            }
          }

          foreach ($sales_textareaArrays as $k => $v) {
            echo '$(\'textarea[name="' . $k . '"]\').text("' . str_replace('
', ' ', $WorkOrderRepDraft[$v]) . '");
						';
          }

          foreach ($sales_radioArrays as $k => $v) {
            echo '$(\'input:radio[name="' . $k . '"]\').filter(\'[value="' . $WorkOrderRepDraft[$v] . '"]\').attr(\'checked\', true)
						';
          }

          foreach ($sales_checkboxArrays as $k => $v) {

            echo '$(\'input[name="' . $k . '[]"]\').each(function() {
						this.checked = false;
					});
					';
            if ($WorkOrderRepDraft[$v] != '') {
              $s = explode(',', $WorkOrderRepDraft[$v]);
              foreach ($s as $val) {
                echo '$(\'input:checkbox[name="' . $k . '[]"]\').filter("[value=\'' . $val . '\']").prop(\'checked\', true);
							';
              }
            }
          }

          foreach ($sales_selectArrays as $k => $v) {
            echo '$(\'select[name="' . $k . '"]\').val("' . $WorkOrderRepDraft[$v] . '").change();
					';
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
      setSplHoleDia();
      setUpSelect2s();
      setUpFilmToLaminate();
      fillSubstrate();
      setUpTubeLength();
      setUpTubeCircum();
      setUpPouchImage();
      setUpBagImage();

      //Listeners	

      //Trigger Functions for Ply Value Change
      $('#plyValueInput').change(function(e) {
        if ($('#plyValueInput').val() > 0 && $('#plyValueInput').val() < 6) {
          setUpLaminateEntryLayers();
           
          setUpFilmToLaminate();
          $('.select_material').select2();
        }
      });

      //Trigger Functions for Essentials Printed Change
      $("input[name=work_order_3_essentials_printed]").change(function(e) {
        setPrintedSetup();
      });

      //Trigger Functions for Structure
      $("select[name=work_order_3_structure]").change(function(e) {
        setBagPouchSetup();
      });

      $('#splHoleInputCheck').click(function(e) {
        setSplHoleDia();
      });

      for (l = 1; l <= ($('#plyValueInput').val()); l++) {
        $('input[name="work_order_layer_' + l + '_micron"]').change(function(e) {
          setUpFilmToLaminate();
          fillSubstrate();
        });

        $('select[name="work_order_5_layer_' + l + '_material"]').change(function(e) {
          setUpFilmToLaminate();
          fillSubstrate();
        });

      }

      $('#plyValueInput').change(function(e) {
        if ($('#plyValueInput').val() > 0 && $('#plyValueInput').val() < 6) {

          for (l = 1; l <= ($('#plyValueInput').val()); l++) {
            $('input[name="work_order_layer_' + l + '_micron"]').change(function(e) {
              setUpFilmToLaminate();
              fillSubstrate();
            });

            $('select[name="work_order_5_layer_' + l + '_material"]').change(function(e) {
              setUpFilmToLaminate();
              fillSubstrate();
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

      $("#formLoading").hide();
    });

    function setSplHoleDia() {
      var splHoleDiaCont = $("#splHoleDiaContainer");
      var optionsVal = $("#splHoleInputCheck");
      if (optionsVal.is(":checked")) {
        splHoleDiaCont.fadeIn();
      } else {
        splHoleDiaCont.fadeOut();
      }

    }

    function setBagPouchSetup() {
      bagPouchRoll = $("select[name=work_order_3_structure]").children("option:selected").val();

      if (bagPouchRoll == 1) {
        $("#workOrderBagProcess").fadeIn();
        $("#workOrderPouchProcess").fadeOut();
      } else if (bagPouchRoll == 2) {
        $("#workOrderBagProcess").fadeOut();
        $("#workOrderPouchProcess").fadeIn();
      } else if (bagPouchRoll == 3) {
        $("#workOrderBagProcess").fadeOut();
        $("#workOrderPouchProcess").fadeOut();
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

    function setUpLaminateEntryLayers() {
      var layers = $('#plyValueInput').val();
      var containerLayer = $('#containerLaminateLayers');
      var lamPrefix = 'laminateRowId';
      var stringOutput = "";
      var l;

      for(l = 1; l <= (layers); l++){
		stringOutput = stringOutput.concat(""+
		"<div id=\"laminateRowId" + l + "\" class=\"row\">"+
		"    <div class=\"col-12\">"+
		"        <div class=\"row\">"+
		"           <div class=\"col-12\">"+
		"               <p align=\"left\" style=\"margin-left:10px\">Film/Laminate Layer " + l + "</p>"+
		"            </div>"+
		"        </div>"+
		"       <div class=\"row\">"+
		"           <div class=\"form-group col-6\">"+
		"            <label>Micron</label>"+
		"             <input type=\"number\" class=\"form-control\" min='0' step='0.01' required name=\"work_order_layer_" + l + "_micron\" placeholder=\"Film Micron\">" +
		"           </div>"+
		"           <div class=\"form-group col-6\">"+
		"             <label>Film</label>"+
		"             <select class=\"form-control select_a\" required name=\"work_order_5_layer_" + l + "_material\">                        <?php
							 $getMaterials= mysqlSelect("SELECT * FROM `materials_main` order by material_value asc");
							 if(is_array($getMaterials)){
								 foreach($getMaterials as $Material){
									 echo '<option value=\"'.$Material['material_id'].'\">'.$Material['material_value'].'</option>';
								 }
							 }
							?>
	</select>"+
		"           </div>"+
		"        </div>"+
		"   </div>"+
		"</div>");
	}

      containerLayer.html(stringOutput);
      stringOutput = "";

    }

    function setUpFilmToLaminate() {
      var layers = $('#plyValueInput').val();
      var stringOutput = "";
      var l;
      
      var foilPrint = false;
      var foilLam = false;

      for (l = 1; l <= (layers); l++) {
        var valMicron = $('input[name="work_order_layer_' + l + '_micron"]').val();
        var valFilm = $('select[name="work_order_5_layer_' + l + '_material"] option:selected').text();
        var valFilmID = $('select[name="work_order_5_layer_' + l + '_material"] option:selected').val();


        if ((l == 1 ) && (valFilmID == 3 || valFilmID== 17 || valFilmID == 52) ){
          foilPrint = true;
        }
        if ((l == 2 ) && (valFilmID == 3 || valFilmID== 17 || valFilmID == 52) ){
          foilLam = true;
        }

        stringOutput = ('' +
          '<div class="form-group col-12 col-sm-6 ">' +
          '<label>Micron</label>' +
          '<input type="text" class="form-control" disabled value="' + valMicron + '">' +
          '</div>' +
          '<div class="form-group col-12 col-sm-6 ">' +
          '<label>Film</label>' +
          '<input type="text" class="form-control" disabled value="' + valFilm + '">' +
          '</div>');
        $("#lamFilmFiller" + l).html(stringOutput);
        stringOutput = "";

      }

      if(!foilLam){
        $("#workOrderFoilLam").fadeOut();
      } else {
        $("#workOrderFoilLam").fadeIn();
      }

      if(!foilPrint){
        $("#workOrderFoilPrint").fadeOut();
      } else {
        $("#workOrderFoilPrint").fadeIn();
      }

    }

    function setUpTubeLength() {
      var a = parseFloat($('input[name="work_order_printing_single_coil_width"]').val());
      var b = parseFloat($('input[name="work_order_printing_ups_val"]').val());
      var c = parseFloat($('input[name="work_order_printing_trim_val"]').val());
      var holder = $('#cylinderLengthCalculation');

      holder.html(a + " x " + b + " + " + c + " = " + ((a * b) + c));
    }

    function setUpTubeCircum() {
      var a = parseFloat($('input[name="work_order_printing_single_coil_circ"]').val());
      var b = parseFloat($('input[name="work_order_printing_accross_val"]').val());
      var c = parseFloat($('input[name="work_order_printing_bleed_val"]').val());
      var holder = $('#cylinderCircumferenceCalculation');

      holder.html(a + " x " + b + " + " + c + " = " + ((a * b) + c));
    }

    function fillSubstrate() {
      var micronLevel = $('input[name="work_order_layer_1_micron"]').val();
      var FilmLevel = $('select[name="work_order_5_layer_1_material"] option:selected').text();

      $("#inputSubstrate").val(micronLevel + "u, " + FilmLevel);
    }


    function setUpPouchImage() {
      $("#pouchSwHolder").html('<img class="img-thumbnail" src="' + $("#pouch_switcher").find(':selected').data('id') + '" />');

    }

    function setUpBagImage() {
      $("#bagSwHolder").html('<img class="img-thumbnail" src="' + $("#bag_switcher").find(':selected').data('id') + '" />');

    }
  </script>

  <script>
    $(document).ready(function(e) {
      <?php
      //Fill the Laminate Layers with the Database Data
      if (isset($_GET['repeatFromPublished'])) {
        if (is_array($WorkOrderRepPub)) {
          if (is_numeric($WorkOrderRepPub['master_wo_ply'])) {

            for ($counterL = 1; $counterL <= $WorkOrderRepPub['master_wo_ply']; $counterL++) {
              echo '$(\'input[name="work_order_layer_' . $counterL . '_micron"]\').val("' . $WorkOrderRepPub['master_wo_layer_' . $counterL . '_micron'] . '");';
              echo '$(\'select[name="work_order_5_layer_' . $counterL . '_material"]\').val("' . $WorkOrderRepPub['master_wo_layer_' . $counterL . '_structure'] . '").change();';
            }
          }
        }
      }

      if (isset($_GET['repeatFromDraft'])) {
        if (is_array($WorkOrderRepDraft)) {
          if (is_numeric($WorkOrderRepDraft['s_wo_ply'])) {

            for ($counterL = 1; $counterL <= $WorkOrderRepDraft['s_wo_ply']; $counterL++) {
            echo '$(\'input[name="work_order_layer_' . $counterL . '_micron"]\').val("' . $WorkOrderRepDraft['s_wo_layer_' . $counterL . '_micron'] . '");
    ';
            echo '$(\'select[name="work_order_5_layer_' . $counterL . '_material"]\').val("' . $WorkOrderRepDraft['s_wo_layer_' . $counterL . '_structure'] . '").change();
    ';

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