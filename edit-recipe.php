<?php 

include "./includes/utils/start_session.php";

include "./includes/utils/auth_check.php";

include "./includes/utils/db_connection.php";

try {

  if (isset($_SESSION['user_id']) && isset($_GET['title'])) {

    // Fetch user
    $user_id = $_SESSION['user_id'];
    // To prevent sql injection
    $statement = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
    $statement->execute([$user_id]);
    // execute task
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Fetch recipe
    $recipe = $_GET['title'];
    $recipe_statement = $pdo->prepare("SELECT * FROM Recipes WHERE title = ?");
    $recipe_statement->execute([$recipe]);
    // execute task
    $recipe = $recipe_statement->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
      header("Location: ./login.php");
    }
    
    if ($user['is_admin'] == 0 || $recipe['chef_id'] !== $user_id) {
      header("Location: ./restricted.php");      
    }

    if ($recipe) {
      ?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/navbar.css">
        <link rel="stylesheet" href="./css/recipe-page.css">
        <link rel="stylesheet" href="./css/footer.css">
        <title>Edit Recipe</title>
        <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
        <!-- <link rel="manifest" href="/site.webmanifest"> -->

      </head>
      <body>
        <!-- NAVBAR -->
        <?php include "./partials/navbar.php"; ?>
        
        <!-- RECIPE UPDATE FORM -->
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-6">
              <?php include "./partials/recipe/update_recipe_form.php"; ?>
            </div>
          </div>
        </div>
        

        <!-- FOOTER -->
        <?php include "./partials/footer.php"; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>     
      </body>
      </html>
      <?php
    } else {
      header("Location: error.php");
      exit();
    }

  }
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>