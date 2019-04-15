<?php
    require_once __DIR__."/../model/order_product.php";
    require_once __DIR__."/../model/order.php";

    class OrderProductCtr {
        function fetch($userId){
            $orderProduct = new OrderProduct();
            return $orderProduct->fetchAllOrderByUser($userId);
        }

        function create($orderProduct){
            return $orderProduct->create();            
        }

        //Check the existence of a product_id in a session
        function existProduct($orderProduct, $product_id, $order_id){
            $data = $orderProduct->gets();
            foreach($data as $d) {
                if($d['order_id'] == $order_id && $d['product_id'] == $product_id) return $d;
            }
            return false;
        }

        function update($orderProduct, $userId){
            $affectRow = $orderProduct->updateOrderProduct($userId);
            if($affectRow > 0){
                return json_encode(array(
                    "status" => "success"
                ));
            }
            return json_encode(array("status" => "review",  "message" => "not row affect"));
        
        }

        function delete($orderProduct, $userId){
            $affectRow = $orderProduct->deleteOrderProduct($userId);
            
        }

        //If deliver_status = 0 exists, continue with the old order_id
        //else create new order
        function checkDeliverStatus($userId){
            $orderProduct = new OrderProduct();
            $data = $orderProduct->fetchAllOrderByUser($userId);
            foreach($data as $d){
                if($d['deliver_status'] == 0) return $d;
            }
            return false;
        }

    }

   
?>