<?php 

try {
  // fetch Recipes owned by chef


  
  $fetch_recipes = "SELECT * FROM Recipes WHERE chef_id = ?";
  $statement = $pdo->prepare($fetch_recipes);
  $statement->execute([$user['user_id']]);
  $recipes = $statement->fetchAll(PDO::FETCH_ASSOC);

  // Display the list of Recipes
  if(empty($recipes)) {
    echo "No Recipes created yet";
  } else {
    echo "<h3 class='recipe-header text-center mt-5'> {$user['username']}'s Collections</h3>";
    echo "<div class='row row-cols-1 row-cols-md-3 g-4'>";
    foreach ($recipes as $recipe) {
      echo "<div class='col'>";
        echo "<div class='card'>";
          echo "<div class='card-img-container'>";
            echo "<img src='./uploads/{$recipe['photo']}' alt='Recipe Photo' card='card-img-top' />";
          echo "</div>";

          echo "<div class='card-body'>";
            echo "<h5><a href='../../recipe.php?title={$recipe['title']}'>{$recipe['title']}</a></h5>";
            echo "<div>";
              echo "<img src='./uploads/{$user['photo']}' class='card-recipe-user avatar-bordered' />";
            echo "</div>";
          echo "</div>";
          echo "<small class='p-3 recipe-owner-intro'>created by {$user['username']}</small>";
        echo "</div>";
      echo "</div>";

    }
    echo "</div>";
  }
} catch (PDOException $e) {
  // throw error
  echo "<h3>Something went wrong</h3> " . $e->getMessage();
}