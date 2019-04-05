<?php
    function connectDB(){
        $db = array(
            "DB_HOST" => 'localhost',
            "DB_USER" => 'root',
            "DB_PASSWORD" => "",
            "DB_NAME" => "e-book",
        );
        $conn = mysqli_connect( $db['DB_HOST'], $db['DB_USER'], $db['DB_PASSWORD'], $db['DB_NAME']);
        mysqli_set_charset($conn,"utf8");
        return $conn;
    }
?>