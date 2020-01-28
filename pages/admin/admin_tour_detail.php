<?php
session_start();

include_once '../../helper/connection.php';

if (!isset($_SESSION["user_id"]) || (isset($_SESSION["user_id"]) && $_SESSION["user_level"] != 10)) {
    header("Location: ../auth/auth.php");
}

$user = $_SESSION["user_id"];

$tour = $_GET['tour'];

$sql = "SELECT * FROM wpzu_posts WHERE ID = $tour";
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
                    <h5><?= $row['post_title'] ?></h5>
                    <button type="button" class="btn btn-outline-info" onclick="formEditDetail()">Edit Detail</button>
                </div>
                <div id="editDetailForm" style="display: none">
                    <form method="post" action="../tour/update-tour_action.php">
                        <input type="hidden" name="tour_id" value="<?= $tour ?>">
                        <div class="row-content">
                            <h5 class="mt-3">Deskripsi</h5>
                            <textarea name="deskripsi" class="editor" placeholder="" autofocus><?= $row['post_content'] ?></textarea>
                            <div class="accordion" id="accordionContent">
                                <div>
                                    <button class="btn btn-block btn-outline-secondary rounded mb-2 d-flex align-items-center collapsed " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="mr-2"><i class="soap-icon-plus mr-1"></i></span>
                                        <span>Harga Paket</span>
                                    </button>
                                    <div id="collapseOne" class="collapse ml-2" aria-labelledby="headingOne" data-parent="#accordionContent">
                                        <textarea name="harga" class="editor" placeholder="" autofocus><?= $row['harga_paket'] ?></textarea>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-block btn-outline-secondary rounded mb-2 d-flex align-items-center collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <span class="mr-2"><i class="soap-icon-plus mr-1"></i></span>
                                        <span>Detail Itinerary</span>
                                    </button>
                                    <div id="collapseTwo" class="collapse ml-2" aria-labelledby="headingTwo" data-parent="#accordionContent">
                                        <textarea name="itinerary" class="editor" placeholder="" autofocus><?= $row['detail_itinerary'] ?></textarea>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-block btn-outline-secondary rounded mb-2 d-flex align-items-center collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <span class="mr-2"><i class="soap-icon-plus mr-1"></i></span>
                                        <span>Harga Termasuk</span>
                                    </button>
                                    <div id="collapseThree" class="collapse ml-2" aria-labelledby="headingThree" data-parent="#accordionContent">
                                        <textarea name="hargaTermasuk" class="editor" placeholder="" autofocus><?= $row['harga_termasuk'] ?></textarea>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-block btn-outline-secondary rounded mb-2 d-flex align-items-center collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        <span class="mr-2"><i class="soap-icon-plus mr-1"></i></span>
                                        <span>Harga Tidak Termasuk</span>
                                    </button>
                                    <div id="collapseFour" class="collapse ml-2" aria-labelledby="headingFour" data-parent="#accordionContent">
                                        <textarea name="hargaTidakTermasuk" class="editor" placeholder="" autofocus><?= $row['harga_tidak_termasuk'] ?></textarea>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-block btn-outline-secondary rounded mb-2 d-flex align-items-center collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        <span class="mr-2"><i class="soap-icon-plus mr-1"></i></span>
                                        <span>Force Majeur</span>
                                    </button>
                                    <div id="collapseFive" class="collapse ml-2" aria-labelledby="headingFive" data-parent="#accordionContent">
                                        <textarea name="forceMajeur" class="editor" placeholder="" autofocus><?= $row['force_majeur'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="saveChanges" onclick="saveChanges()">Simpan Perubahan</button>
                    </form>
                </div>
                <div id="detailTour">
                    <div class="row-content">
                        <p>
                            <?php echo $row["post_content"]; ?>
                        </p>
                        <div class="accordion" id="accordionContent">
                            <div>
                                <button class="btn btn-block btn-outline-secondary rounded mb-2 d-flex align-items-center collapsed " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span class="mr-2"><i class="soap-icon-plus mr-1"></i></span>
                                    <span>Harga Paket</span>
                                </button>
                                <div id="collapseOne" class="collapse ml-2" aria-labelledby="headingOne" data-parent="#accordionContent">
                                    <p>
                                        <?php echo $row["harga_paket"]; ?>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-block btn-outline-secondary rounded mb-2 d-flex align-items-center collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span class="mr-2"><i class="soap-icon-plus mr-1"></i></span>
                                    <span>Detail Itinerary</span>
                                </button>
                                <div id="collapseTwo" class="collapse ml-2" aria-labelledby="headingTwo" data-parent="#accordionContent">
                                    <p>
                                        <?php echo $row["detail_itinerary"]; ?>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-block btn-outline-secondary rounded mb-2 d-flex align-items-center collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span class="mr-2"><i class="soap-icon-plus mr-1"></i></span>
                                    <span>Harga Termasuk</span>
                                </button>
                                <div id="collapseThree" class="collapse ml-2" aria-labelledby="headingThree" data-parent="#accordionContent">
                                    <p>
                                        <?php echo $row["harga_termasuk"]; ?>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-block btn-outline-secondary rounded mb-2 d-flex align-items-center collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <span class="mr-2"><i class="soap-icon-plus mr-1"></i></span>
                                    <span>Harga Tidak Termasuk</span>
                                </button>
                                <div id="collapseFour" class="collapse ml-2" aria-labelledby="headingFour" data-parent="#accordionContent">
                                    <p>
                                        <?php echo $row["harga_tidak_termasuk"]; ?>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-block btn-outline-secondary rounded mb-2 d-flex align-items-center collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    <span class="mr-2"><i class="soap-icon-plus mr-1"></i></span>
                                    <span>Force Majeur</span>
                                </button>
                                <div id="collapseFive" class="collapse ml-2" aria-labelledby="headingFive" data-parent="#accordionContent">
                                    <p>
                                        <?php echo $row["force_majeur"]; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mt-2 mb-4 d-flex justify-content-between">
                    <h5 class=" ">List Schedule </h5>
                    <!-- <a class="  " href="../tour/add-schedule.php?tour=<?= $tour ?>"> -->
                    <button type="button" class="btn btn-outline-success" onclick="formAddSchedule()">Add Schedule</button>
                    <!-- </a> -->
                </div>
                <div class="mt-2 mb-4" id="formAddSchedule" style="display: none">
                    <h6>Add New Tour Schedule</h6>
                    <form method="post" action="../tour/add-schedule_action.php">
                        <input type="hidden" name="tour_id" value="<?= $tour ?>">
                        <div class="form-group row">
                            <h6 class="col-sm-3 mt-3">Tour</h6>
                            <div class="col-sm-9">
                                <input disabled class="form-control" value="<?= $row['post_title'] ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <h6 class="col-sm-3 mt-3">Schedule Type</h6>
                            <div class="col-sm-9">
                                <select class="form-control" name="scheduleType">
                                    <option value="0"></option>
                                    <option value="0">Weekday</option>
                                    <option value="1">Weekend</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <h6 class="col-sm-3 mt-3">Max People</h6>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="maxPeople" min="1" value="1" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <h6 class="col-sm-3 mt-3">Duration</h6>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="duration" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <h6 class="col-sm-3 mt-3">Is Daily?</h6>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="isDaily" onchange="myFunction()" id="check">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <h6 class="col-sm-3 mt-3">Tour Date</h6>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tourDate" />
                            </div>
                        </div>
                        <div id="endDate" style="display: none">
                            <div class="form-group row">
                                <h6 class="col-sm-3 mt-3">End Date</h6>
                                <div class="col-sm-9">
                                    <input id="inputEndDate" type="date" class="form-control" name="endDate" />
                                </div>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <h6 class="col-sm-3 mt-3">Charge Per Person?</h6>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="perPerson" onchange="myFunction2()" id="check2">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <h6 class="col-sm-3 mt-3">Price</h6>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="price" />
                            </div>
                        </div>
                        <div id="childPrice" style="display: none">
                            <div class="form-group row">
                                <h6 class="col-sm-3 mt-3">Price Per Child</h6>
                                <div class="col-sm-9">
                                    <input id="inputChildPrice" type="text" class="form-control" name="childPrice" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <h6 class="col-sm-3 mt-3">Member Price</h6>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="memberPrice" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 "></div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary" id="saveSchedule" onclick="saveSchedule()">Save Schedule</button>
                            </div>
                        </div>
                    </form>
                </div>
                <table id="table-tour" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Tour Date</th>
                            <th>Max People</th>
                            <th>Price adult</th>
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
                                    $dateTour = date('d-m-y', $datetimeTour);
                                    echo $dateTour;
                                    ?></td>
                                <td><?= $row_schedule_list['max_people'] ?></td>
                                <td><?= $row_schedule_list['price'] ?></td>
                                <td><?= $row_schedule_list['member_price'] ?></td>
                                <td><?= $row_schedule_list['duration'] ?></td>
                                <td>
                                    <div style="display:none"> <?= $st_id = $row_schedule_list['st_id'] ?></div>
                                    <?php
                                    if ($st_id == 0) {
                                        echo "Weekday";
                                    } else {
                                        echo "Weekend";
                                    }
                                    ?>
                                </td>
                                <!-- <td><?=
                                                $datetimeEnd = strtotime($row_schedule_list['date_to']);
                                            $dateEnd = date('m/d/y', $datetimeEnd);
                                            echo $dateEnd;
                                            ?></td> -->
                                <td>

                                    <a href="../tour/delete_schedule_action.php?schedule=<?= $row_schedule_list['id']; ?>&tour=<?= $tour ?>" style="font-size: 0.9rem">
                                        <i class="fas fa-external-link-alt" style="font-size: 0.7rem"></i>
                                        Delete Schedule
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