<?php

function send_response($success, $message = '')
{
    $response = array('success' => $success, 'message' => $message);
    return json_encode($response);
}
