<?php
	require_once("PHPMailer/class.phpmailer.php");
	require_once("PHPMailer/class.smtp.php");
	require_once("PHPMailer/language/phpmailer.lang-es.php");

	$to_name = "";
	$to = "";
	$subject = "comp424-test";
	$message = "verify your email here";
	$message = wordwrap($message,70);
	$from_name = "CSUN COMP424";
	$from = "noreply.comp424@gmail.com";
	
	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->Username ="noreply.comp424@gmail.com";
	$mail->Password ="roryrxacwllcybjz";
	$mail->FromName = $from_name;
	$mail->From=$from;
	$mail->AddAddress($to, $to_name);
	$mail->Subject=$subject;
	$mail->Body=$message;

	$result=$mail->Send();
	echo $result ? 'Sent' : 'Error';

//	mail($to, $subject, $message, $headers);
?>
