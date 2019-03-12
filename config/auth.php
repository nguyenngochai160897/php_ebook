<?php
    $secret = "secret";
    if(!isset($_COOKIE['login'])){
        return json_encode(array(
            "status" => "fail",
            "message" => "not authorization"
        ));
    }
    function generate(){
        setcookie("login", $_REQUEST['email'].";".md5($_REQUEST['email'].$secret));
    }

    function check(){
        if(isset($_COOKIE['login'])){
            list($c_email, $cookie_hash)= split(";", $_COOKIE['login']);
            if(md5($c_email.$secret) == $cookie_hash){
                return true;
            }
        }
        return false;
    }
?>