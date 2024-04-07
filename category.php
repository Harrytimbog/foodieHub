<?php 

// imports

include("./includes/utils/db_connection.php");

// Fetch recipe details using the title from the url params

if (isset($_GET["name"])) {
  $category_name = $_GET["name"];


  // Fetch the recipe with this title from the database

  $sql_category = $pdo->prepare("SELECT * FROM Categories WHERE name = ?");
  $sql_category->execute([$category_name]);
  $category = $sql_category->fetch(PDO::FETCH_ASSOC);

  if (!$category) {
    die('Category not Found');
  }

} else {
  header("Location: error.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | <?php echo $category['name']; ?></title>
  <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
  <!-- <link rel="manifest" href="/site.webmanifest"> -->
</head>
<body>
  <h1><?php $category['name'];  ?></h1>
  <ul>
    <li>Title: <?php echo $category['name']; ?></li>
    <p><?php print_r($category) ?></p>
  </ul>
</body>
</html>