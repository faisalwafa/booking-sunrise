<?php
session_start();

include_once '../../helper/connection.php';
include_once '../../helper/response.php';

$response;

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function post_captcha($user_response)
    {
        $fields_string = '';
        $fields = array(
            'secret' => '6LcMA9MUAAAAAP3g6L2aMrK_eUp119BlcKgJ_N2j',
            'response' => $user_response
        );
        foreach ($fields as $key => $value)
            $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // Call the function post_captcha
    $res = post_captcha($_POST['gRecaptchaResponse']);


    $tour_id = $_POST['tour'];
    $st_id = $_POST['stId'];
    $tour_date = $_POST['tourDate'];
    $total_adults = $_POST['totalAdults'];
    $total_price = $_POST['totalPrice'];
    $post_title = $_POST['postTitle'];
    $location = $_POST['location'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];

    if (!$res['success']) {
        $redirect = array('tour' => $tour_id, 'st_id' => $st_id, 'post_title' => $post_title, 'location' => $location, 'duration' => $duration, 'price' => $price, 'dateTour' => $tour_date, 'totalAdults' => $total_adults, 'totalPrice' => $total_price, 'message' => 'Gagal membuat booking baru');
        $response = send_response(FAIL, json_encode($redirect));
    } else {
        function randomNumber()
        {
            $result = '';

            for ($i = 0; $i < rand(4, 6); $i++) {
                $result .= mt_rand(0, 9);
            }

            return $result;
        }

        $bookingCode = randomNumber();

        while (mysqli_num_rows(mysqli_query($con, "SELECT booking_no FROM wpzu_trav_tour_bookings WHERE booking_no = $bookingCode")) != 0) {
            $bookingCode = randomNumber();
        }

        $first_name = $_POST['firstName'];
        $last_name = $_POST['lastName'];
        $email = $_POST['email'];
        $confirm_email = $_POST['confirmEmail'];
        $country_code = $_POST['countryCode'];
        $country = $_POST['country'];
        $phone_number = $_POST['phoneNumber'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $zip_code = $_POST['zipCode'];
        $special_req = $_POST['specialReq'];

        $sql_add_booking;

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $sql_add_booking = "INSERT INTO wpzu_trav_tour_bookings (  tour_id , st_id , tour_date , first_name , last_name , email , country_code , phone , 
        address , city , zip , country , special_requirements , adults , kids , discount_rate , total_price , 
        currency_code , exchange_rate , deposit_price , deposit_paid , user_id , pin_code , booking_no , 
        status , created , updated, mail_sent ) VALUES (
            $tour_id, $st_id, '$tour_date',
            '$first_name', '$last_name', '$email',
            '$country_code', '$phone_number', '$address',
            '$city', '$zip_code', '$country',
            '$special_req', $total_adults, 0,
            0, $total_price, 'idr',
            0, 0, 0, $user_id, 0,
            $bookingCode, 1, now(), 0, 0           
        )";
        } else {
            $sql_add_booking = "INSERT INTO wpzu_trav_tour_bookings (  tour_id , st_id , tour_date , first_name , last_name , email , country_code , phone , 
        address , city , zip , country , special_requirements , adults , kids , discount_rate , total_price , 
        currency_code , exchange_rate , deposit_price , deposit_paid , pin_code , booking_no , 
        status , created , updated , mail_sent) VALUES (
            $tour_id, $st_id, '$tour_date',
            '$first_name', '$last_name', '$email',
            '$country_code', '$phone_number', '$address',
            '$city', '$zip_code', '$country',
            '$special_req', $total_adults, 0,
            0, $total_price, 'idr',
            0, 0, 0, 0,
            $bookingCode, 1, now(), 0, 0           
        )";
        }

        if (mysqli_query($con, $sql_add_booking)) {
            $redirect = array('booking_confirm' => $bookingCode);

            $yourEmail = "booking@sunrise-indonesia.com";
            $subject = "Booking Tour - Sunrise Indonesia ";

            $message = '<html>
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
                                <h3>Informasi Pemesanan</h3>
                                <a href="http://booking.sunrise-indonesia.com/pages/booking_confirm/booking_confirm.php?booking_confirm=' . $bookingCode . '" style="font-size:0.8rem; text-decoration:none; color:white; padding:10px 15px; background-color:#FFA500; border-radius:10%; margin-bottom: 10px">Tour Order Detail</a>
                                <br>
                                <br>
                                <hr>
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
                                        <tr>
                                            <th width="40%">Phone:</th>
                                            <td>' . $phone_number . '</td>
                                        </tr>
                                        <tr>
                                            <th width="40%">Tour Name:</th>
                                            <td>' . $post_title . '</td>
                                        </tr>
                                        <tr>
                                            <th width="40%">Tour Date:</th>
                                            <td>' . $tour_date . '</td>
                                        </tr>
                                        <tr>
                                            <th width="40%">PAX:</th>
                                            <td>' . $total_adults . '</td>
                                        </tr>
                                        <tr>
                                            <th width="40%">Booking Date:</th>
                                            <td>' . date("Y-m-d") . '</td>
                                        </tr>
                                        <tr>
                                            <th width="40%">Special Requirement:</th>
                                            <td>' . $special_req . '</td>
                                        </tr>
                                        <tr>
                                            <th width="40%">Total Price:</th>
                                            <td><b>' . $total_price . '</b></td>
                                        </tr>
                                    </table>
                                </div>
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
                    
                    </html';

            sendMail($email, $subject, $message, $yourEmail);

            $response = send_response(SUCCESS, json_encode($redirect));
        } else {
            $redirect = array('tour' => $tour_id, 'st_id' => $st_id, 'post_title' => $post_title, 'location' => $location, 'duration' => $duration, 'price' => $price, 'dateTour' => $tour_date, 'totalAdults' => $total_adults, 'totalPrice' => $total_price, 'message' => 'Gagal membuat booking tour baru');
            $response = send_response(FAIL, json_encode($redirect));
        }
    }
}

mysqli_close($con);
echo $response;
