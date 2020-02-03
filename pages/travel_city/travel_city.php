<?php


include_once '../../helper/connection.php';

// $travel = $_GET['travel'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../inc/header.php'; ?>
    <title>Travel Antar Kota | Sunrise Indonesia</title>
</head>

<body>
    <?php include_once '../inc/navbar.php'; ?>
    <div class="page-title">
        <div class="container">
            <h2 style="margin-top: 10px;" class="post-title">Travel Antar Kota </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="head-image"></div>
        </div>
    </div>
    </div>
    <section id="content">
        <div class="container">
            <div id="main" class="entry-content">
                <div class="row">
                    <div class="col-sm-12" style=" margin-bottom: 25px;">
                        <h4 style="font-size: 13px;" class="text-center"><strong>HARGA TRAVEL ANTAR KOTA</strong></h4>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM wpzu_trav_city WHERE id";
                    $results = mysqli_query($con, $sql);

                    while ($row =  mysqli_fetch_assoc($results)) {
                        $convert_price = $row["price"];
                        $convert_memberPrice = $row["price_member"];
                    ?>
                        <div class="col-sm-3">
                            <div class="pricing-table box <?= $row["color"] ?>">
                                <div class="box-title d-flex justify-content-between mb-3">
                                    <div class="title">
                                        <h4 style="font-size: 15px;"><?= $row["location_from"] ?> - <?= $row["location_to"] ?></h4>
                                    </div>
                                    <div class="price">
                                        <small>Jam Ganjil</small>
                                    </div>
                                </div>
                                <div class="box-title d-flex justify-content-between">
                                    <div class="price">
                                        <small>Member Price</small>
                                        <h4 style="font-size: 17px">Rp. <?= number_format($convert_memberPrice, 0, ".", ".") ?></h4>
                                    </div>
                                    <div class="price">
                                        <small>Normal Price</small>
                                        <h4 style="font-size: 17px">Rp. <?= number_format($convert_price, 0, ".", ".") ?></h4>
                                    </div>
                                </div>
                                <p></p>
                                <ul class="sizing <?= $row["color"] ?>">
                                    <?= $row["details"] ?>
                                </ul>
                                <div class="mt-3 animate-btn">
                                    <a href="../booking_travel/booking_travel.php">
                                        <span>Pesan Disini</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    <?php } ?>
                </div>
                <div style="background-color: #ffffff !important;" class="row">
                    <div class="col-sm-12" style=" margin-bottom: 25px;">
                        <div class="d-flex justify-content-between">
                            <hr class="rules">
                            <h4 style="font-size: 13px;" class="mt-3 text-center">
                                <strong>MENGAPA SUNRISE INDONESIA</strong>
                            </h4>
                            <hr class="rules">
                        </div>
                        <ul class="nav nav-tabs whySunrise mt-5" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#armada" role="tab" aria-selected="true"><i class="fas fa-car"></i> &nbsp;&nbsp;
                                    Armada Terbaik</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#price" role="tab" aria-selected="false"><i class="fas fa-money"></i> &nbsp;&nbsp;
                                    Low Price</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#legalitas" role="tab" aria-selected="false"><i class="fas fa-gavel"></i> &nbsp;&nbsp;
                                    Legalitas Jelas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#pasti" role="tab" aria-selected="false"><i class="fas fa-check-square"></i> &nbsp;&nbsp;
                                    Pasti Berangkat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#etc" role="tab" aria-selected="false"><i class="fas fa-globe"></i> &nbsp;&nbsp;
                                    Banyak Pilihan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#pelayanan" role="tab" aria-selected="false"><i class="fas fa-thumbs-up"></i> &nbsp;&nbsp;
                                    Standart Pelayanan</a>
                            </li>
                        </ul>
                        <div style="padding: 20px;" class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="armada" role="tabpanel" aria-labelledby="home-tab">
                                Disetiap rute keberangkatan untuk travel antar kota kami hanya menggunakan armada terbaik di kelasnya seperti Toyota Hi ace , Toyata Grand Innova Reborn,Toyota Grand New Avanza,Bahkan Mitsubisihi Xpander dengan hampir keselurahan armada kami adalah armada diatas tahun 2017. Untuk travel Malang Surabaya kami juga menggunakan armada terbaru di kelasnya dengan komitmen kami yang mengutamakan pelayanan kepada konsumen
                            </div>
                            <div class="tab-pane fade" id="price" role="tabpanel" aria-labelledby="profile-tab">
                                Dengan fasilitas armada terbaru dan berkualitas kami berkomitmen untuk tidak mematok harga tinggi kepada konsumen baik itu travel antara kota,travel malang surabaya ataupun sewa mobil murah. Jadi apakah anda masih ragu menggunakan jasa kami?
                            </div>
                            <div class="tab-pane fade" id="legalitas" role="tabpanel" aria-labelledby="contact-tab">
                                Bagi anda yang masih ragu tentang kami atau pelayanan kami anda tidak perlu khawatir karena perusahaan kami sudah jelas berbadan hukum dan mempunyai legalitas perijinan yang lengkap dan sudah banyak customer yang kami layani baik itu family,corporate,pribadi bahkan perusahaan besar sekelas traveloka juga sudah bekerjasama dengan kami . Semuanya sudah puas dengan jasa pelayanan kami baik itu untuk jasa paket wisata batu , paket wisata bromo , paket wisata bali open trip bromo midnight tour , paket wisata karimun jawa dan banyak paket wisata lainnya yang kami sediakan.
                            </div>
                            <div class="tab-pane fade" id="pasti" role="tabpanel" aria-labelledby="contact-tab">
                                Untuk anda yang khawatir ketika memesan travel antar kota , travel Malang Surabaya hanya untuk 1 orang. Anda tidak usah khawatir karena setiap hari ketika ada pemberangkatan kami akan selalu komitmen memberangkatkan perjalanan anda meskipun hanya 1 orang selama seat tidak penuh.
                            </div>
                            <div class="tab-pane fade" id="etc" role="tabpanel" aria-labelledby="contact-tab">
                                Ketika perjalanan anda membutuhkan privasi dan tidak ingin digabung dengan penumpang lain,kami juga menyediakan carter drop kemanapun tujuan anda baik itu antar kota antar propinsi, antar kota ataupun travel malang juanda. Dan bagi anda wisatawan atau seorang bussinesman yang membutuhkan sewa mobil murah dengan fasilitas all include kami juga menyediakan apapun kebutuhan kendaraan anda.
                            </div>
                            <div class="tab-pane fade" id="pelayanan" role="tabpanel" aria-labelledby="contact-tab">
                                Kami memiliki standart pelayanan prosedur untuk pegawai kami baik itu untuk pelayanan dan etika ketika bekerja. Jadi semua pegawai kami baik itu driver,tour guide,runner dan customer service memiliki standart pelayanan pariwisata.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <?php include_once '../inc/footer.php'; ?>
    <?php include_once '../inc/scripts.php'; ?>
</body>


</html>