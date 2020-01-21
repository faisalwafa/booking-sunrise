<?php
$is_logged_in = isset($_SESSION['user_id']);
?>

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
                    <?php
                    if ($is_logged_in) {
                    ?>
                        <li class="nav-item active">
                            <a class="nav-link text-white mr-3" href="/booking-sunrise/pages/auth/logout.php">Logout</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item active">
                            <a class="nav-link text-white mr-3" href="/booking-sunrise/pages/auth/auth.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/booking-sunrise/pages/auth/auth.php">Register</a>
                        </li>
                    <?php } ?>
            </div>
        </div>
    </nav>
</div>