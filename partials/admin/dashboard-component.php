<?php 

try {

  // SQL to fetch users
  $fetch_all_users_sql = "SELECT * FROM users";
  $fetch_all_users_stmt = $pdo->prepare($fetch_all_users_sql);
  $fetch_all_users_stmt->execute();
  $users = $fetch_all_users_stmt->fetchAll(PDO::FETCH_ASSOC);
  
  
  // SQL to fetch recipes
  
  $fetch_all_recipes_sql = "SELECT * FROM Recipes";
  $fetch_all_recipes_stmt = $pdo->prepare($fetch_all_recipes_sql);
  $fetch_all_recipes_stmt->execute();
  $recipes = $fetch_all_recipes_stmt->fetchAll(PDO::FETCH_ASSOC);

  // Display a list of users and recipes side by side
  echo "<div class='container dashboard'>";
  echo "<div class='row justify-content-center'>";
  
  // Users column
  echo "<div class='col-md-6'>";
  echo "<h2 class='dashboard-heading text-center'>Users</h2>";
  echo "<div class='list-group'>";
  foreach($users as $user) {
    if ($user['is_admin'] === 0 ) {
      echo "<div class='list-group-item d-flex justify-content-between align-items-center'>";
      echo "<a class='user-link' href='user_details.php?username={$user['username']}'>{$user['username']}</a>";
      echo "<span class='badge bg-secondary'>{$user['role']}</span>";
      echo "<form class='delete-form' action='../includes/admin/delete_user.php' method='post'>";
      echo "<input type='hidden' name='user_id' value='{$user['user_id']}'>";
      echo "<input type='submit' class='btn btn-danger' value='Delete' onclick='return confirm(\"Are you sure you want to delete this user?\");'>";
      echo "</form>";
      echo "</div>";
    }
  }
  echo "</div>"; // Close list-group
  echo "</div>"; // Close col-md-6
  
  // Recipes column
  echo "<div class='col-md-6'>";
  echo "<h2 class='dashboard-heading text-center'>Recipes</h2>";
  echo "<div class='list-group'>";
  foreach($recipes as $recipe) {
    echo "<div class='list-group-item d-flex justify-content-between align-items-center'>";
    echo "<a class='recipe-link' href='recipe_details.php?username={$recipe['title']}'>{$recipe['title']}</a>";
    echo "<form class='delete-form' action='../includes/recipes/delete_recipe.inc.php' method='post'>";
    echo "<input type='hidden' name='recipe_id' value='{$recipe['recipe_id']}'>";
    echo "<input type='submit' class='btn btn-danger' value='Delete' onclick='return confirm(\"Are you sure you want to delete this recipe?\");'>";
    echo "</form>";
    echo "</div>";
  }
  echo "</div>"; // Close list-group
  echo "</div>"; // Close col-md-6
  
  echo "</div>"; // Close row
  echo "</div>"; // Close container
  
} catch (PDOException $e) {
  echo "<h3>Error: </h3>" . $e->getMessage();
}

?>
