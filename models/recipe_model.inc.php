<?php 

declare(strict_types= 1);

// Get Recipe title From DB
function get_recipe(object $pdo, string $title) {
  $query = "SELECT title FROM recipes WHERE title = :title";
  $statement = $pdo->prepare($query);
  $statement->bindParam(":title", $title);
  $statement->execute();

  // Fetch this result as an associative array
  $result = $statement->fetch(PDO::FETCH_ASSOC);
  return $result;
}

function set_recipe(object $pdo, string $title, string $description, string $ingredients, string $instructions, string $chef_id) {
  $query = "INSERT INTO recipes (title, description, ingredients, :instructions) VALUES (:title, :description, :ingredients, :instructions, :chef_id);";
  $statement = $pdo->prepare($query);


  $statement->bindParam(":title", $title);
  $statement->bindParam(":description", $description);
  $statement->bindParam(":ingredients", $ingredients);
  $statement->bindParam(":instructions", $instructions);
  $statement->bindParam(":chef_id", $chef_id);
  $statement->execute();
}