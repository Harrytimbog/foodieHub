<?php 

try {
  // fetch Recipes
  // Display the list of Recipes
  if(empty($recipes)) {
    echo "No Recipes created yet";
  } else {
    echo "<h3 class='recipe-header text-center mt-5'> {$user['username']}'s Collections</h3>";
    echo "<div class='row row-cols-1 row-cols-md-3 g-4'>";
    foreach ($recipes as $recipe) {
      // $chefId = $recipe['chef_id'];
      // $chefSql = "SELECT * FROM users where user_id = ?";
      // $statement = $pdo->prepare($chefSql);
      // $statement->execute([$chefId]);
      // $chef = $statement->fetchAll(PDO::FETCH_ASSOC);
      // print_r($chef[0]);
      // echo $chef['photo'];
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
  // throw error if any
  echo "<h3>Something went wrong</h3> " . $e->getMessage();
}