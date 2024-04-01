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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/dashboard.css">
        <link rel="stylesheet" href="./css/footer.css">
        <title>FoodieHub | Dashboard</title>
      </head>
      <body>
        <!-- Navbar -->
        <?php include "./partials/navbar.php";  ?>

        <!-- DASHBOARD -->

        <?php include "./partials/admin/dashboard-component.php"; ?>
       
        <!-- Footer -->

        <?php include "./partials/footer.php"; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      </body>
      </html>
      <?php
    } else {
      header("Location: ./restricted.php");
    }
  } else {
    header("Location: login.php");
    exit();
  }
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>
