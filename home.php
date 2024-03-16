<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | HomePage</title>
  <link rel="stylesheet" href="css/navbar.css">
</head>
<body>
  <!-- NAVBAR -->
  <?php include("./components/navbar.php") ?>
  <h1>Welcome to FoodieHub</h1>

  <ul>
    <li><a href="/signup.php">Signup</a></li>
    <li><a href="/login.php">Login</a></li>
    <li><a href="/profile.php">Profile</a></li>
  </ul>

  <?php 
  echo "<h2>Session User ID: " . $_SESSION['user_id'] . "</h2>";
  ?>
</body>
</html>