<?php
require_once("../server_fundamentals/SessionHandler.php");

if(isset($_POST['client_id']) && isset($_POST['client_name']) && isset($_POST['client_code']) && isset($_POST['client_show'])){
    

    if(!is_numeric($_POST['client_id'])){
        die("Invalid Client ID");
    }

    if(!is_numeric($_POST['client_show'])){
        die("Invalid Client Show");
    }
    

    $getMat = mysqlSelect("SELECT * FROM `clients_main` where client_id = ".$_POST['client_id']);
   
    $updateQ = mysqlUpdateData("UPDATE `clients_main` SET 
    `client_code`='".$_POST['client_code']."',
    `client_name`='".$_POST['client_name']."',
    `client_show`='".$_POST['client_show']."' WHERE client_id = ".$_POST['client_id'] , true);
    if(is_numeric($updateQ)){   
        header("Location: ../master_clients.php");
        die();
    }
}


if(isset($_POST['add_client_name']) && isset($_POST['add_client_code'])){

    $insertQ = mysqlInsertData("INSERT INTO `clients_main`(`client_code`, `client_name`, `client_dnt`, `client_lum_id`) VALUES (
        '".$_POST['add_client_code']."',
        '".$_POST['add_client_name']."',
        '".time()."',
        '".$USER_ARRAY['lum_id']."'
    )",true);

    if(is_numeric($insertQ)){   
        var_dump($insertQ);
        die();
        header("Location: ../master_clients.php");
        die();
    }
}
?>