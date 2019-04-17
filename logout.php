<?php 
    require_once __DIR__."/config/helper.php";
    require_once __DIR__."/config/base_url.php";
    sessionStart();
    unset($_SESSION['login']);
    unset($_SESSION['userId']);
    header('Location: '.base_url());
 ?>