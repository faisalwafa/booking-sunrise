<?php
$is_logged_in = isset($_SESSION['user_id']);
?>

<div class="main-header">
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="https://sunrise-indonesia.com/">
                <img src="../../assets/logo.jpg" alt="logo" class="navbar-img">
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
                        <a class="nav-link mr-3" href="https://sunrise-indonesia.com/paket-wisata">Paket Wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-3" href="https://sunrise-indonesia.com/rent-car">Rent Car</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-3" href="https://sunrise-indonesia.com/travel-malang-surabaya">Travel Antar Kota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-3" href="https://sunrise-indonesia.com/info-wisata-indonesia/">Blog</a>
                    </li>
                    <?php
                    if ($is_logged_in) {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="user-info" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $_SESSION['display_name'] ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="user-info">
                                <?php if ($_SESSION['user_level'] == 10) {
                                ?>
                                    <a class="dropdown-item navbar-dropdown-item" href="../admin/admin.php">Panel Admin</a>
                                <?php } else { ?>
                                    <a class="dropdown-item navbar-dropdown-item" href="../profile/profile.php">Profil</a>
                                    <a class="dropdown-item navbar-dropdown-item" href="../profile/profile_booking.php">Booking</a>
                                    <div class="dropdown-divider"></div>
                                <?php } ?>
                                <a class="dropdown-item navbar-dropdown-item" href="../auth/logout.php">Logout</a>
                            </div>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item active">
                            <a class="nav-link text-white mr-3" href="/booking-sunrise/pages/auth/auth.php?tour=<?= $_GET['tour'] ?>">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/booking-sunrise/pages/auth/auth.php">Register</a>
                        </li>
                    <?php } ?>
            </div>
        </div>
    </nav>
</div>