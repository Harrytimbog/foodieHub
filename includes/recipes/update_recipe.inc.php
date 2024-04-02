<?php

// Check if a session is not already active
include("../utils/start_session.php");

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
    $instructions = $_POST["instructions"];
    $location = $_POST["location"];
    $category_id = $_POST["category_id"];
    // $photo = $_POST["photo"]; // Remove this line

    // Handle file type
    $fileName = $_FILES['photo']['name']; // Correct usage of $_FILES instead of $_POST
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

    // Write the SQL Script to update to database

    $sql = "UPDATE Recipes SET title = ?, description = ?, ingredients = ?, instructions = ?, location = ?, category_id = ?, photo = ? WHERE recipe_id = ?";

    $result = $pdo->prepare($sql);
    $result->execute([$title, $description, $ingredients, $instructions, $location, $category_id, $photo, $recipe_id]);

    header("Location: ../../../../profile.php");
    exit; // Ensure no further code execution after redirection
  } catch (PDOException $e) {
    // Handle database errors
    echo "Error: " . $e->getMessage();
  }
}

?>