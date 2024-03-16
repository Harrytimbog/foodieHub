<?php 

// Check for session start
include("./start_session.php");

if (!isset($_SESSION['user_id'])) {
  // Redirect to login page
  header("Location: ../../../../login.php");
  exit;
}

?>