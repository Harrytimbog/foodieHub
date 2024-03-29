<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | Add New Category</title>
  <link rel="stylesheet" href="./css/navbar.css">
  <link rel="stylesheet" href="./css/footer.css">
</head>
<body>
  <!-- NAVBAR  -->
  <?php include("./partials/navbar.php"); ?>
  <!-- Add Recipe Form  -->
  <main style="height: 90vh;">
    <?php include("./partials/category//new_category_form.php"); ?>
  </main>

  <?php check_add_recipe_errors();  ?>
  <!-- FOOTER -->
  <?php include("./partials/footer.php"); ?>
</body>
</html>