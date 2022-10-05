<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php

        $id = $_GET['id'];

        $sql = "SELECT * FROM food_admin WHERE id=$id";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            $count = mysqli_num_rows($result);
            if ($count == 1) {
                $rows = mysqli_fetch_assoc($result);

                $fullname = $rows['full_name'];
                $username = $rows['username'];
            } else {
                header("location: " . SITEURL . "admin/manage-admin.php");
            }
        }


        ?>

        <form action="" method="POST">
            <table class="tab">
                <tr>
                    <td>Full name: </td>
                    <td><input type="text" name="fullname" value="<?php echo $fullname; ?>" placeholder="Full name"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username"></td>
                </tr>

                <tr>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <td><input type="submit" name="submit" value="Update admin" class="btn-secondary" style="padding: 3% 1%;"></td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];


    $sql = "UPDATE food_admin SET 
    full_name='$fullname',
    username='$username'
    WHERE id='$id'
    ";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['update'] = "Admin Updated Succesfully";
        header("location: " . SITEURL . "admin/manage-admin.php");
    } else {
        //$_SESSION['update'] = "Admin Update failed";
        //header("location: " . SITEURL . "admin/manage-admin.php");
        echo mysqli_error($conn);
    }
}

?>

<?php include('partials/footer.php'); ?>