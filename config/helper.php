<?php
    function isEmail($email){
        if(!preg_match("/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i",$email)){
            return false;
        }
        return true;
    }

    function valid($arr){
        $err = array();
        foreach($arr as $a){
            if(!isset($a) || empty(trim($a))) {
                array_push($err, $a);
            }
        }
        return $err;
    }
    
    function setUpSession($account_type, $userId){
        session_start();
        $_SESSION['login'] = $account_type;
        $_SESSION['userId'] = $userId;
    }

    function checkSession(){
        if(isset($_SESSION['login']) && $_SESSION['login'] == "customer"){
            return "customer";
        }
        else if(isset($_SESSION['login']) && $_SESSION['login'] == "admin"){
            return "admin";
        }
        else{
            return false; // not authorization
        }
    }
   
?>