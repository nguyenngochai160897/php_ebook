<?php
    require_once __DIR__."/object.php";
    require_once __DIR__."db.php";
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

            return mysqli_affected_rows($conn);
        }

        function updateTotalPrice(){
            $conn = connectDB();
            $query = "UPDATE orders
                SET total_price = (SELECT SUM(price) FROM orders_products WHERE orders_products.order_id = orders.id AND 
                orders.deliver_status=0 AND orders.user_id=".$this->user_id.")";
            $result = mysqli_query($conn, $query);

            return mysqli_affected_rows($conn);
        }

        
    }

?>