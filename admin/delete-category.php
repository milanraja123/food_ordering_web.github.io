<?php

include('../config/constants.php');

if (isset($_GET['id']) and isset($_GET['image_name'])) {

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if ($image_name != "") {
        $path = "../images/category/" . $image_name;

        $remove = unlink($path);

        //if failed to remove image then add an error message and stop the process
        if ($remove == false) {
            $_SESSION['remove'] = "Failed to remove category image";
            header('location:' . SITEURL . 'admin/manage-category.php');
            die();
        }
    }

    $sql = "DELETE FROM food_category WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "Category deleted succesfully";
        header('location:' . SITEURL . 'admin/manage-category.php');
    } else {
        $_SESSION['delete'] = "Category deleted failed";
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
} else {
    header('location:' . SITEURL . 'admin/manage-category.php');
}
