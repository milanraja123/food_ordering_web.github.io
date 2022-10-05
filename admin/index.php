<?php include('partials/menu.php'); ?>

<!-- main content section start here  -->
<div class="main-content ">
    <div class="wrapper">
        <h1>Dashboard</h1>

        <?php

        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        ?>
        <br><br>
        <div class="col text-center">
            <?php
            $sql = "SELECT * FROM `food_category`";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            ?>
            <h1><?php echo $count; ?></h1>
            <br>
            Categories
        </div>

        <div class="col text-center">
            <?php
            $sql2 = "SELECT * FROM `food-details`";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            ?>
            <h1><?php echo $count2; ?></h1>
            <br>
            Food
        </div>

        <div class="col text-center">
            <?php
            $sql3 = "SELECT * FROM `food-order`";
            $res3 = mysqli_query($conn, $sql3);
            $count3 = mysqli_num_rows($res3);
            ?>
            <h1><?php echo $count3; ?></h1>
            <br>
            Total orders
        </div>

        <div class="col text-center">
            <?php
            $sql4 = "SELECT SUM(total) AS Total FROM `food-order` WHERE status='Delivered'";
            $res4 = mysqli_query($conn, $sql4);
            $row = mysqli_fetch_assoc($res4);
            $total_revenue = $row['Total'];
            ?>
            <h1>Rs.<?php echo $total_revenue; ?></h1>
            <br>
            Total Reveneue Generated
        </div>

        <div class="clearfix">

        </div>

    </div>
</div>
<!-- main content section end here  -->

<?php include('partials/footer.php');  ?>