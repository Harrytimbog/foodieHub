<?php 

// Imports

// require_once 'includes/db_connection.php';
require_once "includes/session_config.php";
require_once 'includes/login/login_view.inc.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | Login Page</title>
  <link rel="stylesheet" href="/css/navbar.css">
  <link rel="stylesheet" href="/css/login.css">
  <link rel="stylesheet" href="/css/footer.css">
</head>
<body>
  <!-- NAVBAR -->
  <?php include("./components/navbar.php") ?>
  <main class="login-page">
    <h3>Welcome Back to FoodieHub</h3>
    <form action="includes/login/login.inc.php" target="_self" method="post" autocomplete="on">
      <input type="text" name="username" placeholder="Username" required size="50" autofocus><br>
      <input type="password" name="password" placeholder="Password" required size="50" autofocus><br>
      <button>Login</button>
    </form>
    <p>Are you new here? <a href="/signup.php">create an account</a></p>

    <?php 
    
    check_login_errors()
    ?>
    <!-- FOOTER -->
    <a href="/">back home</a>
  </main>
  <?php include("./components/footer.php") ?>
</body>
</html>