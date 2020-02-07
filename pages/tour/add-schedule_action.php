<?php

include_once '../../helper/connection.php';

$tour = $_POST['tour_id'];

$stId = $_POST["scheduleType"];
$maxPeople = $_POST["maxPeople"];
$minPeople = $_POST["minPeople"];
$duration = $_POST["duration"];
$isDaily = (isset($_POST["isDaily"])) ? "1" : "0";
$rawTourDate = $_POST["tourDate"];
$rawEndDate = ($_POST["endDate"] != "") ? $_POST["endDate"] : "9999-12-31";
$perPerson = (isset($_POST["perPerson"])) ? "1" : "0";
$price = $_POST["price"];
$childPrice = ($_POST["childPrice"] != "") ? $_POST["childPrice"] : "0.00";
$memberPrice = $_POST["memberPrice"];
$note = $_POST['note'];

$tourDate = date('Y-m-d', strtotime($rawTourDate));
$endDate = date('Y-m-d', strtotime($rawEndDate));

// echo $rawTourDate;
// echo $rawEndDate;
// echo $tourDate;
// echo $endDate;
// return;

$query = "INSERT INTO wpzu_trav_tour_schedule ( tour_id , st_id , tour_date , duration , max_people , min_people, price , child_price , member_price , is_daily , per_person_yn , date_to, note ) 
VALUES ( $tour , $stId , '$tourDate', '$duration' , $maxPeople, $minPeople, $price, $childPrice , $memberPrice , $isDaily , $perPerson , '$endDate' , '$note')";

if (mysqli_query($con, $query)) {
    header("Location:../admin/admin_tour_detail.php?tour=$tour");
} else {
    $error = urldecode("<div class='alert alert-danger' role='alert'>Edit Schedule Gagal</div>");
    header("Location:../admin/admin_tour_detail.php?error=$error");
}

mysqli_close($con);
