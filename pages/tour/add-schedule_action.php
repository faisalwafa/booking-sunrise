<?php

include_once '../../helper/connection.php';

$tour = $_POST['tour_id'];

$stId = $_POST["scheduleType"];
$maxPeople = $_POST["maxPeople"];
$duration = $_POST["duration"];
$isDaily = (isset($_POST["isDaily"])) ? "1" : "0";
$tourDate = $_POST["tourDate"];
$endDate = ($_POST["endDate"] != "") ? $_POST["endDate"] : "9999-12-31";
$perPerson = (isset($_POST["perPerson"])) ? "1" : "0";
$price = $_POST["price"];
$childPrice = ($_POST["childPrice"] != "") ? $_POST["childPrice"] : "0.00";
$memberPrice = $_POST["memberPrice"];


$query = "INSERT INTO wpzu_trav_tour_schedule ( tour_id , st_id , tour_date , duration , max_people , price , child_price , member_price , is_daily , per_person_yn , date_to ) VALUES ( $tour , $stId , $tourDate, '$duration' , $maxPeople, $price, $childPrice , $memberPrice , $isDaily , $perPerson , $endDate)";

if (mysqli_query($con, $query)) {
    header("Location:./tour.php?tour=$tour");
} else {
    $error = urldecode("<div class='alert alert-danger' role='alert'>Edit Schedule Gagal</div>");
    header("Location:./add-schedule.php?error=$error");
}

mysqli_close($con);
