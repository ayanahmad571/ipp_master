<?php

function getRawAmendmentQuery($id, $not = false, $all = false, $ref = 0)
{
    $selector = "a.afm_rel_wo_ref";
    $leftJoiner = "";
    $conditional = "and a.afm_status " . ($not ? "not in " : " in ") . " (" . $id . ") ";

    if ($all) {
        $selector = "*";
        $leftJoiner = "left join amendment_form_identity afi on a.afm_status = afi.afi_id";
        $conditional = "";
    }

    $condRef = "";

    if ($ref > 0) {
        $selector = "*";
        $condRef = "and a.afm_rel_wo_ref = " . $ref;
        $leftJoiner = "left join amendment_form_identity afi on a.afm_status = afi.afi_id";
        $conditional = "and a.afm_status " . ($not ? "not in " : " in ") . " (" . $id . ") ";
    }

    $amendmentTable = "select " . $selector . " from amendment_form_main a 
    " . $leftJoiner . "
    where a.afm_id = 
    (SELECT c.afm_id FROM `amendment_form_main` c 
    where c.afm_rel_wo_ref = a.afm_rel_wo_ref
    order by c.afm_id desc 
    limit 1)
    " . $conditional . " " . $condRef;

    return $amendmentTable;
}

function getAmendmentWrapped($pubQuery, $id, $not = false, $all = false)
{

    $amendmentTableAll = getRawAmendmentQuery($id, $not, true);
    $amendmentTableSome = getRawAmendmentQuery($id, $not);

    return "select * from (" . $pubQuery . ") wp 
    left join (" . $amendmentTableAll . ") am on am.afm_rel_wo_ref = wp.master_wo_ref
    where wp.master_wo_ref " . ($all ? " not in " : "in") . "
      (" . $amendmentTableSome . ")";
}


function getEssentials($headName)
{
    getHead($headName);
?>
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
    <link rel="stylesheet" href="assets/modules/izit.css">
<?php
}

function getPubQuery()
{
    return workOrderPagesQuery("1,2,3,10", true);
}

