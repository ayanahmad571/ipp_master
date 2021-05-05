<?php
require_once("Settings.php");



function getPageTitle($title)
{
?>
    <div class="section-header">
        <h1><?php echo $title; ?></h1>
    </div>
<?php
}

function getTopCard($sizes, $icon, $head, $body)
{
?>
    <div class="<?php echo $sizes ?>">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="<?php echo $icon ?>"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4><?php echo $head ?></h4>
                </div>
                <div class="card-body"><?php echo $body ?></div>
            </div>
        </div>
    </div>
<?php
}

function workOrderPagesQuery($sqlInCondition, $notIn = false)
{
    return "select *
    from `master_work_order_reference_number` r 
    left join master_work_order_main on (		
        SELECT master_wo_id FROM `master_work_order_main`
        where master_wo_ref = r.mwo_ref_id
        order by master_wo_id desc 
        limit 1
    ) = master_wo_id 
         
    left join clients_main on master_wo_2_client_id = client_id
    left join master_work_order_main_identitiy on master_wo_status = mwoid_id
    where master_wo_status " . ($notIn ? "not in" : "in") . " (" . $sqlInCondition . ")
    order by master_wo_gen_dnt desc";
}

function getByForFromWO($gen, $sales_person)
{
    return (is_array($gen) ? $gen[0]['lum_code'] . "-" . $gen[0]['lum_name'] : " - ") . ' for ' . (is_array($sales_person) ? $sales_person[0]['lum_code'] . "-" . $sales_person[0]['lum_name'] : " - ");
}

function wrapInput($value)
{
}

function getDateTimeFormat()
{
    return 'Y-m-d @ h:i:s a';
}

function getDataTableDefiner($id, $pos = 4, $sort = "desc")
{
    echo '
    <script>
        $("#' . $id . '").DataTable({
            "order": [
            [' . $pos . ', "' . $sort . '"]
            ]
        });
    </script>
      ';
}

?>