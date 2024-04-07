<?php 
// Check if user is logged in

include "./includes/utils/start_session.php";
include "./includes/utils/db_connection.php";

try {
  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch the user from the database
    $sql_statement = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
    $sql_statement->execute([$user_id]);
    $user = $sql_statement->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
      header("Location: /login.php");
    }
    

    // Fetch the user's favorite recipes from the database
    $sql_favorites = $pdo->prepare("
      SELECT r.* 
      FROM Recipes r
      INNER JOIN Favorites f ON r.recipe_id = f.recipe_id
      WHERE f.user_id = ?
    ");
    $sql_favorites->execute([$user_id]);
    $favorite_recipes = $sql_favorites->fetchAll(PDO::FETCH_ASSOC);
  }
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit(); // Terminate script if the database connection fails
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | <?php echo isset($user['username']) ? $user['username'] . "'s Favorite Recipes" : "Favorite Recipes"; ?></title>
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
        <h1 class='text-center'>
          <?php echo isset($user['username']) ? $user['username'] . "'s Favorite Recipes" : "Favorite Recipes"; ?>
        </h1>            
        <h3 class='text-center'>Role: 
          <?php 
            echo isset($user['role']) ? ($user['role'] === 'Chef' ? $user['role'] . ' 👨🏾‍🍳' : $user['role']) : "";
          ?>
        </h3>
        <?php 
        if (isset($user['is_admin']) && $user['is_admin'] === 1) {
          echo "<p class='text-center'>Admin 👮‍♀️</p>";
        }
        ?>
      </div>

      <!-- recipes created by user -->
      <div class="row">
        <?php           
          if (isset($favorite_recipes) && is_array($favorite_recipes)) {
            foreach ($favorite_recipes as $recipe) {
              // Fetch the user details of the recipe owner
              $sql_owner = $pdo->prepare("SELECT * FROM Users WHERE user_id = ?");
              $sql_owner->execute([$recipe['chef_id']]);
              $recipeOwner = $sql_owner->fetch(PDO::FETCH_ASSOC);
        ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
              <div class="card-img-container">
                <img src='./uploads/<?php echo $recipe['photo']; ?>' alt='Recipe Photo' class='card-img-top' />
              </div>
              <div class='card-body'>
                <h5><a href='../../recipe.php?title=<?php echo $recipe['title']; ?>'><?php echo $recipe['title']; ?></a></h5>
                <div>
                  <img src='./uploads/<?php echo $recipeOwner['photo']; ?>' class='card-recipe-user avatar-bordered' />
                </div>
              </div>
              <small class='p-3 recipe-owner-intro'>created by <a href='user_details.php?username=<?php echo $recipeOwner['username']; ?>'><?php echo $recipeOwner['username']; ?></a></small>
            </div>
          </div>
        <?php
            }
          }
        ?>
      </div>
    </div>
  </main>
  <!-- FOOTER -->
  <?php include("./partials/footer.php") ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body