function getNumberAmendments($ref)
{
    $getNumberAmendment = mysqlSelect("select count(afm_id) as total 
    from amendment_form_main 
    where afm_rel_wo_ref = " . $ref . " and afm_status = 10 ");

    $totPrint = 0;
    if (is_array($getNumberAmendment)) {
        return $getNumberAmendment[0]["total"];
    }
    return $totPrint;
}

function getSentBody($pubQuery, $tableID, $amendID)
{
?>
    <div class="row">
        <div class="col-12 ">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Received</h4>
                </div>
                <div class="card-body text-justify">
                    <table class="table table-striped table-bordered " id="<?php echo $tableID; ?>">
                        <thead>
                            <tr>
                                <th>WO#</th>
                                <th>Client</th>
                                <th>Design ID</th>
                                <th>User</th>
                                <th>WO Status</th>
                                <th>Amendment #</th>
                                <th>Amendment Status</th>
                                <th>TimeStamp</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $finalWrap = getAmendmentWrapped($pubQuery, $amendID);
                            $getDrafts = mysqlSelect($finalWrap);

                            if (is_array($getDrafts)) {
                                foreach ($getDrafts as $Draft) {
                            ?>
                                    <tr>
                                        <td><?php echo $Draft['master_wo_ref'] ?></td>
                                        <td><?php echo $Draft['client_code'] . " - " . $Draft['client_name']; ?></td>
                                        <td><?php echo $Draft['master_wo_design_id']; ?></td>
                                        <td>
                                            <?php
                                            echo getByForFromWO($Draft['mwo_gen_lum_id'], $Draft['mwo_gen_on_behalf_lum_id']);
                                            ?>
                                        </td>
                                        <td><?php echo $Draft['mwoid_desc2']; ?></td>
                                        <td>
                                            <?php echo 1 + getNumberAmendments($Draft["master_wo_ref"]); ?>
                                        </td>
                                        <td><?php echo $Draft['afi_text']; ?></td>
                                        <td><?php echo date(getDateTimeFormat(), $Draft['afm_gen_dnt']); ?></td>
                                        <td>

                                            <button data-id="<?php echo $Draft['master_wo_ref'] ?>" class="sendAmendment btn btn-success mt-1">Approve</button><br>
                                            <button onclick="openWindowAmendRaw(<?php echo $Draft['master_wo_ref'] ?>)" class="btn btn-primary mt-1">View Form</button><br>
                                            <button onclick="openWindow(<?php echo $Draft['master_wo_ref'] ?>)" class="btn btn-warning mt-1">View WO</button><br>
                                            <button data-id="<?php echo $Draft['master_wo_ref'] ?>" class="discardDraft btn btn-danger mt-1">Reject</button>

                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>

                    </table>

                    <p>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php
}

function getReturnBody($pubQuery, $tableID, $amendID)
{
?>
    <div class="row">
        <div class="col-12 ">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Sent Back</h4>
                </div>
                <div class="card-body text-justify">
                    <table class="table table-striped table-bordered " id="<?php echo $tableID; ?>">
                        <thead>
                            <tr>
                                <th>WO#</th>
                                <th>Client</th>
                                <th>Design ID</th>
                                <th>User</th>
                                <th>WO Status</th>
                                <th>Amendment #</th>
                                <th>Amendment Status</th>
                                <th>TimeStamp</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $finalWrap = getAmendmentWrapped($pubQuery, $amendID);
                            $getDrafts = mysqlSelect($finalWrap);

                            if (is_array($getDrafts)) {
                                foreach ($getDrafts as $Draft) {
                            ?>
                                    <tr>
                                        <td><?php echo $Draft['master_wo_ref'] ?></td>
                                        <td><?php echo $Draft['client_code'] . " - " . $Draft['client_name']; ?></td>
                                        <td><?php echo $Draft['master_wo_design_id']; ?></td>
                                        <td>
                                            <?php
                                            echo getByForFromWO($Draft['mwo_gen_lum_id'], $Draft['mwo_gen_on_behalf_lum_id']);
                                            ?>
                                        </td>
                                        <td><?php echo $Draft['mwoid_desc2']; ?></td>
                                        <td>
                                            <?php echo 1 + getNumberAmendments($Draft["master_wo_ref"]); ?>
                                        </td>
                                        <td><?php echo $Draft['afi_text']; ?></td>
                                        <td><?php echo date(getDateTimeFormat(), $Draft['afm_gen_dnt']); ?></td>
                                        <td>
                                            <button onclick="openWindow(<?php echo $Draft['master_wo_ref'] ?>)" class="btn btn-warning mt-1">View WO</button><br>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>

                    </table>

                    <p>
                    </p>
                </div>
            </div>
        </div>
    </div>

<?php
}

function getBootboxScript($classIn, $confirmationIn, $fromIn, $toIn, $multFrom = false)
{
?>
    <script>
        $(document).ready(function(e) {
            $('.<?php echo $classIn; ?>').click(function(e) {
                var dataId = ($(this).data("id"));
                <?php echo ($multFrom ? 'var datafrom = ($(this).data("from"));' : "") ?>

                bootbox.confirm("<?php echo $confirmationIn; ?>  -  Work Order Number " + dataId + " ?", function(result) {
                    if (result) {


                        $.post("AmendmentController/AmendmentFormController", {
                                afm_ref: dataId,
                                from: <?php echo $fromIn; ?>,
                                to: <?php echo $toIn; ?>
                            },
                            function(data, status) {
                                if (data.includes("This action has been successfully completed")) {
                                    bootbox.alert(data);
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 1000);

                                } else {
                                    bootbox.alert(data);
                                }
                            });


                    }
                });
            });
        }); /*Doc Ready*/
    </script>
<?php
}

function getDiscardScript($classIn, $pathIn)
{
?>
    <script>
        $(document).ready(function(e) {
            $('.<?php echo $classIn; ?>').click(function(e) {
                var dataId = ($(this).data("id"));

                $.post("AmendmentController/<?php echo $pathIn; ?>", {
                        WorkOrderGetDetails: dataId,
                    },
                    function(data, status) {
                        $(".modal-body").html(data);

                        $('#myModal').modal('show');
                    });

            });
        }); /*Doc Ready*/
    </script>
<?php
}

function getUpdater($pubQuery, $mainID, $sales = 0)
{
    $finalWrap = getAmendmentWrapped($pubQuery, $mainID);
    $getAll = mysqlSelect($finalWrap);
?>
    <script src="assets/modules/iZiToast.js"></script>
    <input type="hidden" id="rowDiff" value="<?php echo (is_array($getAll) ? count($getAll) : "0"); ?>" />
    <script>
        function fetchdata() {
            var rowD = $("#rowDiff").val();
            $.ajax({
                url: 'WorkOrderControllers/AllController',
                type: 'post',
                data: {
                    amendRowDiffChecker: rowD,
                    ids: "<?php echo $mainID; ?>",
                    not_ski: "0",
                    sales: "<?php echo $sales; ?>"
                },
                success: function(response) {
                    // Perform operation on the return value
                    if (response != "0") {
                        iziToast.success({
                            title: 'Amendment Update!',
                            message: 'New Updates, Refresh the page to see them',
                            position: 'topRight'
                        });
                        $("#rowDiff").val(response);
                    }
                }
            });
        }

        $(document).ready(function() {
            setInterval(fetchdata, 5000);
        });
    </script>
<?php
}
?>