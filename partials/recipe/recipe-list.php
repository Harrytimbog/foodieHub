<?php 

try {
  // fetch Recipes
  $fetch_recipes = "SELECT * FROM Recipes";
  
  // Check if there are any filters applied
  if (isset($_GET['address']) && $_GET['address'] != '') {
    $fetch_recipes .= " WHERE address LIKE '%{$_GET['address']}%'";
  }
  if (isset($_GET['category']) && $_GET['category'] != 'Choose Category') {
    $category_id = $_GET['category'];
    if (strpos($fetch_recipes, 'WHERE') !== false) {
      $fetch_recipes .= " AND category_id = $category_id";
    } else {
      $fetch_recipes .= " WHERE category_id = $category_id";
    }
  }

  $statement = $pdo->prepare($fetch_recipes);
  $statement->execute();
  $recipes = $statement->fetchAll(PDO::FETCH_ASSOC);

  // Display the list of Recipes
  if(empty($recipes)) {
    echo "No Recipes found";
  } else {
    echo "<h3 class='recipe-header text-center mt-5'>Recipes</h3>";
    echo "<div class='row row-cols-1 row-cols-md-3 g-4'>";
    foreach ($recipes as $recipe) {
      $recipeOwnerId = $recipe['chef_id'];
      $recipeOwnerSql = "SELECT * FROM users where user_id = ?";
      $statement = $pdo->prepare($recipeOwnerSql);
      $statement->execute([$recipeOwnerId]);
      $recipeOwner = $statement->fetchAll(PDO::FETCH_ASSOC);
      echo "<div class='col'>";
      echo "<div class='card'>";
      echo "<div class='card-img-container'>";
      echo "<img src='./uploads/{$recipe['photo']}' alt='Recipe Photo' card='card-img-top' />";
      echo "</div>";
      echo "<div class='card-body'>";
      echo "<h5><a href='../../recipe.php?title={$recipe['title']}'>{$recipe['title']}</a></h5>";
      echo "<div>";
      echo "<img src='./uploads/{$recipeOwner[0]['photo']}' class='card-recipe-user avatar-bordered' />";
      echo "</div>";
      echo "</div>";
      echo "<small class='p-3 recipe-owner-intro'>created by <a href='user_details.php?username={$recipeOwner[0]['username']}'>{$recipeOwner[0]['username']}</a></small>";
      echo "</div>";
      echo "</div>";

    }
    echo "</div>";
  }
} catch (PDOException $e) {
  // throw error
  echo "<h3>Something went wrong</h3> " . $e->getMessage();
}
?>
