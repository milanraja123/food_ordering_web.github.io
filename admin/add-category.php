<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br><br>
        <!-- Add category form starts here -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tab">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Category title"></td>
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Add category" class="btn-secondary" style="padding: 3% 1%;"></td>
                </tr>
            </table>
        </form>
        <!-- Add category form ends here -->
        <?php

        if (isset($_POST['submit'])) {
            $title = $_POST['title'];

            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No";
            }


            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            if (isset($_FILES['image']['name'])) {

                //upload the image
                //to upload image we need image name,source path and destination path
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {


                    $ext = end(explode('.', $image_name));

                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/" . $image_name;

                    $upload = move_uploaded_file($source_path, $destination_path);

                    if ($upload == false) {
                        $_SESSION['upload'] = "failed to upload image.";
                        header("location:" . SITEURL . "admin/add-category,php");

                        die();
                    }
                }
            } else {
                //don't upload the image
                $image_name = "";
            }

            $sql = "INSERT INTO food_category SET title='$title', image_name='$image_name' , featured='$featured', active='$active'";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                $_SESSION['add'] = "Category added succesfully";
                header("location:" . SITEURL . "admin/manage-category.php");
            } else {
                $_SESSION['add'] = "Category add failed";
                header("location:" . SITEURL . "admin/add-category.php");
            }
        }


        ?>
    </div>
</div>


<?php include('partials/footer.php');  ?>