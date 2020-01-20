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

function sendMail($toEmail, $fromEmail, $subject, $message)
{
    $validFromEmail = spamcheck($fromEmail);
    if ($validFromEmail) {
        mail($toEmail, $subject, $message, "From: $fromEmail");
    }
}

$email = isset($_POST['forgot-password-email']) ? $_POST['forgot-password-email'] : false;

if ($email != false) {
    $sql_user_email = "SELECT user_email FROM wpzu_users WHERE user_email = '$email'";
    $results = mysqli_query($con, $sql_user_email);
    if (mysqli_num_rows($results) === 0) {
        header("Location: forgot_password.php?pesan=Email tidak dapat ditemukan");
    } else {
        $yourEmail = "booking@sunrise-indonesia.com";
        $subject = "Lupa Password";
        $message = "Klik link ini untuk mengubah password anda: http://booking.sunrise-indonesia.com/pages/auth/forgot_password.php?u=$email";
        $success = sendMail($email, $yourEmail, $subject, $message);
        header("Location: forgot_password.php?u=sent");
    }
}

mysqli_close($con);
