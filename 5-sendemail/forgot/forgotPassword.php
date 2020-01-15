<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';
require 'functions.php';

if (isset($_POST['email'])) {
    $conn = new mysqli("localhost", "root", "", "latihan_user_forgot");

    $email = $conn->real_escape_string($_POST['email']);

    $sql = $conn->query("SELECT id FROM users WHERE email = '$email'");
    if ($sql->num_rows > 0) {

        $token = generateToken();

        $conn->query("UPDATE users SET token = '$token', tokenExpire=DATE_ADD(NOW(), INTERVAL 10 MINUTE) WHERE email ='$email'");

        try {
            $mail = new PHPMailer(true);
            $mail->Host = "smtp.gmail.com";
            $mail->isSMTP();
            $mail->SMTPAuth = true;

            $mail->Username = "langkahkita01@gmail.com";
            $mail->Password = "qwerty1070";

            $mail->SMTPSecure = "ssl"; // or we can use TLS

            $mail->Port = 465; // or 587 if TLS

            $mail->Subject = "Reset Password";
            $mail->isHTML(true);
            $mail->Body = "
                  Hi, <br><br>
                  In order to reset your password, please click on the link below <a href='localhost/latihan/crud/forgot/resetPassword.php?email=$email&token=$token'>click here</a>
                 <br><br>
                  Thanks.
            ";

            $mail->setFrom("langkahkita01@gmail.com", "M Rizal");
            $mail->addAddress($email);

            if ($mail->send()) {
                exit(json_encode(
                    array(
                        'status' => 1,
                        'message' => 'Please check your email!'
                    )
                ));
            } else {
                exit(json_encode(
                    array(
                        'status' => 0,
                        'message' => 'Something wrong just happened!'
                    )
                ));
            }
        } catch (Exception $e) {
            exit(json_encode(
                array(
                    'status' => 0,
                    'message' => 'Message couldn\'t send!',
                    'error' => $e->getMessage()
                )
            ));
        }
        exit(json_encode(
            array(
                'status' => 1,
                'message' => "Successfully email"
            )
        ));
    } else {
        exit(json_encode(
            array(
                'status' => 0,
                'message' => "Please check your inputs!"
            )
        ));
    }
} else {
    redirectToPage();
}
