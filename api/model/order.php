<?php
    require_once __DIR__."/object.php";
    class Order extends Objects{
        public $user_id, $order_date, $deliver_status, $total_price;
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
            // $father_table = "users";
            $query = "SELECT orders.* FROM orders JOIN users on orders.user_id = users.id ".
                    "WHERE users.id =".$this->user_id;
            $result = mysqli_query($this->conn, $query);
            $arr = array();
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    array_push($arr, $row);
                }
            }
            return $arr;
        }

        function create(){
            $query = "INSERT INTO ".$this->table.
                    " SET ". 
                    "user_id = '".$this->user_id."', ".
                    "deliver_status = '".$this->deliver_status."', ".
                    "total_price = '".$this->total_price."'";
            $result = mysqli_query($this->conn, $query);
            $order_id = mysqli_insert_id($this->conn);
            return $order_id;
        }

        //just update deliver_status and total_price
        function update(){
            $query = "UPDATE ".$this->table.
                    " SET ". 
                    "user_id = '".$this->user_id."', ".
                    "deliver_status = '".$this->deliver_status."', ".
                    "total_price = '".$this->total_price."'".
                    " WHERE id = ".$this->id;
            $result = mysqli_query($this->conn, $query);

            return mysqli_affected_rows($this->conn);
        }

        function updateTotalPrice(){
            $query = "UPDATE orders
                SET total_price = (SELECT SUM(price) FROM orders_products WHERE orders_products.order_id = orders.id)";
            $result = mysqli_query($this->conn, $query);
            return mysqli_affected_rows($this->conn);
        }

        
    }

?>