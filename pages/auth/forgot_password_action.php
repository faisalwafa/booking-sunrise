<?php

include_once '../../helper/connection.php';
include_once '../../helper/PasswordHash.php';
include_once '../../helper/response.php';

$t_hasher = new PasswordHash(8, TRUE);

$response;

$email = $_POST['email'];
$new_password = $_POST['password'];

$new_password_hashed = $t_hasher->HashPassword($new_password);

$sql_user = "UPDATE wpzu_users SET user_pass = '$new_password_hashed' WHERE user_email = '$email'";

if (mysqli_query($con, $sql_user)) {
    $response = send_response(SUCCESS);
} else {
    $response = send_response(FAIL, "Gagal mengubah password");
}

echo $response;
