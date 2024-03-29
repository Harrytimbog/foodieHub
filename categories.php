<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | Categories</title>
  <link rel="stylesheet" href="/css/categories.css">
  <link rel="stylesheet" href="/css/navbar.css">
  <link rel="stylesheet" href="/css/footer.css">
</head>
<body>
  <!-- NAVBAR -->
  <?php include("./partials/navbar.php") ?>
  <main class="recipe-page">

    <h1>Categories</h1>
    <p>Discover and expore our huge selection of delicious recipes from around the World</p>
    
    <!-- brand | search bar -->
    
    <!-- categories -->
    <!-- Category List -->
    <?php
      include "./includes/utils/db_connection.php";
     include("./partials/category/categories.php");
    ?>

    <?php 
    // Confirm that user is logged in and that user is an admin or a chef
    if (isset($_SESSION['is_admin'])) {
      if ($_SESSION['is_admin'] === 1) {
        echo '<a href="/add-category.php">Add Recipe Category</a> <br>';
      }
  
      if ($_SESSION['user_id'] === "Chef" || $_SESSION['is_admin'] === 1) {
        echo '<a href="/add-recipe.php">Add Your Recipe</a>';
      }
    }

    ?>
    <!-- FOOTER -->
  </main>

  <?php include("./partials/footer.php") ?>
</body>
</html>