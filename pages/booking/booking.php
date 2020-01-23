<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../inc/header.php'; ?>
    <title>Tours | Sunrise Indonesia</title>
</head>

<body>
    <?php include_once '../inc/navbar.php'; ?>
    <div class="page-title">
        <div class="container">
            <h2 style="margin-top: 10px;" class="post-title">Tour Booking </h2>
        </div>
    </div>
    <section id="content">
        <div class="container">
            <div id="main" class="entry-content">
                <div class="row">
                    <div class="col-sm-8 col-md-9">
                        <div class="booking-section">
                            <div class="person-information">
                                <h2 class="mb-4">Your Personal Information</h2>
                                <form class="booking-form">
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5 mb-3">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" id="">
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" id="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5 mb-3">
                                            <label>Email Address</label>
                                            <input type="email" class="form-control" id="">
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Verify E-mail Address</label>
                                            <input type="email" class="form-control" id="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5 mb-3">
                                            <label>Country Code</label>
                                            <input type="text" class="form-control" id="">
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control" id="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5 mb-3">
                                            <label>Address</label>
                                            <input type="text" class="form-control" id="">
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>City</label>
                                            <input type="text" class="form-control" id="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5 mb-3">
                                            <label>Zip Code</label>
                                            <input type="text" class="form-control" id="">
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Country</label>
                                            <input type="text" class="form-control" id="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-11 mb-3">
                                            <label>Special requirements</label>
                                            <textarea class="form-control" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="ml-3 col-sm-12 col-md-4">
                                            <div class="g-recaptcha" data-sitekey="6LcU9NEUAAAAAGeXmHn9x9Vs-KA5a_DYM0Ts6hLD"></div>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <label>Security Code</label>
                                            <input type="text" class="form-control" id="">
                                        </div>
                                    </div>
                                    <hr style="margin-top: 45px">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input value="agree" type="checkbox" checked>
                                                By Continuing, you agree to the
                                                <a href="https://sunrise-indonesia.com/booking-terms-condition/" target="_blank">
                                                    Terms and Conditions.
                                                </a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <button type="submit" class="btn btn-green btn-block">CONFIRM BOOKING</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="booking-details">
                            <h4>Booking Details</h4>
                            <div class="d-flex align-items-start">
                                <div class="mr-2">
                                    <img src="https://dummyimage.com/75x75/000/fff" alt="thumbnail-image" width="75" height="75">
                                </div>
                                <div class="ml-2">
                                    <a class="text-decoration-none" href="https://sunrise-indonesia.com/tour/open-trip-bromo-midnight-tour/">
                                        Open Trip Bromo Midnight Tour
                                    </a>
                                    <span>
                                        <span>
                                            <button class="d-inline btn btn-green">Edit</button>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <hr>
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