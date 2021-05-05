<?php
require_once("../server_fundamentals/SessionHandler.php");

if(isset($_POST['material_id']) && isset($_POST['material_name']) && isset($_POST['material_density']) && isset($_POST['material_show']) && isset($_POST['material_position'])){
    if(!is_numeric($_POST['material_id'])){
        die("Invalid Material Id Selected");
    }

    if(!is_numeric($_POST['material_show'])){
        die("Invalid Material Show Value");
    }
    
    if(!is_numeric($_POST['material_position'])){
        die("Invalid Material Position Value");
    }

    if(!is_numeric($_POST['material_density'])){
        die("Invalid Material Density    Value");
    }

    $getMat = mysqlSelect("SELECT * FROM `materials_main` where material_id = ".$_POST['material_id']);
    $updateQ = mysqlUpdateData("UPDATE `materials_main` SET 
    `material_value`='".$_POST['material_name']."',
    `material_density`='".$_POST['material_density']."',
    `material_show`='".$_POST['material_show']."',
    `material_position`= '".$_POST['material_position']."' WHERE material_id = ".$_POST['material_id'],true);
    if(is_numeric($updateQ)){   
        header("Location: ../master_materials.php");
        die();
    }
}


if(isset($_POST['add_material_name']) && isset($_POST['add_material_density']) && isset($_POST['add_material_position'])){

    if(!is_numeric($_POST['add_material_density'])){
        die("Invalid Material Density Value");
    }
    
    if(!is_numeric($_POST['add_material_position'])){
        die("Invalid Material Position Value");
    }

    $insertQ = mysqlInsertData("INSERT INTO `materials_main`( `material_value`, `material_density`, `material_position`) VALUES (
        '".$_POST['add_material_name']."',
        '".$_POST['add_material_density']."',
        '".$_POST['add_material_position']."'
    )",true);

    if(is_numeric($insertQ)){   
        header("Location: ../master_materials.php");
        die();
    }
    // TODO Add Logs here and at the top
}
?>