<?php
require "lib/database.php";

if (isset($_POST['submit'])) {
  // Get data from post
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $phoneNumber = $_POST['phoneNumber'];
  $email = $_POST['email'];
  $addressOne = $_POST['addressOne'];
  $addressTwo = $_POST['addressTwo'];
  $postcode = $_POST['postcode'];
  $city = $_POST['city'];
  $country = $_POST['country'];

  // For each product, get the quantity from post
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if (!$conn) die("Connection failed: " . mysqli_connect_error()); // Inform user if the connection doesn't work

  // Insert order into database
  $date = date('Y-m-d H:i:s');
  $orderID = newOrder($conn, $firstName, $lastName, $phoneNumber, $email, $addressOne, $addressTwo, $postcode, $city, $country, $date);

  $products = getProducts($conn);

  while ($row = $products->fetch_assoc()) {
    // If the product is in the basket, get the quantity
    if ($_POST['quantity-' . $row["productID"]]) {
      $quantity = $_POST['quantity-' . $row["productID"]];
      // Insert new item into database
      newItem($conn, $orderID, $row["productID"], $quantity);
    }
  }

  $conn->close();
  setcookie('basket', '', time() - 3600, '/');
  header('Location: invoice.php?orderID=' . $orderID);
} else if (isset($_POST['clear'])) {
  setcookie('basket', '', time() - 3600, '/');
  header('Location: basket.php');
} else {
  header('Location: basket.php');
}