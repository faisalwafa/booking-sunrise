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
                <li class="my-2 active">
                    <a href="admin_tour.php">
                        <i class="fas fa-map-marked-alt" style="color: #AC49BC"></i>
                        Tour
                    </a>
                </li>
                <li class="my-2">
                    <a href="admin_booking.php">
                        <i class="fas fa-book text-orange"></i>
                        Booking
                    </a>
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

            <div class="container mt-4 py-3 w-95 rounded bg-white">
                <div class="mt-2 mb-4 d-flex justify-content-between">
                    <h5><?= $row['location_from'] ?> - <?= $row['location_to'] ?></h5>
                    <button type="button" class="btn btn-outline-info" onclick="formEditDetailTravel()">Edit Detail</button>
                </div>
                <div id="editTravelForm" style="display: none">
                    <form method="POST" action="../travel_city/update-travel_action.php">
                        <input type="hidden" name="travel_id" value="<?= $travel ?>">
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