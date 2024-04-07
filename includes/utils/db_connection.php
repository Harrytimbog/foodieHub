<?php 

require_once realpath(__DIR__ . "/../../vendor/autoload.php");


use Dotenv\Dotenv;

// Load the .env file from the root folder


// Access environmental variables

if (getenv('CLEARDB_DATABASE_URL')) {
    // Heroku environment variables
    $url = parse_url(getenv('CLEARDB_DATABASE_URL'));
    $db_servername = $url['host'];
    $db_username = $url['user'];
    $db_password = $url['pass'];
    $db_name = substr($url['path'], 1);
  } else {
    // Local development environment variables from .env file
    $dotenv = Dotenv::createImmutable(dirname(__DIR__ . "/../../.env"));
    $dotenv->load();
    $db_servername = $_ENV['DB_SERVERNAME'];
    $db_username = $_ENV['DB_USERNAME'];
    $db_password = $_ENV['DB_PASSWORD'];
    $db_name = $_ENV['DB_NAME'];
    $googleMapApiKey = $_ENV["GOOGLE_MAP_API"];
}


// $db_servername = $_ENV['DB_SERVERNAME'];
// $db_username = $_ENV['DB_USERNAME'];
// $db_password = $_ENV['DB_PASSWORD']; 
// $db_name = $_ENV['DB_NAME'];


try {

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
    photo VARCHAR(255) DEFAULT 'https://kitt.lewagon.com/placeholder/users/harrytimbog',
    is_admin BOOLEAN DEFAULT FALSE,
    role ENUM('Viewer', 'Chef') NOT NULL
  )";

  // Create Categories Table

  $sql_categories = "CREATE TABLE IF NOT EXISTS Categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";

  // Create Recipes Table

  $sql_recipes = "CREATE TABLE IF NOT EXISTS Recipes (
    recipe_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    ingredients TEXT,
    instructions TEXT,
    chef_id INT NOT NULL,
    category_id INT NOT NULL,
    location VARCHAR(255),
    photo VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (chef_id) REFERENCES Users(user_id),
    FOREIGN KEY (category_id) REFERENCES Categories(category_id)

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
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (recipe_id) REFERENCES Recipes(recipe_id)
  )";


// Execute SQL commands

$pdo->exec($sql_db);
$pdo->exec($sql_users);
$pdo->exec($sql_categories);
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
