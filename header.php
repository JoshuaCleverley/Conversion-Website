<?php
$homeClass = "nav-item";
$productsClass = "nav-item";
$currentPage = basename($_SERVER['PHP_SELF']);

if ($currentPage == "index.php") {
  $homeClass .= " active";
} else if ($currentPage == "products.php") {
  $productsClass .= " active";
}
?>

<header class="header">
  <h1 class="logo"><a href="index.php">Shop</a></h1>
  <nav>
    <ul>
      <li class=<?php echo $homeClass ?>><a href="index.php">Home</a></li>
      <li class=<?php echo $productsClass ?>><a href="products.php">Products</a></li>
    </ul>
  </nav>
  <div class="basket">
    <div class="basket-count"></div>
  </div>
</header>