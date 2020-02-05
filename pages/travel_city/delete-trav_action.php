<?php

include_once '../../helper/connection.php';

$travel = $_GET['travel'];

$sql = "DELETE FROM wpzu_trav_city WHERE id = $travel";

if (mysqli_query($con, $sql)) {
    header("Location:../admin/admin_city_travel.php?travel=$travel");
} else {
    $error = urldecode("<div class='alert alert-danger' role='alert'>Hapus Travel Gagal</div>");
    header("Location:../admin/admin_city_travel.php?error=$error");
}

mysqli_close($con);
