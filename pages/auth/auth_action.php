<?php

session_start();

include_once '../../helper/connection.php';
include_once '../../helper/PasswordHash.php';
include_once '../../helper/response.php';

$t_hasher = new PasswordHash(8, TRUE);

$response;

if (isset($_POST['login'])) {
    $username_email = $_POST['username'];
    $password = $_POST['password'];
    $sql_find_user = "SELECT user.*, meta.meta_value AS user_level FROM wpzu_users user INNER JOIN wpzu_usermeta AS meta ON user.ID = meta.user_id WHERE (user.user_login = '$username_email' OR user.user_email = '$username_email') AND meta.meta_key = 'wpzu_user_level'";
    if ($results = mysqli_query($con, $sql_find_user)) {
        if (mysqli_num_rows($results) == 0) {
            $response = send_response(FAIL, "Tidak ditemukan user dengan username / email tersebut");
        } else {
            $row = mysqli_fetch_assoc($results);
            $check = $t_hasher->CheckPassword($password, $row['user_pass']);
            if ($check == 1) {
                $id_user = $row['ID'];
                $sql_find_data = "SELECT meta_value FROM wpzu_usermeta WHERE (meta_key = 'first_name' OR meta_key = 'last_name') AND user_id = $id_user ORDER BY meta_key";
                if ($results_find_data = (mysqli_query($con, $sql_find_data))) {
                    $i = 0;
                    while ($row_find_data = mysqli_fetch_assoc($results_find_data)) {
                        if ($i == 0) {
                            $_SESSION['first_name'] = $row_find_data['meta_value'];
                        } else {
                            $_SESSION['last_name'] = $row_find_data['meta_value'];
                        }
                        $i++;
                    }
                    $_SESSION["user_id"] = $row['ID'];
                    $_SESSION["user_email"] = $row['user_email'];
                    $_SESSION['display_name'] = $row['display_name'];
                    $_SESSION['user_level'] = $row['user_level'];
                    $response = send_response(SUCCESS, json_encode($row));
                } else {
                    $response = send_response(FAIL, "Gagal Mengeset Session");
                }
            } else {
                $response = send_response(FAIL, "Password salah");
            }
        }
    } else {
        $response = send_response(FAIL, "Gagal mencari user dangan username / email tersebut");
    }
} else {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $t_hasher->HashPassword($_POST['password']);

    $sql_check_user_exist = "SELECT user_login, user_email FROM wpzu_users WHERE user_login = '$username' OR user_email = '$email'";
    if ($results = mysqli_query($con, $sql_check_user_exist)) {
        if (mysqli_num_rows($results) != 0) {
            $response = send_response(FAIL, 'Akun dengan username / email tersebut sudah ada');
        } else {
            $sql_user = "INSERT INTO wpzu_users (user_login, user_pass, user_nicename, user_email, user_registered, user_status, display_name) 
    VALUE ('$username', '$password', '$username', '$email', now(), 0, '$username')";

            if (mysqli_query($con, $sql_user)) {
                $user_id =  mysqli_insert_id($con);
                $capabilities = 'a:1:{s:10:"subscriber";b:1;}';
                $sql_metauser = "INSERT INTO wpzu_usermeta (user_id, meta_key, meta_value) VALUES 
            ($user_id, 'nickname', '$username'),
            ($user_id, 'first_name', '$first_name'),
            ($user_id, 'last_name', '$last_name'),
            ($user_id, 'description', ''),
            ($user_id, 'rich_editing', 'true'),
            ($user_id, 'syntax_highlighting', 'true'),
            ($user_id, 'comment_shortcuts', 'false'),
            ($user_id, 'dismissed_wp_pointers', ''),
            ($user_id, 'ur_form_id', '41073'),
            ($user_id, 'admin_color', 'fresh'),
            ($user_id, 'use_ssl', '0'),
            ($user_id, 'show_admin_bar_front', 'true'),
            ($user_id, 'locale', ''),
            ($user_id, 'wpzu_capabilities', '$capabilities'),
            ($user_id, 'wpzu_user_level', '0')
        ";
                if (mysqli_query($con, $sql_metauser)) {
                    $response = send_response(SUCCESS);
                } else {
                    $response = send_response(FAIL, 'Gagal membuat user baru');
                }
            } else {
                $response = send_response(FAIL, 'Gagal membuat user baru');
            }
        }
    } else {
        $response = send_response(FAIL, 'Gagal mengecek apakah user sudah ada');
    }
}


// $success = "success";

mysqli_close($con);
echo $response;
