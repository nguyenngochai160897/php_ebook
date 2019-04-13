<?php
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    ini_set('SMTP', "server.com");
    ini_set('smtp_port', "465");
    $from = "nguyenngochai160897@gmail.com";
    $to = "cacloaihoadai@gmail.com";
    $subject = "Checking PHP mail";
    $message = "PHP mail works just fine";
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);
    echo "The email message was sent.";
?>