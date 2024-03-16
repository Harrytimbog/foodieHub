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
</head>
<body>
  <h1>Join FoodieHub: Your Culinary Adventure Begins Here</h1>
  <form action="includes/signup/signup.inc.php" method="POST">
    <?php 
      auth_inputs();
    ?>

    <button>sign up</button>
  </form>

  <p>Already have an account? <a href="/login">login</a></p>

  <?php check_auth_errors() ?>
</body>
</html>