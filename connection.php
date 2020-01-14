<?php
    //koneksi ke database
    $server = "localhost";
    $usernames = "root";
    $passwords = "";
    $database = "sunriseindonesia7";//nama database

    $con = mysqli_connect($server, $usernames, $passwords, $database);

    //check error_get_last
    if(mysqli_connect_errno()){
        echo "Koneksi gagal, ada masalah pada : ".mysqli_connect_error();
        exit();
        mysqli_close($mysqli);
    }
?>