<?php 

// Imports

// require_once 'includes/db_connection.php';
require_once "includes/utils/session_config.php";
require_once 'views/login_view.inc.php';


// Redirect logged in user away from login page
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
  <title>FoodieHub | Login Page</title>
  <link rel="stylesheet" href="/css/navbar.css">
  <link rel="stylesheet" href="/css/login.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/footer.css">
</head>
<body>
  <!-- NAVBAR -->
  <?php include("./partials/navbar.php") ?>
  <main class="login-page">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-6 col-lg-8">

          <h2 class="mt-5 login-header">Welcome Back to FoodieHub</h2>
          <form action="includes/login/login.inc.php" target="_self" method="post" autocomplete="on">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email location</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" placeholder="Password" class="form-control" id="exampleInputPassword1">
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>
          <button type="submit" class="btn btn-primary btn-lg">Login</button>
        </form>
        <p>Are you new here? <a href="/signup.php">create an account</a></p>
        <p>Forgot Password? <a href="/password-reset.php">Reset Password</a></p>
        
        <?php 
        
        check_login_errors()
        ?>
        <!-- FOOTER -->
        <a href="/">back home</a>
      </div>
      </div>
      <div class="bg-form-content"></div>
    </div>
  </main>
  <?php include("./partials/footer.php") ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>