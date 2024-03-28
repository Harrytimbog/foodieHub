<?php 
// Check if user is logged in
include_once "../utils/db_connection.php";
// if user is logged in, check for user's authorisation based on user's role
$user_id = $_SESSION['user_id'];


if ($_SESSION["role"] !== 'Chef' && $_SESSION['role'] !== 'Admin') {
  header("Location: restricted.php");
  exit();
}
