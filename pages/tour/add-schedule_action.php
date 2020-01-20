<?php

include_once '../../helper/connection.php';

$tour = $_GET['tour'];

$maxPeople = $_POST["maxPeople"];
$duration = $_POST["duration"];
$isDaily = $_POST["isDaily"];
$startDate = $_POST["startDate"];
$endDate = $_POST["endDate"];
$tourDate = $_POST["tourDate"];
$perPerson = $_POST["perPerson"];
$price = $_POST["price"];
$childPrice = $_POST["childPrice"];
$memberPrice = $_POST["memberPrice"];

$query = "UPDATE wpzu_trav_tour_schedule SET max_people = '$maxPeople' , duration = '$duration' , is_daily = '$isDaily' , start_date = '$startDate' , end_date = '$endDate' , tour_date = '$tourDate' , per_person_yn = '$perPerson' price = '$price' , child_price = '$childPrice' , member_price = '$memberPrice'  WHERE ID = '' ";

if (mysqli_query($con, $query)) {
    header("Location:./add-schedule.php");
} else {
    $error = urldecode("<div class='alert alert-danger' role='alert'>Edit Schedule Gagal</div>");
    header("Location:../add-schedule.php?error=$error");
}
 
mysqli_close($con); 


?>