<?php
    require_once __DIR__."/object.php";
    require_once __DIR__."/db.php";
    class Order{
        public $user_id, $order_date, $deliver_status, $total_price, $id;
        public $table = "orders";

        // function fetchAll(){
        //     $query = "SELECT orders.* FROM orders JOIN users on orders.user_id = users.id";
        //     $result = mysqli_query($this->conn, $query);
        //     $arr = array();
        //     if(mysqli_num_rows($result) > 0){
        //         while($row = mysqli_fetch_assoc($result)){
        //             array_push($arr, $row);
        //         }
        //     }
        //     return $arr;
        // }

        // function fetch(){
        //     // $father_table = "users";
        //     $query = "SELECT orders.* FROM orders JOIN users on orders.user_id = users.id ".
        //             "WHERE orders.id =".$this->id;
        //     $result = mysqli_query($this->conn, $query);
        //     $arr = array();
        //     if(mysqli_num_rows($result) > 0){
        //         while($row = mysqli_fetch_assoc($result)){
        //             array_push($arr, $row);
        //         }
        //     }
        //     return $arr;
        // }

        function fetchAllByUser(){
            $conn = connectDB();
            // $father_table = "users";
            $query = "SELECT orders.* FROM orders JOIN users on orders.user_id = users.id ".
                    "WHERE users.id =".$this->user_id;
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

        function create(){
            $query = "INSERT INTO ".$this->table.
                    " SET ". 
                    "user_id = '".$this->user_id."', ".
                    "deliver_status = '".$this->deliver_status."', ".
                    "total_price = '".$this->total_price."'";
            $result = mysqli_query($this->conn, $query);
            $query = "SELECT id FROM ".$this->table." WHERE user_id=".$this->user_id.
                    " AND status_deliver=0";
            $order_id = mysqli_insert_id($conn);
            mysqli_close($conn);

            return $order_id;
        }

        //just update deliver_status and total_price
        function update(){
            $conn = connectDB();
            $query = "UPDATE ".$this->table.
                    " SET ". 
                    "user_id = '".$this->user_id."', ".
                    "deliver_status = '".$this->deliver_status."', ".
                    "total_price = '".$this->total_price."'".
                    " WHERE id = ".$this->id;
            $result = mysqli_query($conn, $query);

            $affected = mysqli_affected_rows($conn);
            mysqli_close($conn);
            return $affected;
        }

        function updateTotalPrice(){
            $conn = connectDB();
            $query = "UPDATE orders
                SET total_price = (SELECT SUM(price) FROM orders_products WHERE orders_products.order_id = orders.id AND 
                orders.deliver_status=0 AND orders.user_id=".$this->user_id.")";
            $result = mysqli_query($conn, $query);

            $affected = mysqli_affected_rows($conn);
            mysqli_close($conn);
            return $affected;
        }
        function get(){
            $conn = connectDB();
            $query = "SELECT users.phone as phone, users.email as email, orders.id as order_id, orders.total_price as total, orders.address as address, products.*, orders_products.num_of_product as amount, orders_products.price as totalAmount ".
                "from users,orders, orders_products, products where orders.id = ".$this->id.
                " AND orders_products.order_id=orders.id AND orders_products.product_id=products.id ".
                "AND orders.user_id=users.id";
            $result = mysqli_query($conn, $query);
            $arr = array();
            if(mysqli_num_rows($result)){
                while($row = mysqli_fetch_assoc($result)){
                    array_push($arr, $row);
                }
            }
            mysqli_close($conn);
            return ($arr);
        }
        function gets(){
            $conn = connectDB();
            $query = "SELECT orders.*, users.email, users.phone FROM users, orders WHERE orders.user_id=users.id AND users.account_type!='admin' AND deliver_status!=0";
            $result = mysqli_query($conn, $query);
            $arr = array();
            if(mysqli_num_rows($result)){
                while($row = mysqli_fetch_assoc($result)){
                    array_push($arr, $row);
                }
            }
            mysqli_close($conn);
            return ($arr);
        }
        function updateStatus(){
            $conn = connectDB();
            if($this->deliver_status==3){
                $query1="SELECT * FROM `orders_products` where order_id=".$this->id;
                $arr = [];
                $result = mysqli_query($conn, $query1);
                while($row = mysqli_fetch_assoc($result)){
                    array_push($arr, $row);
                }
                foreach($arr as $a){
                    $query2 = "UPDATE products SET num_existed=num_existed+".$a['num_of_product']." WHERE id=".$a['product_id'];
                    mysqli_query($conn, $query2);
                }
            }
            $query = "UPDATE orders SET deliver_status=".$this->deliver_status." WHERE id=".$this->id;
            echo $query;
            
            mysqli_query($conn, $query);
            mysqli_close($conn);
        }
    }

?>