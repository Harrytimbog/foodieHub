<?php 

require_once realpath(__DIR__ . "/vendor/autoload.php");

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$algoliaApiID = $_ENV["ALGOLIA_APP_ID"];
$algoliaApiKey = $_ENV["ALGOLIA_API_KEY"];


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | Add New Recipe</title>
  <link rel="stylesheet" href="./css/navbar.css">
  <link rel="stylesheet" href="./css/add-recipe.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/footer.css">
  <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
  <script src="https://cdn.jsdelivr.net/npm/places.js@1"></script>
  <!-- <link rel="manifest" href="/site.webmanifest"> -->

</head>
<body>
  <!-- NAVBAR  -->
  <?php include("./partials/navbar.php"); ?>
  <!-- Add Recipe Form  -->
  <main style="min-height: 90vh;">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-6 col-lg-8">

          <?php
          include("./includes/utils/db_connection.php");
          include("./partials/recipe/new_recipe_form.php");
          ?>
        </div>
      </div>
    </div>
  </main>

  <?php // check_add_recipe_errors()  ?>

  <!-- FOOTER -->
  <?php include("./partials/footer.php"); ?>
  <script>
    var placesAutocomplete = places({
        appId: <?php echo $algoliaApiID; ?>,
        apiKey: <?php echo $algoliaApiKey; ?>,
        container: document.querySelector('#location'), // Replace '#location' with the ID or class of your location field input
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>