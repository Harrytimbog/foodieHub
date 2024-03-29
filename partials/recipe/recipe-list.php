<?php 

try {
  // fetch Recipes
  $fetch_recipes = "SELECT * FROM Recipes";
  $statement = $pdo->prepare($fetch_recipes);
  $statement->execute();
  $recipes = $statement->fetchAll(PDO::FETCH_ASSOC);

  // Display the list of Recipes
  if(empty($recipes)) {
    echo "No Recipes created yet";
  } else {
    echo "<h3>Recipes</h3>";
    echo "<ul>";
    foreach ($recipes as $recipe) {

      echo "<li><a href='../../recipe.php?title={$recipe['title']}'>{$recipe['title']}</a></li>";
      echo "<img src='./uploads/{$recipe['photo']}' alt='Recipe Photo' />";

    }
    echo "</ul>";
  }
} catch (PDOException $e) {
  // throw error
  echo "<h3>Something went wrong</h3> " . $e->getMessage();
}