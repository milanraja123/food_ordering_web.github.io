<?php include('../config/constants.php');

if (isset($_GET['id']) && isset($_GET['image_name'])) {

    $id = $_GET['id'];
    $image = $_GET['image_name'];

    if ($image != "") {
        $path = "../images/food/" . $image;
        $remove = unlink($path);

        if ($remove == false) {
            $_SESSION['remove'] = "Failed to remove the image";
            header('location:' . SITEURL . 'admin/manage-food.php');
            die();
        }
    }

    $sql = "DELETE FROM `food-details` WHERE id = $id";


    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "food succesfully removed";
        header("location:" . SITEURL . "admin/manage-food.php");
    } else {
        $_SESSION['delete'] = "Failed to remove the food-item";
        header("location:" . SITEURL . "admin/manage-food.php");
    }
} else {
    $_SESSION['unauthorize'] = "Unauthorized access";
    header('location:' . SITEURL . 'admin/manage-food.php');
}
