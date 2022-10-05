<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tab">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" id="" placeholder="Title of food"></td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="10" placeholder="Description of the food"></textarea></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td><input type="number" name="price"></td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td><select name="category">


                            <?php

                            $sql = "SELECT * FROM food_category WHERE active='Yes'";

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);

                            if ($count > 0) {

                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];

                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No category Found</option>
                            <?php
                            }
                            ?>
                            <option value="2">Snacks</option>
                        </select></td>
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
                    <td><input type="submit" name="submit" value="Add food" class="btn-secondary" style="padding: 3% 1%;"></td>
                </tr>
            </table>
        </form>
        <?php

        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

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
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {

                    //Get the extension of the selected image

                    $temp = explode('.', $image_name);
                    $ext = end($temp);

                    //new name for the image
                    $image_name = "Food-name-" . rand(0000, 9999) . "." . $ext;

                    //current location of the image
                    $src = $_FILES['image']['tmp_name'];

                    //destination path for the image to upload
                    $des = "../images/food/" . $image_name;

                    //upload the food image
                    $upload = move_uploaded_file($src, $des);

                    if ($upload == false) {
                        $_SESSION['uplaod'] = "Image upload failed";
                        die();
                    }
                } else {
                }
            } else {
                $image_name = "";
            }

            $sql2 = "INSERT INTO `food-details`( `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES ('$title','$description','$price','$image_name','$category','$featured','$active')";

            $res2 = mysqli_query($conn, $sql2);

            echo mysqli_error($conn);

            if ($res2 == true) {
                $_SESSION['add'] = "Food added succesfully";
                header("location:" . SITEURL . "admin/manage-food.php");
            } else {
                $_SESSION['add'] = "Failed to add food";
                header("location:" . SITEURL . "admin/manage-food.php");
            }
        }


        ?>
    </div>
</div>

<?php include("partials/footer.php"); ?>