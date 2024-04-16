<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | Categories</title>
  <link rel="stylesheet" href="/css/categories.css">
  <link rel="stylesheet" href="/css/navbar.css">
  <link rel="stylesheet" href="/css/footer.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
  <!-- <link rel="manifest" href="/site.webmanifest"> -->

</head>
<body>
  <!-- NAVBAR -->
  <?php include("./partials/navbar.php") ?>
  <main class="categories-page">
    <div class="container">

      <h1>Recipe Categories</h1>
      <p>Discover and expore our huge selection of delicacy categories from around the World</p>
      
      <!-- brand | search bar -->
      
      <!-- categories -->
      <!-- Category List -->
      <div class="category-bars">
      <?php
        include "./includes/utils/db_connection.php";
        include("./partials/category/categories.php");
      ?>
      </div>

      <div class="action-buttons">

        <?php 
          // Confirm that user is logged in and that user is an admin or a chef
          if (isset($_SESSION['is_admin'])) {
            if ($_SESSION['is_admin'] === 1) {
              echo '<a class="btn btn-primary" href="/add-category.php">Add Recipe Category</a> <br>';
            }
            
            if ($_SESSION['user_id'] === "Chef" || $_SESSION['is_admin'] === 1) {
              echo '<a class="btn btn-success" href="/add-recipe.php">Add Your Recipe</a>';
            }
          }
      
        ?>
      </div>
    </div>
  </main>
  
  <!-- FOOTER -->
  <?php include("./partials/footer.php") ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>