<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: ../tour/tour.php?tour=38211");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../inc/header.php'; ?>
    <title>Autentikasi | Sunrise Indonesia</title>
</head>

<body class="bg-login min-vh-100">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-sm-none d-md-block"></div>
            <div class="col-md-6 col-sm-12 d-flex flex-column align-items-center mt-5">
                <div class="card mh-100 w-75 mb-3 rounded">
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3 py-2 rounded text-center" id="pills-tab" role="tablist">
                            <li class="nav-item col-6 border-right border-orange">
                                <a class="nav-link active" id="pills-daftar-tab" data-toggle="pill" href="#pills-daftar" role="tab" aria-controls="pills-daftar" aria-selected="true">
                                    <h6>Daftar</h6>
                                </a>
                            </li>
                            <li class="nav-item col-6 border-left border-orange">
                                <a class="nav-link" id="pills-masuk-tab" data-toggle="pill" href="#pills-masuk" role="tab" aria-controls="pills-masuk" aria-selected="false">
                                    <h6>Masuk</h6>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-daftar" role="tabpanel" aria-labelledby="pills-daftar-tab">
                                <div class="alert alert-light" role="alert" style="display: none" id="alert-failed-daftar">
                                    <strong class="text-danger">Pendaftaran Gagal!</strong> <span id="daftar-failed-feedback"></span>
                                </div>
                                <form id="formRegister">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="register-firstName">Nama Depan</label>
                                            <input type="text" class="form-control" id="register-firstName" onfocusout="checkRegisterFirstName()">
                                            <small class="invalid-feedback">Nama Depan tidak boleh kosong</small>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="register-lastName">Nama Belakang</label>
                                            <input type="text" class="form-control" id="register-lastName" onfocusout="checkRegisterLastName()">
                                            <small class="invalid-feedback">Nama Belakang tidak boleh kosong</small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="register-username">Username</label>
                                        <input type="text" class="form-control" id="register-username" onfocusout="checkRegisterUsername()">
                                        <div class="invalid-feedback" id="register-username-feedback">
                                            Username tidak boleh kosong
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="register-email">Email</label>
                                        <input type="email" class="form-control" id="register-email" onfocusout="checkRegisterEmail()">
                                        <div class="invalid-feedback" id="register-email-feedback">
                                            Email tidak boleh kosong
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="register-password">Password</label>
                                        <input type="password" class="form-control" id="register-password" class="form-control" onfocusout="checkRegisterPassword()">
                                        <small class="invalid-feedback" id="register-password-feedback">Password tidak boleh kosong</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="register-passwordConfirm">Konfirmasi Password</label>
                                        <input type="password" class="form-control" id="register-passwordConfirm" class="form-control" onfocusout="checkRegisterPasswordConfirm()" onkeyup="checkRegisterPasswordConfirm()">
                                        <div class="invalid-feedback">
                                            Password tidak cocok
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-block btn-orange">Daftar</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-masuk" role="tabpanel" aria-labelledby="pills-masuk-tab">
                                <div class="alert alert-light alert-dismissible fade show" role="alert" style="display: none" id="alert-login">
                                    <strong class="text-green">Pendaftaran berhasil!</strong> Silahkan login.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="alert alert-light" role="alert" style="display: none" id="alert-failed-login">
                                    <strong class="text-danger">Login Gagal!</strong> <span id="login-failed-feedback"></span>
                                </div>
                                <form id="formLogin">
                                    <div class="form-group">
                                        <label for="login-email">Email / Username</label>
                                        <input type="text" class="form-control" id="login-username" onfocusout="checkLoginUsername()">
                                        <div class="invalid-feedback">Username tidak boleh kosong</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="login-password">Password</label>
                                        <input type="password" class="form-control" id="login-password" onfocusout="checkLoginPassword()">
                                        <small class="invalid-feedback">Password tidak boleh kosong</small>
                                    </div>
                                    <a class="text-dark" href="forgot_password.php">Lupa password?</a>
                                    <button type="submit" class="btn btn-orange btn-block mt-2">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once '../inc/scripts.php'; ?>
    <!-- <script src="/js/auth.js"></script> -->
    <script src="/booking-sunrise/js/auth.js"></script>
</body>

</html>