<?php include('partials-front/menu.php'); ?>

<!-- food search Section Starts Here -->
<section class="food-search text-center">
  <div class="container">
    <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
      <input type="search" name="search" placeholder="Search for Food.." required />
      <input type="submit" name="submit" value="Search" class="btn btn-primary" />
    </form>
  </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php
if (isset($_SESSION['order'])) {
  echo $_SESSION['order'];
  unset($_SESSION['order']);
}
?>
<!-- CAtegories Section Starts Here -->
<section class="categories">
  <div class="container">
    <h2 class="text-center">Explore Foods</h2>

    <?php

    $sql = "SELECT * FROM `food_category` WHERE active='Yes' AND featured='Yes' LIMIT 3";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count > 0) {
      while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['id'];
        $title = $row['title'];
        $image_name = $row['image_name'];

    ?>

        <a href="<?php echo SITEURL; ?>category-foods.php?id=<?php echo $id; ?>">
          <div class="box-3 float-container">
            <?php

            if ($image_name != "") {
            ?> <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve" />

            <?php
            } else {
              echo "<div>Image not available</div>";
            }

            ?>


            <h3 class="float-text text-white"><?php echo $title; ?></h3>
          </div>
        </a>

    <?php
      }
    } else {
      echo "<div>Category not added.</div>";
    }



    ?>



    <div class="clearfix"></div>
  </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
  <div class="container">
    <h2 class="text-center">Food Menu</h2>

    <?php
    $sql2 = "SELECT * FROM `food-details`";

    $res2 = mysqli_query($conn, $sql2);

    $count = mysqli_num_rows($res2);

    if ($count > 0) {
      while ($row = mysqli_fetch_assoc($res2)) {
        $id2 = $row['id'];
        $title2 = $row['title'];
        $price2 = $row['price'];
        $desc2 = $row['description'];
        $image_name2 = $row['image_name'];
    ?>
        <div class="food-menu-box">
          <div class="food-menu-img">
            <?php
            if ($image_name2 != "") {
            ?>
              <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name2; ?>" alt="<?php echo $title2; ?>" class="img-responsive img-curve" />
            <?php
            } else {
              echo "<div>Image not found</div>";
            }
            ?>

          </div>

          <div class="food-menu-desc">
            <h4><?php echo $title2; ?></h4>
            <p class="food-price"><?php echo $price2 ?></p>
            <p class="food-detail">
              <?php echo $desc2; ?>
            </p>
            <br />

            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id2 ?>" class="btn btn-primary">Order Now</a>
          </div>
        </div>
    <?php
      }
    } else {
      echo "<div>Food not available.</div>";
    }
    ?>

    <div class="clearfix">

    </div>

    <p class="text-center">
      <a href="#">See All Foods</a>
    </p>
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