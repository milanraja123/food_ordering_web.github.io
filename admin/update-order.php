<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>
            Update Food
        </h1>
        <br><br><br>

        <form action="" method="POST">

            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $sql = "SELECT * FROM `food-order` WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($res);

                $title = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
            } else {
                header("location:" . SITEURL . "admin/manage-food.php");
            }
            ?>

            <table class="tab">
                <tr>
                    <td>Food Name</td>
                    <td><strong><?php echo $title; ?></strong></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><strong><?php echo $price; ?></strong></td>
                </tr>

                <tr>
                    <td>Quantity</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == 'Ordered') {
                                        echo 'selected';
                                    } ?> value="Ordered">Ordered</option>
                            <option <?php if ($status == "On delivery") {
                                        echo "selected";
                                    } ?> value="On delivery">On delivery</option>
                            <option <?php if ($status == "Delivered") {
                                        echo "selected";
                                    } ?> value="Delivered">Delivered</option>
                            <option <?php if ($status == "Canceled") {
                                        echo "selected";
                                    } ?> value="Canceled">Canceled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name</td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Contact</td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td><input type="email" name="customer_email" value="<?php echo $customer_email; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td><textarea name="address" cols="30" rows="5"><?php echo $customer_address; ?></textarea></td>
                </tr>

                <tr>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <td><input type="submit" name="submit" value="Update category" class="btn-secondary" style="padding: 3% 1%;"></td>
                </tr>
            </table>
        </form>

        <?php

        if (isset($_POST['submit'])) {
            $id2 = $_POST['id'];
            $price = $_POST['price'];
            $total = $price * $qty;
            $qty = $_POST['qty'];
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['address'];

            $sql2 = "UPDATE `food-order` SET
                price = '$price',
                qty = '$qty',
                `status` = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'
                WHERE id=$id2
            ";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {
                $_SESSION['update'] = "<div>Order Update succesfully</div>";
                header("location:" . SITEURL . "admin/manage-order.php");
            } else {
                $_SESSION['update'] = "<div>Update Failed</div>";
                header("location:" . SITEURL . "admin/manage-orderphp");
            }
        } else {
        }

        ?>

    </div>
</div>

<?php include("partials/footer.php") ?>