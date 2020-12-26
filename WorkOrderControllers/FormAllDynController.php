<?php 
require_once("../server_fundamentals/SessionHandler.php");


if(isset($_POST['bag_id']) && is_numeric($_POST['bag_id'])){
    $getBag = mysqlSelect("SELECT * FROM `bag_digital_master` where bdm_valid =1 and bdm_id=".$_POST['bag_id']);
    if(!is_array($getBag)){
        die();
    }
    $getParams = mysqlSelect("SELECT * FROM `bag_digital_params` where bdp_bdm_id =".$_POST['bag_id']);
    if(!is_array($getParams)){
        die();
    }
    $paramsCont = "";

    foreach($getParams as $Param){
        $paramsCont .= '<div class="form-group col-xs-12 col-sm-6">
                        <label>'.$Param['bdp_title'].'</label>
                        <input type="text" class="form-control" name="bags['.$Param['bdp_id'].']" placeholder="'.$Param['bdp_title'].'">
                        </div>';

    }

    $toRet = array('<img class="img-thumbnail" src="'.$getBag[0]['bdm_url'].'" />',$paramsCont);
    echo json_encode($toRet);
    die();
}

if(isset($_POST['pouch_sub_id']) && is_numeric($_POST['pouch_sub_id'])){
    $getPouch = mysqlSelect("SELECT * FROM `pouch_digital_sub` where pds_valid =1 and pds_id=".$_POST['pouch_sub_id']);
    if(!is_array($getPouch)){
        die();
    }
    $getParams = mysqlSelect("SELECT * FROM `pouch_digital_params` where pdp_pds_id =".$_POST['pouch_sub_id']);
    if(!is_array($getParams)){
        die();
    }
    $paramsCont = "";

    foreach($getParams as $Param){
        $paramsCont .= '<div class="form-group col-xs-12 col-sm-6">
                        <label>'.$Param['pdp_title'].'</label>
                        <input type="text" class="form-control" name="pouch['.$Param['pdp_id'].']" placeholder="'.$Param['pdp_title'].'">
                        </div>';

    }

    $toRet = array('<img class="img-thumbnail" src="'.$getPouch[0]['pds_url'].'" />',$paramsCont);
    echo json_encode($toRet);
    die();
}
?>
