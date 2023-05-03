<?php
require 'lib/database.php';

if (!isset($_GET['orderID'])) header('Location: index.php'); // Redirect to index if orderID isn't set
// Get orderID from url parameter
$orderID = $_GET['orderID'];

// Get order details from database
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) die("Connection failed: " . mysqli_connect_error()); // Inform user if the connection doesn't work

$orderDetails = getOrderDetails($conn, $orderID);

// If the order doesn't exist, redirect to index
if ($orderDetails->num_rows == 0) header('Location: index.php');

$order = $orderDetails->fetch_assoc();

// Get items for order from database
$items = getItemsForOrder($conn, $orderID);

// Add all items to an array, so we can loop through them later. Also add up total price
$itemsArray = array();
$totalPrice = 0;
while ($item = $items->fetch_assoc()) {
  array_push($itemsArray, $item);
  $totalPrice += getProduct($conn, $item['productID'])->fetch_assoc()['price'] * $item['quantity'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice #<?php echo $orderID ?> - Middleware Shopping</title>
  <link rel="stylesheet" type="text/css" href="reset.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="js/hamburger.js" type="text/javascript" defer></script>
  </script>
</head>

<body>
  <?php require 'header.php' ?>

  <section>
    <h2>Invoice #<?php echo $orderID ?></h2>
    <div class="invoice-container">
      <div class="invoice-details">
        <p><b>Order ID:</b> <?php echo $orderID ?></p>
        <p><b>Order Date:</b> <?php echo $order['orderDate'] ?></p>
        <p><b>Order Total:</b> $<?php echo $totalPrice ?></p>
      </div>
      <div class="invoice-items">
        <table>
          <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
          </tr>
          <?php
          foreach ($itemsArray as $item) {

            echo $item;
            $product = getProduct($conn, $item['productID']);
            if ($product->num_rows == 0) die("Product doesn't exist"); // Inform user if the product doesn't exist
            $product = $product->fetch_assoc();

            echo "
              <tr>
                <td>" . $product["productName"] . "</td>
                <td>" . $item["quantity"] . "</td>
                <td>$" . $product["price"] . "</td>
              </tr>";
          } ?>
        </table>
      </div>
  </section>

  <?php require 'footer.php' ?>
</body>

</html>