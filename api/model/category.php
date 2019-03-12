<?php
    require_once __DIR__."/object.php";
    
    class Category extends Objects{
        public $name;
        public $table = "categories";

        public function __construct(){
            parent::__construct();
        }

        public function create(){
            $query = "INSERT INTO ".$this->table.
                    " SET ". "name = N'" .$this->name."'";
            $result = mysqli_query($this->conn, $query);
            if($result){
                return json_encode(array("status"=>"success"));
            }
        }

        function update(){
            $query = "UPDATE ".$this->table.
                    " SET "."name = N'".$this->name."'".
                    " WHERE "."id = ".$this->id;
            $result = mysqli_query($this->conn, $query);
            
            if($result){
                return json_encode(array("status" => "success", "affected_rows" => mysqli_affected_rows($this->conn)));
            }
        }
    }

    

?>