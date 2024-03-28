<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | Recipes</title>
  <link rel="stylesheet" href="/css/recipes.css">
  <link rel="stylesheet" href="/css/navbar.css">
  <link rel="stylesheet" href="/css/footer.css">
</head>
<body>
  <!-- NAVBAR -->
  <?php include("./components/navbar.php") ?>
  <main class="recipe-page">

    <h1>Recipes</h1>
    <p>Discover and expore our huge selection of delicious recipes from around the World</p>
    
    <!-- brand | search bar -->
    
    <!-- categories -->
    
    <!-- Recipe List -->
    <ul>
      <li></li>
    </ul>
    <?php 
    include("./includes/utils/is_chef_or_admin.php");
    echo '<a href="/add-recipe.php">Add Your Recipe</a>';
    ?>
    <!-- FOOTER -->
  </main>
  <?php include("./components/footer.php") ?>
</body>
</html>