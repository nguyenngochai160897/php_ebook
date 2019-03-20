<?php
    require_once __DIR__."/controller/order.php";
    require_once __DIR__."/../config/helper.php";
    
    sessionStart();
    $method = $_SERVER['REQUEST_METHOD'];
    $orderCtr = new OrderCtr();

    //for admin
    if($method == "GET"){
        //check auth
        if(checkSession() == false || checkSession() == "customer"){
            echo json_encode(array(
                "message" => "not auth",
                "status" => "fail"
            ));
            return;
        }

        if(checkSession() == "admin"){
            if(isset($_GET['id'])){ //get a order with id = ?
                echo $orderCtr->fetch($_GET['id']);
            }
            else{ // get all order
                echo $orderCtr->fetch();
            }
        }
        
    }

    

    else{
        echo json_encode(array(
            "message" => "Not exsit method ".$method
        ));
    }
?>