<?php

include_once '../../helper/connection.php';

$id_schedule = $_GET['schedule'];
$travel = $_GET['travel'];

$sql = "DELETE FROM wpzu_trav_city_schedule WHERE id = $id_schedule";

if (mysqli_query($con, $sql)) {
    header("Location:../admin/admin_city_travel_detail.php?travel=$travel");
} else {
    $error = urldecode("<div class='alert alert-danger' role='alert'>Hapus Travel Schedule Gagal</div>");
    header("Location:../admin/admin_city_travel_detail.php?error=$error");
}

mysqli_close($con);
