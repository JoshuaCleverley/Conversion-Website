<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - Middleware Shopping</title>
  <link rel="stylesheet" type="text/css" href="reset.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="js/hamburger.js" type="text/javascript" defer></script>
  <script src="js/basket.js" type="text/javascript" defer></script>
</head>

<body>
  <?php require 'header.php' ?>

  <section class="hero">
    <h1>Shopping Website</h1>
    <button onclick="location.href='products.php'" type="button">Browse Products</button>
  </section>

  <section>
    <h2>Testimonials</h2>
    <div class="card-container">
      <div class="card">
        <h3>Reviewer One</h3>
        <div class="testimonial-stars-container">
          <img src="images/star-full.png" />
          <img src="images/star-full.png" />
          <img src="images/star-full.png" />
          <img src="images/star-half-empty.png" />
          <img src="images/star-empty.png" />
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
      </div>
      <div class="card">
        <h3>Reviewer Two</h3>
        <div class="testimonial-stars-container">
          <img src="images/star-full.png" />
          <img src="images/star-full.png" />
          <img src="images/star-full.png" />
          <img src="images/star-full.png" />
          <img src="images/star-empty.png" />
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
      </div>
      <div class="card">
        <h3>Reviewer Three</h3>
        <div class="testimonial-stars-container">
          <img src="images/star-full.png" />
          <img src="images/star-full.png" />
          <img src="images/star-half-empty.png" />
          <img src="images/star-empty.png" />
          <img src="images/star-empty.png" />
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
      </div>
    </div>
  </section>

  <section>
    <h2>Featured Products</h2>
    <div class="card-container product-card-container">
      <?php
      require('lib/database.php');

      // Connect to database
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      if (!$conn) die("Connection failed: " . mysqli_connect_error()); // Inform user if the connection doesn't work

      $products = getFeaturedProducts($conn);
      if ($products->num_rows == 0) echo "No results";
      else {
        while ($row = $products->fetch_assoc()) {
          echo '
          <div class="product-card">
            <img class="product-image" src="images/' . $row["image"] . '" />
            <p class="product-info product-name">' . $row["productName"] . '</p>
            <p class="product-info product-price">£' . $row["price"] . '</p>
            <form class="product-form" onsubmit="
              event.preventDefault();
              addToBasket(' . $row["productID"] . ', document.getElementById(\'' . $row["productID"] . '\').value);
              document.getElementById(\'' . $row["productID"] . '\').value = 1;
            ">
              <input class="product-number-input" id="' . $row["productID"] . '" type="number" value="1" />
              <button class="product-submit-button" type="submit">Add to basket</button>
            </form>
          </div>';
        }
      }
      ?>
    </div>

    <button onclick="location.href='products.php'" type="button">View More Products</button>
  </section>

  <?php require 'footer.php' ?>
</body>

</html>