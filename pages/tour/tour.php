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
                <h2 style="margin-top: 10px;" class="post-title"> <?php echo $row["post_title"] ?> </h2>
            </div>
<<<<<<< HEAD
        </div><br><br>
        <section id="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-9">
                        <div class="content">
                            <div>
                                <img src="https://dummyimage.com/900x500/000/fff" class="img-fluid" alt="Responsive image">
=======
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
>>>>>>> 75bb589b80b8c72dfaf71b20280029ad654a681a
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <input class="form-control" type="date">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" type="date">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </div>
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
                        <div class="content mt-4 p-2">
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
        </section>
    <?php } ?>
    <?php include_once '../inc/footer.php'; ?>
    <?php include_once '../inc/scripts.php'; ?>
</body>

</html>