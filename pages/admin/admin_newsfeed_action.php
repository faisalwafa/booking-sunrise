<?php

$newsfeed_CC = $_POST["newsfeed_CC"];
$newsfeed_subject = $_POST["newsfeed_subject"];
$newsfeed_body = $_POST['newsfeed_body'];

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

function sendMail($toEmail, $subject, $message, $fromEmail, $CC)
{
    $validFromEmail = spamcheck($fromEmail);
    if ($validFromEmail) {
        $headers = "From: $fromEmail\r\n";
        if (empty($CC)) {
            $headers .= "CC: no-reply@sunrise-indonesia.com\r\n";
        } else {
            $headers .= "CC: $CC\r\n";
        }
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        mail($toEmail, $subject, $message, $headers);
    }
}

if (!empty($newsfeed_subject) && !empty($newsfeed_body)) {
    $sql_user_emails = "SELECT user_email FROM wpzu_users";
    $results_user_emails = mysqli_query($con, $sql_user_emails);
    if (mysqli_num_rows($results_user_emails) === 0) {
        header("Location: admin_newsfeed.php?message=Email tidak dapat ditemukan");
    } else {
        $to = array();
        while ($row_user_emails = mysqli_fetch_assoc($results_user_emails)) {
            array_push($to, $row_user_emails['user_email']);
        }
        $email = implode(', ', $to);
        $yourEmail = "info@sunrise-indonesia.com";
        $subject = $newsfeed_subject;

        $message = '<html>

        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Newsfeed | Sunrise Indonesia</title>
        </head>
        
        <body>
            ' . $newsfeed_body . '
        </body>
        
        </html>';

        sendMail($email, $subject, $message, $yourEmail, $newsfeed_CC);
        header("Location: admin_newsfeed.php?message=Email sukses terkirim");
    }
} else {
    header("Location: admin_newsfeed.php?message=Subjek dan Body email harus terisi");
}

mysqli_close($con);
