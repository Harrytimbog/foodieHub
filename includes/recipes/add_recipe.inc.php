<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include("../utils/start_session.php");
    require_once("../db_connection.php");

    // Retrieve form data
    $title = $_POST["title"];
    $description = $_POST["description"];
    $ingredients = $_POST["ingredients"];
    $instructions = $_POST["instructions"];

    // Validate and sanitize the data
    $title = trim($title);
    $description = trim($description);
    $ingredients = trim($ingredients);
    $instructions = trim($instructions);

    // Prepare the SQL statement
    $sql = "INSERT INTO Recipes (title, description, ingredients, instructions, chef_id) VALUES (:title, :description, :ingredients, :instructions, :chef_id)";
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
    $stmt->bindParam(':instructions', $instructions, PDO::PARAM_STR);
    $stmt->bindParam(':chef_id', $_SESSION['user_id'], PDO::PARAM_INT);

    // Execute the statement
    if ($stmt->execute()) {
        // Recipe added successfully
        // Redirect back to the page where the form was submitted
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?success=1");
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
