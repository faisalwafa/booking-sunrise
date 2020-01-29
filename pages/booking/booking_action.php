<?php
session_start();

include_once '../../helper/connection.php';
include_once '../../helper/response.php';

$response;

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
        $phone_number = $_POST['phoneNumber'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $zip_code = $_POST['zipCode'];
        $special_req = $_POST['specialReq'];
        $tour_id = $_POST['tour'];
        $st_id = $_POST['stId'];
        $tour_date = $_POST['tourDate'];
        $total_adults = $_POST['totalAdults'];
        $total_price = $_POST['totalPrice'];

        $post_title = $_POST['postTitle'];
        $location = $_POST['location'];
        $duration = $_POST['duration'];
        $price = $_POST['price'];

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
            '$city', '$zip_code', '$country_code',
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
            '$city', '$zip_code', '$country_code',
            '$special_req', $total_adults, 0,
            0, $total_price, 'idr',
            0, 0, 0, 0,
            $bookingCode, 1, now(), 0, 0           
        )";
        }

        if (mysqli_query($con, $sql_add_booking)) {
            $id_booking = mysqli_insert_id($con);
            $redirect = array('booking_confirm' => $id_booking);
            $response = send_response(SUCCESS, json_encode($redirect));
        } else {
            $redirect = array('tour' => $tour_id, 'st_id' => $st_id, 'post_title' => $post_title, 'location' => $location, 'duration' => $duration, 'price' => $price, 'dateTour' => $tour_date, 'totalAdults' => $total_adults, 'totalPrice' => $total_price, 'message' => 'Gagal membuat booking baru');
            $response = send_response(FAIL, json_encode($redirect));
        }
    }
}

mysqli_close($con);
echo $response;
