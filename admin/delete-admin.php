<?php

include('../config/constants.php');

$id = $_GET['id'];

$sql = "DELETE FROM `food_admin` WHERE id = $id";

$result = mysqli_query($conn, $sql);


if ($result) {

    $_SESSION['delete'] = "Admin deleted succesfully";
    header('location: ' . SITEURL . 'admin/manage-admin.php');
} else {

    $_SESSION['delete'] = "Admin deleted unsuccesful";
    header('location: ' . SITEURL . 'admin/manage-admin.php');
}
