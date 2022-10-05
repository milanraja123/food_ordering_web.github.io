<?php include('partials/menu.php'); ?>

<!-- main content section start here  -->
<div class="main-content ">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }
        if (isset($_SESSION['pwd-change'])) {
            echo $_SESSION['pwd-change'];
            unset($_SESSION['pwd-change']);
        }
        if (isset($_SESSION['pwd-not-change'])) {
            echo $_SESSION['pwd-not-change'];
            unset($_SESSION['pwd-not-change']);
        }
        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }

        ?>
        <br><br>
        <a href="./add-admin.php"><button class="btn-primary">Add admin</button></a>
        <br /><br /><br />
        <div class="container">

            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>

                <?php

                $sql = "SELECT * FROM `food_admin`";

                $result = mysqli_query($conn, $sql);



                if ($result) {

                    $num = mysqli_num_rows($result);

                    if ($num > 0) {

                        $sn = 1;
                        while ($rows = mysqli_fetch_assoc($result)) {
                            $id = $rows['id'];
                            $fullname = $rows['full_name'];
                            $username = $rows['username'];

                ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $fullname; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/change-password.php?id=<?php echo $id; ?>"><button class="btn-primary">Change password</button></a>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>"><button class="btn-secondary">Update admin</button></a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"><button class="btn-danger">Delete admin</button></a>
                                </td>
                            </tr>

                <?php
                        }
                    } else {
                        echo "no data";
                    }
                }

                ?>


            </table>
        </div>

    </div>

</div>
</div>
<!-- main content section end here  -->

<?php include('partials/footer.php'); ?>