<?php
require_once("../server_fundamentals/SessionHandler.php");

if (isset($_POST['WorkOrderGetDetails'])) {
    if (!is_numeric($_POST['WorkOrderGetDetails'])) {
        die("<p style='color:red'>Invalid Work-Order ID</p>");
    }


    $WorkOrderMain = mysqlSelect($UpdatedStatusQuery . "        
    left join clients_main on master_wo_2_client_id = client_id
    left join master_work_order_main_identitiy on master_wo_status = mwoid_id

        where master_wo_status not in (1,2,3,10) and master_wo_ref= " . $_POST['WorkOrderGetDetails'] . " 
    " . $inColsWO . "
    order by master_wo_id desc
    ");


    if (!is_array($WorkOrderMain)) {
        die("<p style='color:red'>Invalid Work Order ID</p>");
    }

    $checkIn = mysqlSelect("select * from (
        select * from amendment_form_main a where a.afm_id = 
        (SELECT c.afm_id FROM `amendment_form_main` c 
        where c.afm_rel_wo_ref = a.afm_rel_wo_ref
        order by c.afm_id desc 
        limit 1) ) ap 
    left join amendment_form_identity ai on ap.afm_status = ai.afi_id
    where 
    ap.afm_status = 6 and ap.afm_rel_wo_ref = " . $_POST['WorkOrderGetDetails']);

    if (!is_array($checkIn)) {
        die("<p style='color:red'>This amendment form doesn't exist for this status</p>");
    }

?>

    <h3 align="center">Amendment Form Verification Rejection</h3>
    <hr>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td><?php echo '<p>WO#: <strong>' . $WorkOrderMain[0]['master_wo_ref'] . '</strong></p>'; ?></td>
                <td><?php echo '<p>Client: <strong>' . $WorkOrderMain[0]['client_code'] . ' - ' . $WorkOrderMain[0]['client_name'] . '</strong></p>'; ?></td>
                <td><?php echo '<p>PO: <strong>' . $WorkOrderMain[0]['master_wo_customer_po'] . '</strong></p>'; ?></td>
            </tr>
        </tbody>
    </table>

    <hr>
    <div id="success">
        <p style='color:green'>Successfully Returned Document, Click below to continue</p>
        <button class="btn btn-success" onclick="window.location.reload();">Continue..</button>
    </div>

    <hr>
    <p id="ret"></p>

    <div id="holderContainer">
        <input id="a" type="hidden" value="<?php echo $_POST['WorkOrderGetDetails'] ?>" />

        <label><strong>Reason for Rejection</strong></label>
        <input id="c" class="form-control" type="text" placeholder="Reason for Rejection" /><br><br>

        <button id="clickerFunction" type="submit" class="btn btn-success">Click to Return</button>
    </div>

    <script>
        $(document).ready(function(e) {
            $("#success").hide();
            $('#clickerFunction').click(function(e) {
                var a = $("#a").val();
                var c = $("#c").val();

                $.post("AmendmentController/AmendmentFormController", {
                        afm_ref: a,
                        from: 6,
                        to: 7,
                        reason: c
                    },
                    function(data, status) {
                        if (data.includes("This action has been successfully completed")) {
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