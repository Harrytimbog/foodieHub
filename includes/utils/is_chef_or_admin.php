<?php 
// Check if user is logged in
include_once "../utils/db_connection.php";
// if user is logged in, check for user's authorisation based on user's role
$user_id = $_SESSION['user_id'];


try {
  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
    $sql->execute([$user_id]);

    $user = $sql->fetch(PDO::FETCH_ASSOC);
    if ($user["role"] !== 'Chef' || $user['is_admin'] === 0) {
      header("Location: restricted.php");
      exit();
    }
  }
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

