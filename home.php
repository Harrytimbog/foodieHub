<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | HomePage</title>
  <link rel="stylesheet" href="css/homepage.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
  <!-- <link rel="manifest" href="/site.webmanifest"> -->

</head>
<body>
  <!-- NAVBAR -->
  <?php include("./partials/navbar.php") ?>
  
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
   include("./partials/footer.php")
  ?>
</body>
</html>