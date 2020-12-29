<?php
require_once("../server_fundamentals/SessionHandler.php");

if(isset($_POST['rowDiffChecker']) && isset($_POST['ids']) && isset($_POST['not_ski'])){
    if(is_numeric(($_POST['rowDiffChecker'])) && is_numeric($_POST['not_ski'])){
        $notIn = false;
        if($_POST['not_ski'] == 1){
            $notIn = true;
        }
        
        $getDrafts = mysqlSelect(workOrderPagesQuery($_POST['ids'],$notIn));
        
        $nos = 0;
        if(is_array($getDrafts)){
            $nos = count($getDrafts);
        }
        if($nos != $_POST['rowDiffChecker']){
            echo $nos;
            die();
        }else{
            echo "0";
            die();
        }
    }
}
?>
