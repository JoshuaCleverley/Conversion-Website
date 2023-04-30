<?php
// Database connection details
$servername = "localhost";
$username   = "ddm337669";
$password   = "DDMTest!JC1";
$dbname     = "ddm337669";

// Authenticate admin
function authenticateAdmin($conn, $username, $password)
{
  // Query the database
  $query = "SELECT * FROM Admins WHERE username = '$username' AND password = '$password'";
  $res = $conn->query($query);

  // Return true if their is an admin with that username and password combination, otherwise return false
  if ($res->num_rows > 0) return true;
  else return false;
}

// Get products from database
function getProducts($conn)
{
  // Query the database
  $query = "SELECT * FROM Products";
  $res = $conn->query($query);

  // Return response
  return $res;
}

// Get featured products from database
function getFeaturedProducts($conn)
{
  // Query the database
  $query = "SELECT * FROM Products WHERE featured = 1";
  $res = $conn->query($query);

  // Return response
  return $res;
}

function getOrderDetails($conn, $orderID)
{
  // Query the database
  $query = "SELECT * FROM Orders WHERE orderID = '$orderID'";
  $res = $conn->query($query);

  // Return response
  return $res;
}

function getItemsForOrder($conn, $orderID)
{
  // Query the database
  $query = "SELECT * FROM Items WHERE orderID = '$orderID'";
  $res = $conn->query($query);

  // Return response
  return $res;
}

// Create a new order item in the database
function newOrder($conn, $firstName, $lastName, $phoneNumber, $email, $addressOne, $addressTwo, $postcode, $city, $country, $date)
{
  // Query the database
  $query = "INSERT INTO Orders (firstName, lastName, phoneNumber, email, addressOne, addressTwo, postcode, city, country, orderDate) VALUES ('$firstName', '$lastName', '$phoneNumber', '$email', '$addressOne', '$addressTwo', '$postcode', '$city', '$country', '$date')";
  $conn->query($query);
  $last_id = $conn->insert_id;

  // Return last_id
  return $last_id;
}

// Create a new order item in the database
function newItem($conn, $orderID, $productID, $quantity)
{
  // Query the database
  $query = "INSERT INTO Items (orderID, productID, quantity) VALUES ('$orderID', '$productID', '$quantity')";
  $conn->query($query);
  $last_id = $conn->insert_id;

  // Return last_id
  return $last_id;
}