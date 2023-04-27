<?php
if (isset($_POST['submit'])) {
  $productID = $_POST['productID'];
  $quantity = $_POST['quantity'];

  // Update a basket cookie
  if (isset($_COOKIE['basket'])) {
    $basket = json_decode($_COOKIE['basket'], true);
    $basket[$productID] = $quantity + $basket[$productID];
    setcookie('basket', json_encode($basket), time() + (86400 * 30), "/");
  } else {
    $basket = array($productID => $quantity);
    setcookie('basket', json_encode($basket), time() + (86400 * 30), "/");
  }
}