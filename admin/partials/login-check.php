<?php

if (!isset($_SESSION['user'])) {
    $_SESSION['no-login'] = "Please login to access admin panel";

    header("location:" . SITEURL . "admin/login.php");
}
