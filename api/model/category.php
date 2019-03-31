<?php
    require_once __DIR__."/object.php";
    
    class Category extends Objects{
        public $name;
        public $table = "categories";

        public function __construct(){
            parent::__construct();
        }

        function get(){
            $query = "SELECT categories.* FROM categories WHERE categories.id =".$this->id;
            $result = mysqli_query($this->conn, $query);
            $arr = array();
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    array_push($arr, $row);
                }
            }
            return ($arr);
        }

        public function create(){
            $query = "INSERT INTO ".$this->table.
                    " SET ". "name = N'" .$this->name."'";
            $result = mysqli_query($this->conn, $query);
        }

        function update(){
            $query = "UPDATE ".$this->table.
                    " SET "."name = N'".$this->name."'".
                    " WHERE "."id = ".$this->id;
            $result = mysqli_query($this->conn, $query);
            return mysqli_affected_rows($this->conn);
        }
    }

    

?>