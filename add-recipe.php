<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | Add New Recipe</title>
  <link rel="stylesheet" href="./css/navbar.css">
  <link rel="stylesheet" href="./css/add-recipe.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/footer.css">
</head>
<body>
  <!-- NAVBAR  -->
  <?php include("./partials/navbar.php"); ?>
  <!-- Add Recipe Form  -->
  <main style="min-height: 90vh;">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-6 col-lg-8">

          <?php
          include("./includes/utils/db_connection.php");
          include("./partials/recipe/new_recipe_form.php");
          ?>
        </div>
      </div>
    </div>
  </main>

  <?php // check_add_recipe_errors()  ?>

  <!-- FOOTER -->
  <?php include("./partials/footer.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>