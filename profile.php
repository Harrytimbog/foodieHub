<?php 


// include "./includes/utils/auth_check.php";
include "./includes/utils/start_session.php";
// // Redirect logged in user away from profile page
// if(isset($_SESSION['user_id'])) {
//   exit();
// }
include "./includes/utils/db_connection.php";


try {

  // Find the user_id from the session
  if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];
    
    $sql = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
    $sql->execute([$user_id]);
    $user = $sql->fetch(PDO::FETCH_ASSOC);
    if ($user) {
      ?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FoodieHub | Profile Page</title>
        <link rel="stylesheet" href="/css/navbar.css">
        <link rel="stylesheet" href="/css/profile.css">
        <link rel="stylesheet" href="/css/recipes.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/footer.css">
        <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
        <!-- <link rel="manifest" href="/site.webmanifest"> -->
      </head>
        <body>
          <!-- NAVBAR -->
          <?php include("./partials/navbar.php") ?>
          <main class="profile-page">
            <div class="container">
              <div class="row justify-content-center">

                <h1 class='text-center'><?php echo $user['username'] . "'s Profile" ?></h1>
                <img id="profile-avatar" src="./uploads/<?php echo $user['photo'];  ?>" alt=<?php echo $user['username'] ?> />
                
                <h3 class='text-center'>Email: <?php echo $user['email']  ?></h3>
                <h3 class='text-center'>Role: <?php echo $user['role']  ?></h3>
                <?php 
                if ($user['is_admin'] === 1) {
                  echo "<p class='text-center'>Admin 👮‍♀️</p>";
                }
                ?>
              <div class="col-md-6 action-buttons">
                  <a href="/manage-profile.php" class="btn btn-secondary">Manage Profile</a>
                  <a href="/" class="btn btn-dark">back home</a>
                </div>
              </div>

              <!-- recipes created by user -->

              <?php include "./partials/user/user-recipes.php"; ?>
            </div>
            </main>
            <!-- FOOTER -->
            <?php include("./partials/footer.php") ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      </body>
      
      </html>
    <?php
    }else {
      echo "<h1>User Not Found</h1>";
    }
  } else {
    header("Location: home.php");
  }
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>


