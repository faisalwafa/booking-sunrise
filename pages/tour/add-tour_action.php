<?php

include_once '../../helper/connection.php';

$tour = $_GET['tour'];

$deskripsi = $_POST["deskripsi"];
$harga = $_POST["harga"];
$itinerary = $_POST["itinerary"];
$hargaTermasuk = $_POST["hargaTermasuk"];
$hargaTidakTermasuk = $_POST["hargaTidakTermasuk"];
$forceMajeur = $_POST["forceMajeur"];

$query = "UPDATE wpzu_posts SET post_content = '$deskripsi' , harga_paket = '$harga' , detail_itinerary = '$itinerary' , harga_termasuk = '$hargaTermasuk' , harga_tidak_termasuk = '$hargaTidakTermasuk' , force_majeur = '$forceMajeur'  WHERE ID = '' ";

if (mysqli_query($con, $query)) {
    header("Location:./add-tour.php");
} else {
    $error = urldecode("<div class='alert alert-danger' role='alert'>Edit Tour Gagal</div>");
    header("Location:../add-tour.php?error=$error");
}

mysqli_close($con); 


?>