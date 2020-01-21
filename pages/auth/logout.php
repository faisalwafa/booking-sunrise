<?php

session_start();
if (session_destroy()) {
    header("Location: https://sunrise-indonesia.com");
}
