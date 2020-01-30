<?php
include_once '../../helper/connection.php';

function spamcheck($field)
{
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);

    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function sendMail($toEmail, $subject, $message, $fromEmail)
{
    $validFromEmail = spamcheck($fromEmail);
    if ($validFromEmail) {
        $headers = "From: $fromEmail\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        mail($toEmail, $subject, $message, $headers);
    }
}

$email = isset($_POST['forgot-password-email']) ? $_POST['forgot-password-email'] : false;

if ($email != false) {
    $sql_user_email = "SELECT user_email FROM wpzu_users WHERE user_email = '$email'";
    $results = mysqli_query($con, $sql_user_email);
    if (mysqli_num_rows($results) === 0) {
        header("Location: forgot_password.php?pesan=Email tidak dapat ditemukan");
    } else {
        $yourEmail = "no-reply@sunrise-indonesia.com";
        $subject = "Lupa Password";

        $message = '<html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Forgot Password | Sunrise Indonesia</title>
        </head>
        
        <body style="background: #f3f3f3; font-family:Arial, Helvetica, sans-serif;">
            <div style="margin: 0 auto; width:30%">
                <img style="margin: 20px 0px;  display: block;
          margin-left: auto;
          margin-right: auto;" src="http://booking.sunrise-indonesia.com/assets/logo-pwa.png" alt="logo" width="120">
                <div style="background: white; padding: 15px 30px 20px 30px;">
                    <p style="font-size: 0.9rem; text-align:center">Klik Button dibawah <br> Untuk Mendapatkan Link Ganti Password</p>
                    <hr>
                    <a style="text-decoration: none;" href="http://booking.sunrise-indonesia.com/pages/auth/forgot_password.php?u=' . $email . '">
                        <h4 style="padding: 20px 15px; background-color: #FFA500; color: #fff; text-align:center;">Lupa Password</h4>
                    </a>
                </div>
                <p style="margin-top: 20px; text-align:center;">
                    <small>
                        Copyright © 2020 Sunrise Indonesia
                        All rights reserved.
                    </small>
                </p>
            </div>
        </body>
        
        </html>';

        sendMail($email, $subject, $message, $yourEmail);
        header("Location: forgot_password.php?u=sent");
    }
}

mysqli_close($con);

// <?php
// include_once '../../helper/connection.php';

// function spamcheck($field)
// {
//     $field = filter_var($field, FILTER_SANITIZE_EMAIL);

//     if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
//         return true;
//     } else {
//         return false;
//     }
// }

// function sendMail($toEmail, $fromEmail, $subject, $message)
// {
//     $validFromEmail = spamcheck($fromEmail);
//     if ($validFromEmail) {
//         mail($toEmail, $subject, $message, "From: $fromEmail");
//     }
// }

// $email = isset($_POST['forgot-password-email']) ? $_POST['forgot-password-email'] : false;

// if ($email != false) {
//     $sql_user_email = "SELECT user_email FROM wpzu_users WHERE user_email = '$email'";
//     $results = mysqli_query($con, $sql_user_email);
//     if (mysqli_num_rows($results) === 0) {
//         header("Location: forgot_password.php?pesan=Email tidak dapat ditemukan");
//     } else {
//         $yourEmail = "no-reply@sunrise-indonesia.com";
//         $subject = "Lupa Password";
//         $message = "Klik link ini untuk mengubah password anda: http://booking.sunrise-indonesia.com/pages/auth/forgot_password.php?u=$email";
//         sendMail($email, $yourEmail, $subject, $message);
//         header("Location: forgot_password.php?u=sent");
//     }
// }

// mysqli_close($con);
