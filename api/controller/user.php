<?php
    require_once __DIR__."/../model/user.php";

    class UserCtr{
        function login($user){
            $data = $user->login();
            if(isset($data['status']) && $data['status'] == "fail"){
                return $user->login();
            }
            else{
                // establish session
                sessionStart();
                setUpSession($data['account_type'], $data['id']);
                return json_encode(array(
                    "message" => "login success",
                    "status" => "success"
                ));
            }
        }

        function signup($user){
            //check email exist
            $data = $user->gets();
            foreach($data as $d) {
                if($d['email'] == $user->email){
                    return json_encode(array(
                        "message" =>"email had already exist",
                        "status" => "fail"
                    ));
                }
            }

            //check validate email
            $email = ($user->email);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return json_encode(array(
                    "message" =>"invalid email format",
                    "status" => "fail"
                )); 
            }
            
            //success
            $user->create();
            return json_encode(array(
                "status" =>"sucess"
            ));
        }

        function verifyPassword($user) {
            if(!$user->verifyPassword()){
                return json_encode(
                    array("status" => "fail", "message" => "wrong the password") 
                );
            }
            return json_encode(array("status" => "success"));
        }

        function changePassword($user){
            $data = $user->changePassword();
            if($data<1){
                return json_encode(array(
                    "status" => "fail",
                    "message" => "id has not already exist"
                ));
            }
            else{
                return json_encode(
                    array("status" => "success", "message" => "update success")
                );
            }
        }

        function shipment($user){
            return $user->shipment();
        }
    }

        
?>