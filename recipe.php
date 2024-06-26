<?php 

require_once realpath(__DIR__ . "/vendor/autoload.php");

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$googleMapApiKey = $_ENV["GOOGLE_MAP_API"];

// echo $googleMapApiKey;


// imports

include("./includes/utils/db_connection.php");

// Fetch recipe details using the title from the url params

if (isset($_GET["title"])) {
  $recipe_title = $_GET["title"];

  // Fetch the recipe with this title from the database
  $sql_recipe = $pdo->prepare("SELECT * FROM Recipes WHERE title = ?");
  $sql_recipe->execute([$recipe_title]);
  $recipe = $sql_recipe->fetch(PDO::FETCH_ASSOC);

  $longitude = $recipe['longitude'];
  $latitude = $recipe['latitude'];
  
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

  // Check if the recipe is already in the user's favorites
  include "./includes/utils/start_session.php";
  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql_check_favorite = $pdo->prepare("SELECT * FROM Favorites WHERE user_id = ? AND recipe_id = ?");
    $sql_check_favorite->execute([$user_id, $recipe['recipe_id']]);
    $is_favorite = $sql_check_favorite->fetch(PDO::FETCH_ASSOC);
} else {
  $is_favorite = false;
}
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
  <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
  <!-- <link rel="manifest" href="/site.webmanifest"> -->  
  <title>FoodieHub | <?php echo $recipe['title']; ?></title>
</head>
<body>
  <!-- NAVBAR -->
  <?php include("./partials/navbar.php") ?>
  <div class="recipe-page">
    <div class="container">
      <div class="row justify-content-center">
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
              <p>Prep Time: <b><?php echo $recipe["prep_time"] ?> minutes </b><img src="./images/icons/timer.png" alt="Timer" /></p>
              <p>location: <?php echo $recipe["location"]; ?> <img src="./images/icons/location.png" alt="location"></p>
              <p>Created on: <?php echo date("F j, Y, g:i a", strtotime($recipe["created_at"])); ?></p>
              <button class="copy-btn btn btn-light my-5" onclick="copyToClipboard(this)"><img src="./images/icons/share.png" alt="share">Share Recipe</button>
              <textarea id="recipe-textarea" style="position: absolute; left: -9999px;"></textarea>

            </div>
            
            <?php 

            if (isset($_SESSION['user_id'])) {
              if ($_SESSION['is_admin'] === 1 || ($_SESSION['user_id'] === $chef['user_id'])) {
                  echo "<div class='action-btns'>";
                  echo "<a href='./edit-recipe.php?title={$recipe['title']}' class='btn btn-secondary'>Edit Recipe</a>";
                  echo "<form action='./includes/recipes/delete_recipe.inc.php' method='POST'>";
                  echo "<input type='hidden' name='recipe_id' value='{$recipe['recipe_id']}'>";
                  echo "<button type='submit' class='btn btn-danger'>Delete Recipe <img src='./images/icons/delete.png' alt=''></button>";
                  echo "</form>";
                  echo "</div>";
              }
              if ($is_favorite) {
                // If the recipe is already in favorites, display "Remove From Favorites" button
                echo "<form action='./includes/favorites/remove_from_favorites.inc.php' method='POST'>";
                echo "<input type='hidden' name='recipe_id' value='{$recipe['recipe_id']}' />";
                echo "<button type='submit' name='remove_from_favorites' class='btn btn-danger mt-5'>Remove From Favorites</button>";
                echo "</form>";
              } else {
                // If the recipe is not in favorites, display "Add To Favorites" button
                echo "<form action='./includes/favorites/add_to_favorites.inc.php' method='POST'>";
                echo "<input type='hidden' name='recipe_id' value='{$recipe['recipe_id']}' />";
                echo "<button type='submit' name='add_to_favorites' class='btn btn-dark mt-5'>Add To Favorites</button>";
                echo "</form>";
              }
            }



          ?>
        </div>
      </div>
      <a href="/recipes.php">Back</a>

    </div>
    <div id="map">

    </div>
  </div>
  <!-- FOOTER -->
  <?php include("./partials/footer.php") ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    function initMap() {
      var location = {lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?>}
      var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 4,
        center: location
      });

      var marker = new google.maps.Marker({
        position: location,
        map: map
      });
    }
  </script>    
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $googleMapApiKey; ?>&callback=initMap"></script>
  <script>
  function copyToClipboard(button) {
      // Get the recipe text to copy
      var recipeText = button.parentElement.textContent.trim();

      // Get the textarea element
      var textarea = document.getElementById('recipe-textarea');

      // Set the textarea value to the recipe text
      textarea.value = recipeText;

      // Select the textarea content
      textarea.select();

      // Copy the selected text to clipboard
      document.execCommand('copy');

      // Deselect the textarea
      textarea.setSelectionRange(0, 0);

      // Display a success message
      alert('Recipe copied to clipboard!');
  }
  </script>
</body>
</html>
