<?php

// Import database connection
include "../utils/db_connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if user is logged in
    include "../utils/start_session.php";
    
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect user to login page if not logged in
        header("Location: /login.php");
        exit();
    }
    
    // Get user ID from session
    $user_id = $_SESSION['user_id'];
    
    // Check if recipe ID is provided in the POST data
    if (isset($_POST['recipe_id'])) {
        // Get recipe ID from POST data
        $recipe_id = $_POST['recipe_id'];

        $recipe_sql = $pdo->prepare("SELECT * FROM Recipes WHERE recipe_id = ?");
        $recipe_sql->execute([$recipe_id]);
        $recipe = $recipe_sql->fetch(PDO::FETCH_ASSOC);

        // Prepare SQL statement to remove recipe from favorites
        $sql_remove_favorite = $pdo->prepare("DELETE FROM Favorites WHERE user_id = ? AND recipe_id = ?");
        
        // Execute the SQL statement
        $sql_remove_favorite->execute([$user_id, $recipe_id]);

        // Redirect user back to the recipe page after removal
        header("Location: /recipe.php?title=" . urlencode($recipe['title']));

        exit(); 
    } else {
        // Redirect user to error page if recipe ID is not provided
        header("Location: /error.php");
        exit();
    }
} else {
    // Redirect user to error page if form is not submitted via POST method
    header("Location: /error.php");
    exit(); // Terminate script
}
