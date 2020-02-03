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
                <li class="my-2">
                    <a href="admin_city_travel.php">
                        <i class="fas fa-route" style="color: #ff99cc"></i>
                        Travel
                    </a>
                </li>
                <li class="my-2">
                    <a href="#bookingSubMenu" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                        <i class="fas fa-book text-orange"></i>
                        Booking
                    </a>
                    <ul class="collapse list-unstyled show" id="bookingSubMenu">
                        <li class="active">
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
                                <th>Jumlah Pax</th>
                                <th>Price</th>
                                <th>Created Date</th>
                                <th>Status Member</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_history_booking = "SELECT w.first_name, w.last_name, w.id, p.post_title, w.tour_date, w.created, w.total_price, w.status, w.adults, w.user_id, booking_no FROM wpzu_trav_tour_bookings AS w INNER JOIN wpzu_posts AS p ON w.tour_id = p.ID ORDER BY created DESC";
                            $result_history_booking = mysqli_query($con, $sql_history_booking);
                            $index_history_list = 1;
                            while ($row_booking_list = mysqli_fetch_assoc($result_history_booking)) {
                                $convert_price = $row_booking_list['total_price'];
                                // var_dump($row_booking_list);
                            ?>
                                <tr>
                                    <td><?= $index_history_list ?></td>
                                    <td><?= $row_booking_list['first_name'] ?> <?= $row_booking_list['last_name'] ?> <br> <a href="../booking_confirm/booking_confirm.php?booking_confirm=<?= $row_booking_list['booking_no'] ?>" class="table-link" target="_blank"><small>Detil Pesanan</small></a> </td>
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
                                    <td><?php
                                        if (isset($row_booking_list['user_id'])) {
                                            echo "Member";
                                        } else {
                                            echo "Non Member";
                                        }
                                        ?>
                                    </td>
                                    <?php
                                    $status = "";
                                    if ($row_booking_list['status'] == 2) {
                                        $status = "Completed";
                                    } else if ($row_booking_list['status'] == 1) {
                                        $status = "Upcoming";
                                    } else {
                                        $status = "Canceled";
                                    }
                                    ?>
                                    <td>
                                        <div id="status<?= $index_history_list ?>">
                                            <?= $status ?>
                                        </div>
                                        <form method="post" action="edit_status_tour.php">
                                            <div id="selectStatus<?= $index_history_list ?>" style="display: none">
                                                <input type="hidden" name="booking_id" value="<?= $row_booking_list['id'] ?>">
                                                <select name="status" onchange="editStatus()">
                                                    <option value="0">Canceled</option>
                                                    <option value="1">Upcoming</option>
                                                    <option value="2">Completed</option>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-link btn-sm px-0" onclick="editStatus<?= $index_history_list ?>()">Ubah</button>
                                                </div>
                                                <div class="col-md-3">
                                                    <button class="btn btn-link btn-sm" id="save<?= $index_history_list ?>" style="display: none" type="submit">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                <script>
                                    function editStatus<?= $index_history_list ?>() {
                                        var status<?= $index_history_list ?> = document.getElementById("status<?= $index_history_list ?>");
                                        var selectStatus<?= $index_history_list ?> = document.getElementById("selectStatus<?= $index_history_list ?>");
                                        var save<?= $index_history_list ?> = document.getElementById("save<?= $index_history_list ?>");

                                        if (selectStatus<?= $index_history_list ?>.style.display == "none") {
                                            selectStatus<?= $index_history_list ?>.style.display = "block";
                                            status<?= $index_history_list ?>.style.display = "none";
                                            save<?= $index_history_list ?>.style.display = "block";
                                        } else {
                                            selectStatus<?= $index_history_list ?>.style.display = "none";
                                            status<?= $index_history_list ?>.style.display = "block";
                                            save<?= $index_history_list ?>.style.display = "none";
                                        }
                                    }
                                </script>
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
    <script src=" https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"> </script>
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