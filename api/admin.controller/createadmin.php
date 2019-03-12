<?php
    require_once("../../../config/database.php");
    require_once("../model/admin.php");
    $admin = new Admin((new DB)->connect());
    
    // header("content-type: application/json");
    if(!isset($_POST["email"]) || !isset($_POST['password']) || $_POST["email"]=="" || $_POST['password'] == ""
        || !isset($_POST["name"]) || $_POST["name"]==""){
        echo json_encode(array("message" => "Invalid email, password or name"));
    } 
    else{
        $admin->email = $_POST['email'];
        $admin->password = $_POST['password'];
        $admin->name = $_POST['name'];
        require_once("../../../config/helper.php");
        if(!isEmail($admin->email)){
            echo json_encode(array("message" => "Wrong format email"));
        }
        else if($admin->checkEmail()){
            echo json_encode(array("message" => "Email already exist", "status" => "fail"));
        }
        else {
            echo $admin->createAdmin();
            
        }
    }
?>