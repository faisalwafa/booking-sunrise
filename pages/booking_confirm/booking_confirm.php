<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../inc/header.php'; ?>
    <title>Tour Booking Confirmation | Sunrise Indonesia</title>
</head>

<body>
    <?php include_once '../inc/navbar.php'; ?>
    <div class="page-title">
        <div class="container">
            <h2 style="margin-top: 10px;" class="post-title">Tour Booking Confirmation </h2>
        </div>
    </div>
    <section id="content">
        <div class="container">
            <div id="main" class="entry-content">
                <div class="row">
                    <div class="col-sm-8 col-md-9">
                        <div class="booking-information">
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
                                <dd>test</dd>
                                <dt>E-mail Address : </dt>
                                <dd>test</dd>
                                <dt>Tour Date : </dt>
                                <dd>test</dd>
                                <dt>Adults : </dt>
                                <dd>test</dd>
                            </dl>
                            <hr>
                            <dl class="term-description" style="font-size: 16px;">
                                <dt style="text-transform: none;">Total Price : </dt>
                                <dd><b style="color: #2d3e52">1.000.000</b></dd>
                            </dl>
                            <hr>
                            <h3 style="font-size: 18px;">Tours Details</h3>
                            <h4 style="font-size: 16px;">
                                <a href="#">Open Trip Example</a>
                            </h4>
                            <dl class="term-description">
                                <dt>Country : </dt>
                                <dd>test</dd>
                                <dt>City : </dt>
                                <dd>test</dd>
                                <dt>Cancellation : </dt>
                                <dd>
                                    <a href="https://sunrise-indonesia.com/booking-terms-condition/">
                                        Cek syarat dan ketentuan apabila anda ingin refund.
                                    </a>
                                </dd>
                            </dl>
                            <hr>
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
                                    <a href="#">
                                        Cancel Your Booking
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