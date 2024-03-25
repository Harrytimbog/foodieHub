<?php 

declare(strict_types= 1);

function find_user(object $pdo, string $email) {
  $query = "SELECT * FROM users WHERE email = :email";
  $statement = $pdo->prepare($query);
  $statement->bindParam(":email", $email);
  $statement->execute();

  // Fetch this result as an associative array
  $data = $statement->fetch(PDO::FETCH_ASSOC);
  return $data;
};