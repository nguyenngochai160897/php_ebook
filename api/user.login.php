<?php

    require_once __DIR__."/controller/user.php";
    require_once __DIR__."/../config/helper.php";

    $method = $_SERVER['REQUEST_METHOD'];
    
    if($method == "POST"){
        if(!isset($_POST['email']) || !isset($_POST['password']) ||empty(trim($_POST['email'])) || empty(trim($_POST['password']))){
            echo json_encode(array(
                "message" => "invalid input",
                "status" => "fail"
            ));
        }
        else{
            $userCtr = new UserCtr();
            $user = new User();
            $user->email = $_POST['email'];
            $user->password = $_POST['password'];
            $data = $userCtr->login($user);
            echo $data;
        }
    }
    else{
        echo json_encode(array(
            "message" => "Not exsit method ".$method
        ));
    }
?>