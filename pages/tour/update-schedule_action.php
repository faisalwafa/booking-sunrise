<?php

include_once '../../helper/connection.php';

$tour = $_POST['tour_id'];

$scheduleId = $_POST['id'];
$stId = $_POST["scheduleType"];
$postTitle = $_POST["post_title"];
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

$tourDate = date('Y-m-d', strtotime($rawTourDate));
$endDate = date('Y-m-d', strtotime($rawEndDate));

$query = "UPDATE wpzu_trav_tour_schedule SET st_id = '$stId' , max_people = '$maxPeople' , min_people = '$minPeople' , duration = '$duration' , is_daily = '$isDaily' , tour_date = '$tourDate' , date_to = '$endDate' , per_person_yn = '$perPerson' , price = '$price' , child_price = '$childPrice' , member_price = '$memberPrice' WHERE id = '$scheduleId'";

$query2 = "UPDATE wpzu_posts SET post_title = '$postTitle' WHERE ID = $tour";
// echo $query2;
// return;

if (mysqli_query($con, $query)) {
    if (mysqli_query($con, $query2)) {
        header("Location:../admin/admin_tour_detail.php?tour=$tour");
    }
} else {
    $error = urldecode("<div class='alert alert-danger' role='alert'>Edit Tour Gagal</div>");
    header("Location:../admin/admin_tour_detail.php?error=$error");
}

mysqli_close($con);
