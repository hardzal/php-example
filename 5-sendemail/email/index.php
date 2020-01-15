<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once "./src/PHPMailer.php";
require_once "./src/Exception.php";
require_once "./src/SMTP.php";

$mail = new PHPMailer(true);

$mail->Host = "smtp.gmail.com";
$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Username = "langkahkita01@gmail.com";
$mail->Password = "qwerty1070";

$mail->SMTPSecure = "ssl"; // or we can use TLS
$mail->Port = 465; // or 587 if TLS
// $mail->SMTPDebug = 2;

$mail->isHTML(true);
$mail->Subject = "Test send email";
$mail->Body = "This is our body email...";

$mail->addAttachment("attachment/1-grandblue.jpg", "1-grandblue.jpg");
$mail->setFrom('langkahkita01@gmail.com', 'M Rizal');
$mail->addAddress('rizaldoeta98@gmail.com');

if ($mail->send()) {
    echo "mail is sent";
} else {
    echo $mail->ErrorInfo;
}
