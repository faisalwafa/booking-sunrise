<?php
session_start();

include_once '../../helper/connection.php';

if (!isset($_SESSION["user_id"]) || (isset($_SESSION["user_id"]) && $_SESSION["user_level"] != 10)) {
    header("Location: ../auth/auth.php");
}

$user = $_SESSION["user_id"];

$travel = $_GET['travel'];

$sql = "SELECT * FROM wpzu_trav_city WHERE id = $travel";
$results = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($results);

$convert_price = $row['price'];
$convert_memberPrice = $row['price_member'];

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
</head>

<body>
    <div class="wrapper">
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
                    <h5><?= $row['location_from'] ?> - <?= $row['location_to'] ?></h5>
                    <button type="button" class="btn btn-outline-info" onclick="formEditDetailTravel()">Edit Detail</button>
                </div>
                <div id="editTravelForm" style="display: none">
                    <form method="POST" action="../travel_city/update-travel_action.php">
                        <input type="hidden" name="travel_id" value="<?= $travel ?>">
                        <div class="form-row">
                            <div class="col-md-5 col-sm-12">
                                <div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6>Location From</h6>
                                        </div>
                                        <div class="col-md-7 mb-4">
                                            <input type="text" name="location_from" class="form-control" id="travelAdmin-LocationFrom" value="<?= $row['location_from'] ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6>Price</h6>
                                        </div>
                                        <div class="col-md-7 mb-4">
                                            <input type="text" name="price" class="form-control" id="travelAdmin-Price" value="<?= $row['price'] ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6>Schedule</h6>
                                        </div>
                                        <div class="col-md-7 mb-4">
                                            <input type="text" name="schedule" class="form-control" id="travelAdmin-Schedule" value="<?= $row['schedule'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5 col-sm-12 mb-3">
                                <div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6>Location To</h6>
                                        </div>
                                        <div class="col-md-7 mb-4">
                                            <input type="text" name="location_to" class="form-control" id="travelAdmin-LocationTo" value="<?= $row['location_to'] ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6>Member Price</h6>
                                        </div>
                                        <div class="col-md-7 mb-4">
                                            <input type="text" name="price_member" class="form-control" id="travelAdmin-Price" value="<?= $row['price_member'] ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6>Card Color</h6>
                                        </div>
                                        <div class="col-md-7 mb-4">
                                            <select class="form-control" name="color">
                                                <option value="squeaky">Squeaky</option>
                                                <option value="blueCuracao">Blue Curacao</option>
                                                <option value="purpleMountain">Purple Mountain Majesty</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-content">
                            <div class="accordion" id="accordionContent">
                                <div>
                                    <button class="btn btn-block btn-outline-secondary rounded mb-2 d-flex align-items-center collapsed " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="mr-2"><i class="soap-icon-plus mr-1"></i></span>
                                        <span>Inter-City Travel Details</span>
                                    </button>
                                    <div id="collapseOne" class="collapse ml-2" aria-labelledby="headingOne" data-parent="#accordionContent">
                                        <textarea name="details" class="editor" placeholder="" autofocus><?= $row['details'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="saveChanges" onclick="saveChanges()">Simpan Perubahan</button>
                    </form>
                </div>
                <div id="detailTravel">
                    <div class="row-content">
                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <h6 class="float-md-left">Location From</h6>
                                <p class="float-md-right"><?= $row['location_from'] ?></p>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5 mb-2">
                                <h6 class="float-md-left">Location To</h6>
                                <p class="float-md-right"><?= $row['location_to'] ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <h6 class="float-md-left">Price</h6>
                                <p class="float-md-right">Rp. <?= number_format($convert_price, 0, ".", ".") ?></p>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5 mb-2">
                                <h6 class="float-md-left">Member Price</h6>
                                <p class="float-md-right">Rp. <?= number_format($convert_memberPrice, 0, ".", ".") ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <h6 class="float-md-left">Schedule</h6>
                                <p class="float-md-right">Jam Ganjil</p>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5 mb-2">
                                <h6 class="float-md-left">Card Color</h6>
                                <p class="float-md-right"><?= $row['color'] ?></p>
                            </div>
                        </div>
                        <div class="accordion" id="accordionContent">
                            <div>
                                <button class="btn btn-block btn-outline-secondary rounded mb-2 d-flex align-items-center collapsed " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span class="mr-2"><i class="soap-icon-plus mr-1"></i></span>
                                    <span>Inter-City Travel Details</span>
                                </button>
                                <div id="collapseOne" class="collapse ml-2" aria-labelledby="headingOne" data-parent="#accordionContent">
                                    <p>
                                        <?= $row['details'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 mb-2 d-flex justify-content-between">
                    <h5>List Schedule</h5>
                    <button type="button" class="btn btn-outline-success" onclick="formAddTravSchedule()">Add Schedule</button>
                </div>
                <div class="mt-2 mb-4" id="formAddTravSchedule" style="display: none">
                    <h6>Add New Travel Schedule</h6>
                    <form method="post" action="../travel_city/add-trav-schedule_action.php">
                        <input type="hidden" name="travel_id" value="<?= $travel ?>">
                        <div class="form-group row">
                            <h6 class="col-sm-3 mt-3">Travel</h6>
                            <div class="col-sm-9">
                                <input disabled class="form-control" value="<?= $row['location_from'] ?> - <?= $row['location_to'] ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <h6 class="col-sm-3 mt-3">Available Time</h6>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="availableTime" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 "></div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary" id="saveSchedule" onclick="saveTourSchedule()">Save Schedule</button>
                            </div>
                        </div>
                    </form>
                </div>
                <table id="table-tour" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Available Time</th>
                            <th>Other</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_trav_schedule_list = "SELECT * FROM `wpzu_trav_city_schedule` WHERE `id_travel` = $travel ORDER BY `id` DESC";
                        $results_trav_schedule_list = mysqli_query($con, $sql_trav_schedule_list);
                        $index_trav_schedule_list = 1;
                        while ($row_trav_schedule_list = mysqli_fetch_assoc($results_trav_schedule_list)) {
                        ?>
                            <tr>
                                <td><?= $index_trav_schedule_list ?></td>
                                <td><?= $row_trav_schedule_list['available_time'] ?></td>
                                <td>
                                    <a href="../travel_city/delete-trav-schedule_action.php?schedule=<?= $row_trav_schedule_list['id'] ?>&travel=<?= $travel ?>" style="font-size: 0.9rem">
                                        <i class="fas fa-external-link-alt" style="font-size: 0.7rem"></i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php
                            $index_trav_schedule_list++;
                        }
                        ?>
                    </tbody>
                </table>
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