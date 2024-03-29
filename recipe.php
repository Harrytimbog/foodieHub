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

} else {
  header("Location: error.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | <?php $recipe['title']; ?></title>
</head>
<body>
  <h1><?php $recipe['title'];  ?></h1>
  <ul>
    <li>Title: <?php echo $recipe["title"]; ?></li>
    <p><?php print_r($recipe) ?></p>
  </ul>
</body>
</html>