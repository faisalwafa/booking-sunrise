<?php

session_start();

include_once '../../helper/connection.php';

if (!isset($_SESSION["user_id"]) || (isset($_SESSION["user_id"]) && $_SESSION["user_level"] != 10)) {
    header("Location: ../auth/auth.php");
}

$user = $_SESSION["user_id"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../css/custom-bootstrap.css">
    <title>Admin | Sunrise Indonesia</title>
    <link rel="stylesheet" type="text/css" href="../../css/admin.css">
    <script src="https://kit.fontawesome.com/29c1d44eb7.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/ico" sizes="192x192" href="../../assets/564da423-cropped-4c267bf8-logo-300x300.png">
</head>

<body>
    <div class="wrapper bg-white">
        <!-- Sidebar -->
        <nav id="sidebar-admin" class="tes">
            <div class="sidebar-admin-header">
                <h4>Sunrise Indonesia</h4>
                <img src="../../assets/logo-pwa.png" alt="" width="60">
            </div>

            <ul class="list-unstyled components">
                <li class="mb-2">
                    <a href="admin_dashboard.php">
                        <i class="fas fa-home text-primary"></i>
                        Dashboard
                    </a>
                </li>
                <li class="my-2">
                    <a href="admin_tour.php">
                        <i class="fas fa-map-marked-alt" style="color: #AC49BC"></i>
                        Tour
                    </a>
                </li>
                <li class="my-2">
                    <a href="admin_city_travel.php">
                        <i class="fas fa-route" style="color: #ff99cc"></i>
                        Travel
                    </a>
                </li>
                <li class="my-2">
                    <a href="#bookingSubMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-book text-orange"></i>
                        Booking
                    </a>
                    <ul class="collapse list-unstyled" id="bookingSubMenu">
                        <li>
                            <a href="admin_booking_tour.php">
                                <i class="fas fa-map-marked-alt" style="color: #AC49BC"></i>
                                Booking Tour
                            </a>
                        </li>
                        <li>
                            <a href="admin_booking_travel.php">
                                <i class="fas fa-route" style="color: #ff99cc"></i>
                                Booking Travel
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="my-2">
                    <a href="admin_newsfeed.php">
                        <i class="far fa-newspaper text-green"></i>
                        Newsfeed
                    </a>
                </li>
            </ul>
        </nav>

        <div class="w-100">
            <nav class="navbar navbar-expand-lg navbar-light navbar-admin">
                <button type="button" id="sidebarCollapse" class="btn btn-default">
                    <i class="fas fa-bars"></i>
                </button>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropleft">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Admin
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="../auth/logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container mt-4 py-5 w-75 rounded">
                <img src="../../assets/logo-pwa.png" alt="logo" width="200" class="mb-5 mx-auto d-block">
                <h2 class="text-center">Selamat datang Admin Sunrise Indonesia</h2>
                <!-- <div class="">
                </div> -->
            </div>
        </div>
    </div>

    <?php include_once '../inc/scripts.php'; ?>
    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar-admin').toggleClass('active');
            });

        });
    </script>
</body>

</html>