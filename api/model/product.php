<?php
    require_once __DIR__."/object.php";

    class Product extends Objects{
        public $title, $publisher_name, $author_name, $publish_year, $category_id, $price, $picture,
            $num_existed, $description;
        public $table = "products";
        public $conn;

        public function __construct(){
            parent::__construct();
        }

        public function create(){
            $query = "INSERT INTO ".$this->table.
                    " SET ". "category_id = '" .$this->category_id."',".
                            " title = N'".$this->title."',".
                            " publisher_name = N'".$this->publisher_name."',".
                            " author_name = N'".$this->author_name."',".
                            " price = '".$this->price."',".
                            " picture = '".$this->picture."',".
                            " publish_year = '".$this->publish_year."',".
                            " description = '".$this->description."',".
                            " num_existed = '".$this->num_existed."'";
            $result = mysqli_query($this->conn, $query);
        }

        function update(){
            $query = "UPDATE ".$this->table.
                    " SET ". "category_id = '" .$this->category_id."',".
                    " title = N'".$this->title."',".
                    " publisher_name = N'".$this->publisher_name."',".
                    " author_name = N'".$this->author_name."',".
                    " price = '".$this->price."',".
                    " picture = '".$this->picture."',".
                    " publish_year = '".$this->publish_year."',".
                    " description = N'".$this->description."',".
                    " num_existed = '".$this->num_existed."'".
                    " WHERE "."id =".$this->id;
            $result = mysqli_query($this->conn, $query);
            return mysqli_affected_rows($this->conn);
        }

        function fetchAllByCategory(){
            $father_table = "categories";
           
            $query = "SELECT products.*, categories.name as category_name FROM ".$this->table.
                    " JOIN categories ON products.category_id = categories.id";
            $result = mysqli_query($this->conn, $query);
            $arr = array();
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    array_push($arr, $row);
                }
            }
            return $arr;
        }

        function fetchByCategory(){
            $father_table = "categories";
            $query = "SELECT products.*, categories.name as category_name FROM ".$this->table.
                    " JOIN categories ON products.category_id = categories.id ".
                    "WHERE products.id = ".$this->id;
            $result = mysqli_query($this->conn, $query);
            $arr = array();
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                array_push($arr, $row);
            }
            return $arr;
        }

    }

?>