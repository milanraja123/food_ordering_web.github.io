<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br><br>

        <?php

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if (isset($_SESSION['unauthorize'])) {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        ?>

        <br><br>

        <a href="<?php echo SITEURL; ?>admin/add-food.php"><button class="btn-primary">Add Food</button></a>



        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

            $sql = "SELECT * FROM `food-details`";

            $res = mysqli_query($conn, $sql);

            echo mysqli_error($conn);

            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {

                while ($rows = mysqli_fetch_assoc($res)) {
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $price = $rows['price'];
                    $image = $rows['image_name'];
                    $featured = $rows['featured'];
                    $active = $rows['active'];

            ?>

                    <tr>

                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $price; ?></td>
                        <td>
                            <?php

                            if ($image != "") {
                            ?>

                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image; ?>" width="100px">

                            <?php
                            } else {
                                echo "Image not found";
                            }

                            ?>
                        </td>
                        <td><?php echo $featured ?></td>
                        <td><?php echo $active ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image; ?>"><button class="btn-secondary">Update Food</button></a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image; ?>"><button class="btn-danger">Delete Food</button></a>
                        </td>
                    </tr>

            <?php
                }
            }

            ?>


        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>