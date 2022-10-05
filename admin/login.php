<?php include('../config/constants.php'); ?>

<html>

<head>
    <title>
        Food ordering app
    </title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div>
        <div class="login text-center">

            <h1>Login</h1>
            <br><br>
            <?php

            if (isset($_SESSION['login-failed'])) {
                echo $_SESSION['login-failed'];
                unset($_SESSION['login-failed']);
            }
            if (isset($_SESSION['no-login'])) {
                echo $_SESSION['no-login'];
                unset($_SESSION['no-login']);
            }

            ?>
            <br><br>
            <!-- Login Form start here -->
            <form action="" method="POST">
                <p>Username: <input type="text" name="username" id="" placeholder="Enter Username"></p>
                <br>
                <p>Password: <input type="password" name="password" placeholder="Enter Password"></p>
                <br>
                <input type="submit" name="login" class="btn-primary" value="login">

            </form>
            <!-- Login form end here -->
            <br>
            <p>Created by <a href="#">Milan Kumar</a></p>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['login'])) {


    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $username = mysqli_real_escape_string($conn, $_POST['password']);


    $sql = "SELECT * FROM food_admin WHERE username='$username' AND password='$password'";

    $result = mysqli_query($conn, $sql);

    echo mysqli_error($conn);

    if ($result) {
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            $_SESSION['login'] = "Login succesfull";
            $_SESSION['user'] = $username;
            header('location:' . SITEURL . 'admin/index.php');
        } else {
            $_SESSION['login-failed'] = "login unsuccesfull";
            header('location:' . SITEURL . 'admin/login.php');
        }
    } else {
        echo "not";
    }
}

?>