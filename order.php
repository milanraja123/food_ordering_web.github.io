<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
  <div class="container">
    <h2 class="text-center text-white">
      Fill this form to confirm your order.
    </h2>

    <?php
    if (isset($_GET['food_id'])) {

      $food_id = $_GET['food_id'];

      $sql = "SELECT * FROM `food-details` WHERE id=$food_id";

      $res = mysqli_query($conn, $sql);

      echo mysqli_error($conn);

      $count = mysqli_num_rows($res);
      if ($count == 1) {
        $row = mysqli_fetch_assoc($res);

        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
      }
    } else {
      header("location:" . SITEURL);
    }
    ?>

    <form action="" class="order" method="POST">
      <fieldset>
        <legend>Selected Food</legend>

        <div class="food-menu-img">
          <?php
          if ($image_name != "") {
          ?>
            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve" />
          <?php
          } else {
            echo "<div>Image not found</div>";
          }
          ?>

        </div>

        <div class="food-menu-desc">
          <h3><?php echo $title; ?></h3>
          <input type="hidden" name="title" value="<?php echo $title ?>">

          <p class="food-price"><?php echo $price; ?></p>
          <input type="hidden" name="price" value="<?php $price; ?>">

          <div class="order-label">Quantity</div>
          <input type="number" name="qty" class="input-responsive" value="1" required />
        </div>
      </fieldset>

      <fieldset>
        <legend>Delivery Details</legend>
        <div class="order-label">Full Name</div>
        <input type="text" name="full-name" placeholder="E.g. Milan Kumar" class="input-responsive" required />

        <div class="order-label">Phone Number</div>
        <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required />

        <div class="order-label">Email</div>
        <input type="email" name="email" placeholder="E.g. hi@milan.com" class="input-responsive" required />

        <div class="order-label">Address</div>
        <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>


        <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary" />
      </fieldset>
    </form>

    <?php
    if (isset($_POST['submit'])) {
      $food = $_POST['title'];

      $qty = $_POST['qty'];
      $total = $price * $qty;

      $order_date = date("Y-m-d h:i:sa");

      $status = "Ordered";

      $customer_name = $_POST['full-name'];
      $contact = $_POST['contact'];
      $address = $_POST['address'];
      $email = $_POST['email'];



      $sql2 = "INSERT INTO `food-order` SET 
      food = '$food',
      price = '$price',
      qty = '$qty',
      total = '$total',
      `order-date` = '$order_date',
      `status` = '$status',
      customer_name = '$customer_name',
      customer_contact = '$contact',
      customer_email = '$email',
      customer_address = '$address'
      ";

      $res2 = mysqli_query($conn, $sql2);

      echo mysqli_error($conn);




      if ($res2 == true) {
        $_SESSION['order'] = "<div class=front>Food ordered successfully.</div>";
        header('location:' . SITEURL . 'order.php');
      } else {
        $_SESSION['order'] = "<div class=front>Failed to order food.</div>";
        header('location:' . SITEURL);
      }
    }
    ?>
  </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- social Section Starts Here -->
<section class="social">
  <div class="container text-center">
    <ul>
      <li>
        <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png" /></a>
      </li>
      <li>
        <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png" /></a>
      </li>
      <li>
        <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png" /></a>
      </li>
    </ul>
  </div>
</section>
<!-- social Section Ends Here -->

<?php include('partials-front/footer.php'); ?>