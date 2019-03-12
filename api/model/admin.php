<?php
    class Admin{
        public $id, $email, $password, $name;
        public $conn, $table = "admin"; 
        
        public function __construct($db){
            $this->conn = $db;
        }

        public function getAdmin(){
            $query = "SELECT * FROM ".$this->table." WHERE email='".$this->email."' LIMIT 0, 1";
            $result = mysqli_query($this->conn, $query);
            if(mysqli_num_rows($result)>0){
                $row =  mysqli_fetch_assoc($result);
                    if(password_verify($this->password,$row['password'])){
                        return json_encode(array(
                            "record"=>array(
                                "id"=>$row["id"],
                                "email"=>$row["email"],
                                "password"=>$row["password"],
                                "name" => $row['name']
                            ),
                            "status" => "success",
                        ));
                    }
                    else{
                        return json_encode( array( "status" => "fail", "message" => "wrong password"));
                    }
            }
            else{
                return json_encode( array("status" => "fail", "message" => "wrong email"));
            }
        }

        public function createAdmin(){
            $query = "INSERT INTO ".$this->table." SET email = '".$this->email.
                                                "', password = '".password_hash($this->password, PASSWORD_BCRYPT).
                                                "', name = '".$this->name."'";
            $result = mysqli_query($this->conn, $query);
            if($result){
                return json_encode( array("status" => "success"));
            } 
            else{
                return json_encode( array("status" => "fail", "error" => mysqli_error($this->conn)));
            }                                   
        }

        public function checkEmail(){
            $query = "SELECT * FROM ".$this->table." WHERE email = '".$this->email."' LIMIT 0, 1";
            $result = mysqli_query($this->conn, $query);
            $row = mysqli_num_rows($result);
            if($row > 0){
                return true;
            }
            else return false;
        }
    }
    
?>