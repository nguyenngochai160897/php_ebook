<?php
    require_once __DIR__."/object.php";
    class User extends Objects{
        public $email, $password, $phone, $last_name, $first_name, $ship_address, $account_type;
        public $table = "users";

        //use for signup
        function create(){
           $query = "INSERT INTO ".$this->table. " SET email = '".$this->email."', ".
                                                "password = '".password_hash($this->password, PASSWORD_DEFAULT)."', ".
                                                "first_name = N'".$this->first_name."', ".
                                                "last_name = N'".$this->last_name."', ".
                                                "account_type = '".$this->account_type."' ";
            $row = mysqli_query($this->conn, $query);
        }

        function update(){

        }

        function verifyPassword(){
            $query = "SELECT * FROM ".$this->table. " WHERE id = ".$this->id;
            $result = mysqli_query($this->conn, $query);
            $row = mysqli_fetch_assoc($result);
            return password_verify($this->password, $row['password']);
        }

        function changePassword(){
            $query = "UPDATE ".$this->table." SET password = '".password_hash($this->password, PASSWORD_DEFAULT)."' ".
                                            "WHERE id = ".$this->id;
            $result = mysqli_query($this->conn, $query);
            return mysqli_affected_rows($this->conn);
        }

        function shipment(){
            $query = "UPDATE ".$this->table." SET ".
                                            "first_name = N'".$this->first_name."', ".
                                            "last_name = N'".$this->last_name."', ".
                                            "ship_address = N'".$this->ship_address."', ".
                                            "phone = '".$this->phone."', ".
                                            "WHERE id = ".$this->id;
            $result = mysqli_query($this->conn, $query);
            return mysqli_affected_rows($this->conn);
        }

        function login(){
            $query = "SELECT * FROM ".$this->table." WHERE email = '".$this->email."'";
            $result = mysqli_query($this->conn, $query);
            
            if(mysqli_num_rows($result) == 0){
                return json_encode(array(
                    "status" => "fail",
                    "message" => "The email did not exist"
                ));
            }
            else{
                $row = mysqli_fetch_assoc($result);
                if(!password_verify($this->password, $row['password'])){
                    return json_encode(array(
                        "message" => "wrong the password",
                        "status" => "fail"
                    ));
                }
                //success .. pass
                // return json_encode(
                //     array("status" => "success", "message" => "login success")
                // );
                return $row;
            }
        }

    }

?>