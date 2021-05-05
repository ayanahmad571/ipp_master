<?php

/**
What this page does:
=Take a WO Reference 
Then returns the Client, and PO of the WO

=Take a PO and Update the PO on the WO
 **/

require_once("SessionHandler.php");

if (isset($_POST['wo_id']) && isset($_POST['WorkOrderRelReasonID']) && isset($_POST['WorkOrderRelReason']) && isset($_POST['WorkOrderRelNCR'])) {

	if (!is_numeric($_POST['wo_id'])) {
		die("<p style='color:red'>Invalid Work Order ID</p>");
	}
	if (!is_numeric($_POST['WorkOrderRelReasonID'])) {
		die("<p style='color:red'>Invalid Release Condition Selected</p>");
	}

	if (trim($_POST['WorkOrderRelReason']) == '') {
		die("<p style='color:red'>Invalid Release Reason Input</p>");
	}

	if (trim($_POST['WorkOrderRelNCR']) == '') {
		die("<p style='color:red'>Invalid NCR Input</p>");
	}
	$getReasons = mysqlSelect("select * from conditional_release_reason where crr_show = 1 and crr_id =" . $_POST['WorkOrderRelReasonID']);
	if (!is_array($getReasons)) {
		die("<p style='color:red'>Invalid Release Condition </p>");
	}

	$getRecieved = mysqlSelect($UpdatedStatusQuery . "
	left join clients_main on master_wo_2_client_id = client_id
	left join master_work_order_main_identitiy on master_wo_status = mwoid_id
	
		where master_wo_status = 4 and master_wo_ref = " . $_POST['wo_id'] . "
	" . $inColsWO . "
	order by master_wo_id desc
	");

	if (!is_array($getRecieved)) {
		die("<p style='color:red'>Work Order Not Found</p>");
	}

	$getCondRel = mysqlSelect("SELECT * FROM `conditional_release_wo` where
	crw_wo_ref = " . $getRecieved[0]['master_wo_ref'] . " order by crw_id desc limit 1");

	if (is_array($getCondRel) && $getCondRel[0]['crw_status'] == 1) {
		die("<p style='color:red'>Release Already Requested</p>");
	}

	$insert = mysqlInsertData("INSERT INTO `conditional_release_wo`
	(crw_wo_ref, crw_crr_id, crw_reason, crw_ncr, crw_lum_id, crw_dnt) 
	VALUES (
		" . $_POST['wo_id'] . ",
		" . $_POST['WorkOrderRelReasonID'] . ",
		'" . $_POST['WorkOrderRelReason'] . "',
		'" . $_POST['WorkOrderRelNCR'] . "',
		" . $USER_ARRAY['lum_id'] . ",
		'" . time() . "'
	)", true);

	if (!is_numeric($insert)) {
		die("<p style='color:red'>Not Released Conditionally</p>");
	} else {
		logInsert(
			basename($_SERVER['PHP_SELF']),
			$_SESSION[SESSION_HASH_NAME],
			$USER_ARRAY['lum_id'],
			$_SERVER['REMOTE_ADDR'],
			$USER_ARRAY['lum_code'] . " requested conditional release for work order with  REF: " . $_POST['wo_id'] . " | Reason: " . $_POST['WorkOrderRelReason'] . " |ID: " . $insert,
			"mysqlInsertData"
		);

		die("1");
		#die("<p style='color:green'>Successfully Requested Work Order Release</p>");
	}
} else if (isset($_POST['WorkOrderGetDetails'])) {
	if (!is_numeric($_POST['WorkOrderGetDetails'])) {
		die("<p style='color:red'>Invalid Work-Order ID</p>");
	}

	$getRecieved = mysqlSelect($UpdatedStatusQuery . "
	left join clients_main on master_wo_2_client_id = client_id
	left join master_work_order_main_identitiy on master_wo_status = mwoid_id
	
		where master_wo_status = 4 and master_wo_ref = " . $_POST['WorkOrderGetDetails'] . "
	" . $inColsWO . "
	order by master_wo_id desc
	");


	if (!is_array($getRecieved)) {
		die("<p style='color:red'>Invalid Work Order ID</p>");
	}

	$getCondRel = mysqlSelect("SELECT * FROM `conditional_release_wo` where
	crw_wo_ref = " . $getRecieved[0]['master_wo_ref'] . " order by crw_id desc limit 1");

	if (is_array($getCondRel) && $getCondRel[0]['crw_status'] == 1) {
		die("<p style='color:red'>Release Already Requested</p>");
	}
?>
	<h3 align="center">Conditional Release Request</h3>
	<hr>
	<table class="table table-bordered">
		<tbody>
			<tr>
				<td><?php echo '<p>WO#: <strong>' . $getRecieved[0]['master_wo_ref'] . '</strong></p>'; ?></td>
				<td><?php echo '<p>Client: <strong>' . $getRecieved[0]['client_code'] . ' - ' . $getRecieved[0]['client_name'] . '</strong></p>'; ?></td>
				<td><?php echo '<p>PO: <strong>' . $getRecieved[0]['master_wo_customer_po'] . '</strong></p>'; ?></td>
			</tr>
		</tbody>
	</table>

	<hr>
	<div id="success">
		<p style='color:green'>Successfully Requested Work Order Release, Click below to continue</p>
		<button class="btn btn-success" onclick="window.location.reload();">Continue..</button>
	</div>
	<p id="ret"></p>
	<div id="holderContainer">
		<input id="a" type="hidden" value="<?php echo $_POST['WorkOrderGetDetails'] ?>" />
		<label><strong>Pick an option from below</strong></label>
		<select id="b" require class="form-control">
			<?php
			$getReasons = mysqlSelect("select * from conditional_release_reason where crr_show = 1");
			if (is_array($getReasons)) {
				foreach ($getReasons as $reason) {
					# code...
					echo '<option value="' . $reason['crr_id'] . '">' . $reason['crr_value'] . '</option>';
				}
			}
			?>
		</select>
		<br>
		<label><strong>Short Description</strong></label>
		<input id="c" class="form-control" type="text" placeholder="Reason" /><br>

		<label><strong>NCR Number</strong></label>
		<input id="d" class="form-control" type="text" placeholder="NCR" /><br><br>

		<button id="clickerFunction" type="submit" class="btn btn-success">Request Conditional Release </button>
	</div>
	<script>
		$(document).ready(function(e) {
			$("#success").hide();
			$('#clickerFunction').click(function(e) {
				var a = $("#a").val();
				var b = $('#b').find(":selected").val();
				var c = $("#c").val();
				var d = $("#d").val();

				$.post("server_fundamentals/AccountsController", {
						wo_id: a,
						WorkOrderRelReasonID: b,
						WorkOrderRelReason: c,
						WorkOrderRelNCR: d

					},
					function(data, status) {
						if (data == '1') {
							$("#holderContainer").hide();
							$("#ret").hide();
							$("#success").show();
						} else {
							$("#ret").html(data);
						}

					});

			}); /* .pubslishDraft Click*/
		}); /*Doc Ready*/
	</script>


<?php
} else if (isset($_POST['AccountsCondToTechnicalRejectCond']) && isset($_POST['rejCond'])) {
	if (trim($_POST['rejCond']) == "") {
		die("Invalid Rejection Condition");
	}


	$insert = mysqlInsertData("INSERT INTO `conditional_release_wo`
	(crw_wo_ref, crw_crr_id, crw_reason, crw_ncr, crw_lum_id, crw_dnt, crw_status) 
	VALUES (
		" . $_POST['AccountsCondToTechnicalRejectCond'] . ",
		NULL,
		'" . $_POST['rejCond'] . "',
		'-',
		" . $USER_ARRAY['lum_id'] . ",
		'" . time() . "',
		3
	)", true);

	if (!is_numeric($insert)) {
		die("<p style='color:red'>Error Updating records</p>");
	} else {
		logInsert(
			basename($_SERVER['PHP_SELF']),
			$_SESSION[SESSION_HASH_NAME],
			$USER_ARRAY['lum_id'],
			$_SERVER['REMOTE_ADDR'],
			$USER_ARRAY['lum_code'] . " REJECTED conditionally approving request for work order with  REF: " . $_POST['AccountsCondToTechnicalRejectCond'] . " | Reason: " . $_POST['rejCond'],
			"mysqlInsertData"
		);

		die("<p style='color:green'>Successfully Registered Request</p>");
	}
}


?>