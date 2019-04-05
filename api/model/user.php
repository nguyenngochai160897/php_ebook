<?php
    require_once __DIR__."/object.php";
    require_once __DIR__."/db.php";
    class User{
        public $email, $password, $phone, $last_name, $first_name, $ship_address, $account_type, $id;
        public $table = "users";

        function gets(){
            $conn = connectDB();
            $query = sprintf("SELECT * FROM ".$this->table);
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

        //use for signup
        function create(){
            $conn = connectDB();
            $query = "INSERT INTO ".$this->table. " SET email = '".$this->email."', ".
                                                "password = '".password_hash($this->password, PASSWORD_DEFAULT)."', ".
                                                "first_name = N'".$this->first_name."', ".
                                                "last_name = N'".$this->last_name."', ".
                                                "account_type = '".$this->account_type."' ";
            $row = mysqli_query($conn, $query);
            mysqli_close($conn);
        }

        function update(){

        }

        function verifyPassword(){
            $conn = connectDB();
            $query = "SELECT * FROM ".$this->table. " WHERE id = ".$this->id;
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            mysqli_close($conn);
            return password_verify($this->password, $row['password']);
        }

        function changePassword(){
            $conn = connectDB();
            $query = "UPDATE ".$this->table." SET password = '".password_hash($this->password, PASSWORD_DEFAULT)."' ".
                                            "WHERE id = ".$this->id;
            $result = mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);
        }

        function shipment(){
            $conn = connectDB();
            $query = "UPDATE ".$this->table." SET ".
                                            "first_name = N'".$this->first_name."', ".
                                            "last_name = N'".$this->last_name."', ".
                                            "ship_address = N'".$this->ship_address."', ".
                                            "phone = '".$this->phone."', ".
                                            "WHERE id = ".$this->id;
            $result = mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);
        }

        function login(){
            $conn = connectDB();
            $query = "SELECT * FROM ".$this->table." WHERE email = '".$this->email."'";
            $result = mysqli_query($conn, $query);
            
            if(mysqli_num_rows($result) == 0){
                return (array(
                    "status" => "fail",
                    "message" => "The email did not exist"
                ));
            }
            else{
                $row = mysqli_fetch_assoc($result);
                if(!password_verify($this->password, $row['password'])){
                    return (array(
                        "message" => "wrong the password",
                        "status" => "fail"
                    ));
                }
                //success .. pass
              
                mysqli_close($conn);
                return $row;
            }
        }

    }

?>