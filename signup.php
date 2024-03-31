<?php 
require_once "includes/utils/session_config.php";
require_once "views/signup_view.inc.php";


  // Redirect logged in user away from signup page
  if(isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | Signup Page</title>
  <link rel="stylesheet" href="/css/navbar.css">
  <link rel="stylesheet" href="/css/signup.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/footer.css">

</head>
<body>
  <!-- NAVBAR -->
  <?php include("./partials/navbar.php") ?>
  <main class="signup-page">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-6 col-lg-8">

          <h2 class="mt-5 signup-header">Join FoodieHub: Your Culinary Adventure Begins Here</h2>
          <form action="includes/signup/signup.inc.php" method="POST">
            <?php 
            auth_inputs();
            ?>

        <button class="btn btn-primary btn-lg">sign up</button>
        </form>

        <p>Already have an account? <a href="/login.php">login</a></p>

        <?php check_auth_errors() ?>
        <!-- FOOTER -->
        <a href="/">back home</a>
        </div>
      </div>
    </div>
  </main>
  <?php include("./partials/footer.php") ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

    
    
