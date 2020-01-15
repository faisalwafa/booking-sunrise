<?php

// Gak usah direken

include_once 'helper/connection.php';
// $con = mysqli_connect("localhost","sunriseindonesia_7","13h-p.S14c","sunriseindonesia_7");

$sql = "SELECT * FROM wpzu_users";
$results = mysqli_query($con, $sql);

while($row =  mysqli_fetch_assoc($results)) {
    printf ("%s (%s)\n", $row["user_login"], $row["user_email"]);
}
