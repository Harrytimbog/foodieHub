<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | Add New Category</title>
  <link rel="stylesheet" href="./css/navbar.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/categories.css">
  <link rel="stylesheet" href="./css/footer.css">
</head>
<body>
  <!-- NAVBAR  -->
  <?php include("./partials/navbar.php"); ?>
  <!-- Add Recipe Form  -->
  <main class="container mt-5" style="height: 90vh;">
  <div class="row justify-content-center">
    <div class="col-6">
      <?php include("./partials/category/new_category_form.php"); ?>
    </div>
  </div>
  </main>

  <?php check_add_recipe_errors();  ?>
  <!-- FOOTER -->
  <?php include("./partials/footer.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>