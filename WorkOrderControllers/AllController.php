<?php
require_once("../server_fundamentals/SessionHandler.php");

if(isset($_POST['rowDiffChecker'])){
    
    if(is_numeric(($_POST['rowDiffChecker']))){
        $getDrafts = mysqlSelect(workOrderPagesQuery("9"));
        
        if(count($getDrafts) != $_POST['rowDiffChecker']){
            echo count($getDrafts);
            die();
        }else{
            echo "0";
            die();
        }
    }
}
?>