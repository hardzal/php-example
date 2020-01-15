<?php

function generateToken()
{
    $token = "qwertyuiopasdfghjklzxcvbnm0987654321";
    $token = str_shuffle($token);
    $token = substr($token, 0, 10);

    return $token;
}

function redirectToPage()
{
    header("Location: login.php");
    exit;
}
