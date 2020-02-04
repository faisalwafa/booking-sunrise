<?php

include_once '../../helper/connection.php';

$travel = $_POST['travel_id'];
$available_time = $_POST['availableTime'];

$query = "INSERT INTO wpzu_trav_city_schedule (id_travel, available_time) VALUES ($travel , '$available_time')";

if (mysqli_query($con, $query)) {
    header("Location:../admin/admin_city_travel_detail.php?travel=$travel");
} else {
    $error = urldecode("<div class='alert alert-danger' role='alert'>Add Travel Schedule Gagal</div>");
    header("Location:../admin/admin_city_travel_detail.php?error=$error");
}

mysqli_close($con);
