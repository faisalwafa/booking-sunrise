<<<<<<< HEAD
<div class="main-header">
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="https://sunrise-indonesia.com/">
                <img src="/booking-sunrise/assets/logo.jpg" alt="logo" class="navbar-img">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSunrise" aria-controls="navbarSunrise" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse item-list" id="navbarSunrise">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link mr-3" href="https://sunrise-indonesia.com/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-3" href="https://sunrise-indonesia.com/info-wisata-indonesia/">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-3" href="#">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Register</a>
                    </li>
            </div>
=======
<?php
$is_logged_in = isset($_SESSION['user_id']);
?>
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="/booking-sunrise/assets/logo.jpg" alt="logo" class="navbar-img">
            <!-- <img src="/assets/logo.jpg" alt="logo" class="navbar-img"> -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSunrise" aria-controls="navbarSunrise" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSunrise">
            <ul class="navbar-nav ml-auto">
                <?php
                if ($is_logged_in) {
                ?>
                    <li class="nav-item active">
                        <a class="nav-link text-white mr-3" href="/booking-sunrise/pages/auth/logout.php">Logout</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item active">
                        <a class="nav-link text-white mr-3" href="#">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Register</a>
                    </li>
                <?php } ?>
>>>>>>> 75bb589b80b8c72dfaf71b20280029ad654a681a
        </div>
    </nav>
</div>