<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update category</h1>
        <br><br>

        <?php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM food_category WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $count = mysqli_num_rows($res);
                if ($count == 1) {

                    $row = mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                } else {
                    $_SESSION['no-category'] = "No category found";
                    header('location:' . SITEURL . 'admin/manage-category.php');
                }
            } else {
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tab">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>
                            <img src="<?php echo SITEURL; ?>/images/category/<?php echo $current_image; ?>" alt="" width="100px">
                        <?php
                        } else {
                            echo "Image not added";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td><input type="file" name="image" id=""></td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" <?php if ($featured == "Yes") {
                                                echo "checked";
                                            } ?> name="featured" value="Yes"> Yes
                        <input type="radio" <?php if ($featured == "No") {
                                                echo "checked";
                                            } ?> name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" <?php if ($active == "Yes") {
                                                echo "checked";
                                            } ?> name="active" value="Yes"> Yes
                        <input type="radio" <?php if ($active == "No") {
                                                echo "checked";
                                            } ?> name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <td><input type="submit" name="submit" value="Update category" class="btn-secondary" style="padding: 3% 1%;"></td>
                </tr>
            </table>
        </form>
        <?php

        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            if ($_FILES['image']['name']) {
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
                    if ($current_image != "") {

                        $remove_path = "../images/category/" . $current_image;
                        $remove = unlink($remove_path);

                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "Failed to remove the current image";
                            header('location:' . SITEURL . 'admin/manage-category.php');
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }


            $sql2 = "UPDATE food_category SET title='$title',image_name='$image_name', featured='$featured',active='$active'
            WHERE id=$id";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {
                $_SESSION['update'] = "Category updated succesfully";
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['update'] = "Category update failed";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        }

        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>