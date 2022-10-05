<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage-category</h1>
        <br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['no-category'])) {
            echo $_SESSION['no-category'];
            unset($_SESSION['no-category']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }

        ?>
        <br><br>

        <a href="<?php echo SITEURL; ?>admin/add-category.php"><button class="btn-primary">Add category</button></a>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php

            $sql = "SELECT * FROM food_category";

            $res = mysqli_query($conn, $sql);

            if ($res) {
                $sn = 1;
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $image_name = $row['image_name'];
                        $title = $row['title'];
                        $featured = $row['featured'];
                        $active = $row['active'];
            ?>

                        <tr>
                            <td><?php echo $sn++; ?>.</td>
                            <td><?php echo $title; ?></td>
                            <td><?php
                                if ($image_name != "") {
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="" width="100px">
                                <?php
                                } else {
                                    echo "Image not Added";
                                }
                                ?>

                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL ?>admin/update-category.php?id=<?php echo $id; ?>"><button class=" btn-secondary">Update Category</button></a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"><button class="btn-danger">Delete Category</button></a>
                            </td>

                        </tr>

            <?php
                    }
                }
            }

            ?>

        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>