<?php
include_once '../../helper/connection.php';

$booking_id = $_POST['booking_id'];
$status = $_POST['status'];

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
        $headers .= "CC: info@sunrise-indonesia.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        mail($toEmail, $subject, $message, $headers);
    }
}

$sql = "UPDATE wpzu_trav_city_bookings SET status = $status WHERE id = $booking_id";

if (mysqli_query($con, $sql)) {

    if ($status == 2) {
        $sql_select_booking = "SELECT email, first_name, last_name, booking_no FROM wpzu_trav_city_bookings WHERE id = $booking_id";
        $row_select_booking = mysqli_fetch_assoc(mysqli_query($con, $sql_select_booking));

        $email = $row_select_booking['email'];
        $first_name = $row_select_booking['first_name'];
        $last_name = $row_select_booking['last_name'];
        $bookingCode = $row_select_booking['booking_no'];

        $yourEmail = "booking@sunrise-indonesia.com";
        $subject = "Konfirmasi Booking Travel - Sunrise Indonesia ";

        $message = '
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Booking | Sunrise Indonesia</title>
            <style>
                .wrapper {
                    margin: 0 auto;
                    width: 40%;
                }
        
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
        
                .text-center {
                    text-align: center;
                }
        
                .text-blue {
                    color: #5EA0C7;
                }
        
                @media only screen and (max-width: 600px) {
                    .wrapper {
                        width: 90%;
                    }
        
                    .overflow {
                        overflow-x: auto;
                    }
                }
            </style>
        </head>
        
        <body style="background: #f3f3f3; font-family:Arial, Helvetica, sans-serif;">
            <div class="wrapper">
                <img style="margin: 20px 0px;  display: block;
                                margin-left: auto;
                                margin-right: auto;" src="http://booking.sunrise-indonesia.com/assets/logo-pwa.png" alt="logo" width="120">
                <div style="background: white; padding: 15px 30px 20px 30px;">
                    <h3>Konfirmasi Booking Travel</h3>
                    <h4>Terima Kasih telah melakukan konfirmasi booking</h4>
                    <hr>
                    <br>
                    <div class="overflow">
                        <table id="booking">
                            <tr>
                                <th width="40%">Booking Number:</th>
                                <td>' . $bookingCode . '</td>
                            </tr>
                            <tr>
                                <th width="40%">Name:</th>
                                <td>' . $first_name . ' ' . $last_name . '</td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <a href="http://booking.sunrise-indonesia.com/pages/booking_travel_confirm/booking_travel_confirm.php=' . $bookingCode . '" style="font-size:0.8rem; text-decoration:none; color:white; padding:10px 15px; background-color:#FFA500; border-radius:10%; margin-bottom: 10px">Travel Order Detail</a>
                    <br>
                    <br>
                    <hr>
                </div>
                <p style="margin-top: 20px; text-align:center;">
                    <small>
                        Copyright © 2020 Sunrise Indonesia
                        All rights reserved.
                    </small>
                </p>
            </div>
        </body>
        
        </html>
        ';

        sendMail($email, $subject, $message, $yourEmail);
    }

    header("Location:./admin_booking_travel.php");
} else {
    $error = urldecode("<div class='alert alert-danger' role='alert'>Edit Status Gagal</div>");
    header("Location:./admin_booking_travel.php?error=$error");
}

mysqli_close($con);
