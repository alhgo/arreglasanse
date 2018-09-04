<?php


require_once('includes/toolkit.php');

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
	$mail->SMTPDebug = false;
	$mail->do_debug = 0;
    /*
	$mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'user@example.com';                 // SMTP username
    $mail->Password = 'secret';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
	*/
    //Recipients
    $mail->setFrom('correo@laultimapregunta.com', 'Mailer');
    $mail->addAddress('jalvaro@laultimapregunta.com', 'Álvaro');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('alvaro@laultimapregunta.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

	/*
    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	*/
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    @$mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	$error_msg = 'Se ha producido un error al enviar el correo al usuario temporal (ID: ' . $id . '). Código de error: ' . $mail->ErrorInfo;
	log::putErrorLog($error_msg);
	echo $error_msg;
}


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Probar correo</title>
</head>

<body>
</body>
</html>