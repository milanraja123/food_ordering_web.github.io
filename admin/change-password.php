<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }

        ?>
        <table class="tab">
            <form action="" method="POST">
                <tr>
                    <td>Old Password: </td>
                    <td><input type="password" name="old_password" id=""></td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td><input type="password" name="new_password"></td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td><input type="password" name="confirm_password" id=""></td>
                </tr>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <td><input type="submit" name="submit" value="Change Password" class="btn-secondary" style="padding: 3% 1%;"></td>
                </tr>
            </form>
        </table>
    </div>
</div>

<?php

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $sql = "SELECT * FROM food_admin WHERE id=$id AND password='$old_password'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            if ($new_password == $confirm_password) {

                $sql2 = "UPDATE food_admin SET password='$new_password' WHERE id=$id";

                $res2 = mysqli_query($conn, $sql2);

                if ($result) {
                    // $_SESSION['pwd-changed'] = "Password changed succesfully";
                    // header("location: " . SITEURL . "admin/manage-admin.php");
                    echo mysqli_error($conn);
                } else {
                    $_SESSION['pwd-not-change'] = "Password change failed";
                    header("location: " . SITEURL . "admin/manage-admin.php");
                }
            } else {
                $_SESSION['pwd-not-match'] = "Password does not matched.";
                header("location: " . SITEURL . "admin/manage-admin.php");
            }
        } else {
            $_SESSION['user-not-found'] = "User not found";
            header("location: " . SITEURL . "admin/manage-admin.php");
        }
    }
}

?>

<?php include('partials/footer.php'); ?>