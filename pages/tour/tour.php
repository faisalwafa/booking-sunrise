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
                                                    <img src="/sunrise/<?= $img_src ?>" class="d-block w-100" alt="...">
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
                                                            <input class="form-control" type="date">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>To</label>
                                                            <input class="form-control" type="date">
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