<?php

include_once '../../helper/connection.php';

$id_schedule = $_GET['schedule'];
$tour = $_GET['tour'];

$sql = "DELETE FROM wpzu_trav_tour_schedule WHERE `id` = $id_schedule";

if (mysqli_query($con, $sql)) {
    header("Location:../admin/admin_tour_detail.php?tour=$tour");
} else {
    $error = urldecode("<div class='alert alert-danger' role='alert'>Hapus Tour Gagal</div>");
    header("Location:../admin/admin_tour_detail.php?error=$error");
}

mysqli_close($con);
