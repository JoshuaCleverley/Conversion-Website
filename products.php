<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products - Middleware Shopping</title>
  <link rel="stylesheet" type="text/css" href="reset.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="js/hamburger.js" type="text/javascript" defer></script>
</head>

<body>
  <?php require 'header.php' ?>
  <section>
    <h1>Products</h1>

    <div class="card-container product-card-container">
      <?php
      require('lib/database.php');

      // Connect to database
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      if (!$conn) die("Connection failed: " . mysqli_connect_error()); // Inform user if the connection doesn't work

      $products = getProducts($conn);

      if ($products->num_rows == 0) echo "No results";
      else {
        while ($row = $products->fetch_assoc()) {
          echo '
          <div class="product-card">
            <img class="product-image" src="images/' . $row["image"] . '" />
            <p class="product-info product-name">' . $row["productName"] . '</p>
            <p class="product-info product-price">£' . $row["price"] . '</p>
            <form class="product-form">
              <input class="product-number-input" type="number" value="1" />
              <button class="product-submit-button" type="submit">Add to basket</button>
            </form>
          </div>';
        }
      }
      ?>
    </div>
  </section>

  <?php require 'footer.php' ?>
</body>

</html>