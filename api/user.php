<?php
    require_once __DIR__."/controller/user.php";
    require_once __DIR__."/../config/helper.php";

    $method = $_SERVER['REQUEST_METHOD'];
    
    //signup just for customer
    if($method == "POST"){
        if(!isset($_POST['email']) || !isset($_POST['password']) ||empty(trim($_POST['email'])) || empty(trim($_POST['password'])) 
            || !isset($_POST['phone']) || !isset($_POST['first_name']) || !isset($_POST['last_name']) ){
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
            $user->phone = $_POST['phone'];
            $user->first_name = $_POST['first_name'];
            $user->last_name = $_POST['last_name'];
            $user->account_type = "customer";
            echo $userCtr->signup($user);
        }
    }

    //change password
    else if($method == "PUT"){
        //check user
        if(checkSession() == false) {
            echo json_encode(array("message" => "not auth", "status" => "fail"));
            return;
        }
        parse_str(file_get_contents('php://input'), $_PUT);
        if(!isset($_PUT['old_password']) || empty(trim($_PUT['old_password']))
            || !isset($_PUT['new_password']) || empty(trim($_PUT['new_password']))
            || !isset($_PUT['confirm_new_password']) || empty(trim($_PUT['confirm_new_password']))){
                echo json_encode(array(
                    "message" => "invalid input",
                    "status" => "fail"
                ));
        }
        else if($_PUT['new_password'] != $_PUT['confirm_new_password']){
            echo json_encode(array(
                "message" => "password don't match",
                "status" => "fail"
            ));
        }
        else{
            $userCtr = new UserCtr();
            $user = new User();
            $user->id = $_SESSION['userId'];
            $user->password = $_PUT['old_password'];
            $check = $userCtr->verifyPassword($user);
            $check = json_decode($check);
            
            if(($check->{'status'}) == "fail") echo $userCtr->verifyPassword($user);
            else{
                $user->password = $_PUT['new_password'];
                echo $userCtr->changePassword($user);
            }
        }      
    }

    //payment for customer
    else if($method == "PATCH"){
        //check auth
        if(checkSession() == false) {
            echo json_encode(array("message" => "not auth", "status" => "fail"));
            return;
        }
        parse_str(file_get_contents('php://input'), $_PATCH);
        if(!isset($_PATCH['first_name']) || empty(trim($_PATCH['first_name']))
            ||!isset($_PATCH['last_name']) || empty(trim($_PATCH['last_name']))
            ||!isset($_PATCH['phone']) || empty(trim($_PATCH['phone']))
            ||!isset($_PATCH['ship_address']) || empty(trim($_PATCH['ship_address']))){
                echo json_encode(array(
                    "message" => "invalid input",
                    "status" => "fail"
                ));
        }
        else{
            $userCtr = new UserCtr();
            $user = new User();
            $user->id = $_SESSION['userId'];
            $user->first_name = $_PATCH['first_name'];
            $user->last_name = $_PATCH['last_name'];
            $user->phone = $_PATCH['phone'];
            $user->ship_address = $_PATCH['ship_address'];
            $userCtr->shipment($user);
        }
    }
    else{
        echo json_encode(array(
            "message" => "Not exsit method ".$method
        ));
    }
?>