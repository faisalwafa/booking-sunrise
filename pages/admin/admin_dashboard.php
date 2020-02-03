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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar-admin" class="tes">
            <div class="sidebar-admin-header">
                <h4>Sunrise Indonesia</h4>
                <img src="../../assets/logo-pwa.png" alt="" width="60">
            </div>

            <ul class="list-unstyled components">
                <li class="mb-2 active">
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
                    <a href="admin_city_travel.php">
                        <i class="fas fa-shuttle-van" style="color: #ff99cc"></i>
                        Inter-City Travel
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

            <div class="container py-3 mt-1">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card border-0">
                            <div class="card-body">
                                <h6 class="text-center font-weight-bold mb-4">Tour Terpopuler</h6>
                                <div class="row">
                                    <?php
                                    $sql_most_popular_tour = "SELECT p.ID, p.post_title, Count(t.tour_id) AS jumlah_kepopuleran FROM wpzu_posts p INNER JOIN wpzu_trav_tour_bookings t ON p.ID = t.tour_id WHERE p.post_status = 'publish' AND p.post_type = 'tour' GROUP BY p.ID, p.post_title ORDER BY jumlah_kepopuleran DESC LIMIT 3";

                                    $results_most_popular_tour = mysqli_query($con, $sql_most_popular_tour);
                                    while ($row_most_popular_tour = mysqli_fetch_assoc($results_most_popular_tour)) {
                                        $post_id = $row_most_popular_tour['ID'];

                                        $sql_thumbnail_price = "SELECT * FROM `wpzu_postmeta` WHERE (`post_id` = $post_id) AND (`meta_key` = 'trav_tour_min_price' OR `meta_key` = '_thumbnail_id') ORDER BY `wpzu_postmeta`.`meta_key` ASC";

                                        $result_thumbnail_price = mysqli_query($con, $sql_thumbnail_price);

                                        $i = 0;
                                        $post_id_thumbnail;
                                        $tour_min_price;

                                        while ($row_thumbnail_price = mysqli_fetch_assoc($result_thumbnail_price)) {
                                            if ($i == 0) {
                                                $post_id_thumbnail = $row_thumbnail_price['meta_value'];
                                            } else {
                                                $tour_min_price = $row_thumbnail_price['meta_value'];
                                            }
                                            $i++;
                                        }
                                        $sql_thumbnail = "SELECT guid FROM wpzu_posts WHERE ID = $post_id_thumbnail";
                                        $result_thumbnail = mysqli_query($con, $sql_thumbnail);
                                        $row_thumbnail = mysqli_fetch_assoc($result_thumbnail);
                                        $thumbnail_src = substr($row_thumbnail['guid'], strpos($row_thumbnail['guid'], "/wp-content") + 1);
                                    ?>
                                        <div class="col-md-4 d-flex align-items-stretch">
                                            <div class="card border-0 border-info mb-3">
                                                <div class="card body">
                                                    <div class="text-center mb-3">
                                                        <img src="https://sunrise-indonesia.com/<?= $thumbnail_src ?>" alt="thumbnail-image" class="card-img-top">
                                                    </div>
                                                    <div class="text-center pb-3">
                                                        <a class="text-dark text-decoration-none" href="../tour/tour.php?tour=<?= $post_id; ?>">
                                                            <p class="sidebar-li-title px-2 text-dark" style="font-size: 1em"><?= $row_most_popular_tour['post_title'] ?></p>
                                                        </a>
                                                        <span>
                                                            <span>
                                                                <h6 class="d-inline text-green sidebar-li-title">IDR<?= number_format($tour_min_price, 0, ".", ".") ?></h6>
                                                                <small class="text-secondary"> &nbsp; PER PERSON</small>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-8 col-sm-12">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="rounded bg-white p-3">
                                    <h6 class="mt-2 mb-3 font-weight-bold">Statistik Booking Tour</h6>
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="row mb-3">
                            <div class="col-md-12 mb-3">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <h6 class="mb-3 font-weight-bold">Total User</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <i class="far fa-user text-green" style="font-size: 1.8rem"></i>
                                            <?php
                                            $sql_user_count = "SELECT COUNT(*) AS jumlah_user FROM wpzu_users";
                                            $results_user_count = mysqli_query($con, $sql_user_count);
                                            $row_user_count = mysqli_fetch_assoc($results_user_count);
                                            echo "<h5>" . $row_user_count['jumlah_user'] . "</h5>";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <h6 class="mb-3 font-weight-bold">Total Tour</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <i class="fas fa-map-marker-alt text-info" style="font-size: 1.8rem"></i>
                                            <?php
                                            $sql_tour_count = "SELECT COUNT(*) AS jumlah_tour FROM wpzu_posts WHERE post_type = 'tour' AND post_status = 'publish'";
                                            $results_tour_count = mysqli_query($con, $sql_tour_count);
                                            $row_tour_count = mysqli_fetch_assoc($results_tour_count);
                                            echo "<h5>" . $row_tour_count['jumlah_tour'] . "</h5>";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <h6 class="mb-3 font-weight-bold">Total Schedule</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <i class="far fa-clock text-orange" style="font-size: 1.8rem"></i>
                                            <?php
                                            $sql_schedule_count = "SELECT COUNT(*) AS jumlah_schedule FROM wpzu_trav_tour_schedule";
                                            $results_schedule_count = mysqli_query($con, $sql_schedule_count);
                                            $row_schedule_count = mysqli_fetch_assoc($results_schedule_count);
                                            echo "<h5>" . $row_schedule_count['jumlah_schedule'] . "</h5>";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var chartLabels = [];
            var chartData = [];

            const monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            <?php
            $sql_reports_booking = "SELECT MONTH(tour_date) AS Bulan, YEAR(tour_date) AS Tahun, COUNT(tour_id) AS Jumlah FROM wpzu_trav_tour_bookings WHERE tour_date > DATE_SUB(NOW(),INTERVAL 1 YEAR) GROUP BY MONTH(tour_date), YEAR(tour_date) ORDER BY Tahun ASC, Bulan ASC";
            $results_reports_booking = mysqli_query($con, $sql_reports_booking);

            while ($row_reports_booking = mysqli_fetch_assoc($results_reports_booking)) {
            ?>
                chartLabels = [...chartLabels, `${ monthNames[<?= $row_reports_booking['Bulan'] - 1 ?>]} <?= $row_reports_booking['Tahun'] ?>`];
                chartData = [...chartData, <?= $row_reports_booking['Jumlah'] ?>];
            <?php } ?>



            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',

                // The data for our dataset
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Booking selama 1 tahun terakhir',
                        backgroundColor: 'rgba(255, 99, 132, 0.1)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: chartData
                    }]
                },

                // Configuration options go here
                options: {
                    responsive: true
                }
            });
        </script>
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