<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include("../utils/start_session.php");
    require_once("../utils/db_connection.php");
    include("../../views/category_view.inc.php");
    include("../../models/category_model.inc.php");
    include("../../controllers/category_controller.inc.php");

    // Retrieve form data
    $name = $_POST["name"];

    // Validate and sanitize the data
    $name = trim($name);

    // Prepare the SQL statement
    $sql = "INSERT INTO Categories (name) VALUES (:name)";
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);

    // Execute the statement
    if ($stmt->execute()) {
        // Recipe added successfully
        // Redirect back to the page where the form was submitted
        header("Location: ../../../../categories.php");
        exit();
    } else {
        // Error occurred while adding the category
        // Redirect back to the form with an error message
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=1");
        exit();
    }
} else {
    // If the form is not submitted, redirect to an error page or homepage
    header("Location: ../../error.php");
    exit();
}
