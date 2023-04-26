<?php
// Database connection details
$servername = "localhost";
$username   = "ddm337669";
$password   = "DDMTest!JC1";
$dbname     = "ddm337669";

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