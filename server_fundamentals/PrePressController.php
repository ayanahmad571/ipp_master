<?php
require_once("PostDataHeadChecker.php");

/**
What this page does:
=Take a WO Reference  and check if printing is req
Then returns the Printing Structure of the PO along with remarks

=Take the PRINTING SECTION and Update the stuff on the WO
 **/

require_once("SessionHandler.php");


if (isset($_POST['WorkOrderGetDetails'])) {
  if (!is_numeric($_POST['WorkOrderGetDetails'])) {
    die("<p style='color:red'>Invalid Work Order ID</p>");
  }

  $getRecieved = mysqlSelect($UpdatedStatusQuery . "
		 
		left join clients_main on master_wo_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id
		where master_wo_status = 7 and master_wo_ref = " . $_POST['WorkOrderGetDetails'] . "");

  if (!is_array($getRecieved)) {
    die("<p style='color:red'>Invalid Work Order ID</p>");
  }

  echo '<p>WO#: <strong>' . $getRecieved[0]['master_wo_ref'] . '</strong></p>';
  echo '<p>Client: <strong>' . $getRecieved[0]['client_code'] . ' - ' . $getRecieved[0]['client_name'] . '</strong></p>';

  if ($getRecieved[0]['master_wo_printed_question'] != 1) {
    die("<p> THIS WORK ORDER DOES NOT HAVE A PRINTING PROCESS</p>");
  }
?>
  <hr>
  <p id="ret"></p>

  <div id="formFail" class="alert alert-danger" style="display:none; ">
  </div>
  <div id="formSuccess" class="alert alert-success" style="display:none">
    Changes have Been saved to the Work Order Printing Section
  </div>

  <form id="formContainer" action="server_fundamentals/PrePressController" method="post">
    <input type="hidden" name="WOID" value="<?php echo $getRecieved[0]['master_wo_ref'] ?>" />

    <div id="workOrderPrintingProcess">

      <div class="row">
        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Design Name</label>
          <input type="text" class="form-control" name="work_order_printing_design" placeholder="Design Name">
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Cylinder Supplier</label>

          <div class="selectgroup w-100">
            <?php
            $get_cylinder_supplier = mysqlSelect("SELECT * FROM `work_order_ui_print_cylinder_supplier` where cylinder_supplier_show = 1 ");
            if (is_array($get_cylinder_supplier)) {
              foreach ($get_cylinder_supplier as $cylinder_supplier) {
                echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_printing_cylinder_supplier" value="' . $cylinder_supplier['cylinder_supplier_id'] . '" class="selectgroup-input" ' . ($cylinder_supplier['cylinder_supplier_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $cylinder_supplier['cylinder_supplier_value'] . '</span>
            </label>
    ';
              }
            }
            ?>

          </div>
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Printing Method</label>
          <div class="selectgroup w-100">
            <?php
            $getSurfRev = mysqlSelect("SELECT * FROM `work_order_ui_print_surfrev` where surfrev_show = 1 ");
            if (is_array($getSurfRev)) {
              foreach ($getSurfRev as $SurfRev) {
                echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_printing_surface_reverse" value="' . $SurfRev['surfrev_id'] . '" class="selectgroup-input" ' . ($SurfRev['surfrev_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $SurfRev['surfrev_value'] . '</span>  
            </label>
    ';
              }
            }
            ?>

          </div>
        </div>


      </div>

      <div class="row">

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>QTY.</label>
          <input type="number" min="1" max="999999999" step="0.01" class="form-control" name="work_order_printing_qty" placeholder="Qty">
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Qty Unit</label>
          <select class="form-control select_qty_unit" name="work_order_5_printing_units">
            <?php
            $getUnits = mysqlSelect("SELECT * FROM `work_order_qty_units` ");
            if (is_array($getUnits)) {
              foreach ($getUnits as $Unit) {
                echo '<option value="' . $Unit['unit_id'] . '">' . $Unit['unit_value'] . '</option>';
              }
            }
            ?>
          </select>
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Substrate </label>
          <input id="inputSubstrate" type="text" class="form-control" placeholder="Substrate" name="work_order_printing_substrate">
        </div>

      </div>

      <div class="row">


        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Single Coil Width </label>
          <input onChange="setUpTubeLength()" type="number" class="form-control" name="work_order_printing_single_coil_width" step=".01" value="0" min="0" max="999999999" placeholder="Single Coil Width">
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>UPS</label>
          <input onChange="setUpTubeLength()" type="number" class="form-control" name="work_order_printing_ups_val" step=".01" value="0" min="0" max="999999999" placeholder="UPS">
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Trim</label>
          <input onChange="setUpTubeLength()" type="number" class="form-control" name="work_order_printing_trim_val" step=".01" value="0" min="0" max="999999999" placeholder="Trim">
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Total Jumbo Film Width</label>
          <p id="cylinderLengthCalculation">0 x 0 + 0 = 0</p>
        </div>



      </div>

      <div class="row">


        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Single Coil Circumference </label>
          <input onChange="setUpTubeCircum()" type="number" class="form-control" name="work_order_printing_single_coil_circ" step=".01" value="0" min="0" max="999999999" placeholder="Single Coil Circumference">
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>No. Of Across</label>
          <input onChange="setUpTubeCircum()" type="number" class="form-control" name="work_order_printing_accross_val" step=".01" value="0" min="0" max="999999999" placeholder="Accross">
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Bleed </label>
          <input onChange="setUpTubeCircum()" type="number" class="form-control" name="work_order_printing_bleed_val" step=".01" value="0" min="0" max="999999999" placeholder="Bleed">
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Total Circumference </label>
          <p id="cylinderCircumferenceCalculation">0 x 0 + 0 = 0</p>
        </div>



      </div>

      <div class="row">

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Shade Card Required</label>

          <div class="selectgroup w-100">
            <?php
            $getShadeCardsReq = mysqlSelect("SELECT * FROM `work_order_ui_print_shadecardreq` where shadecardreq_show = 1 ");
            if (is_array($getShadeCardsReq)) {
              foreach ($getShadeCardsReq as $ShadeCardsReq) {
                echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_printing_shade_card_needed" value="' . $ShadeCardsReq['shadecardreq_id'] . '" class="selectgroup-input" ' . ($ShadeCardsReq['shadecardreq_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $ShadeCardsReq['shadecardreq_value'] . '</span>
            </label>
    ';
              }
            }
            ?>

          </div>
        </div>


        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Color Reference Type </label>
          <div class="selectgroup w-100">
            <?php
            $getColRef = mysqlSelect("SELECT * FROM `work_order_ui_print_shadecard_ref_type` where shadecard_ref_type_show = 1 ");
            if (is_array($getColRef)) {
              foreach ($getColRef as $ColRef) {
                echo '
            <label class="selectgroup-item">
              <input type="radio" name="work_order_3_printing_color_ref_type" value="' . $ColRef['shadecard_ref_type_id'] . '" class="selectgroup-input" ' . ($ColRef['shadecard_ref_type_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $ColRef['shadecard_ref_type_value'] . '</span>  
            </label>
    ';
              }
            }
            ?>

          </div>
        </div>

      </div>

      <div class="row">


        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Eyemark Color</label>
          <input type="text" class="form-control" name="work_order_printing_eyemark_color" placeholder="Eyemark Color">
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Eyemark Size (mm) (width x length)</label>
          <input type="text" class="form-control" name="work_order_printing_size" placeholder="numberxnumber" value="0x0">
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Eyemark Path</label>
          <div class="selectgroup w-100">
            <?php
            $geteyemark_path = mysqlSelect("SELECT * FROM `work_order_ui_print_eyemark_path` where eyemark_path_show = 1 ");
            if (is_array($geteyemark_path)) {
              foreach ($geteyemark_path as $eyemark_path) {
                echo '
		<label class="selectgroup-item">
		  <input type="radio" name="work_order_3_printing_eyemark_path" value="' . $eyemark_path['eyemark_path_id'] . '" class="selectgroup-input" ' . ($eyemark_path['eyemark_path_id'] == 1 ? 'checked' : '') . '>
		  <span class="selectgroup-button">' . $eyemark_path['eyemark_path_value'] . '</span>  
		</label>
    ';
              }
            }
            ?>

          </div>
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Eyemark Side (in D.A) </label>
          <div class="selectgroup selectgroup-pills">
            <?php
            $getPrintEye = mysqlSelect("SELECT * FROM `work_order_ui_print_eyemark_da` where eyemark_da_show = 1 ");
            if (is_array($getPrintEye)) {
              foreach ($getPrintEye as $PrintEye) {
                echo '
			<label class="selectgroup-item">
              <input type="checkbox" name="work_order_4_printing_eyemark_side[]" value="' . $PrintEye['eyemark_da_id'] . '" class="selectgroup-input" ' . ($PrintEye['eyemark_da_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $PrintEye['eyemark_da_value'] . '</span>
            </label>
    ';
              }
            }
            ?>

          </div>
        </div>

      </div>

      <div class="row">

        <div class="form-group col-sm-12">
          <label>Print Approval by</label>
          <div class="selectgroup w-100">
            <?php
            $getPrintOp = mysqlSelect("SELECT * FROM `work_order_ui_print_options` where print_options_show = 1 ");
            if (is_array($getPrintOp)) {
              foreach ($getPrintOp as $PrintOp) {
                echo '

		<label class="selectgroup-item">
		  <input type="radio" name="work_order_3_printing_approvalby" value="' . $PrintOp['print_options_id'] . '" class="selectgroup-input" ' . ($PrintOp['print_options_id'] == 1 ? 'checked' : '') . '>
		  <span class="selectgroup-button">' . $PrintOp['print_options_value'] . '</span>  
		</label>
    ';
              }
            }
            ?>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>CYL PR# </label>
          <input type="text" class="form-control" name="work_order_printing_plate_cyl_pr" placeholder="Plate CYL PR#">
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Ink System</label>
          <div class="selectgroup w-100">
            <?php
            $getink_sys = mysqlSelect("SELECT * FROM `work_order_ui_print_ink_sys` where ink_sys_show = 1 ");
            if (is_array($getink_sys)) {
              foreach ($getink_sys as $ink_sys) {
                echo '
		<label class="selectgroup-item">
		  <input type="radio" name="work_order_3_printing_ink_system" value="' . $ink_sys['ink_sys_id'] . '" class="selectgroup-input" ' . ($ink_sys['ink_sys_id'] == 1 ? 'checked' : '') . '>
		  <span class="selectgroup-button">' . $ink_sys['ink_sys_value'] . '</span>  
		</label>
    ';
              }
            }
            ?>

          </div>
        </div>


      </div>

      <div class="row">

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Baseshel</label>
          <div class="selectgroup w-100">
            <?php
            $big = mysqlSelect("SELECT * FROM `work_order_ui_print_baseshel` where print_baseshel_show = 1 ");
            if (is_array($big)) {
              foreach ($big as $small) {
                echo '
		<label class="selectgroup-item">
		  <input type="radio" name="work_order_3_printing_baseshel" value="' . $small['print_baseshel_id'] . '" class="selectgroup-input" ' . ($small['print_baseshel_id'] == 1 ? 'checked' : '') . '>
		  <span class="selectgroup-button">' . $small['print_baseshel_value'] . '</span>  
		</label>
    ';
              }
            }
            ?>

          </div>
        </div>


        <div class="form-group col-sm-12 col-lg-6 ">
          <label>Ink GSM</label>
          <input type="text" class="form-control" name="work_order_printing_ink_gsm" placeholder="Ink GSM">
        </div>

      </div>

      <p align="left"><strong>Pantone</strong></p>

      <div class="row">

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>1</label>
          <input type="text" class="form-control" name="work_order_printing_pantone_1" placeholder="Pantone 1">
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>2</label>
          <input type="text" class="form-control" name="work_order_printing_pantone_2" placeholder="Pantone 2">
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>3</label>
          <input type="text" class="form-control" name="work_order_printing_pantone_3" placeholder="Pantone 3">
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>4</label>
          <input type="text" class="form-control" name="work_order_printing_pantone_4" placeholder="Pantone 4">
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>5</label>
          <input type="text" class="form-control" name="work_order_printing_pantone_5" placeholder="Pantone 5">
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>6</label>
          <input type="text" class="form-control" name="work_order_printing_pantone_6" placeholder="Pantone 6">
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>7</label>
          <input type="text" class="form-control" name="work_order_printing_pantone_7" placeholder="Pantone 7">
        </div>

        <div class="form-group col-sm-12 col-lg-6 ">
          <label>8</label>
          <input type="text" class="form-control" name="work_order_printing_pantone_8" placeholder="Pantone 8">
        </div>



      </div>

      <div class="row">
        <div class="form-group col-12">
          <div class="selectgroup selectgroup-pills">
            <?php
            $getPrintPant = mysqlSelect("SELECT * FROM `work_order_ui_print_end_options` where print_end_options_show = 1 ");
            if (is_array($getPrintPant)) {
              foreach ($getPrintPant as $PrintPant) {
                echo '
			<label class="selectgroup-item">
              <input type="checkbox" name="work_order_4_printing_end_options[]" value="' . $PrintPant['print_end_options_id'] . '" class="selectgroup-input" ' . ($PrintPant['print_end_options_id'] == 1 ? 'checked' : '') . '>
              <span class="selectgroup-button">' . $PrintPant['print_end_options_value'] . '</span>
            </label>
    ';
              }
            }
            ?>

          </div>

        </div>
      </div>

      <div class="row">
        <div class="form-group col-12">
          <label>Printing Remarks</label>
          <table class="table table-striped table-bordered">
            <tr>
              <th width="20%">User </th>
              <th width="70%">Remark</th>
              <th width="10%">Time</th>
            </tr>
            <?php
            $getOverallRem = mysqlSelect("SELECT r.*,m.lum_code,m.lum_name FROM `remarks_wo` r
                left join user_main m on remark_lum_id = m.lum_id
                where remark_status = 1
                and remark_type = 3
                and remark_master_wo_id = " . $getRecieved[0]['master_wo_ref']);

            if (is_array($getOverallRem)) {
              foreach ($getOverallRem as $OverallRem) {
                echo '
                        <tr>
                            <td>' . $OverallRem['lum_code'] . ' - ' . $OverallRem['lum_name'] . '</td>
                            <td>' . $OverallRem['remark_text'] . '</td>
                            <td>' . date('d-m-Y @ h:i:s a', $OverallRem['remark_dnt']) . '</td>
                        </tr>
                        
                        ';
              }
            }

            ?>
          </table>

          <textarea name="work_order_remarks_printing" class="form-control" placeholder="Remarks" style="height:90px"></textarea>
        </div>
      </div>

      <HR>
    </div>
    <p align="center"><button class="btn btn-success" type="submit">Save Changes (No Confirmation)</button></p>
  </form>


  <script>
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


    $(document).ready(function(e) {
      <?php
      foreach ($master_wo_straightArrays as $k => $v) {
        echo '$(\'input[name="' . $k . '"]\').val("' . $getRecieved[0][$v] . '");
						';
      }

      foreach ($master_wo_radioArrays as $k => $v) {
        echo '$(\'input:radio[name="' . $k . '"]\').filter(\'[value="' . $getRecieved[0][$v] . '"]\').attr(\'checked\', true);
					';
      }

      foreach ($master_wo_checkboxArrays as $k => $v) {

        echo '$(\'input[name="' . $k . '[]"]\').each(function() {
						this.checked = false;
					});
					';
        if ($getRecieved[0][$v] != '') {
          $s = explode(',', $getRecieved[0][$v]);
          foreach ($s as $val) {
            echo '$(\'input:checkbox[name="' . $k . '[]"]\').filter("[value=\'' . $val . '\']").prop(\'checked\', true);
							';
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


      }));

    });
  </script>
<?php
}


