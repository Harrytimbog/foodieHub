<?php
include "../utils/start_session.php";
include "../utils/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $newPassword = $_POST['new_password'];

    // Check if the email exists in the database
    $sql_email_exists = $pdo->prepare("SELECT user_id FROM Users WHERE email = ? LIMIT 1");
    $sql_email_exists->execute([$email]);
    $row = $sql_email_exists->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Update the user's password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updatePassword = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
        if ($updatePassword->execute([$hashedPassword, $email])) {
            // Password reset successful
            $_SESSION['status'] = "Password reset successfully";
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?success=1");
            exit();
        } else {
            // Password reset failed
            $_SESSION['status'] = "Failed to reset password. Please try again later.";
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=1");
            exit();
        }
    } else {
        // Email not found in database
        $_SESSION['status'] = "Email not found. Please enter a valid email address.";
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=1");
        exit();
    }
}
?>