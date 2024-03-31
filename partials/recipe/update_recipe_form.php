
<h1 class='mt-5 edit-recipe-header text-center'>Update Recipe</h1>

<form action="../../includes/recipes/update_recipe.inc.php" method="POST" enctype="multipart/form-data">
  <label for="title" class="form-label">Title</label>
  <input type="text" id="title" name="title" value="<?php echo $recipe['title'] ?>" class="form-control" ><br>
  <input type="hidden" id="recipe_id" name="recipe_id" value="<?php echo $recipe['recipe_id'] ?>" class="form-control" ><br>
  <label for="description" class="form-label">Description</label>
  <textarea id="description" name="description" class="form-control" rows="4" cols="50"><?php echo $recipe['description'] ?></textarea><br>
  <label for="ingredients" class="form-label">Ingredients</label>
  <textarea id="ingredients" name="ingredients" class="form-control" rows="4" cols="50"><?php echo $recipe['ingredients'] ?></textarea><br>
  <label for="instructions" class="form-label">Instructions</label>
  <textarea id="instructions" name="instructions" class="form-control" rows="4" cols="50"><?php echo $recipe['instructions'] ?></textarea><br>
  <label for="photo" class="form-label">Photo</label>
  <input type="file" id="photo" class="form-control" name="photo" required ><br>
  <label for="address" class="form-label">Address</label>
  <input type="text" class="form-control" id="address" name="address" value="<?php echo $recipe['address'] ?>" required ><br>
  <?php 
    // Fetch categories from database

    $sql_categories = "SELECT * FROM Categories";
    $result = $pdo->query($sql_categories);

    if ($result->rowCount() > 0) {
      echo '<select name="category_id" id="category_id" value="<?php echo $recipe["title"] ?>">';
      echo '<option value="">Select Recipe Category</option>';

      while( $row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="' . $row['category_id'] . '">' . $row['name'] . '</option>';
      }
      echo '</select><br>';
    } else {
      echo '<p>No categories found</p>';
    }
   ?>
  <button type="submit" class="btn btn-dark btn-lg mt-5">Update Recipe</button>
  <?php
    // print_r($_SERVER);
  ?>
</form>