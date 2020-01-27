<!DOCTYPE html>
<html lang="en">

<?php

session_start();

include_once '../../helper/connection.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/auth.php");
} // $history_booking = $_GET['history-booking'];

?>


<head>
    <?php include_once '../inc/header.php'; ?>
    <link rel="stylesheet" type="text/css" href="../../css/profile.css">
    <title>Tours | Sunrise Indonesia</title>
</head>

<body>
    <?php
    include_once '../inc/navbar.php'; ?>

    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 style="margin-top: 10px;" class="post-title"> Booking Saya </h2>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </div>
    <div class="container pt-4 w-100 overflow-hidden">
        <div class="content d-flex align-items-stretch">
            <nav id="sidebar">
                <div class="custom-menu">
                    <button type="button" id="sidebarCollapse" class="d-sm-block d-md-none btn btn-primary">
                    </button>
                </div>

                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="profile.php" class="font-weight-bold"><i class="fas fa-user-alt mr-3 py-2 profile-icon"></i> Profile</a>
                    </li>
                    <li class="active">
                        <a href="profile_booking.php" class="font-weight-bold"><i class="fas fa-clipboard-check mr-3 py-2 profile-icon"></i> Riwayat Booking</a>
                    </li>
                    <li>
                        <a href="../auth/logout.php" class="font-weight-bold"><i class="fa fa-sign-out mr-3 py-2 profile-icon"></i> Sign Out</a>
                    </li>
                </ul>

            </nav>

            <div id="content" class="p-4 p-md-5 pt-5 w-100 account overflow-hidden">
                <h2 class="">Riwayat Booking</h2>
                <p class="mt-2 mb-4"></p>
                <hr class="mb-4">
                <div class="w-100 table-responsive">
                    <table data-page-length='6' id="table-history-booking" class="table">
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
    <?php include_once '../inc/footer.php'; ?>
    <?php include_once '../inc/scripts.php'; ?>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css"></script>
    <script>
        $(document).ready(function() {
            $('#table-history-booking').DataTable({
                "columnDefs": [{
                    "width": "12%",
                    "targets": 2
                }]
            });
        });
    </script>
</body>

</html>