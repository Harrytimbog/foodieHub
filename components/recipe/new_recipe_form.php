
<h3>Add New Recipe</h3>
<form action="../../includes/recipes/add_recipe.inc.php" method="POST">
  <label for="title">Title</label>
  <input type="text" id="title" name="title" required ><br>
  <label for="description">Description</label>
  <textarea id="description" name="description" rows="4" cols="50"></textarea><br>
  <label for="ingredients">Ingredients</label>
  <textarea id="ingredients" name="ingredients" rows="4" cols="50"></textarea><br>
  <label for="instructions">Instructions</label>
  <textarea id="instructions" name="instructions" rows="4" cols="50"></textarea><br>
  <button type="submit">Add Recipes</button>
</form>