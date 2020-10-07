<?php

/**
What this page does:
=Take a WO Reference 
Then returns the Client, and PO of the WO

=Take a PO and Update the PO on the WO
**/

require_once("SessionHandler.php");


if(isset($_POST['WorkOrderGetDetails'])){
	if(!is_numeric($_POST['WorkOrderGetDetails'])){
		die("<p style='color:red'>Invalid Work Order ID</p>");
	}
	
	$getRecieved= mysqlSelect($UpdatedStatusQuery."
		 
		left join clients_main on master_wo_client_id = client_id
		left join master_work_order_main_identitiy on master_wo_status = mwoid_id
		where master_wo_status = 5 and master_wo_ref = ".$_POST['WorkOrderGetDetails']."");

	if(!is_array($getRecieved)){
		die("<p style='color:red'>Invalid Work Order ID</p>");
	}

	echo '<p>WO#: <strong>'.$getRecieved[0]['master_wo_ref'].'</strong></p><br>';
	echo '<p>Client: <strong>'.$getRecieved[0]['client_code'].' - '.$getRecieved[0]['client_name'].'</strong></p><br>';
	echo '<p>PO: <strong>'.$getRecieved[0]['master_wo_po'].'</strong></p><br>';
	
	
	?>
    <hr>
    <p id="ret"></p>
    
    	<input id="a" type="hidden" value="<?php echo $_POST['WorkOrderGetDetails'] ?>" />
    	<input id="b" class="form-control" type="text" placeholder="New PO Number" /><br><br>
    	<input id="c" class="form-control" type="text" placeholder="Change Reason" /><br><br>
        <button id="clickerFunction" type="submit" class="btn btn-success">Change PO</button>
        
    
    <script>
	$(document).ready(function(e) {
	$('#clickerFunction').click(function(e) {
		var a = $("#a").val();
		var b = $("#b").val();
		var c = $("#c").val();
				
		$.post("server_fundamentals/PreCostController",
		{
			WOID: a,
			WorkOrderNewPO: b,
			WorkOrderNewPOReason: c
			
		},
		function(data, status){
			$("#ret").html(data);
		});

	}); /* .pubslishDraft Click*/
}); /*Doc Ready*/

	</script>
    <?php
}


if(isset($_POST['WorkOrderNewPO']) && isset($_POST['WorkOrderNewPOReason']) && isset($_POST['WOID'])){
	
	if(!is_numeric($_POST['WOID'])){
		die("<p style='color:red'>Invalid Work Order ID</p>");
	}
	
	if(trim($_POST['WorkOrderNewPOReason']) == ''){
		die("<p style='color:red'>Invalid PO UPDATE REASON</p>");
	}
	
	
	
	$getRecieved= mysqlSelect($UpdatedStatusQuery."
	 
	left join clients_main on master_wo_client_id = client_id
	left join master_work_order_main_identitiy on master_wo_status = mwoid_id
	where master_wo_status = 5 and master_wo_ref = ".$_POST['WOID']."");

	if(!is_array($getRecieved)){
		die("<p style='color:red'>Work Order Not Found</p>");
	}
	
	$updatesql = mysqlUpdateData("update master_work_order_main set master_wo_po = '".$_POST['WorkOrderNewPO']."' where master_wo_id = ".$getRecieved[0]['master_wo_id'],true);
	
	if(!is_numeric($updatesql)){
		die("<p style='color:red'>PO Not Updated</p>");
	}

	$insRem = mysqlUpdateData("INSERT INTO `remarks_wo`( `remark_lum_id`, `remark_text`, `remark_master_wo_id`, `remark_dnt`, `remark_type`) 
	VALUES (
	".$USER_ARRAY['lum_id'].",
	'".$_POST['WorkOrderNewPOReason']."',
	".$getRecieved[0]['master_wo_ref'].",
	'".time()."',
	1
	)",true);
	
	if(!is_numeric($insRem)){
		die("<p style='color:red'>ERROR : REMARK NOT ADDED #11829 </p>");
	}


logInsert(basename($_SERVER['PHP_SELF']), 
		$_SESSION[SESSION_HASH_NAME], 
		$USER_ARRAY['lum_id'], 
		$_SERVER['REMOTE_ADDR'], 
		$USER_ARRAY['lum_code']." updated the PO on Work Order: ".$getRecieved[0]['master_wo_ref'], 
		"mysqlInsertData");


	echo '<p style="color:green">Work Order PO Updated Successfully</p>';
}
?>