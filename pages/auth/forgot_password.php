<?php
$is_input_email = 1;
if (!isset($_GET['u'])) {
    $is_input_email = 1;
} else if ($_GET['u'] == 'sent') {
    $is_input_email = 2;
} else {
    $is_input_email = 3;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../inc/header.php'; ?>
    <title>Lupa Password | Sunrise Indonesia</title>
</head>

<body class="min-vh-100 bg-light">
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card w-50">
            <div class="card-body">
                <?php
                switch ($is_input_email) {
                    case 1:
                        # code...
                ?>
                        <h6 class="text-center mb-3">Masukkan Email anda untuk mendapatkan link untuk mengganti password anda</h6>
                        <?php
                        if (isset($_GET['pesan'])) { ?>
                            <div class="alert alert-light" role="alert">
                                <strong class="text-danger"><?= $_GET['pesan'] ?></strong> Coba tulis email lagi dengan benar
                            </div>
                        <?php
                        }
                        ?>
                        <form action="email_handler.php" method="POST">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="forgot-password-email" class="form-control" id="forgot-password-email" required>
                            </div>
                            <button type="submit" class="btn btn-block btn-orange">Kirim Email</button>
                        </form>
                    <?php
                        break;
                    case 2:
                        # code...
                    ?>
                        <div class="text-center">
                            <!-- <img src="/booking-sunrise/assets/verified.png" alt="verified-icon" height="60"> -->
                            <img src="/assets/verified.png" alt="verified-icon" height="60">
                            <h6 class="mt-3"><span class="text-greem">Email Berhasil terkirim.</span> Silahkan cek inbox email anda (atau di dalam folder spam jika tidak ada di dalam inbox)</h6>
                        </div>
                    <?php
                        break;
                    case 3:
                        # code...
                    ?>
                        <form id="formForgotPassword">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" readonly class="form-control-plaintext" id="forgot-password-email" value=<?= $_GET['u'] ?>>
                            </div>
                            <div class="form-group">
                                <label for="forgot-password-password">Password</label>
                                <input type="password" class="form-control" id="forgot-password-password" class="form-control" onfocusout="checkForgotPasswordPassword()">
                                <small class="invalid-feedback" id="forgot-password-password-feedback">Password tidak boleh kosong</small>
                            </div>
                            <div class="form-group">
                                <label for="forgot-password-passwordConfirm">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="forgot-password-passwordConfirm" class="form-control" onfocusout="checkForgotPasswordPasswordConfirm()" onkeyup="checkForgotPasswordPasswordConfirm()">
                                <div class="invalid-feedback">
                                    Password tidak cocok
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-orange">Ganti Password</button>
                        </form>
                <?php
                        break;
                }
                ?>
            </div>
        </div>
    </div>
    <?php include_once '../inc/scripts.php'; ?>
    <script src="/js/forgotPassword.js"></script>
    <!-- <script src="/booking-sunrise/js/forgotPassword.js"></script> -->
</body>

</html>