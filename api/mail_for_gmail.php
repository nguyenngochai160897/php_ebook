<?php 
	require_once 'PHPMailer/PHPMailerAutoload.php';
	 $method = $_SERVER['REQUEST_METHOD'];
	if($method == "POST")
	{
	  //#1
	  $to_id = $_POST['email'];
	  $message = "Cam on quy khach da mua hang";
	  $subject = "Cam on quy khach da mua hang";

	  //#2
	  $mail = new PHPMailer;
	  $mail->isSMTP();
	  $mail->SMTPDebug = 2;
	  $mail->Host = 'smtp.gmail.com';
	  $mail->Port = 587;
	  $mail->SMTPSecure = 'tls';
	  $mail->SMTPAuth = true;
	  $mail->Username = 'tunado1997@gmail.com';
	  $mail->Password = 'ttuqxmkvhfhexnya';
	  $mail->FromName = "book shop!";

	  //#3
	  $mail->addAddress($to_id);
	  $mail->Subject = $subject;
	  $mail->msgHTML($message);

	  //#4
	  if (!$mail->send()) {
	    echo json_encode(array(
                "message" => "khong gui duoc",
                "status" => "fail"
           ));
	    return;
	  }
	  else {
	    echo json_encode(array(
                "message" => "gui thanh cong",
                "status" => "success"
           ));
	    return;
	  }
	}
	else{
	     echo json_encode(array(
                "message" => "khong gui duoc",
                "status" => "fail"
           ));
	    return;
	}
 ?>