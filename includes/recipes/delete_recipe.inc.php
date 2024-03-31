<?php
  // Include the database connection
  include "../utils/db_connection.php";

  // Verify that user_id is set 
  if (isset($_POST['recipe_id']) && !empty($_POST['recipe_id'])) {
      $recipe_id = $_POST['recipe_id'];

      try {
          $delete_recipe_script = "DELETE FROM Recipes WHERE recipe_id = ?";
          $delete_recipe_stmt = $pdo->prepare($delete_recipe_script);
          $delete_recipe_stmt->execute([$recipe_id]);

          // Redirect back to the recipes pages after successful deletion
          header("Location: ../../recipes.php");
          exit();
        } catch (PDOException $e) {
          echo "Error" . $e->getMessage();
        }
  } else {
        // Redirect to the dashboard if user_id is not provided or empty
        header("Location: ../../recipes.php");
      exit();
  }
?>