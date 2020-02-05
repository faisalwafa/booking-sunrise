<?php
include_once '../../helper/connection.php';

$location_from = $_POST["location_from"];
$location_to = $_POST["location_to"];
$schedule = $_POST["schedule"];
$price = $_POST["price"];
$price_member = $_POST["price_member"];
$details = $_POST["details"];
$color = $_POST["color"];

$query = "INSERT INTO wpzu_trav_city ( location_from, location_to, schedule, price, price_member, details, color ) 
VALUES ( '$location_from', '$location_to', '$schedule', $price, $price_member, '$details', '$color' )";

if (mysqli_query($con, $query)) {
    header("Location:../admin/admin_city_travel.php");
} else {
    $error = urldecode("<div class='alert alert-danger' role='alert'>Edit Schedule Gagal</div>");
    header("Location:../admin/admin_city_travel.php?error=$error");
}

mysqli_close($con);
