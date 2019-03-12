<?php
    class DB{
        public $conn ;
        public function __construct(){
            $db = array(
                "DB_HOST" => 'localhost',
                "DB_USER" => 'root',
                "DB_PASSWORD" => "",
                "DB_NAME" => "project_php",
            );
            $this->conn = mysqli_connect( $db['DB_HOST'], $db['DB_USER'], $db['DB_PASSWORD'], $db['DB_NAME']);
            mysqli_set_charset($this->conn,"utf8");
            return $this->conn;
        }

        // public function connect(){
        //     $db = array(
        //         "DB_HOST" => 'localhost',
        //         "DB_USER" => 'root',
        //         "DB_PASSWORD" => "",
        //         "DB_NAME" => "project_php",
        //     );
        //     $conn = mysqli_connect( $db['DB_HOST'], $db['DB_USER'], $db['DB_PASSWORD'], $db['DB_NAME']);
        //     return $conn;
        // }
    }

    
?>