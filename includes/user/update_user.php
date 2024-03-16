<?php 

// Check if a session is not already active
include("../utils/start_session.php");


// Check for user's is log in status

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  
  try {
    // GET form data
    include("../db_connection.php");
    include("../utils/auth_check.php");
    $role = $_POST["role"];

    // Check if "user" session variable is set
    if (!isset($_SESSION['user_id'])) {
        throw new Exception("User session not set.");
    }

    // Write the SQL Script to update to database

    $sql = "UPDATE users SET role = ? WHERE user_id = ?";

    $result = $pdo->prepare($sql);
    $result->execute([$role, $_SESSION['user_id']]);

    // Redirect to profile page on update
    header("Location: ../../profile.php");
    exit; // Ensure no further code execution after redirection
  } catch (PDOException $e) {
    // Handle database errors
    echo "Error: " . $e->getMessage();
  }
}
