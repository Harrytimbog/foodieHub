<?php 
// Check if user is logged in

// if user is logged in, check for user's authorisation based on user's role
if ($_SESSION["role"] !== 'Chef' && $_SESSION['role'] !== 'Admin') {
  header("Location: restricted.php");
  exit();
}
