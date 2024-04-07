<?php
// Include the database connection
include "../utils/db_connection.php";

// Verify that user_id is set and not empty
if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    try {
        $delete_user_sql = "DELETE FROM Users WHERE user_id = ?";
        $delete_user_stmt = $pdo->prepare($delete_user_sql);
        $delete_user_stmt->execute([$user_id]);

        // Redirect back to the admin dashboard after user is deleted successfully
        header("Location: ../../../../admin-dashboard.php");
        exit();
    } catch (PDOException $e) {
        echo "Error" . $e->getMessage();
    }
} else {
    // Redirect to the dashboard if user_id is not provided or empty
    header("Location: ../../../../admin-dashboard.php");
    exit();
}
