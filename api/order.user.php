<?php
    require_once __DIR__."/controller/order_product.php";
    require_once __DIR__."/controller/order.php";
    require_once __DIR__."/../config/helper.php";
    require_once __DIR__."/model/product.php";

    $method = $_SERVER['REQUEST_METHOD'];
    $orderProductCtr = new OrderProductCtr();
    $orderCtr = new OrderCtr();

    //get all order (transaction history) -> shopping cart
    if($method == "GET"){
        //check auth
        session_start();
        if(checkSession() == false){
            echo json_encode(array(
                "message" => "not auth",
                "status" => "fail"
            ));
            return;
        }
        
        $data = $orderProductCtr->fetch($_SESSION['userId']);
        echo json_encode(
            array("records" => $data)
        );
    }

    //add a order_product by the user 
    else if($method == "POST"){
        
        //check auth
        session_start();
        if(checkSession() == false){
            echo json_encode(array(
                "message" => "not auth",
                "status" => "fail"
            ));
            return;
        }

        if(!isset($_POST['product_id']) || empty(trim($_POST['product_id']))
            ||!isset($_POST['num_of_product']) || empty(trim($_POST['num_of_product']))){
                echo json_encode(array(
                    "message" => "invalid input",
                    "status" => "fail"
                ));
        }
        else{
            //check status_deliver
            $checkDeliverStatus = $orderProductCtr->checkDeliverStatus($_SESSION['userId']);
            if(is_array($checkDeliverStatus)){
                $_SESSION['orderId'] = $checkDeliverStatus['order_id'];
            }

            //setup session make add to shopping cart
            $order = new Order();
            if(!isset($_SESSION['orderId'])){
                //create a empty order
                $order->user_id = $_SESSION['userId'];
                $order->deliver_status = 0;
                $order->total_price = 0;
                $_SESSION['orderId'] = $orderCtr->create($order);;
            }
            
            
            //get price of product
            $product = new Product();
            $product->id = $_POST['product_id'];
            $priceAProduct = ($product->get())[0]["price"];

            //Check the existence of a product_id in a session
            $oP = new OrderProduct();
            $existProduct = $orderProductCtr->existProduct($oP, $_POST['product_id'], $_SESSION['orderId']);
            if(is_array($existProduct)){
                $op = new OrderProduct();
                $op->num_of_product = $existProduct['num_of_product'] + $_POST['num_of_product'];
                $op->price = $existProduct['price'] + $_POST['num_of_product'] * $priceAProduct;
                $op->order_id = $_SESSION['orderId'];
                $op->product_id = $_POST['product_id'];
                $orderProductCtr->update($op);
            }
            else{
                //create a order_product
                $orderProduct = new OrderProduct();
                $orderProduct->order_id= $_SESSION['orderId'];
                $orderProduct->product_id = $_POST['product_id'];
                $orderProduct->num_of_product = $_POST['num_of_product'];
                $orderProduct->price = $_POST['num_of_product'] * $priceAProduct;
                $orderProductCtr->create($orderProduct);
            }

            //update total_price for order which just happend
            require_once __DIR__."/model/order.php";
            $order->updateTotalPrice(); //ship = 0 discount = 0...
            echo json_encode(array("message" => "order_product is created", "stauts" => "sucess"));
        }
    }
    else{
        echo json_encode(array(
            "message" => "Not exsit method ".$method
        ));
    }
?>