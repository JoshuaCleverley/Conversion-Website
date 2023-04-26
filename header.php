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

<header>
  <div class="header">
    <a id="hamburger" class="hamburger-menu">
      <svg class="hamburger-open" xmlns="http://www.w3.org/2000/svg" fill="#FFFFFF" width="24" height="24"
        viewBox="0 0 16 16">
        <path d="M 1 2 L 1 3 L 14 3 L 14 2 Z M 1 7 L 1 8 L 14 8 L 14 7 Z M 1 12 L 1 13 L 14 13 L 14 12 Z"></path>
      </svg>
    </a>
    <a class="logo" href="index.php">Logo</a>

    <nav class="desktop-nav">
      <a class="<?php echo $homeClass ?>" href="index.php">Home</a>
      <a class="<?php echo $productsClass ?>" href="products.php">Products</a>
    </nav>
    <a href="basket.php" class="basket_icon">
      <img
        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAACXBIWXMAAAsTAAALEwEAmpwYAAABWElEQVR4nO2WMU4CURRFpxIbLCggsRYXIC5AXIBogqVuADegG8AN6AZ0A9pQakIBDVgbsbLTTm2ojvlyJyQ6Q97E9xvDTab5//De4TPzhiRZpmCAFeAEGAKfugZAJ+zFbr4OPJCfcWBiNS+pQcgL0AbKug6AR+2NopwEs2NPm1cy9ivaC+nEEBiqeHsBcyhmEEPgQ8XLC5g1Me9/bdbDPz1r81XipWQRqAp+/bH+HcPnf3GhlparFoG64CdHgYmWNywCDcEjR4F0fmxZBJqC7xwF7rW8YxFoCb5JnALcquaeBT4WfOUocK2aR0VG7oWjwKV5RANngruOAueqeWqBu2bYLmD/UhQ5LruA/WelyA1jF7Df2MwfmZajwL750WY+NJqOArtZwy0PTv/zNRwFtlVzbIGfBdcdBTZVc2KB3wTXHAVqWa/4PHhKvEwtAv2IAn2nQ13mH+ULuCrG8NnpP3EAAAAASUVORK5CYII=">
      <span>1</span>
    </a>
  </div>
  <nav id="mobile-nav" class="mobile-nav">
    <a class="<?php echo $homeClass ?>" href="index.php">Home</a>
    <a class="<?php echo $productsClass ?>" href="products.php">Products</a>
  </nav>
</header>