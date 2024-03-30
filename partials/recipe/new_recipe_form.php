
<h3>Add New Recipe</h3>
<form action="../../includes/recipes/add_recipe.inc.php" method="POST" enctype="multipart/form-data">
  <label for="title">Title</label>
  <input type="text" id="title" name="title" required ><br>
  <label for="description">Description</label>
  <textarea id="description" name="description" rows="4" cols="50"></textarea><br>
  <label for="ingredients">Ingredients</label>
  <textarea id="ingredients" name="ingredients" rows="4" cols="50"></textarea><br>
  <label for="instructions">Instructions</label>
  <textarea id="instructions" name="instructions" rows="4" cols="50"></textarea><br>
  <label for="photo">Photo</label>
  <input type="file" id="photo" name="photo" required ><br>
  <label for="address">Address</label>
  <input type="text" id="address" name="address" required ><br>
  <?php 
    // Fetch categories from database

    $sql_categories = "SELECT * FROM Categories";
    $result = $pdo->query($sql_categories);

    if ($result->rowCount() > 0) {
      echo '<select name="category_id" id="category_id">';
      echo '<option value="">Select Recipe Category</option>';

      while( $row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="' . $row['category_id'] . '">' . $row['name'] . '</option>';
      }
      echo '</select>';
    } else {
      echo '<p>No categories found</p>';
    }
   ?>
  <button type="submit">Add Recipes</button>
  <?php
    // print_r($_SERVER);
  ?>
</form>