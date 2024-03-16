<?php 
require_once "includes/session_config.php";
require_once "includes/signup/signup_view.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | Signup Page</title>
  <link rel="stylesheet" href="/css/navbar.css">
  <link rel="stylesheet" href="/css/signup.css">
  <link rel="stylesheet" href="/css/footer.css">

</head>
<body>
  <!-- NAVBAR -->
  <?php include("./components/navbar.php") ?>
  <main class="signup-page">
    <h1>Join FoodieHub: Your Culinary Adventure Begins Here</h1>
    <form action="includes/signup/signup.inc.php" method="POST">
      <?php 
        auth_inputs();
      ?>

      <button>sign up</button>
    </form>

    <p>Already have an account? <a href="/login">login</a></p>

    <?php check_auth_errors() ?>
    <!-- FOOTER -->
    <a href="/">back home</a>
  </main>
  <?php include("./components/footer.php") ?>
</body>
</html>

    
    
