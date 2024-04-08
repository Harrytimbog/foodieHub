<?php

require_once realpath(__DIR__ . "/../../vendor/autoload.php");


use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(dirname(__DIR__ . "/../../.env"));
$dotenv->load();

// Check if a session is not already active
include("../utils/start_session.php");



$googleMapApiKey = $_ENV["GOOGLE_MAP_API"];


// Check if the user is logged in
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  include("../utils/db_connection.php");

  try {
    // GET form data
    include("../utils/auth_check.php");
    $title = $_POST["title"];
    $recipe_id = $_POST["recipe_id"];
    $description = $_POST["description"];
    $ingredients = $_POST["ingredients"];
    $prep_time = $_POST["prep_time"];
    $instructions = $_POST["instructions"];
    $location = $_POST["location"];
    $category_id = $_POST["category_id"];
    $photo = $_POST["photo"];

    // Handle file type
    $fileName = $_FILES['photo']['name'];
    $fileTmpName = $_FILES['photo']['tmp_name'];
    $fileSize = $_FILES['photo']['size'];
    $fileErr = $_FILES['photo']['error'];
    $fileType = $_FILES['photo']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowedFormat = array('jpg', 'jpeg', 'png', 'avif');

    // check if type of file submitted is of a format we allowed
    if (in_array($fileActualExt, $allowedFormat)) {
      if ($fileErr === 0) {
        if ($fileSize < 1000000) {
          $fileNameNew = uniqid('', true) . "." . $fileActualExt;
          $fileDestination = '../../uploads/' . $fileNameNew;
          // move the file to the desired location
          move_uploaded_file($fileTmpName, $fileDestination);
          echo "uploaded";
          $photo = $fileNameNew; // Assign the new filename to $photo
        } else {
          echo "<p>The file is too large!</p>";
        }
      } else {
        echo "<p>There was an error uploading your file!</p>";
      }
    } else {
      echo "<p>You cannot upload files of this type!</p>";
    }

    // Check if "user" session variable is set
    if (!isset($_SESSION['user_id'])) {
      // throw new Exception("User session not set.");
      header("Location: ../../restricted.php");
    }

    $api_key = $googleMapApiKey;
    $geocode_url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($location) . "&key=" . $api_key;

    // Send the request to the Geocoding API
    $response = file_get_contents($geocode_url);

    // Parse the JSON response
    $data = json_decode($response);

    // check the request state

    if ($data->status === "OK") {

      $latitude = $data->results[0]->geometry->location->lat;
      $longitude = $data->results[0]->geometry->location->lng;
      
      // Write the SQL Script to update to database
      
      $sql = "UPDATE Recipes SET title = ?, description = ?, ingredients = ?, instructions = ?, location = ?, prep_time = ?, category_id = ?, photo = ?, longitude = ?, latitude = ? WHERE recipe_id = ?";
      
      $result = $pdo->prepare($sql);
      $result->execute([$title, $description, $ingredients, $instructions, $location, $prep_time, $category_id, $photo, $longitude, $latitude, $recipe_id]);
      
      header("Location: ../../../../profile.php");
      exit();
    } else {
      header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=1");
      exit();
    }
  } catch (PDOException $e) {
    // Handle database errors
    echo "Error: " . $e->getMessage();
  }
}