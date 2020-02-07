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
    <link rel="stylesheet" type="text/css" href="../../css/trumbowyg.min.css">
    <link rel="stylesheet" href="../../css/trumbowyg.colors.min.css">
    <link rel="stylesheet" href="../../css/trumbowyg.emoji.min.css">
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
                <li class="mb-2">
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
                <li class="my-2 active">
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
                <div class="mt-2 mb-4 d-flex justify-content-between">
                    <h4>List Inter-City Travel</h4>
                    <button type="button" class="btn btn-outline-info" onclick="formAddTravel()">Add Travel</button>
                </div>
                <div id="addTravel" class="mt-2 mb-4" style="display: none;">
                    <h6 style="font-weight: 700;" class="mb-4">Add New Tour Schedule</h6>
                    <form method="post" action="../travel_city/add-trav_action.php">
                        <div class="form-group row">
                            <h6 class="col-sm-3 mt-3">Location From</h6>
                            <div class="col-sm-9">
                                <input class="form-control" required name="location_from" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <h6 class="col-sm-3 mt-3">Location To</h6>
                            <div class="col-sm-9">
                                <input class="form-control" required name="location_to" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <h6 class="col-sm-3 mt-3">Schedule</h6>
                            <div class="col-sm-9">
                                <input class="form-control" required name="schedule" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <h6 class="col-sm-3 mt-3">Price</h6>
                            <div class="col-sm-9">
                                <input class="form-control" required name="price" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <h6 class="col-sm-3 mt-3">Price Member</h6>
                            <div class="col-sm-9">
                                <input class="form-control" required name="price_member" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <h6 class="col-sm-3 mt-3">Details</h6>
                            <div class="col-sm-9">
                                <textarea placeholder="Tambah list dengan menggunakan Unordered list" required name="details" class="editor"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <h6 class="col-sm-3 mt-3">Color</h6>
                            <div class="col-sm-9">
                                <select class="form-control" name="color" required>
                                    <option value="porcelainRose" style="background-color: #e66767; color: #fff">Porcelain Rose</option>
                                    <option value="blueCuracao" style="background-color: #3dc1d3; color: #fff">Blue Curacao</option>
                                    <option value="purpleCorallite" style="background-color: #786fa6; color: #fff">Purple Corallite</option>
                                    <option value="brewedMustard" style="background-color: #e77f67; color: #fff">Brewed Mustard</option>
                                    <option value="softBlue" style="background-color: #778beb; color: #fff">Soft Blue</option>
                                    <option value="dupain" style="background-color: #60a3bc; color: #fff">Dupain</option>
                                    <option value="goodSamaritan" style="background-color: #3c6382; color: #fff">Good Samaritan</option>
                                    <option value="syntheticPumpkin" style="background-color: #ff793f; color: #fff">Synthetic Pumpkin</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 "></div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary" id="saveTravel">Save Schedule</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table id="table-travel" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Lokasi Awal</th>
                                <th>Tujuan Akhir</th>
                                <th>Schedule</th>
                                <th>Price</th>
                                <th>Member Price</th>
                                <th>Other</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_travel_list = "SELECT * FROM wpzu_trav_city WHERE id";
                            $results_travel_list = mysqli_query($con, $sql_travel_list);
                            $index_travel_list = 1;
                            while ($row_travel_list = mysqli_fetch_assoc($results_travel_list)) {
                                $convert_price = $row_travel_list['price'];
                                $convert_memberPrice = $row_travel_list['price_member'];
                            ?>

                                <tr>
                                    <td><?= $index_travel_list ?></td>
                                    <td><?= $row_travel_list['id'] ?></td>
                                    <td><?= $row_travel_list['location_from'] ?></td>
                                    <td><?= $row_travel_list['location_to'] ?></td>
                                    <td><?= $row_travel_list['schedule'] ?></td>
                                    <td>Rp. <?= number_format($convert_price, 0, ".", ".") ?></td>
                                    <td>Rp. <?= number_format($convert_memberPrice, 0, ".", ".") ?></td>
                                    <td>
                                        <div>
                                            <a href="admin_city_travel_detail.php?travel=<?= $row_travel_list['id'] ?>" style="font-size: 0.9rem">
                                                <i class="fas fa-external-link-alt" style="font-size: 0.7rem"></i>
                                                Lihat Travel
                                            </a>
                                        </div>
                                        <div>
                                            <a href="../travel_city/delete-trav_action.php?travel=<?= $row_travel_list['id'] ?>" style="font-size: 0.9rem">
                                                <i class="fas fa-trash-alt" style="font-size: 0.7rem"></i>
                                                Hapus Travel
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $index_travel_list++;
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
            $('#table-travel').DataTable();
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar-admin').toggleClass('active');
            });

        });
    </script>
</body>

</html>