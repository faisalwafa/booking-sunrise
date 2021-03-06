<?php

session_start();

include_once '../../helper/connection.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/auth.php");
}

$user = $_SESSION["user_id"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../inc/header.php'; ?>
    <link rel="stylesheet" type="text/css" href="../../css/profile.css">
    <title>Profile | Sunrise Indonesia</title>
</head>

<body>
    <?php
    include_once '../inc/navbar.php'; ?>
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 style="margin-top: 10px;" class="post-title"> Akun Saya </h2>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </div>
    <div class="container pt-4 w-100 overflow-hidden">
        <div class="content d-flex align-items-stretch">
            <nav id="sidebar">
                <div class="custom-menu">
                    <button type="button" id="sidebarCollapse" class="d-sm-block d-md-none btn btn-primary">
                    </button>
                </div>

                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="profile.php" class="font-weight-bold"><i class="fas fa-user-alt mr-3 py-2 profile-icon"></i> Profile</a>
                    </li>
                    <li>
                        <a href="profile_booking.php" class="font-weight-bold"><i class="fas fa-map-marked-alt mr-3 py-2 profile-icon"></i> Riwayat Booking Tour</a>
                    </li>
                    <li>
                        <a href="profile_booking.php" class="font-weight-bold"><i class="fas fa-route mr-3 py-2 profile-icon"></i> Riwayat Booking Travel</a>
                    </li>
                    <li>
                        <a href="../auth/logout.php" class="font-weight-bold"><i class="fa fa-sign-out mr-3 py-2 profile-icon"></i> Sign Out</a>
                    </li>
                </ul>

            </nav>
            <?php
            $query = "SELECT * FROM wpzu_users WHERE ID = $user";
            $query2 = "SELECT * FROM wpzu_usermeta WHERE (user_id = $user) AND (meta_key='first_name' OR meta_key='last_name')";
            $result_user = mysqli_query($con, $query);
            $result_usermeta = mysqli_query($con, $query2);

            while ($data_user =  mysqli_fetch_assoc($result_user)) {
                $first_name;
                $last_name;
                $index = 0;
                while ($data_usermeta =  mysqli_fetch_assoc($result_usermeta)) {
                    if ($index == 0) {
                        $first_name = $data_usermeta['meta_value'];
                    } else {
                        $last_name = $data_usermeta['meta_value'];
                    }
                    $index++;
                }
            ?>
                <div id="content" class="p-4 p-md-5 pt-5 w-100 account overflow-hidden">
                    <div class="row">
                        <div class="col-md-4 d-flex justify-content-between">
                            <h2 class="">Info Pribadi</h2>
                            <div class="iconEdit">
                                <a href="#" onclick="displayFormProfile()">
                                    <h2><i class="fas fa-edit"></i> Edit</h2>
                                </a>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 mb-4">Info dasar, seperti nama dan email, yang <?php echo $first_name ?> gunakan di Sunriser.</p>
                    <?php if (isset($_GET['success-profile']) && $_GET['success-profile'] == 'false') {
                    ?>
                        <div class="alert alert-light alert-dismissible fade show" role="alert" id="alert-failed-daftar">
                            <strong class="text-danger">Update Profil Gagal!</strong> <span id="profil-update-failed-feedback"><?= $_GET['message'] ?></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <hr class="mb-4">
                    <div class="profile" id="profile" style="display: block">
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <h6 class="float-md-left">First name</h6>
                                <p class="float-md-right"><?php echo $first_name ?></p>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5 mb-3">
                                <h6 class="float-md-left">Username</h6>
                                <p class="float-md-right"><?php echo $data_user["user_nicename"] ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <h6 class="float-md-left">Last name</h6>
                                <p class="float-md-right"><?php echo $last_name ?></p>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5 mb-3">
                                <h6 class="float-md-left">Email</h6>
                                <p class="float-md-right"><?php echo $data_user["user_email"] ?></p>
                            </div>
                        </div>
                    </div>

                    <form class="profile" id="profileForm" style="display: none">
                        <div class="form-row">
                            <div class="col-md-5 col-sm-12">
                                <div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6>First name</h6>
                                        </div>
                                        <div class="col-md-7 mb-4">
                                            <input type="text" class="form-control" value="<?php echo $first_name ?>" id="profile-firstName" onfocusout="checkUpdateFirstName()">
                                            <small class="invalid-feedback">Nama Depan tidak boleh kosong</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6>Last name</h6>
                                        </div>
                                        <div class="col-md-7 mb-4">
                                            <input type="text" class="form-control" value="<?php echo $last_name ?>" id="profile-lastName" onfocusout="checkUpdateLastName()">
                                            <small class="invalid-feedback">Nama Belakang tidak boleh kosong</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5 col-sm-12 mb-3">
                                <div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6>Username</h6>
                                        </div>
                                        <div class="col-md-7 mb-4">
                                            <input type="text" class="form-control" value="<?php echo $data_user["user_nicename"] ?>" id="profile-username" onfocusout="checkUpdateUsername()">
                                            <div class="invalid-feedback" id="profile-username-feedback">
                                                Username tidak boleh kosong
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6>Email</h6>
                                        </div>
                                        <div class="col-md-7 mb-4">
                                            <input type="text" class="form-control" value="<?php echo $data_user["user_email"] ?>" id="profile-email" onfocusout="checkUpdateEmail()">
                                            <div class="invalid-feedback" id="profile-email-feedback">
                                                Email tidak boleh kosong
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-orange float-right">Update</button>
                            </div>
                        </div>
                    </form>

                    <div class="security-content">
                        <div class="row">
                            <div class="col-md-12 mt-3 mb-4 separator">
                                <hr id="myForm">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-3 d-flex justify-content-between">
                                <h2 class="">Keamanan Akun</h2>
                                <div class="iconEdit">
                                    <a href="#myForm" onclick="displayFormChangePw()">
                                        <h2><i class="fas fa-key"></i> Edit</h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <p class="mt-2 mb-4">Sebaiknya gunakan kata sandi yang kuat yang tidak <?php echo $first_name ?> gunakan di tempat lain.</p>
                        <?php if (isset($_GET['success-password']) && $_GET['success-password'] == 'false') {
                        ?>
                            <div class="alert alert-light alert-dismissible fade show" role="alert" id="alert-failed-daftar">
                                <strong class="text-danger">Update Password Gagal!</strong> <span id="profil-update-failed-feedback"><?= $_GET['message'] ?></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>
                        <hr class="mb-4">
                        <form class="securityForm" id="passwordForm" style="display: none">
                            <div class="form-row">
                                <div class="col-md-5 col-sm-12">
                                    <div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <h6>Password Lama</h6>
                                            </div>
                                            <div class="col-md-7 mb-4">
                                                <input type="password" class="form-control" id="profile-oldPassword">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <h6>Password Baru</h6>
                                            </div>
                                            <div class="col-md-7 mb-4">
                                                <input type="password" class="form-control" id="profile-newPassword" onfocusout="checkUpdateNewPassword()">
                                                <small class="invalid-feedback" id="profile-newPassword-feedback">Password baru tidak boleh kosong</small>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <h6>Konfirmasi Password Baru</h6>
                                            </div>
                                            <div class="col-md-7 mb-4">
                                                <input type="password" class="form-control" id="profile-confirmPassword" onfocusout="checkUpdateNewPasswordConfirm()" onkeyup="checkUpdateNewPasswordConfirm()">
                                                <div class="invalid-feedback">
                                                    Password baru tidak cocok
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                            </div>
                                            <div class="col-md-7 mb-4">
                                                <button type="submit" class="btn btn-orange float-right">Change</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-5 col-sm-12 mb-3">
                                </div>
                            </div>
                        </form>
                    </div>
                <?php } ?>
                </div>

        </div>

    </div>
    <?php include_once '../inc/footer.php'; ?>
    <?php include_once '../inc/scripts.php'; ?>
    <script src="../../js/profile.js"></script>
</body>

</html>