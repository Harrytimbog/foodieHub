<?php 
session_start();

include("./includes/db_connection.php");

try {
  // Check session for user_id
  if (isset($_SESSION['user_id'])) {
    // find user from the database
    $user_id = $_SESSION['user_id'];
    // To avoid sql injection
    $statement = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
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
      </head>
      <body>
        <h1>Manage Account</h1>
        <?php         
        include("./components/user/user-update-form.php");
        ?>
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

