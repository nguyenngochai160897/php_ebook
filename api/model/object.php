<?php
    abstract class Objects{
        public $conn;
        protected $table;
        public $id;

        //connect db
        function __construct(){
            require_once __DIR__."/../../config/database.php";
            $db = new DB;
            $this->conn = $db->conn;
        }

        //take all objects
        function gets(){
            $query = sprintf("SELECT * FROM ".$this->table);
            $result = mysqli_query($this->conn, $query);
            $arr = array();
            $arr['record'] = array();
            while($row = mysqli_fetch_assoc($result)){
                array_push($arr['record'], $row);
            }
            // header("Content-Type: application/json; charset=UTF-8");
            // var_dump($arr);
            // return json_encode(array("status" => "success", "record"=>$arr['record']));
            // echo json_encode($arr, JSON_UNESCAPED_UNICODE);
            return json_encode($arr);
        }

        //take a object 
        function get(){
            $query = "SELECT * FROM ".$this->table." WHERE id=".$this->id." LIMIT 0,1";
            $result = mysqli_query($this->conn, $query);
            $arr = array();
            $row = mysqli_fetch_assoc($result);
            array_push($arr, $row);
            return (json_encode(array("status" => "success", "record"=>$arr)));
        }

        //add a new object
        abstract function create();

        //update a object 
        abstract function update();

        //delete a object 
        function delete(){
            $query = "DELETE FROM ".$this->table." WHERE id = ".$this->id;
            $result = mysqli_query($this->conn, $query);
            return json_encode(array("status" => "success", "affected_rows" => mysqli_affected_rows($this->conn)));
        }

    }


    
?>