<?php
    require_once __DIR__."/../../../config/helper.php";
    sessionStart(); 
    session_destroy();
    header("Location: login.php");
?>