<?php
    require_once __DIR__."/object.php";
    class Customer extends Objects{
        public $email, $password, $name, $phone;
        public $table = "customers";

       

        function create(){
           $query = "INSERT INTO ".$this->table. " SET email = N'".$this->email."', ".
                                                    "password = N'".password_hash($this->password, PASSWORD_DEFAULT)."', ".
                                                    "name = N'".$this->name."', ".
                                                    "phone = N'".$this->phone."'";
            $row = mysqli_query($this->conn, $query);
            return json_encode(array(
                "status" => "success",
                "data" => $row
            ));
        }

        function update(){

        }


    }

?>