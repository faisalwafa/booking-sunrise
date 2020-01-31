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
        $headers .= "CC: booking@sunrise-indonesia.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        mail($toEmail, $subject, $message, $headers);
    }
}

$booking_no = isset($_POST['booking']) ? $_POST['booking'] : false;

if ($booking_no != false) {
    $sql_booking = "SELECT w.first_name, w.last_name, w.id, p.post_title, w.tour_date, w.created, w.total_price, w.status, w.adults, w.user_id, w.email, w.phone, booking_no FROM wpzu_trav_tour_bookings AS w INNER JOIN wpzu_posts AS p ON w.tour_id = p.ID WHERE booking_no = $booking_no";
    $results_booking = mysqli_query($con, $sql_user_email);
    if (mysqli_num_rows($results) === 0) {
        header("Location: forgot_password.php?pesan=Email tidak dapat ditemukan");
    } else {
        $row_booking = mysqli_fetch_assoc($results_booking);
        $email = $row_booking['email'];
        $yourEmail = "booking@sunrise-indonesia.com";
        $subject = "Lupa Password";

        $message = '<html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Booking | Sunrise Indonesia</title>
            <style>
                #booking {
                    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                    border-collapse: collapse;
                    width: 100%;
                }
        
                #booking td,
                #booking th {
                    border: 1px solid #ddd;
                    padding: 8px;
                }
        
                #booking tr:hover {
                    background-color: #ddd;
                }
        
                #booking th {
                    padding-top: 12px;
                    padding-bottom: 12px;
                    text-align: left;
                    background-color: white;
                    color: #FFA500;
                }
            </style>
        </head>
        
        <body style="background: #f3f3f3; font-family:Arial, Helvetica, sans-serif;">
            <div style="margin: 0 auto; width:30%">
                <img style="margin: 20px 0px;  display: block;
                  margin-left: auto;
                  margin-right: auto;" src="http://booking.sunrise-indonesia.com/assets/logo-pwa.png" alt="logo" width="120">
                <div style="background: white; padding: 15px 30px 20px 30px;">
                    <h3>Informasi Pemesanan</h3>
                    <a href="http://booking.sunrise-indonesia.com/pages/booking_confirm/booking_confirm.php?booking_confirm=' . $row_booking['booking_no'] . '" style="font-size:0.8rem; text-decoration:none; color:white; padding:10px 15px; background-color:#FFA500; border-radius:10%; margin-bottom: 10px">Detil Pesanan</a>
                    <br>
                    <br>
                    <hr>
                    <table id="booking">
                        <tr>
                            <th width="40%">Booking ID:</th>
                            <td>' . $row_booking['booking_no'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Nama:</th>
                            <td>' . $row_booking['first_name'] . ' ' . $row_booking['last_name'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Tour:</th>
                            <td>' . $row_booking['post_title'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Tanggal Tour:</th>
                            <td>' . $row_booking['tour_date'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Jumlah PAX:</th>
                            <td>' . $row_booking['adults'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Tanggal Pemesanan:</th>
                            <td>' . $row_booking['created'] . '</td>
                        </tr>
                    </table>
                    <hr>
                    <small><strong>*Terima Kasih, Order telah berhasil diproses, Tim CS akan segera menghubungi anda</strong></small>
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
