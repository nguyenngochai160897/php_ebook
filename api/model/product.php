<?php
    require("./object.php");
    class Product extends Objects{
        public $category_id, $name, $price, $image, $discount;
        public $table = "products";
        public $conn;

        public function __construct(){
            parent::__construct();
        }

        public function create(){
            $query = "INSERT INTO ".$this->table.
                    " SET ". "category_id = '" .$this->category_id."',".
                            " name = '".$this->name."',".
                            " price = '".$this->price."',".
                            " image = '".$this->image."',".
                            " discount = '".$this->discount."'";
            $result = mysqli_query($this->conn, $query);
            if($result){
                return json_encode(array("status"=>"success"));
            }
        }

        function update(){
            $query = "UPDATE ".$this->table.
                    " SET "."name = '".$this->name."'".
                    " WHERE "."id = ".$this->id;
            $result = mysqli_query($this->conn, $query);
            if($result){
                return json_encode(array("status"=>"success"));
            }
        }

    }
    $p = new Product();
    $p->id = 1;
    echo $p->get();
?>