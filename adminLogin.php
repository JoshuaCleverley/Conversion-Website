<?php
require 'lib/requireNotAuth.php';

// Get username and password from post request
$usernameInput = $_POST['username'];
$passwordInput = $_POST['password'];

// Connect to database
require 'lib/database.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) die("Connection failed: " . mysqli_connect_error()); // Inform user if the connection doesn't work

// Authenticate admin
$admin = authenticateAdmin($conn, $usernameInput, $passwordInput);

// If admin is authenticated, redirect to admin page
if ($admin) {
  $_SESSION['admin'] = $username;
  header('Location: adminOrders.php');
} else if ($usernameInput != "" || $passwordInput != "") {
  $error = true;
} else {
  $error = false;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In - Middleware Shopping</title>
  <link rel="stylesheet" type="text/css" href="reset.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body style="overflow: hidden;">

  <section class="login-page-container">
    <form class="login-form" action="adminLogin.php" method="POST">
      <h2>Log In</h2>
      <div class="login-form-error <?php if (!$error) echo "hide" ?>">
        <p>Invalid username or password</p>
      </div>
      <div class="login-form-input">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="Username...">
      </div>
      <div class="login-form-input">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password..">
      </div>
      <button type="submit">Log In</button>

    </form>
  </section>

</body>

</html>