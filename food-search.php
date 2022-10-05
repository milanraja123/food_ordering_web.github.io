<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
  <div class="container">
    <?php

    $search = mysqli_real_escape_string($conn, $_POST['search']);

    ?>
    <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
  </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
  <div class="container">
    <h2 class="text-center">Food Menu</h2>
    <?php
    $search = $_POST['search'];

    $sql = "SELECT * FROM `food-details` WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);


    if ($count > 0) {
      while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['id'];
        $title = $row['title'];
        $desc = $row['description'];
        $price = $row['price'];
        $image_name = $row['image_name'];

    ?>
        <div class="food-menu-box">
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
            <h4><?php echo $title; ?></h4>
            <p class="food-price">$2.3</p>
            <p class="food-detail">
              <?php echo $desc; ?>
            </p>
            <br />

            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id ?>" class="btn btn-primary">Order Now</a>
          </div>
        </div>
    <?php
      }
    } else {
      echo "<div>No such food available</div>";
    }
    ?>

    <div class="clearfix"></div>
  </div>
</section>
<!-- fOOD Menu Section Ends Here -->

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