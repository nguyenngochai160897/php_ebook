<?php
    require_once __DIR__."/object.php";
    require_once __DIR__."/db.php";
    class Category{
        public $name, $id;
        public $table = "categories";

        function gets(){
            $conn = connectDB();
            $query = "SELECT * FROM ".$this->table;
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

        function get(){
            $conn = connectDB();
            $query = "SELECT categories.* FROM categories WHERE categories.id =".$this->id;
            $result = mysqli_query($conn, $query);
            $arr = array();
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    array_push($arr, $row);
                }
            }
            mysqli_close($conn);
            return ($arr);
        }

        public function create(){
            $conn = connectDB();
            $query = "INSERT INTO ".$this->table.
                    " SET ". "name = N'" .$this->name."'";
            $result = mysqli_query($conn, $query);
            mysqli_close($conn);

        }

        function update(){
            $conn = connectDB();
            $query = "UPDATE ".$this->table.
                    " SET "."name = N'".$this->name."'".
                    " WHERE "."id = ".$this->id;
            $result = mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);
        }

        function delete(){
            $conn = connectDB();
            $query = "DELETE FROM ".$this->table." WHERE id=".$this->id;
            $result = mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);
        }
    }

    

?>