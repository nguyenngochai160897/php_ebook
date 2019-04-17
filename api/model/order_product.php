<?php
    require_once __DIR__."/object.php";
    require_once __DIR__."/order.php";
    require_once __DIR__."/db.php";
    class OrderProduct{
        public $order_id, $product_id, $num_of_product, $price, $id;
        public $table = "orders_products";
        
        function create(){
            $conn = connectDB();
            $query = "INSERT INTO ".$this->table." SET ".
                        "order_id =".$this->order_id.", ".
                        "product_id=".$this->product_id.", ".
                        "num_of_product=".$this->num_of_product.", ".
                        "price=".$this->price;
            $result = mysqli_query($conn, $query);
            // echo $result;
            mysqli_close($conn);
        }

        function update(){
            //no use
        }
        function delete(){
            //no use
        }
        function updateOrderProduct($userId){
            $conn = connectDB();
            $query = "UPDATE orders_products SET".
                    " price =".$this->price.",".
                    " num_of_product =".$this->num_of_product.
                    " WHERE product_id =".$this->product_id." AND order_id=".$this->order_id.
                    " AND order_id = (SELECT id FROM orders WHERE user_id =".$userId." AND orders.deliver_status=0)";
            $result = mysqli_query($conn, $query);
            $affected = mysqli_affected_rows($conn);
            mysqli_close($conn);
            return $affected;
        }

        
        
        function deleteOrderProduct($userId){
            $conn = connectDB();
            $query = "DELETE FROM orders_products WHERE product_id = ".$this->product_id.
                " AND order_id = (SELECT orders.id FROM orders WHERE user_id = ".$userId.
                " AND deliver_status = 0)";
            mysqli_query($conn, $query);
            $affected = mysqli_affected_rows($conn);
            mysqli_close($conn);
            return $affected;
        }

        
        function fetchAllOrderByUser($userId){
            $conn = connectDB();
            $query = "SELECT od.*, p.title, p.picture, o.order_date, o.deliver_status
                FROM orders_products as od, products as p, orders as o
                WHERE p.id = od.product_id AND o.id = od.order_id AND o.user_id = ".$userId;
            $result = mysqli_query($conn, $query);
            $arr = array();
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    array_push($arr, $row);
                }
            }
            mysqli_close($conn);
            return $arr;
        }
    }
?>