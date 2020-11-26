<?php

/**
What this page does:
=Take a WO Reference 
Then returns the Client, and PO of the WO

=Take a PO and Update the PO on the WO
 **/

require_once("SessionHandler.php");


if (isset($_POST['WorkOrderGetDetails'])) {
    if (!is_numeric($_POST['WorkOrderGetDetails'])) {
        die("<p style='color:red'>Invalid Work-Order ID</p>");
    }

    $getRecieved = mysqlSelect($UpdatedStatusQuery . "
	left join clients_main on master_wo_2_client_id = client_id
	left join master_work_order_main_identitiy on master_wo_status = mwoid_id
	
		where master_wo_status = 2 and master_wo_ref = " . $_POST['WorkOrderGetDetails'] . "
	" . $inColsWO . "
	order by master_wo_id desc
	");


    if (!is_array($getRecieved)) {
        die("<p style='color:red'>Invalid Work Order ID</p>");
    }
    echo "<h3>Sales Order Verification Rejection Form</h3><br>";
    echo '<p>WO#: <strong>' . $getRecieved[0]['master_wo_ref'] . '</strong></p><br>';
    echo '<p>Client: <strong>' . $getRecieved[0]['client_code'] . ' - ' . $getRecieved[0]['client_name'] . '</strong></p><br>';
    echo '<p>PO: <strong>' . $getRecieved[0]['master_wo_customer_po'] . '</strong></p><br>';


?>
    <hr>
    <p id="ret"></p>
    <input id="a" type="hidden" value="<?php echo $_POST['WorkOrderGetDetails'] ?>" />

    <input id="c" class="form-control" type="text" placeholder="Reason for Rejection" /><br><br>

    <button id="clickerFunction" type="submit" class="btn btn-success">Sales Order Verification Rejection Form</button>


    <script>
        $(document).ready(function(e) {
            $('#clickerFunction').click(function(e) {
                var a = $("#a").val();
                var c = $("#c").val();

                $.post("server_fundamentals/MainWorkOrderSubmit", {
                        returnSales: a,
                        reasonRej: c
                    },
                    function(data, status) {
                        $("#ret").html(data);
                    });

            }); /* .pubslishDraft Click*/
        }); /*Doc Ready*/
    </script>
<?php
}


if (isset($_POST['WorkOrderGetDetailsTech'])) {
    if (!is_numeric($_POST['WorkOrderGetDetailsTech'])) {
        die("<p style='color:red'>Invalid Work-Order ID</p>");
    }

    $getRecieved = mysqlSelect($UpdatedStatusQuery . "
	left join clients_main on master_wo_2_client_id = client_id
	left join master_work_order_main_identitiy on master_wo_status = mwoid_id
	
		where master_wo_status = 7 and master_wo_ref = " . $_POST['WorkOrderGetDetailsTech'] . "
	" . $inColsWO . "
	order by master_wo_id desc
	");


    if (!is_array($getRecieved)) {
        die("<p style='color:red'>Invalid Work Order ID</p>");
    }
    echo "<h3>Work Order Technical Verification Rejection Form</h3><br>";
    echo '<p>WO#: <strong>' . $getRecieved[0]['master_wo_ref'] . '</strong></p><br>';
    echo '<p>Client: <strong>' . $getRecieved[0]['client_code'] . ' - ' . $getRecieved[0]['client_name'] . '</strong></p><br>';
    echo '<p>PO: <strong>' . $getRecieved[0]['master_wo_customer_po'] . '</strong></p><br>';


?>
    <hr>
    <p id="ret"></p>
    <input id="a" type="hidden" value="<?php echo $_POST['WorkOrderGetDetailsTech'] ?>" />

    <input id="c" class="form-control" type="text" placeholder="Reason for Rejection" /><br><br>

    <button id="clickerFunction" type="submit" class="btn btn-success">Send</button>


    <script>
        $(document).ready(function(e) {
            $('#clickerFunction').click(function(e) {
                var a = $("#a").val();
                var c = $("#c").val();

                $.post("server_fundamentals/MainWorkOrderSubmit", {
                        technicalToVerifyRej: a,
                        reasonRejected: c
                    },
                    function(data, status) {
                        $("#ret").html(data);
                    });

            }); /* .pubslishDraft Click*/
        }); /*Doc Ready*/
    </script>
<?php
}
?>