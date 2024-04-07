<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | Recipes</title>
  <link rel="stylesheet" href="/css/recipes.css">
  <link rel="stylesheet" href="/css/navbar.css">
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
  <main class="recipe-page">
    <div class="container">
      
      <!-- banner -->

      <div class="banner">
        <h1>FoodieHub</h1>
        <p>Discover and expore our huge selection of delicacy recipes from around the World</p>
      </div>
      <!-- brand | search bar -->

      <!-- Filter Form -->
    <div class="row justify-content-center mt-4">
      <form class="form-inline" method="GET" action="">
        <div class="d-flex">
          <div class="form-group mx-sm-3 mb-2">
            <!-- <label for="inputlocation" class="sr-only">location</label> -->
            <input type="text" class="form-control" id="inputlocation" name="location" placeholder="location">
          </div>
          <div class="form-group mx-sm-3 mb-2">
            <!-- <label for="inputCategory" class="sr-only">Category</label> -->
            <select class="form-select" id="inputCategory" name="category">
              <option selected disabled>Choose Category</option>
              <?php
                // Fetch and display categories
                include "./includes/utils/db_connection.php";
                $fetch_categories = "SELECT * FROM Categories";
                $statement = $pdo->prepare($fetch_categories);
                $statement->execute();
                $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($categories as $category) {
                  echo "<option value='{$category['category_id']}'>{$category['name']}</option>";
                }
              ?>
            </select>
          </div>
          <button type="submit" class="btn btn-primary mb-2">Filter</button>
        </div>
      </form>
    </div>

      <?php // echo sizeof($category) ?>
      <div class="row recipe-content">

        <!-- categories -->
        <div class="col-lg-3 mb-3 category-section">

          <?php
            include "./includes/utils/db_connection.php";
            // include("./partials/category/categories.php");
            try {
            // fetch categories
            $fetch_categories = "SELECT * FROM Categories";
            $statement = $pdo->prepare($fetch_categories);
            $statement->execute();
            $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            // Display the list of categories
            if(empty($categories)) {
              echo "No Categories created yet";
            } else {
              echo "<div class='categories col'>";
              echo "<h3 class='mt-5 text-center category-header'>Categories</h3>";
              foreach ($categories as $category) {
                echo "<div class='category-pill'><a href='../../category.php?name={$category['name']}'>{$category['name']}</a></div>";
              }
              echo "</div>";
            }
          } catch (PDOException $e) {
            // throw error
            echo "<h3>Something went wrong</h3> " . $e->getMessage();
          }
          
        ?>
        </div>
        <!-- Recipe List -->
        <div class="col-lg-9 recipes-section">
          
          <?php include("./partials/recipe/recipe-list.php"); ?>
          
          <div class="action-btns">
            
            <?php 
              include "./includes/utils/db_connection.php";
              
              // Confirm that user is logged in and that user is an admin or a chef
              if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                $currentUserSql = "SELECT * FROM Users where user_id = ?";
                $statement = $pdo->prepare($currentUserSql);
                $statement->execute([$user_id]);
                $currentUser = $statement->fetchAll(PDO::FETCH_ASSOC);
                if ($_SESSION['is_admin'] === 1) {
                  echo '<a class="btn btn-dark" href="/add-category.php">Add Recipe Category</a> <br>';
                }
                
                if ($currentUser[0]['role'] === "Chef" || $_SESSION['is_admin'] === 1) {
                  echo '<a class="btn btn-info" href="/add-recipe.php">Add Your Recipe</a>';
                }
              }           
            ?>
          </div>
        </div>
        <!-- FOOTER -->
      </div>
    </div>
  </main>
  
  <?php include("./partials/footer.php") ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>