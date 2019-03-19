<?php
    require_once __DIR__."/object.php";
    require_once __DIR__."/order.php";
    class OrderProduct extends Objects{
        public $order_id, $product_id, $num_of_product;
        public $table = "orders_products";
        
        function create(){
            $query = "INSERT INTO ".$this->table." SET ".
                        "order_id =".$this->order_id.", ".
                        "product_id=".$this->product_id.", ".
                        "num_of_product=".$this->num_of_product.", ".
                        "price=".$this->price;
            $result = mysqli_query($this->conn, $query);
            echo $result;
        }

        function update(){
            $query = "UPDATE ".$this->table." SET ".
                        "num_of_product=".$this->num_of_product.
                        " ,price=".$this->price. 
                        " WHERE order_id =".$this->order_id." AND product_id = ".$this->product_id;
            $result = mysqli_query($this->conn, $query);
            return mysqli_affected_rows($this->conn);
        }

        
        function fetchAllOrderByUser($userId){
            $query = "SELECT od.*, p.title, p.picture, o.order_date, o.deliver_status
                FROM orders_products as od, products as p, orders as o
                WHERE p.id = od.product_id AND o.id = od.order_id AND o.user_id = ".$userId;
            $result = mysqli_query($this->conn, $query);
            $arr = array();
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    array_push($arr, $row);
                }
            }
            return $arr;
        }
    }
?>