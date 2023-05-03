<?php
session_start();
if (isset($_SESSION['admin'])) header('Location: adminOrders.php'); // Redirect to admin page if admin is already logged in