<?php

session_start();

include_once '../../helper/connection.php';

$booking = $_GET['booking_confirm'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php include_once '../inc/header.php'; ?>
    <title>Travel Antar Kota Booking Confirmation | Sunrise Indonesia</title>
</head>

<body>
    <?php include_once '../inc/navbar.php'; ?>
    <div class="page-title">
        <div class="container">
            <h2 style="margin-top: 10px;" class="post-title">Travel Antar Kota Booking Confirmation </h2>
        </div>
    </div>
    <section id="content">
        <div class="container">
            <div id="main" class="entry-content">
                <div class="row">
                    <div class="col-sm-8 col-md-9">
                        <div class="booking-information">
                            <?php
                            $query = "SELECT b.id, location_to, location_from, booking_no, first_name, last_name, email, country, phone, pax, 
                        pick_up_date, pick_up_time, pick_up_location, special_requirements, total_price, date, status FROM wpzu_trav_city_bookings b 
                        INNER JOIN wpzu_trav_city p ON b.travel_id = p.id WHERE b.booking_no = $booking";
                            $results = mysqli_query($con, $query);

                            $row = mysqli_fetch_assoc($results)

                            ?>
                            <h2 class="mb-4">Booking Confirmation</h2>
                            <hr>
                            <div class="booking-confirmation d-flex">
                                <i class="soap-icon-recommend icon circle">
                                </i>
                                <div class="message" style="margin: 0">
                                    <h4 class="main-message">
                                        Thank You. Your Booking Order is Confirmed Now.
                                    </h4>
                                    <p style="margin: 0px">A confirmation email has been sent to your provided email address.</p>
                                </div>
                            </div>
                            <hr>
                            <h3 style="font-size: 18px;">Check Your Details</h3>
                            <dl class="term-description">
                                <dt>Booking Number : </dt>
                                <dd><?= $row['booking_no'] ?></dd>
                                <dt>E-mail Address : </dt>
                                <dd><?= $row['email'] ?></dd>
                                <dt>Phone : </dt>
                                <dd><?= $row['phone'] ?></dd>
                                <dt>Booking Date : </dt>
                                <dd><?= $row['date'] ?></dd>
                                <dt>Pick-Up Date : </dt>
                                <dd><?= $row['pick_up_date'] ?></dd>
                                <dt>Pax : </dt>
                                <dd><?= $row['pax'] ?></dd>
                                <dt>Pick-Up Time : </dt>
                                <dd><?= $row['pick_up_time'] ?></dd>
                                <dt>Pick-Up Location : </dt>
                                <dd><?= $row['pick_up_location'] ?></dd>
                                <dt>Drop-Off Location : </dt>
                                <dd><?= $row['location_to'] ?></dd>
                                <dt>Special Requirements : </dt>
                                <dd><?= $row['special_requirements'] ?></dd>
                            </dl>
                            <hr>
                            <dl class="term-description" style="font-size: 16px;">
                                <dt style="text-transform: none; font-size: 16px; font-weight: 600">Total Price : </dt>
                                <dd><b style="color: #2d3e52; font-size: 16px; font-weight: 600"">Rp. <?= number_format($row['total_price'], 0, ".", ".") ?></b></dd>
                            </dl>
                            <hr>
                            <h3 style=" font-size: 18px;">Travel Antar Kota Details</h3>
                                        <h4 style="font-size: 16px;">
                                            <a href="../travel_city/travel_city.php" target="_blank"><?= $row["location_from"] ?> - <?= $row["location_to"] ?></a>
                                        </h4>
                                        <dl class="term-description">
                                            <dt>Country : </dt>
                                            <dd><?= $row["country"] ?></dd>
                                            <dt>Cancellation : </dt>
                                            <dd>
                                                <a href="https://sunrise-indonesia.com/booking-terms-condition/">
                                                    Cek syarat dan ketentuan apabila anda ingin refund.
                                                </a>
                                            </dd>
                                        </dl>
                                        <hr>
                                        <h3 class="text-center" style="font-size: 18px; font-weight: 900;">Payment Methods</h3>
                                        <div style=" margin-right: 40px;">
                                            <div class="d-flex justify-content-around mt-4">
                                                <div>
                                                    <h3 style="font-size: 15px; margin-right: 17px;">Rekening Pembayaran&nbsp; | &nbsp;BCA</h3>
                                                </div>
                                                <div>
                                                    <h3 style="font-size: 15px;">Rekening Pembayaran&nbsp; | &nbsp;Mandiri</h3>
                                                </div>
                                            </div>
                                            <div class="row d-flex justify-content-around mt-2">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-5 col-sm-12 mb-sm-3">
                                                    <dl class="term-description">
                                                        <dt>Account Holder : </dt>
                                                        <dd>Dery Okky Pratama</dd>
                                                        <dt>Account Number : </dt>
                                                        <dd>8160987651</dd>
                                                        <dt>Branch : </dt>
                                                        <dd>BCA Borobudur Malang</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-md-1"></div>
                                                <div class="col-md-5 col-sm-12">
                                                    <dl class="term-description">
                                                        <dt>Account Holder : </dt>
                                                        <dd>Dery Okky Pratama</dd>
                                                        <dt>Account Number : </dt>
                                                        <dd>144-00-1673900-2</dd>
                                                        <dt>Branch : </dt>
                                                        <dd>Mandiri Borobudur Malang</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="margin: 0;">
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="edit-booking">
                            <h4 style="font-size: 16px;">
                                Is Everything Correct ?
                            </h4>
                            <p style="font-size: 13px; margin-bottom: 15px;">You can always view or cancel your booking online - no registration required</p>
                            <ul>
                                <li>
                                    <form action="booking_travel_confirm_action.php" method="POST">
                                        <input type="hidden" name="id_booking" value="<?= $row['id'] ?>">
                                        <button <?php if ($row['status'] == 1) {
                                                    echo 'type = "submit"';
                                                } ?> class="btn-block btn btn-outline-secondary <?php if ($row['status'] != 1) {
                                                                                                    echo "disabled";
                                                                                                } ?>" <?php if ($row['status'] != 1) {
                                                                                                            echo 'onclick="event.preventDefault();"';
                                                                                                        } ?>>Cancel Your Booking</button>
                                    </form>
                                    </a>
                                </li>
                            </ul>
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