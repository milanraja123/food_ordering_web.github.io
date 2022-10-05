<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add admin</h1>
        <br><br>
        <form action="" method="POST">
            <table class="tab">
                <tr>
                    <td>Full name</td>
                    <td><input type="text" name="fullname" placeholder="Full name"></td>
                </tr>

                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" placeholder="Username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="Password"></td>
                </tr>

                <tr>
                    <td><input type="submit" name="submit" value="Add admin" class="btn-secondary" style="padding: 3% 1%;"></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php



if (isset($_POST['submit'])) {

    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `food_admin`(`full_name`, `username`, `password`) VALUES ('$fullname', '$username', '$password')";

    $result = mysqli_query($conn, $sql);
    if ($result) {

        $_SESSION['add'] = "Admin added succesfully";

        header("location: " . SITEURL . "admin/manage-admin.php");
    } else {
        $_SESSION['add'] = "Admin not added";

        header("location: " . SITEURL . "admin/manage-admin.php");
    }
}


?>