if (isset($_POST['WOID'])) {

  if (!is_numeric($_POST['WOID'])) {
    die("Invalid Work Order ID");
  }


  $getRecieved = mysqlSelect($UpdatedStatusQuery . "
	 
	left join clients_main on master_wo_client_id = client_id
	left join master_work_order_main_identitiy on master_wo_status = mwoid_id
	where master_wo_status = 7 and master_wo_ref = " . $_POST['WOID'] . "");

  if (!is_array($getRecieved)) {
    die("Work Order Not Found");
  }
  $getRecieved = $getRecieved[0];

  $doPrintingModule = ($getRecieved['master_wo_printed_question'] == 1 ? true : false);

  #Check Printing
  if ($doPrintingModule) {
    checkPost($printingNames);
    checkString($printingNames);



    //Check if the posted options are numeric and are valid
    if (isset($_POST[$printingOptions[0]])) {
      foreach ($_POST[$printingOptions[0]] as $exP) {
        if (!is_numeric($exP)) {
          die("Printing - Invalid Eyemark Side");
        } else {
          selectChecker(
            "SELECT * FROM `work_order_ui_print_eyemark_da` where eyemark_da_show = 1 and eyemark_da_id = " . $exP,
            'Printing -  EyeMarkSide Options - Value at ID= ' . $exP . ' Not Found',
            'mysqlSelect'
          );
        }
      }
    }

    //Check if the posted options are numeric
    if (isset($_POST[$printingOptions[1]])) {
      foreach ($_POST[$printingOptions[1]] as $exP) {
        if (!is_numeric($exP)) {
          die("Printing - Invalid End Options");
        } else {
          selectChecker(
            "SELECT * FROM `work_order_ui_print_end_options` where print_end_options_show = 1 and print_end_options_id = " . $exP,
            'Printing -  End Options - Value at ID= ' . $exP . ' Not Found',
            'mysqlSelect'
          );
        }
      }
    }


    //0,4,5,9,10

    //check Print Type
    selectChecker(
      "SELECT * FROM `work_order_ui_print_cylinder_supplier` 
	where cylinder_supplier_show = 1 
	and cylinder_supplier_id = " . $_POST[$printingNames[1]],
      'Printing - Cylinder Supplier Option Value Not Found',
      'mysqlSelect'
    );

    //check SurfaceRev Type
    selectChecker(
      "SELECT * FROM `work_order_ui_print_surfrev` 
	where surfrev_show = 1 
	and surfrev_id = " . $_POST[$printingNames[2]],
      'Printing - Print Surface/Reverse Option Value Not Found',
      'mysqlSelect'
    );

    //check SurfaceRev Type
    selectChecker(
      "SELECT * FROM `work_order_qty_units` 
	where unit_show = 1 
	and unit_id = " . $_POST[$printingNames[4]],
      'Printing - Print Units Option Value Not Found',
      'mysqlSelect'
    );

    //check ShadeCardNeeded
    selectChecker(
      "SELECT * FROM `work_order_ui_print_shadecardreq` 
	where shadecardreq_show = 1 
	and shadecardreq_id = " . $_POST[$printingNames[12]],
      'Printing - Shade Card Option Value Not Found',
      'mysqlSelect'
    );

    //check Tubesheet
    selectChecker(
      "SELECT * FROM `work_order_ui_print_shadecard_ref_type` 
	where shadecard_ref_type_show = 1 
	and shadecard_ref_type_id = " . $_POST[$printingNames[13]],
      'Printing - Color Reference Type Option Value Not Found',
      'mysqlSelect'
    );

    //check Tubesheet
    selectChecker(
      "SELECT * FROM `work_order_ui_print_eyemark_path` 
	where eyemark_path_show = 1 
	and eyemark_path_id = " . $_POST[$printingNames[16]],
      'Printing - Eyemark Path Show Value Not Found',
      'mysqlSelect'
    );

    //check Tubesheet
    selectChecker(
      "SELECT * FROM `work_order_ui_print_options` 
	where print_options_show = 1 
	and print_options_id = " . $_POST[$printingNames[17]],
      'Printing - Print Approval Option Value Not Found',
      'mysqlSelect'
    );

    //check Tubesheet
    selectChecker(
      "SELECT * FROM `work_order_ui_print_ink_sys` 
	where ink_sys_show = 1 
	and ink_sys_id = " . $_POST[$printingNames[19]],
      'Printing - Ink System Option Value Not Found',
      'mysqlSelect'
    );

    //check Tubesheet
    selectChecker(
      "SELECT * FROM `work_order_ui_print_baseshel` 
	where print_baseshel_show = 1 
	and print_baseshel_id = " . $_POST[$printingNames[20]],
      'Printing - Base Shel Option Value Not Found',
      'mysqlSelect'
    );

    $PrintingEyeSize = str_replace(' ', '', $_POST[$printingNames[15]]);

    if (substr_count($PrintingEyeSize, "x") != 1) {
      die("Eyemark Size (mm) Format Invalid, Missing 'x'");
    }

    /**/

    $pEyeScheck = explode("x", $PrintingEyeSize);
    if (!is_numeric($pEyeScheck[0])) {
      die("Eyemark Size (mm) Format Invalid, Left side not Numeric");
    }
    if (!is_numeric($pEyeScheck[1])) {
      die("Eyemark Size (mm) Format Invalid, Right side not Numeric");
    }

    $WorkOrderPrinting = array(
      "master_wo_print_design" => $_POST[$printingNames[0]],
      "master_wo_print_cylinder_supplier" => $_POST[$printingNames[1]],
      "master_wo_print_surface_reverse" => $_POST[$printingNames[2]],
      "master_wo_print_qty" => $_POST[$printingNames[3]],
      "master_wo_print_units" => $_POST[$printingNames[4]],
      "master_wo_print_substrate" => $_POST[$printingNames[5]],
      "master_wo_print_single_coil_width" => $_POST[$printingNames[6]],
      "master_wo_print_ups_val" => $_POST[$printingNames[7]],
      "master_wo_print_trim_val" => $_POST[$printingNames[8]],
      "master_wo_print_single_coil_circ" => $_POST[$printingNames[9]],
      "master_wo_print_accross_val" => $_POST[$printingNames[10]],
      "master_wo_print_bleed_val" => $_POST[$printingNames[11]],
      "master_wo_print_shade_card_needed" => $_POST[$printingNames[12]],
      "master_wo_print_color_ref_type" => $_POST[$printingNames[13]],
      "master_wo_print_eyemark_color" => $_POST[$printingNames[14]],
      "master_wo_print_size" => $_POST[$printingNames[15]],
      "master_wo_print_eyemark_path" => $_POST[$printingNames[16]],
      "master_wo_print_approvalby" => $_POST[$printingNames[17]],
      "master_wo_print_plate_cyl_pr" => $_POST[$printingNames[18]],
      "master_wo_print_ink_system" => $_POST[$printingNames[19]],
      "master_wo_print_baseshel" => $_POST[$printingNames[20]],
      "master_wo_print_ink_gsm" => $_POST[$printingNames[21]],
      "master_wo_print_pantone_1" => $_POST[$printingNames[22]],
      "master_wo_print_pantone_2" => $_POST[$printingNames[23]],
      "master_wo_print_pantone_3" => $_POST[$printingNames[24]],
      "master_wo_print_pantone_4" => $_POST[$printingNames[25]],
      "master_wo_print_pantone_5" => $_POST[$printingNames[26]],
      "master_wo_print_pantone_6" => $_POST[$printingNames[27]],
      "master_wo_print_pantone_7" => $_POST[$printingNames[28]],
      "master_wo_print_pantone_8" => $_POST[$printingNames[29]]
    );

    //Insert Posted Options into Master Array
    if (isset($_POST[$printingOptions[0]])) {
      $WorkOrderPrinting['master_wo_print_eyemark_side'] = implode(',', $_POST[$printingOptions[0]]);
    }

    if (isset($_POST[$printingOptions[1]])) {
      $WorkOrderPrinting['master_wo_print_end_options'] = implode(',', $_POST[$printingOptions[1]]);
    }
    if (($_POST[$printingNames[30]] != '')) {
      $RemarksMain[] = "(
			'" . $USER_ARRAY['lum_id'] . "',
			'" . $_POST[$printingNames[30]] . "',
			'" . $getRecieved['master_wo_ref'] . "',
			'" . time() . "',
			'3')";
    } else {
      die("Explain the Reason for Changes in the Remarks Section.");
    }

    //Insert Posted Options into Master Array
    $updateCols = array();

    foreach ($WorkOrderPrinting as $a => $b) {
      $updateCols[] = '`' . $a . '`' . " = '" . $b . "' ";
    }

    $insertSql = 'update `master_work_order_main` 
		set
		' . implode(', ', $updateCols) . ' 
		
		where
		master_wo_id = ' . $getRecieved['master_wo_id'];

    $check = mysqlUpdateData($insertSql, true);
    if (!is_numeric($check)) {
      die("503 - Internal Server Error, WO#" . $getRecieved['master_wo_ref'] . " Update Failed");
    }

    if (is_array($RemarksMain)) {
      if (count($RemarksMain) > 0) {
        $q = mysqlInsertData("INSERT INTO `remarks_wo`(
				`remark_lum_id`, `remark_text`, `remark_master_wo_id`, `remark_dnt`, `remark_type`) VALUES " . implode(', ', $RemarksMain), true);

        if (!is_numeric($q)) {
          die("Internal Server Error. <br> Work Order Updated, Remark Not Added  <br>ERR: " . $q);
        }

        logInsert(
          basename($_SERVER['PHP_SELF']),
          $_SESSION[SESSION_HASH_NAME],
          $USER_ARRAY['lum_id'],
          $_SERVER['REMOTE_ADDR'],
          $USER_ARRAY['lum_code'] . " edited the printing section for WO: " . $_POST['WOID'],
          "mysqlInsertData"
        );
      }
    }
  } else {
    die("Printing Module NOT EDITABLE");
  }
}
?>