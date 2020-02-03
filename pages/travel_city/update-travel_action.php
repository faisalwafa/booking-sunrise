<?php

include_once '../../helper/connection.php';

$travel = $_POST['travel_id'];

$details = $_POST["details"];

$query = "UPDATE wpzu_trav_city SET details = '$details' WHERE id = $travel";


if (mysqli_query($con, $query)) {
    header("Location:../admin/admin_city_travel_detail.php?travel=$travel");
} else {
    $error = urldecode("<div class='alert alert-danger' role='alert'>Edit Inter-City Travel Gagal</div>");
    header("Location:../admin/admin_city_travel_detail.php?error=$error");
}

mysqli_close($con);
