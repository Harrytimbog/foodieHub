<?php
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
    $location = $_POST["location"];
    $photo = $_POST["photo"];
    $category_id = $_POST["category_id"];

    // Validate and sanitize the data
    $title = trim($title);
    $description = trim($description);
    $ingredients = trim($ingredients);
    $instructions = trim($instructions);
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

    // Handle Error

    $errors = [];

    if (is_input_empty($title, $description, $ingredients, $instructions, $location, $photo)) {
      $errors["empty_input"] = "Fill in all fields!";
    }

    if (is_title_taken($pdo, $title)) {
      $errors["title_taken"] = "Recipe already taken";
    }


    // Prepare the SQL statement
    $sql = "INSERT INTO Recipes (title, description, ingredients, instructions, chef_id, location, photo, category_id) VALUES (:title, :description, :ingredients, :instructions, :chef_id, :location, :photo, :category_id)";
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
    $stmt->bindParam(':instructions', $instructions, PDO::PARAM_STR);
    $stmt->bindParam(':chef_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->bindParam(':location', $location, PDO::PARAM_STR);
    $stmt->bindParam(':photo', $photo, PDO::PARAM_STR);
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
} else {
    // If the form is not submitted, redirect to an error page or homepage
    header("Location: ../../error.php");
    exit();
}
