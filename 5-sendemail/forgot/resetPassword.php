<?php

require 'functions.php';

if (isset($_GET['email']) && isset($_GET['token'])) {
    $conn = new mysqli("localhost", "root", "", "latihan_user_forgot");

    $email = $conn->real_escape_string($_GET['email']);
    $token = $conn->real_escape_string($_GET['token']);

    $sql = $conn->query("SELECT id FROM users WHERE email='$email' AND token='$token' AND token<>'' AND tokenExpire > now()");

    if ($sql->num_rows > 0) {
        $newPassword = generateToken();
        $newPasswordEncrypted = password_hash($newPassword, PASSWORD_BCRYPT);

        $conn->query("UPDATE users SET password = '$newPassword', token = '' WHERE email='$email'");

        echo "Your new password is $newPassword<br><a href='login.php'>Click here to login</a>";
    } else {
        redirectToPage();
    }
} else {
    redirectToPage();
}
