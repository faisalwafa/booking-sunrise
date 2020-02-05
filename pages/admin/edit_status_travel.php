<?php
include_once '../../helper/connection.php';

$booking_id = $_POST['booking_id'];
$status = $_POST['status'];

$sql = "UPDATE wpzu_trav_city_bookings SET status = $status WHERE id = $booking_id";

if (mysqli_query($con, $sql)) {
    header("Location:./admin_booking_travel.php");
} else {
    $error = urldecode("<div class='alert alert-danger' role='alert'>Edit Status Gagal</div>");
    header("Location:./admin_booking_travel.php?error=$error");
}

mysqli_close($con);
