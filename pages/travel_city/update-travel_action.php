<?php

include_once '../../helper/connection.php';

$travel = $_POST['travel_id'];

$location_from = $_POST['location_from'];
$location_to = $_POST['location_to'];
$schedule = $_POST['schedule'];
$price = $_POST['price'];
$member_price = $_POST['price_member'];
$details = $_POST['details'];
$color = $_POST['color'];

$query = "UPDATE wpzu_trav_city SET location_from = '$location_from', location_to = '$location_to', schedule = '$schedule', 
            price = $price, price_member = $member_price, details = '$details', color = '$color' WHERE id = $travel";


if (mysqli_query($con, $query)) {
    header("Location:../admin/admin_city_travel_detail.php?travel=$travel");
} else {
    $error = urldecode("<div class='alert alert-danger' role='alert'>Edit Inter-City Travel Gagal</div>");
    header("Location:../admin/admin_city_travel_detail.php?error=$error&travel=$travel");
}

mysqli_close($con);
