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
    <link rel="icon" type="image/ico" sizes="192x192" href="../../assets/564da423-cropped-4c267bf8-logo-300x300.png">
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
                <li class="mb-2 active">
                    <a href="admin_member.php">
                        <i class="fas fa-users" style="color: #1abc9c"></i>
                        Member
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

            <div class="container mt-4 py-3 w-95 rounded bg-white">
                <h4 class="mt-2 mb-4">List Member</h4>
                <div class="table-responsive">
                    <table id="table-tour" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_member_meta = "SELECT * FROM wpzu_usermeta WHERE meta_key = 'first_name' OR meta_key = 'last_name' ORDER BY meta_key, user_id";
                            $results_member_meta = mysqli_query($con, $sql_member_meta);

                            $member_meta_size = mysqli_num_rows($results_member_meta);

                            $sql_member_list = "SELECT * FROM wpzu_users";
                            $results_member_list = mysqli_query($con, $sql_member_list);


                            $members_meta = array();
                            while ($row_member_meta = mysqli_fetch_assoc($results_member_meta)) {
                                array_push($members_meta, $row_member_meta);
                            }

                            $members_meta_split_size = $member_meta_size / 2;

                            $members_meta = array_chunk($members_meta, $members_meta_split_size);

                            $members = array();
                            while ($row_member_list = mysqli_fetch_assoc($results_member_list)) {
                                array_push($members, $row_member_list);
                            }

                            for ($i = 0; $i < count($members); $i++) {
                                $members[$i] += ['first_name' => $members_meta[0][$i]['meta_value']];
                                $members[$i] += ['last_name' => $members_meta[1][$i]['meta_value']];
                            }

                            $index_member_list = 1;
                            foreach ($members as $member) {
                                $name = $member['first_name'] . ' ' . $member['last_name'];
                                if ($name == " ") {
                                    $name = "-";
                                }
                            ?>

                                <tr>
                                    <td><?= $index_member_list ?></td>
                                    <td><?= $name ?></td>
                                    <td><?= $member['user_login'] ?></td>
                                    <td><?= $member['user_email'] ?></td>
                                </tr>
                            <?php
                                $index_member_list++;
                            }
                            ?>
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
            $('#table-tour').DataTable();
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar-admin').toggleClass('active');
            });

        });
    </script>
</body>

</html>