<?php 

// imports

include("./includes/utils/db_connection.php");

// Fetch recipe details using the title from the url params

if (isset($_GET["title"])) {
  $recipe_title = $_GET["title"];


  // Fetch the recipe with this title from the database

  $sql_recipe = $pdo->prepare("SELECT * FROM Recipes WHERE title = ?");
  $sql_recipe->execute([$recipe_title]);
  $recipe = $sql_recipe->fetch(PDO::FETCH_ASSOC);

  
  if (!$recipe) {
    die('Recipe not Found');
  }

  // Fetch Category for this recipe

  $sql_recipe_category = $pdo->prepare("SELECT * FROM Categories WHERE category_id = ?");
  $sql_recipe_category->execute([$recipe['category_id']]);
  $category = $sql_recipe_category->fetch(PDO::FETCH_ASSOC);

  // Fetch Chef for this recipe

  $sql_recipe_chef = $pdo->prepare("SELECT * FROM Users WHERE user_id = ?");
  $sql_recipe_chef->execute([$recipe['chef_id']]);
  $chef = $sql_recipe_chef->fetch(PDO::FETCH_ASSOC);

} else {
  header("Location: error.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/navbar.css">
  <link rel="stylesheet" href="/css/recipe-page.css">

  <link rel="stylesheet" href="/css/footer.css">  
  <title>FoodieHub | <?php echo $recipe['title']; ?></title>
</head>
<body>
  <!-- NAVBAR -->
  <?php include("./partials/navbar.php") ?>
  <div class="recipe-page">
    <div class="container">
      <div class="row justify-content-center">
        <!-- <h1 class='text-center'><?php echo $recipe['title'];  ?></h1> -->
        <div class="col-5">
          <div class="recipe-image">
            <img src="./uploads/<?php echo $recipe['photo']; ?>" alt=<?php echo $recipe['title'];  ?>>
          </div>
        </div>
        <div class="col-6">
          <div class="recipe-content">
              <h1><?php echo $recipe["title"]; ?></h1>
              <p>Ingredients: <?php echo $recipe["ingredients"]; ?></p>
              <p>Instructions: <?php echo $recipe["instructions"]; ?></p>
              <p>Chef: <?php echo $chef["username"]; ?></p>
              <p>Category: <span class='recipe-category'><a href='./category.php?name=<?php echo urlencode($category["name"]); ?>'><?php echo htmlspecialchars($category["name"]); ?></a></span></p>

              <p>Address: <?php echo $recipe["address"]; ?></p>
              <p>Created on: <?php echo date("F j, Y, g:i a", strtotime($recipe["created_at"])); ?></p>
              <p><?php // print_r($recipe) ?></p>
          </div>
          <?php 
            include "./includes/utils/start_session.php";
            if (isset($_SESSION['user_id'])) {
              if ($_SESSION['user_id'] === $recipe['chef_id'] || $_SESSION['is_admin'] === 1) {
                echo '<a class="btn btn-secondary" href="edit-recipe.php?title=' . urlencode($recipe["title"]) . '">Edit Recipe</a>';

                echo "<form action='./includes/recipes/delete_recipe.inc.php' method='post'>";
                echo "<input type='hidden' name='recipe_id' value='{$recipe['recipe_id']}'>";
                echo "<input type='submit' class='btn btn-danger' value='Delete Recipe' onclick='return confirm(\"Are you sure you want to delete this recipe?\");'>";
                echo "</form>";
              }

            }
          ?>
        </div>

      </div>
    </div>
  </div>
  <!-- FOOTER -->
  <?php include("./partials/footer.php") ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>