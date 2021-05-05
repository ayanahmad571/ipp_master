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
?>

    <h3 align="center">Sales Order Verification Rejection</h3>
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

    <hr>
    <p id="ret"></p>

    <div id="holderContainer">
        <input id="a" type="hidden" value="<?php echo $_POST['WorkOrderGetDetails'] ?>" />

        <label><strong>Reason for Rejection</strong></label>
        <input id="c" class="form-control" type="text" placeholder="Reason for Rejection" /><br><br>

        <button id="clickerFunction" type="submit" class="btn btn-success">Sales Order Verification Rejection Form</button>
    </div>

    <script>
        $(document).ready(function(e) {
            $("#success").hide();
            $('#clickerFunction').click(function(e) {
                var a = $("#a").val();
                var c = $("#c").val();

                $.post("server_fundamentals/MainWorkOrderSubmit", {
                        returnSales: a,
                        reasonRej: c
                    },
                    function(data, status) {
                        if (data.includes("Success- Work Order Successfully Published")) {
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
?>

    <h3 align="center">Work Order Technical Verification Rejection Form</h3>
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
        <input id="a" type="hidden" value="<?php echo $_POST['WorkOrderGetDetailsTech'] ?>" />

        <label><strong>Rejection Reason</strong></label>
        <input id="c" class="form-control" type="text" placeholder="Reason for Rejection" /><br><br>

        <button id="clickerFunction" type="submit" class="btn btn-success">Send</button>
    </div>

    <script>
        $(document).ready(function(e) {
            $("#success").hide();
            $('#clickerFunction').click(function(e) {
                var a = $("#a").val();
                var c = $("#c").val();

                $.post("server_fundamentals/MainWorkOrderSubmit", {
                        technicalToVerifyRej: a,
                        reasonRejected: c
                    },
                    function(data, status) {
                        if (data.includes("Success- Work Order Successfully Published")) {
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
}
?>