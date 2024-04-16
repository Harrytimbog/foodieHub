<?php 
session_start();

include("./includes/utils/db_connection.php");

try {
  // Check session for user_id
  if (isset($_SESSION['user_id'])) {
    // find user from the database
    $user_id = $_SESSION['user_id'];
    // To avoid sql injection
    $statement = $pdo->prepare("SELECT * FROM Users WHERE user_id = ?");
    $statement->execute([$user_id]);
    // execute task
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Display user's profile if there is a user or display an error page if there is no user
    if ($user) {
      ?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage User Profile</title>
        <link rel="stylesheet" href="./css/navbar.css">
        <link rel="stylesheet" href="./css/footer.css">
        <link rel="stylesheet" href="./css/profile.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
        <!-- <link rel="manifest" href="/site.webmanifest"> -->
      </head>
      <body>
        <!-- Navbar -->
        <?php include("./partials/navbar.php"); ?>
        <!-- Navbar -->

        <h1 class='text-center'>Manage Account</h1>

        <div class="container manage-profile">
          <?php         
          include("./partials/user/user-update-form.php");
          ?>
        </div>
        <!-- FOOTER -->
        <?php include("./partials/footer.php"); ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      </body>
      </html>
      <?php
    } else {
      echo "<h1>User not found</h1>";
    }
  } else {
    echo "<h1>UserID not provided</h1>";
  }
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

