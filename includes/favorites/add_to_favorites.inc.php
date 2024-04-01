<?php 

include "../utils/start_session.php";
include "../utils/db_connection.php";

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['add_to_favorites'])) {
  // Get Current UserId

  $user_id = $_SESSION['user_id'];

  // Get recipe Id from form

  $recipe_id = $_POST['recipe_id'];

  // Get recipe

  $recipe_script = "SELECT * FROM Recipes WHERE recipe_id = ?";
  $recipe_statement = $pdo->prepare($recipe_script);
  $recipe_statement->execute([$recipe_id]);

  // Fetch the recipe details
  $recipe = $recipe_statement->fetch(PDO::FETCH_ASSOC);

  // Insert both user reference and recipe reference into Favorites Table
  
  $sql_script = "INSERT INTO Favorites (user_id, recipe_id) VALUES (?, ?)";
  $statement = $pdo->prepare($sql_script);


    // Execute the statement
  if ($statement->execute([$user_id, $recipe_id])) {
      // Recipe added successfully
      // Redirect back to the page where the form was submitted
      // header("Location: " . $_SERVER['HTTP_HOST'] . "/recipes.php");
      header("Location: ../../../../recipe.php?title={$recipe['title']}");
      exit();
  } else {
      // Error occurred while adding the recipe
      // Redirect back to the form with an error message
      header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=1");
      exit();
  }
}
