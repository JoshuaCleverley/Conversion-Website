<?php
require 'lib/requireAuth.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Orders - Middleware Shopping</title>
  <link rel="stylesheet" type="text/css" href="reset.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
  <section>
    <h2>Orders by Product</h2>
    <table>
      <tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Total Products Sold</th>
        <th>Total Revenue</th>
      </tr>

      <?php
      require 'lib/database.php';

      // Connect to database
      $conn = mysqli_connect($servername, $username, $password, $dbname);

      // Get all products
      $products = getProducts($conn);

      // Loop through products
      while ($product = $products->fetch_assoc()) {
        // Get product ID
        $productID = $product['productID'];

        // Get product name
        $productName = $product['productName'];

        // Get total products sold
        $totalProductsSold = getTotalSoldItemsForProduct($conn, $productID);

        // Get total revenue
        $productPrice = $product['price'];
        $totalRevenue = $totalProductsSold * $productPrice;

        // Display product details
        echo "<tr>";
        echo "<td>$productID</td>";
        echo "<td>$productName</td>";
        echo "<td>$totalProductsSold</td>";
        echo "<td>£$totalRevenue</td>";
        echo "</tr>";
      }
      ?>
    </table>
  </section>

  <section>
    <h2>All Orders</h2>

    <form action="adminOrders.php" method="post">
      <label for="fromDate">From:</label>
      <input type="date" id="fromDate" name="fromDate">
      <label for="toDate">To:</label>
      <input type="date" id="toDate" name="toDate">
      <input type="submit" value="Filter">
    </form>

    <!-- Display all orders, filtered by date -->
    <table>
      <tr>
        <th>Order ID</th>
        <th>Customer</th>
        <th>Order Date</th>
        <th>View Invoice</th>
      </tr>

      <?php
      // Get all orders
      $orders = getOrders($conn);

      // Loop through orders
      $noOrders = true;
      while ($order = $orders->fetch_assoc()) {
        // Get order ID
        $orderID = $order['orderID'];

        // Get customer
        $firstName = $order['firstName'];
        $lastName = $order['lastName'];
        $customer = "$firstName $lastName";

        // Get order date
        $orderDate = $order['orderDate'];

        // Check if date falls between filter dates
        if (isset($_POST['fromDate']) && isset($_POST['toDate'])) {
          $fromDate = $_POST['fromDate'];
          $toDate = $_POST['toDate'];

          if ($orderDate < $fromDate || $orderDate > $toDate) continue;
        }
        $noOrders = false;

        // Display order details
        echo "<tr>";
        echo "<td>$orderID</td>";
        echo "<td>$customer</td>";
        echo "<td>$orderDate</td>";
        echo "<td><a href='invoice.php?orderID=$orderID'>Link</a></td>";
        echo "</tr>";
      }

      if ($noOrders) echo "<tr><td colspan='6'>No orders found</td></tr>";
      ?>
    </table>
  </section>
</body>

</html>