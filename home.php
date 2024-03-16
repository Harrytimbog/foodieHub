<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | HomePage</title>
  <link rel="stylesheet" href="css/homepage.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/footer.css">
</head>
<body>
  <!-- NAVBAR -->
  <?php include("./components/navbar.php") ?>
  
  <!-- MAIN -->
  <main class="hero">
      <div class="container hero-content">
        <h1>Welcome to <span class="brand">FoodieHub</span></h1>
        <p>Discover and expore our huge selection of delicious recipes from around the World</p>
        <a class="explore-btn" href="/recipes.php">Discover Recipes</a>
      </div>
  </main>

  <!-- FOOTER -->
  <?php 
   include("./components/footer.php")
  ?>
</body>
</html>