<?php 

try {
  // fetch categories
  $fetch_categories = "SELECT * FROM Categories";
  $statement = $pdo->prepare($fetch_categories);
  $statement->execute();
  $categories = $statement->fetchAll(PDO::FETCH_ASSOC);

  // Display the list of categories
  if(empty($categories)) {
    echo "No Categories created yet";
  } else {
    echo "<h3>Categories</h3>";
    echo "<ul>";
    foreach ($categories as $category) {
      echo "<li><a href='../../category.php?name={$category['name']}'>{$category['name']}</a></li>";
    }
    echo "</ul>";
  }
} catch (PDOException $e) {
  // throw error
  echo "<h3>Something went wrong</h3> " . $e->getMessage();
}
