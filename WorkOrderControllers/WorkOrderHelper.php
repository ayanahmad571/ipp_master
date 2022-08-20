<?php

function getUpdater($ids, $not = 0)
{
    $getDraftsH = mysqlSelect(workOrderPagesQuery($ids));
?>
    <script src="assets/modules/iZiToast.js"></script>
    <input type="hidden" id="rowDiff" value="<?php echo (is_array($getDraftsH) ? count($getDraftsH) : "0"); ?>" />
    <script>
        function fetchdata() {
            var rowD = $("#rowDiff").val();
            $.ajax({
                url: 'WorkOrderControllers/AllController',
                type: 'post',
                data: {
                    rowDiffChecker: rowD,
                    ids: "<?php echo $ids; ?>",
                    not_ski: "<?php echo $not; ?>"
                },
                success: function(response) {
                    // Perform operation on the return value
                    if (response != "0") {
                        iziToast.success({
                            title: 'Work Order Update!',
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


function getBootboxScript($classIn, $confirmationIn, $idName, $tableHolderName)
{
?>
    <script>
        t_<?php echo $tableHolderName ?>.on('draw', function(e) {
            $('.<?php echo $classIn; ?>').click(function(e) {
                var dataId = ($(this).data("id"));

                bootbox.confirm("<?php echo $confirmationIn; ?>- ASales / Work Order Number " + dataId + " ?", function(result) {
                    if (result) {


                        $.post("server_fundamentals/MainWorkOrderSubmit", {
                                <?php echo $idName; ?>: dataId,
                            },
                            function(data, status) {
                                if (data.includes("Success- Work Order Successfully Published")) {
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
            }); /* .pubslishDraft Click*/
        }); /*Table Draw Ready*/
        
    </script>
<?php
}

function getDiscardScript($classIn, $pathIn, $tableHolderName, $name = "WorkOrderGetDetails")
{
?>
    <script>
        t_<?php echo $tableHolderName ?>.on('draw', function(e) {
            $('.<?php echo $classIn; ?>').click(function(e) {
                var dataId = ($(this).data("id"));

                $.post("server_fundamentals/<?php echo $pathIn; ?>", {
                        <?php echo $name; ?>: dataId,
                    },
                    function(data, status) {
                        $(".modal-body").html(data);

                        $('#myModal').modal('show');
                    });

            });
        }); /*Table Draw Ready*/
    </script>
<?php
}

function getDataTableDrawScript($tableHolderName){
    ?>
    <script>
        $(document).ready(function(e) {
            t_<?php echo $tableHolderName ?>.draw();
        });
    </script>
    <?php
    
}

?>