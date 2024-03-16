<?php 

try {
  // Database connection credentials
  $db_servername = "localhost";
  $db_username = "root";
  $db_password = "PeerPal"; 
  $db_name = "FoodieHub";

  // Import load_dotenv

  // require_once("load_dotenv.php");
  // $db_servername = $_ENV['DB_SERVERNAME'];
  // $db_username = $_ENV['DB_USERNAME'];
  // $db_password = $_ENV['DB_PASSWORD']; 
  // $db_name = $_ENV['DB_NAME'];


  // echo "<p> " .$db_servername. "</p>";
  // echo "<p> " .$db_username. "</p>";
  // echo "<p> " .$db_password. "</p>";
  // echo "<p> " .  $db_name. "</p>";

  // connect database

  $pdo = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);

  // Set PDO ERROR MODE TO EXCEPTION

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //////////////////////////////////////// Start Creating Tables ////////////////////////////////////////////
  // CREATE DATABASE

  $sql_db = "CREATE DATABASE IF NOT EXISTS foodiehub";

  // Create Users Table

  $sql_users = "CREATE TABLE IF NOT EXISTS Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    role ENUM('Viewer', 'Chef', 'Admin') NOT NULL
  )";

  // Create Recipes Table

  $sql_recipes = "CREATE TABLE IF NOT EXISTS Recipes (
    recipe_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    ingredients TEXT,
    instructions TEXT,
    chef_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (chef_id) REFERENCES Users(user_id)
  )";

  // Create Favorites Table

  $sql_favorites = "CREATE TABLE IF NOT EXISTS Favorites (
      favorite_id INT AUTO_INCREMENT PRIMARY KEY,
      user_id INT NOT NULL,
      recipe_id INT NOT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      FOREIGN KEY (user_id) REFERENCES Users(user_id),
      FOREIGN KEY (recipe_id) REFERENCES Recipes(recipe_id)
  )";

  // Create Comments Table

  $sql_comments = "CREATE TABLE IF NOT EXISTS Comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    recipe_id INT NOT NULL,
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (recipe_id) REFERENCES Recipes(recipe_id)
  )";


// Execute SQL commands

$pdo->exec($sql_db);
$pdo->exec($sql_users);
$pdo->exec($sql_recipes);
$pdo->exec($sql_favorites);
$pdo->exec($sql_comments);

// echo "Tables created successfully";
// echo "<p>Tables created successfully<p>";
////////////////////////////////////////////// Finished Creating Table //////////////////////////////////////
} catch (PDOException $e) {
  echo "Error occured while creating tables " . $e->getMessage();
  die("Error occured while creating tables " . $e->getMessage());
}
