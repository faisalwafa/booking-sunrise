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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <title>Admin | Sunrise Indonesia</title>
    <link rel="stylesheet" type="text/css" href="../../css/admin.css">
    <script src="https://kit.fontawesome.com/29c1d44eb7.js" crossorigin="anonymous"></script>
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
                <li class="my-2 active  ">
                    <a href="admin_booking.php">
                        <i class="fas fa-book text-orange"></i>
                        Booking
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
                                <a class="dropdown-item" href="#">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container mt-4 py-3 w-95 rounded bg-white">
                <h4 class="mt-2 mb-4">List Booking</h4>
                <div class="table-responsive">
                    <table id="table-booking" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer Name</th>
                                <th>Tour Name</th>
                                <th>Tour Date</th>
                                <th>Adult</th>
                                <th>Price</th>
                                <th>Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_history_booking = "SELECT * FROM wpzu_trav_tour_bookings AS w INNER JOIN wpzu_posts AS p ON w.tour_id = p.ID";
                            $result_history_booking = mysqli_query($con, $sql_history_booking);
                            $index_history_list = 1;
                            while ($row_booking_list = mysqli_fetch_assoc($result_history_booking)) {
                                $convert_price = $row_booking_list['total_price'];
                            ?>
                                <tr>
                                    <td><?= $index_history_list ?></td>
                                    <td><?= $row_booking_list['first_name'] ?><br> <?= $row_booking_list['last_name'] ?></td>
                                    <td><?= $row_booking_list['post_title'] ?></td>
                                    <td><?php $doConvert_tourDate = strtotime($row_booking_list['tour_date']);
                                        $convert_tourDate = date('m/d/Y', $doConvert_tourDate);
                                        echo $convert_tourDate ?></td>
                                    <td><?= $row_booking_list['adults'] ?></td>
                                    <td>IDR <?= number_format($convert_price, 0, ".", ".") ?></td>
                                    <td><?php $doConvert_createdDate = strtotime($row_booking_list['created']);
                                        echo date('m/d/Y', $doConvert_createdDate);
                                        echo date(' h:i:s A', $doConvert_createdDate);
                                        ?></td>
                                </tr>
                            <?php
                                $index_history_list++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include_once '../inc/scripts.php'; ?>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-booking').DataTable();
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar-admin').toggleClass('active');
            });

        });
    </script>
</body>

</html>