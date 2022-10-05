<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br><br><br>
        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <br><br>
        <table class="tbl-full" style="font-size:12px; ">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php

            $sql = "SELECT * FROM `food-order`";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order-date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
            ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $food; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $order_date; ?></td>
                        <?php
                        if ($status == "Ordered") {
                        ?>
                            <td style=" font-weight:bold"><?php echo $status; ?></td>

                        <?php
                        } else if ($status == "Delivered") {
                        ?>
                            <td style="color: green; font-weight:bold"><?php echo $status; ?></td>
                        <?php
                        } else if ($status == "On delivery") {
                        ?>
                            <td style="color: orange; font-weight:bold"><?php echo $status; ?></td>
                        <?php
                        } else {
                        ?>
                            <td style="color: red; font-weight:bold"><?php echo $status; ?></td>
                        <?php
                        }
                        ?>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_contact; ?></td>
                        <td><?php echo $customer_email; ?></td>
                        <td><?php echo $customer_address; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>"><button class="btn-secondary">Update order</button></a>
                        </td>

                    </tr>

            <?php
                }
            } else {
                echo "No Order yet";
            }

            ?>


        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>