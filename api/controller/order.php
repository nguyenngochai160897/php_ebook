<?php
    require_once __DIR__."/../model/order.php";

    class OrderCtr {
        //for admin
        function fetch($id = false){
            if($id != false && !is_numeric($id)){
                return json_encode(array(
                    "message" => "id have to be number",
                    "status" => "fail"
                ));
            }
            if($id == false){
                $order = new Order();
                $data = $order->gets();
                return json_encode(
                    array(
                        "status" => "success",
                        "records" => $data
                    )
                );
            }
            else{
                $order = new Order();
                $order->id = $id;
                return json_encode(array(
                    "records" => $order->get(),
                    "status" => "success"
                ));
            }
        }

        //for customer
        function fetchByUser($order, $id = false){
            return $order->fetchAllByUser();
        }
        //create a order for customer
        function create($order){
            return $order->create();
        }
    }
?>