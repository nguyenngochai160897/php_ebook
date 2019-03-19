<?php
    require_once __DIR__."/controller/order.php";
    require_once __DIR__."/../config/helper.php";

    $method = $_SERVER['REQUEST_METHOD'];
    $orderCtr = new OrderCtr();

    //for admin
    if($method == "GET"){
        //check auth
        session_start();
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

    // //create a new order
    // else if($method == "POST"){
    //     //check auth
    //     session_start();
    //     if(checkSession() == false){
    //         echo json_encode(array(
    //             "message" => "not auth",
    //             "status" => "fail"
    //         ));
    //         return;
    //     }

    //     if(checkSession() == "customer"){
    //         //total_price = ?
    //         $order = new Order();
    //         $order->user_id = $_SESSION['userId'];
    //         $order->deliver_status = 0;
    //         $order->total_price = 0;
    //         $orderCtr->create($order);
    //         echo json_encode(array("message" => "order is created success", "status" => "success"));
    //     }
    // }

    else{
        echo json_encode(array(
            "message" => "Not exsit method ".$method
        ));
    }
?>