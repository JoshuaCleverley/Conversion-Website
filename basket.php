<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Basket - Middleware Shopping</title>
  <link rel="stylesheet" type="text/css" href="reset.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="js/hamburger.js" type="text/javascript" defer></script>
</head>

<body>
  <?php require 'header.php' ?>

  <section>
    <h1>Basket</h1>
    <form class="checkout-form" action="checkout.php" method="POST">
      <?php
      require 'lib/database.php';

      // If the basket is empty, display a message
      if (empty($_COOKIE['basket']))
        echo '<p>Your basket is empty</p>';
      else {
        // For each product, if it is in the basket display it
        // Connect to database
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) die("Connection failed: " . mysqli_connect_error()); // Inform user if the connection doesn't work

        $products = getProducts($conn);
        $basket = json_decode($_COOKIE['basket'], true);

        if ($products->num_rows == 0) echo "No results";
        else {
          while ($row = $products->fetch_assoc()) {
            if ($basket[$row["productID"]]) {
              // Display the product
              echo "
                <div class='basket-item'>
                  <img class='checkout-image' src='images/" . $row["image"] . "' />
                  <div>
                    <p class='product-info product-name'>" . $row["productName"] . "</p>
                    <p class='product-info product-price'>£" . $row["price"] . "</p>
                  </div>
                  <div>
                    <input class='checkout-number-input' name='quantity-" . $row["productID"] . "' type='number' value='" . $basket[$row["productID"]] . "' />
                  </div>              
                </div>
              ";
            }
          }
        }

        $conn->close();

        echo '<div class="checkout-form-details">
                <input class="checkout-form-input" type="text" name="firstName" placeholder="First Name" required />
                <input class="checkout-form-input" type="text" name="lastName" placeholder="Last Name" required />
                <input class="checkout-form-input" type="text" name="phoneNumber" placeholder="Phone Number" required />
                <input class="checkout-form-input" type="text" name="email" placeholder="Email" required />
                <input class="checkout-form-input" type="text" name="addressOne" placeholder="Address Line One" required />
                <input class="checkout-form-input" type="text" name="addressTwo" placeholder="Address Line Two" />
                <input class="checkout-form-input" type="text" name="postcode" placeholder="Post Code" required />
                <input class="checkout-form-input" type="text" name="city" placeholder="Town/City" required />
                <input class="checkout-form-input" type="text" name="country" placeholder="Country" required />
              </div>

              <div class="checkout-form-button-container">
                <button name="clear">Clear Basket</button>
                <button type="submit" name="submit">Checkout</button>
              </div>';
      }
      ?>
    </form>
  </section>

  <?php require 'footer.php' ?>
</body>

</html>