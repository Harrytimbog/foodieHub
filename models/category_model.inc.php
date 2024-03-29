<?php 

declare(strict_types= 1);

// Get Recipe name From DB
function get_category(object $pdo, string $name) {
  $query = "SELECT name FROM categories WHERE name = :name";
  $statement = $pdo->prepare($query);
  $statement->bindParam(":name", $name);
  $statement->execute();

  // Fetch this result as an associative array
  $result = $statement->fetch(PDO::FETCH_ASSOC);
  return $result;
}

function set_category(object $pdo, string $name) {
  $query = "INSERT INTO categories (name) VALUES (:name);";
  $statement = $pdo->prepare($query);


  $statement->bindParam(":name", $name);
  $statement->execute();
}