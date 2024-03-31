
<h3 class='mt-5 new-recipe-header'>Add New Recipe</h3>

<form action="../../includes/recipes/add_recipe.inc.php" method="POST" enctype="multipart/form-data">
  <label for="title" class="form-label">Title</label>
  <input type="text" id="title" name="title" class="form-control" required ><br>
  <label for="description" class="form-label">Description</label>
  <textarea id="description" name="description" class="form-control" rows="4" cols="50"></textarea><br>
  <label for="ingredients" class="form-label">Ingredients</label>
  <textarea id="ingredients" name="ingredients" class="form-control" rows="4" cols="50"></textarea><br>
  <label for="instructions" class="form-label">Instructions</label>
  <textarea id="instructions" name="instructions" class="form-control" rows="4" cols="50"></textarea><br>
  <label for="photo" class="form-label">Photo</label>
  <input type="file" id="photo" class="form-control" name="photo" required ><br>
  <label for="address" class="form-label">Address</label>
  <input type="text" class="form-control" id="address" name="address" required ><br>
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
      echo '</select><br>';
    } else {
      echo '<p>No categories found</p>';
    }
   ?>
  <button type="submit" class="btn btn-dark btn-lg mt-5">Add Recipe</button>
  <?php
    // print_r($_SERVER);
  ?>
</form>