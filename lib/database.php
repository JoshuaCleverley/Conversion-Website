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
  $query = "SELECT * FROM Products WHERE Featured = 1";
  $res = $conn->query($query);

  // Return response
  return $res;
}