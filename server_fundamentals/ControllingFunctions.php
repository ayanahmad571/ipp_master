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

function workOrderPagesQuery($sqlInCondition, $notIn = false, $refCheck = 0)
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
    " . ($refCheck > 0 ? "and master_wo_ref = " . $refCheck : "") . "
    order by master_wo_gen_dnt desc";
}

function getByForFromWO($genIn, $sales_personIn)
{
    $gen = getLum($genIn);
    $sales_person = getLum($sales_personIn);
    return (is_array($gen) ? $gen['lum_code'] . "-" . $gen['lum_name'] : " - ") . ' for ' . (is_array($sales_person) ? $sales_person['lum_code'] . "-" . $sales_person['lum_name'] : " - ");
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
        const t_'.$id.' = $("#' . $id . '").DataTable({
            "order": [
            [' . $pos . ', "' . $sort . '"]
            ]
        });
    </script>
      ';
}

function getModal()
{
?>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
<?php
}

function getWOSales($USER_ARRAY)
{

    $salesGroups = mysqlSelect("select sgp_sgm_id from sales_groups_people where sgp_lum_id = " . $USER_ARRAY['lum_id']);

    if ($USER_ARRAY['lum_user_type'] == 1 || $USER_ARRAY['lum_user_type'] == 2) {
        #Master Admin and MD
        $pubQuery = workOrderPagesQuery("1,2,3,10", true);
    } else if ($USER_ARRAY['lum_user_type'] == 4) {
        #Sales Coordinator
        if (!is_array($salesGroups)) {
            die("User not assigned to any sales group");
        }
        $containerLeft = "select * from ( ";
        $containerRight = " ) sb where (sb.mwo_gen_lum_id = " . $USER_ARRAY['lum_id'] . " or sb.mwo_gen_on_behalf_lum_id = " . $USER_ARRAY['lum_id'] . ")";

        $pubQuery = $containerLeft . workOrderPagesQuery("1,2,3,10", true) . $containerRight;
    } else if ($USER_ARRAY['lum_user_type'] == 18) {
        #Assistant Sales Manager
        if (!is_array($salesGroups)) {
            die("User not assigned to any sales group");
        }


        $containerLeft = "select * from ( ";
        $containerRight = " ) sb where (sb.mwo_gen_lum_id = " . $USER_ARRAY['lum_id'] . " or sb.mwo_gen_on_behalf_lum_id = " . $USER_ARRAY['lum_id'] . ")";

        $pubQuery = $containerLeft . workOrderPagesQuery("1,2,3,10", true) . $containerRight;
    } else if ($USER_ARRAY['lum_user_type'] == 16) {
        #Sales Manager
        if (!is_array($salesGroups)) {
            die("User not assigned to any sales group");
        }

        $allLowerUsers = ("select p.sgp_lum_id from sales_groups_people p 
        left join user_main on p.sgp_lum_id = lum_id
        where 
        lum_user_type in (18,4) and
        p.sgp_sgm_id in (select s.sgp_sgm_id from sales_groups_people s where s.sgp_lum_id = " . $USER_ARRAY['lum_id'] . ")");


        $containerLeft = "select * from ( ";
        $containerRight = " ) sb 
        where (sb.mwo_gen_lum_id = " . $USER_ARRAY['lum_id'] . " or sb.mwo_gen_on_behalf_lum_id = " . $USER_ARRAY['lum_id'] . " or 
        sb.mwo_gen_lum_id in (" . $allLowerUsers . ") 
        or sb.mwo_gen_on_behalf_lum_id in (" . $allLowerUsers . ") )";

        $pubQuery = $containerLeft . workOrderPagesQuery("1,2,3,10", true) . $containerRight;
    } else {
        die("Un-Authorized User");
    }

    return $pubQuery;
}
?>