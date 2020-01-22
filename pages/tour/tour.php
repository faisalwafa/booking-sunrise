<?php
session_start();

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
                        <h2 class="post-title"> <?php echo $row["post_title"] ?> </h2>
                    </div>
                    <div class="col-md-6">
                        <a href="add-schedule.php?tour=<?= $tour ?>">
                            <button class="btn btn-primary">Add Schedule</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-9">
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
                            <h5>Check Availability</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    From
                                </div>
                                <div class="col-md-4">
                                    To
                                </div>
                            </div>
                            <form method="post" action="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input class="form-control" type="date" name="dateFrom">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" type="date" name="dateTo">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-success" id="check">Check</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php

                        // $dateFrom = $_POST['dateFrom'];
                        // $dateTo = $_POST['dateTo'];

                        $sql5 = "SELECT duration , max_people , price , child_price FROM wpzu_trav_tour_schedule WHERE tour_id = $tour ";

                        if ($results5 = mysqli_query($con, $sql5)) {

                            while ($row5 = mysqli_fetch_assoc($results5)) { ?>
                                <div class="row-content row  grey-background ">
                                    <div class=" content-left col-sm-4 ">
                                        <div class="row">
                                            <div class="col-sm-6">
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
                                            <div class="col-sm-6">
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
                                            <div class="col-md-6">
                                                <label>Harga Member</label>
                                                <h5>Rp. </h5>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Harga Normal</label>
                                                <h5>Rp. </h5>
                                            </div>
                                        </div>
                                        <div>
                                            <form>
                                                <div class="form-row">
                                                    <div class="col-md-5 form-group">
                                                        <label>Available On</label>
                                                        <input class="form-control" type="date">
                                                    </div>
                                                    <div class="col-md-2 form-group">
                                                        <label>Adults</label>
                                                        <input type="number" class="form-control" min="1" max="100" />
                                                    </div>
                                                    <div class="col-md-2 form-group">
                                                        <?php
                                                        if ($row5['child_price'] != 0.00) { ?>
                                                            <label>Kids</label>
                                                            <input type="number" class="form-control" min="1" max="100" />
                                                        <?php }
                                                        ?>
                                                    </div>
                                                    <div class="col-md-3 form-group">
                                                        <label>Total</label>
                                                        <h5>Rp.</h5>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                        <div class="row-content">
                            <p>
                                <!-- <textarea id="editor" placeholder="" autofocus> -->
                                <?php echo $row["post_content"]; ?>
                                <!-- </textarea> -->
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
                                            <!-- <textarea id="editor" placeholder="" autofocus> -->
                                            <?php echo $row["harga_paket"]; ?>
                                            <!-- </textarea> -->
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
                                            <!-- <textarea id="editor" placeholder="" autofocus> -->
                                            <?php echo $row["detail_itinerary"]; ?>
                                            <!-- </textarea> -->
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
                                            <!-- <textarea id="editor" placeholder="" autofocus> -->
                                            <?php echo $row["harga_termasuk"]; ?>
                                            <!-- </textarea> -->
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
                                            <!-- <textarea id="editor" placeholder="" autofocus> -->
                                            <?php echo $row["harga_tidak_termasuk"]; ?>
                                            <!-- </textarea> -->
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
                                            <!-- <textarea id="editor" placeholder="" autofocus> -->
                                            <?php echo $row["force_majeur"]; ?>
                                            <!-- </textarea> -->
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class=" content p-2">
                        <h6 class="p-1">Last Minute Deals</h6>
                        <div class="row px-2">
                            <div class="col-md-5">
                                <img src="https://dummyimage.com/600x400/000/fff&text=dummy_image" class="img-fluid" alt="Responsive image">
                            </div>
                            <div>
                                <p>tes</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row px-2">
                            <div class="col-md-5">
                                <img src="https://dummyimage.com/600x400/000/fff&text=dummy_image" class="img-fluid" alt="Responsive image">
                            </div>
                            <div>
                                <p>tes</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row px-2">
                            <div class="col-md-5">
                                <img src="https://dummyimage.com/600x400/000/fff&text=dummy_image" class="img-fluid" alt="Responsive image">
                            </div>
                            <div>
                                <p>tes</p>
                            </div>
                        </div>
                    </div>
                    <div class=" content mt-4 p-2">
                        <h6 class="p-1">Kenapa Booking Melalui Kami?</h6>
                        <div class="row px-2">
                            <div class="col-md-5">
                                <img src="https://dummyimage.com/600x400/000/fff&text=dummy_image" class="img-fluid" alt="Responsive image">
                            </div>
                            <div>
                                <p>tes</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row px-2">
                            <div class="col-md-5">
                                <img src="https://dummyimage.com/600x400/000/fff&text=dummy_image" class="img-fluid" alt="Responsive image">
                            </div>
                            <div>
                                <p>tes</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row px-2">
                            <div class="col-md-5">
                                <img src="https://dummyimage.com/600x400/000/fff&text=dummy_image" class="img-fluid" alt="Responsive image">
                            </div>
                            <div>
                                <p>tes</p>
                            </div>
                        </div>
                    </div>
                    <div class=" content mt-4 p-2">
                        <h6 class="p-1">Butuh Bantuan Kami ?</h6>
                        <p>Teman Setia Perjalanan Wisata Anda, dengan senang hati kami melayani anda dengan support customer service 24/7</p>
                        <h4 class="contact p-2"> +6287 777 890 888</h4>
                        <a class="email" href="mailto:info@sunrise-indonesia.com">info@sunrise-indonesia.com</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php include_once '../inc/footer.php'; ?>
    <?php include_once '../inc/scripts.php'; ?>
</body>

</html>