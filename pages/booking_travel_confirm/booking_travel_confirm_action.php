<?php
include_once '../../helper/connection.php';

$id_booking =  $_POST['id_booking'];

$sql_check_status = "SELECT status FROM wpzu_trav_city_bookings WHERE id = $id_booking";
$results_check_status = mysqli_query($con, $sql_check_status);
$row_check_status = mysqli_fetch_assoc($results_check_status);

if ($row_check_status['status'] == 1 || $row_check_status['status'] == 0) {
    if (mysqli_query($con, "UPDATE wpzu_trav_city_bookings SET status = 0 WHERE id = $id_booking")) {
        header("Location: https://sunrise-indonesia.com/");
    } else {
        header("Location: booking_travel_confirm.php?booking_travel_confirm=$id_booking&message=Transaksi tidak dapat diCancel, untuk mencancel silahkan hubungi Customer Support");
    }
} else {
    header("Location: booking_travel_confirm.php?booking_travel_confirm=$id_booking&message=Transaksi sudah dikonfirmasi, untuk mencancel silahkan hubungi Customer Support");
}
