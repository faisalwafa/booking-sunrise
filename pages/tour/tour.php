<?php
session_start();

$is_logged_in = (isset($_SESSION['user_id'])) ? true : false;

include_once '../../helper/connection.php';

$tour = $_GET['tour'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../inc/header.php'; ?>
    <title>Tours | Sunrise Indonesia</title>
</head>

<body>
    <?php
    include_once '../inc/navbar.php';

    $sql = "SELECT * FROM wpzu_posts WHERE ID = $tour";
    $results = mysqli_query($con, $sql);

    while ($row =  mysqli_fetch_assoc($results)) { ?>
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2 style="margin-top: 10px;" class="post-title"> <?php echo $row["post_title"] ?> </h2>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </div>
        </div>
        <section id="content">
            <div class="container">
                <div class="row">
                    <div id="main" class="col-sm-8 col-md-9">
                        <div class="content">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    $sql2 = "SELECT meta_value AS image_id FROM wpzu_postmeta WHERE post_id = $tour AND meta_key = 'trav_gallery_imgs'";
                                    if ($results2 = mysqli_query($con, $sql2)) {
                                        $sql3 = "SELECT guid FROM wpzu_posts WHERE ";
                                        while ($row2 = mysqli_fetch_assoc($results2)) {
                                            $sql3 = $sql3 . "ID = " . $row2['image_id'] . " || ";
                                        }
                                        $sql3 = substr($sql3, 0, -3);
                                        if ($results3 = mysqli_query($con, $sql3)) {
                                            $i = 0;
                                            while ($row3 = mysqli_fetch_assoc($results3)) {
                                                $img_src = substr($row3['guid'], strpos($row3['guid'], "/wp-content") + 1);
                                    ?>
                                                <div class="carousel-item <?php if ($i == 0) {
                                                                                echo "active";
                                                                            } ?>">
                                                    <img src="/sunrise_indonesia/<?= $img_src ?>" class="d-block w-100" alt="...">
                                                </div>

                                    <?php
                                                $i++;
                                            }
                                        }
                                    }

                                    ?>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <div class="row-content">
                                <form>
                                    <div class="update-search">
                                        <h5>Check Availability</h5>
                                        <div class="row-content">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>From</label>
                                                            <input class="form-control" type="date" name="dateFrom">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>To</label>
                                                            <input class="form-control" type="date" name="dateTo">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-12">
                                                    <label class="visible-md visible-lg">&nbsp;</label>
                                                    <button type="button" class="btn btn-green btn-block">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php
                            // $dateFrom = $_POST['dateFrom'];
                            // $dateTo = $_POST['dateTo'];
                            $sql5 = "SELECT * FROM wpzu_trav_tour_schedule WHERE tour_id = $tour ";

                            if ($results5 = mysqli_query($con, $sql5)) {
                                $i = 1;
                                while ($row5 = mysqli_fetch_assoc($results5)) { ?>
                                    <div class="row-content row  grey-background ">
                                        <div class=" content-left col-sm-4 ">
                                            <div class="row">
                                                <div class="col-sm-6 mt-3">
                                                    <p class="label-detail">LOCATION</p>
                                                    <p class="label-detail">DURATION</p>
                                                    <p class="label-detail">AVAILABLE SEATS</p>
                                                    <p class="label-detail">PRICE PER ADULT</p>
                                                    <?php
                                                    if ($row5['child_price'] != 0) {
                                                        echo "<p>PRICE PER KIDS</p>";
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-sm-6 mt-3">
                                                    <?php
                                                    $sql4 = "SELECT pm.meta_value, t.name FROM wpzu_postmeta pm INNER JOIN wpzu_terms t ON pm.meta_value = t.term_id WHERE pm.post_id = $tour AND pm.meta_key = 'trav_tour_city'";

                                                    if ($results4 = mysqli_query($con, $sql4)) {
                                                        $row4 = mysqli_fetch_assoc($results4);
                                                        $name = $row4['name'];
                                                        echo "<p>$name</p>";
                                                    }

                                                    $duration = $row5['duration'];
                                                    $available = $row5['max_people'];
                                                    $price = $row5['price'];
                                                    $member_price = $row5['member_price'];
                                                    $child_price = $row5['child_price'];

                                                    echo "<p>$duration</p>";
                                                    echo "<p>$available</p>";
                                                    echo "<p>$price</p>";
                                                    if ($row5['child_price'] != 0.00) {
                                                        echo "<p>$child_price</p>";
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-sm-7 content-right">
                                            <div class="row">
                                                <div class="col-md-6 mt-3">
                                                    <label>Harga Member</label>
                                                    <?php
                                                    if ($member_price != 0) { ?>
                                                        <h5>Rp.<span <?php if ($is_logged_in) {
                                                                            $id_member = "id ='price$i'";
                                                                            echo $id_member;
                                                                        } ?>> <?php echo $member_price ?> </span></h5>
                                                    <?php }
                                                    ?>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <label>Harga Normal</label>
                                                    <h5>Rp. <span <?php if (!$is_logged_in) {
                                                                        $id_nonmember = "id ='price$i'";
                                                                        echo $id_nonmember;
                                                                    } ?>> <?php echo $price ?> </span></h5>
                                                </div>
                                            </div>
                                            <div>
                                                <form method="get" action="../booking/booking.php">
                                                    <input type="hidden" name="post_title" value="<?= $row["post_title"] ?>" />
                                                    <input type="hidden" name="location" value="<?= $name ?>" />
                                                    <input type="hidden" name="duration" value="<?= $duration ?>" />
                                                    <div class="form-row">
                                                        <div class="col-md-5 form-group">
                                                            <label>Available On</label>
                                                            <input class="form-control" type="date" name="dateTour">
                                                        </div>
                                                        <div class="col-md-2 form-group">
                                                            <label>Adults</label>
                                                            <input type="number" class="form-control" min="1" max="100" name="totalAdults" id="totalAdults<?= $i ?>" onkeyup="totalPrice<?= $i ?>()" onchange="totalPrice<?= $i ?>()" />
                                                        </div>
                                                        <div class="col-md-1 form-group">

                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <label>Total</label>
                                                            <div>
                                                                <h5 class="d-inline">Rp. </h5>
                                                                <h5 class="d-inline" id="totalPrice<?= $i ?>"></h5>
                                                                <input id="totalPrices<?= $i ?>" name="totalPrice" type="hidden" />
                                                            </div>
                                                            <button type="submit" class="btn btn-green btn-block">Book Now</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        function totalPrice<?= $i ?>() {
                                            var price<?= $i ?> = document.getElementById("price<?= $i ?>");
                                            var totalAdults<?= $i ?> = document.getElementById("totalAdults<?= $i ?>");
                                            var totalPrice<?= $i ?> = document.getElementById("totalPrice<?= $i ?>");
                                            var totalPrices<?= $i ?> = document.getElementById("totalPrices<?= $i ?>");

                                            var total<?= $i ?> = Number(price<?= $i ?>.innerHTML) * Number(totalAdults<?= $i ?>.value);
                                            totalPrice<?= $i ?>.innerHTML = total<?= $i ?>;
                                            totalPrices<?= $i ?>.value = total<?= $i ?>;
                                        }
                                    </script>
                            <?php
                                    $i++;
                                }
                            } ?>
                            <div class="row-content">
                                <p>
                                    <?php echo $row["post_content"]; ?>
                                </p>
                                <div class="accordion" id="accordionContent">
                                    <div>
                                        <strong>
                                            <button class="btn collapsed " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <span><i class="soap-icon-plus mr-1"></i></span>
                                                <span>Harga Paket</span>
                                            </button>
                                        </strong>
                                        <div id="collapseOne" class="collapse ml-2" aria-labelledby="headingOne" data-parent="#accordionContent">
                                            <p>
                                                <?php echo $row["harga_paket"]; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div>
                                        <strong>
                                            <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <span><i class="soap-icon-plus mr-1"></i></span>
                                                <span>Detail Itinerary</span>
                                            </button>
                                        </strong>
                                        <div id="collapseTwo" class="collapse ml-2" aria-labelledby="headingTwo" data-parent="#accordionContent">
                                            <p>
                                                <?php echo $row["detail_itinerary"]; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div>
                                        <strong>
                                            <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                <span><i class="soap-icon-plus mr-1"></i></span>
                                                <span>Harga Termasuk</span>
                                            </button>
                                        </strong>
                                        <div id="collapseThree" class="collapse ml-2" aria-labelledby="headingThree" data-parent="#accordionContent">
                                            <p>
                                                <?php echo $row["harga_termasuk"]; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div>
                                        <strong>
                                            <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                <span><i class="soap-icon-plus mr-1"></i></span>
                                                <span>Harga Tidak Termasuk</span>
                                            </button>
                                        </strong>
                                        <div id="collapseFour" class="collapse ml-2" aria-labelledby="headingFour" data-parent="#accordionContent">
                                            <p>
                                                <?php echo $row["harga_tidak_termasuk"]; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div>
                                        <strong>
                                            <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                <span><i class="soap-icon-plus mr-1"></i></span>
                                                <span>Force Majeur</span>
                                            </button>
                                        </strong>
                                        <div id="collapseFive" class="collapse ml-2" aria-labelledby="headingFive" data-parent="#accordionContent">
                                            <p>
                                                <?php echo $row["force_majeur"]; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <?php include_once '../inc/sidebar.php' ?>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
    <?php include_once '../inc/footer.php'; ?>
    <?php include_once '../inc/scripts.php'; ?>
</body>

</html>