<?php
    require_once("../../../config/database.php");
    require_once("../model/admin.php");

    function generateToken($user){
        $data = array(
            "id" => $user->id,
            "email"=>$user->email,
            "acount_type"=>$user->account_type
        );
        setcookie("token", base64_encode($data), time()+1000);
        return $_COOKIE['token'];
    }

    $admin = new Admin((new DB)->connect());
    
    header("content-type: application/json");
    if(!isset($_POST["email"]) || !isset($_POST['password']) || $_POST["email"]=="" || $_POST['password'] == ""){
        echo json_encode(array("message" => "Invalid email, password", "status" => "fail"));
    } 
    else{
        $admin->email = $_POST['email'];
        $admin->password = $_POST['password'];
        // $status = $admin->getAdmin();
        $admin->acount_type = "admin";
        $token = generateToken($admin);
        echo json_encode( array(
            "status" => "success",
            "token" =>$token
        ));
    }
    
?>