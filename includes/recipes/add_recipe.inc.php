<?php

require_once realpath(__DIR__ . "/../../vendor/autoload.php");

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__ . "/../../.env"));
$dotenv->load();
// Get Google MAP API frim Environment

$googleMapApiKey = $_ENV["GOOGLE_MAP_API"];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include("../utils/start_session.php");
    require_once("../utils/db_connection.php");
    include("../../views/recipe_view.inc.php");
    include("../../models/recipe_model.inc.php");
    include("../../controllers/recipe_controller.inc.php");

    // Retrieve form data
    $title = $_POST["title"];
    $description = $_POST["description"];
    $ingredients = $_POST["ingredients"];
    $instructions = $_POST["instructions"];
    $prep_time = $_POST["prep_time"];
    $location = $_POST["location"];
    $photo = $_POST["photo"];
    $category_id = $_POST["category_id"];

    // Validate and sanitize the data
    $title = trim($title);
    $description = trim($description);
    $ingredients = trim($ingredients);
    $instructions = trim($instructions);
    $prep_time = trim($prep_time);
    $location = trim($location);
    $category_id = trim($category_id);

        // Handle file type
    $fileName = $_FILES['photo']['name'];
    $fileTmpName = $_FILES['photo']['tmp_name'];
    $fileSize = $_FILES['photo']['size'];
    $fileErr = $_FILES['photo']['error'];
    $fileType = $_FILES['photo']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowedFormat = array('jpg', 'jpeg', 'png', 'avif', 'webp');

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

    // Handle Error

    $errors = [];

    if (is_input_empty($title, $description, $ingredients, $prep_time, $instructions, $location)) {
      $errors["empty_input"] = "Fill in all fields!";
    }

    if (is_title_taken($pdo, $title)) {
      $errors["title_taken"] = "Recipe already taken";
    }

    // Geocode Location

    $api_key = $googleMapApiKey;
    $geocode_url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($location) . "&key=" . $api_key;

    $response = file_get_contents($geocode_url);

    $data = json_decode($response);

    if ($data->status == "OK") {

      $latitude = $data->results[0]->geometry->location->lat;
      $longitude = $data->results[0]->geometry->location->lng;
      
      // Prepare the SQL statement
      $sql = "INSERT INTO Recipes (title, description, ingredients, instructions, chef_id, location, prep_time, photo, longitude, latitude, category_id) VALUES (:title, :description, :ingredients, :instructions, :chef_id, :location, :prep_time, :photo, :longitude, :latitude, :category_id)";
      $stmt = $pdo->prepare($sql);

      // Bind parameters
      $stmt->bindParam(':title', $title, PDO::PARAM_STR);
      $stmt->bindParam(':description', $description, PDO::PARAM_STR);
      $stmt->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
      $stmt->bindParam(':prep_time', $prep_time, PDO::PARAM_STR);
      $stmt->bindParam(':instructions', $instructions, PDO::PARAM_STR);
      $stmt->bindParam(':chef_id', $_SESSION['user_id'], PDO::PARAM_INT);
      $stmt->bindParam(':location', $location, PDO::PARAM_STR);
      $stmt->bindParam(':photo', $photo, PDO::PARAM_STR);
      $stmt->bindParam(':latitude', $latitude, PDO::PARAM_STR);
      $stmt->bindParam(':longitude', $longitude, PDO::PARAM_STR);
      $stmt->bindParam(':category_id', $category_id, PDO::PARAM_STR);

      // Execute the statement
      if ($stmt->execute()) {
          // Recipe added successfully
          // Redirect back to the page where the form was submitted
          // header("Location: " . $_SERVER['HTTP_HOST'] . "/recipes.php");
          header("Location: ../../../../recipes.php");
          exit();
      } else {
          // Error occurred while adding the recipe
          // Redirect back to the form with an error message
          header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=1");
          exit();
      }
    }
} else {
    // If the form is not submitted, redirect to an error page or homepage
    header("Location: ../../error.php");
    exit();
  }
