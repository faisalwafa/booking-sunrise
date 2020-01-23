<?php
include_once '../../helper/connection.php';

$tour = $_GET['tour'];

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
                    <a href="#">
                        <i class="fas fa-home text-primary"></i>
                        Dashboard
                    </a>
                </li>
                <li class="my-2 active">
                    <a href="#">
                        <i class="fas fa-map-marked-alt" style="color: #AC49BC"></i>
                        Tour
                    </a>
                </li>
                <li class="my-2">
                    <a href="#">
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
                <h4 class="mt-2 mb-4">List Schedule</h4>
                <a href="../tour/add-schedule.php?tour=<?= $tour ?>">
                    <button class="btn btn-primary">Add Schedule</button>
                </a>
                <table id="table-tour" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Tour Date</th>
                            <th>Max People</th>
                            <th>Price adult</th>
                            <th>Price child</th>
                            <th>Member Price</th>
                            <th>Duration</th>
                            <th>Schedule Type</th>
                            <!-- <th>Date end</th> -->
                            <th>Other</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_schedule_list = "SELECT * FROM `wpzu_trav_tour_schedule` WHERE `tour_id` = $tour ORDER BY `id` DESC";
                        $results_schedule_list = mysqli_query($con, $sql_schedule_list);
                        $index_schedule_list = 1;
                        while ($row_schedule_list = mysqli_fetch_assoc($results_schedule_list)) {
                        ?>

                            <tr>
                                <td><?= $index_schedule_list ?></td>
                                <td><?= $row_schedule_list['id'] ?></td>
                                <td><?php
                                    $datetimeTour = strtotime($row_schedule_list['tour_date']);
                                    $dateTour = date('m/d/y', $datetimeTour);
                                    echo $dateTour;
                                    ?></td>
                                <td><?= $row_schedule_list['max_people'] ?></td>
                                <td><?= $row_schedule_list['price'] ?></td>
                                <td><?= $row_schedule_list['child_price'] ?></td>
                                <td><?= $row_schedule_list['member_price'] ?></td>
                                <td><?= $row_schedule_list['duration'] ?></td>
                                <td><?=
                                        $st_id = $row_schedule_list['st_id'];
                                    if ($st_id == 0) {
                                        echo "Weekday";
                                    } else {
                                        echo "Weekend";
                                    }
                                    ?></td>
                                <!-- <td><?=
                                                $datetimeEnd = strtotime($row_schedule_list['date_to']);
                                            $dateEnd = date('m/d/y', $datetimeEnd);
                                            echo $dateEnd;
                                            ?></td> -->
                                <td>
                                    <a href="edit_schedule.php?schedule=<?= $row_schedule_list['tour_id']; ?>" style="font-size: 0.9rem">
                                        <i class="fas fa-external-link-alt" style="font-size: 0.7rem"></i>
                                        Edit Schedule
                                    </a>
                                </td>
                            </tr>
                        <?php
                            $index_schedule_list++;
                        }
                        ?>
                    </tbody>
                </table>
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