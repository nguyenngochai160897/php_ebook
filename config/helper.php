<?php
    function isEmail($email){
        if(!preg_match("/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i",$email)){
            return false;
        }
        return true;
    }

    function isEmpty($arr){
        foreach($arr as $a){
            if(!isset($a) || trim($a)=="") return true;
        }
        return false;
    }

   
?>