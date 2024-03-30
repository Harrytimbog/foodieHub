<?php 

// Check session
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

include "./includes/utils/db_connection.php";

// Confirm thhat user is logged in and user is an admin

try {
  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
    $sql->execute([$user_id]);

    $user = $sql->fetch(PDO::FETCH_ASSOC);

    if ($user["is_admin"] === 1) {
      ?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/navbar.css">
        <link rel="stylesheet" href="./css/footer.css">
        <title>FoodieHub | Dashboard</title>
      </head>
      <body>
        <!-- Navbar -->
        <?php include "./partials/navbar.php";  ?>

        <!-- DASHBOARD -->

        <div style="height: 90vh">
          <?php include "./partials/admin/dashboard-component.php"; ?>
        </div>
        <!-- Footer -->

        <?php include "./partials/footer.php"; ?>
      </body>
      </html>
      <?php
    } else {
      echo "<h1>You are restricted from this page</h1>";
    }
  } else {
    header("Location: login.php");
    exit();
  }
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>
