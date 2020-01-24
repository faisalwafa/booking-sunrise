<?php
session_start();

include_once '../../helper/connection.php';
include_once '../../helper/response.php';

$user_id =  $_SESSION['user_id'];

$response;

if (isset($_POST['update_password'])) {
    include_once '../../helper/PasswordHash.php';
    $t_hasher = new PasswordHash(8, TRUE);

    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    $sql_check_old_password = "SELECT user_pass FROM wpzu_users WHERE ID = $user_id";
    $row_check_old_password = mysqli_fetch_assoc(mysqli_query($con, $sql_check_old_password));

    $check = $t_hasher->CheckPassword($old_password, $row_check_old_password['user_pass']);
    if ($check == 1) {
        $new_password_hashed = $t_hasher->HashPassword($new_password);
        $sql_change_password = "UPDATE wpzu_users SET user_pass = '$new_password_hashed' WHERE ID = $user_id";
        if (mysqli_query($con, $sql_change_password)) {
            $response = send_response(SUCCESS);
        } else {
            $response = send_response(FAIL, "Gagal mengganti password baru");
        }
    } else {
        $response = send_response(FAIL, "Password salah");
    }
} else {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM wpzu_users WHERE ID = $user_id"));
    $sql_check_user_exist;

    if ($username != $user['user_login'] && $email != $user['user_email']) {
        $sql_check_user_exist = "SELECT user_login, user_email FROM wpzu_users WHERE user_login = '$username' OR user_email = '$email'";
    } else if ($username != $user['user_login']) {
        $sql_check_user_exist = "SELECT user_login FROM wpzu_users WHERE user_login = '$username'";
    } else if ($email != $user['user_email']) {
        $sql_check_user_exist = "SELECT user_email FROM wpzu_users WHERE user_email = '$email'";
    } else {
        $sql_check_user_exist = "SELECT * FROM wpzu_users WHERE 'You' = 'Smart'";
    }
    if ($results = mysqli_query($con, $sql_check_user_exist)) {
        if (mysqli_num_rows($results) != 0) {
            $response = send_response(FAIL, 'Akun dengan username / email tersebut sudah ada');
        } else {
            $sql_user = "UPDATE wpzu_users SET user_login = '$username', user_nicename = '$username', user_email = '$email',  display_name = '$username' WHERE ID = $user_id";
            if (mysqli_query($con, $sql_user)) {
                $sql_metauser_first_name = "UPDATE wpzu_usermeta SET meta_value = '$first_name' WHERE meta_key = 'first_name' AND user_id = $user_id";
                $sql_metauser_last_name = "UPDATE wpzu_usermeta SET meta_value = '$last_name' WHERE meta_key = 'last_name' AND user_id = $user_id";
                if (mysqli_query($con, $sql_metauser_first_name) && mysqli_query($con, $sql_metauser_last_name)) {
                    $response = send_response(SUCCESS);
                } else {
                    $response = send_response(FAIL, 'Gagal mengupdate informasi profil');
                }
            } else {
                $response = send_response(FAIL, 'Gagal mengupdate informasi profil');
            }
        }
    } else {
        $response = send_response(FAIL, 'Gagal mengecek apakah user sudah ada');
    }
}

echo $response;
