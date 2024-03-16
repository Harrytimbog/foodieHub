<?php 

// Check for request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Check for username and password from user request
  $username = $_POST["username"];
  $password = $_POST["password"];

  try {
    // import model, controller
    require_once "../db_connection.php";
    require_once "login_model.inc.php";
    require_once "login_controller.inc.php";

    // ERROR HANDLERS
    // Create Errors array
    $errors = [];
    // Check for username and password from user request

    if (is_login_input_empty($username, $password)) {
      $errors["empty_input"] = "Fill in all fields!";
    }

    // Get user from the database via the model

    $result = find_user($pdo, $username);

    if (is_username_incorrect($result)) {
      $errors["login_input_incorrect"] = "Incorrect login info!";
    }
    
    if (!is_username_incorrect($result) && is_password_incorrect($password, $result['password'])) {
      $errors["login_input_incorrect"] = "Incorrect login info!";      
    }

    // Start session
    require_once '../session_config.php'; // Because I created a safer way to start a session in this required file.
    // Check errors array
    if ($errors) {
      $_SESSION["login_errors"] = $errors;

      header("Location: ../../login.php");
      die();
    }

    // Create an entirely new ID which has the userId attached
    $newSessionId = session_create_id();
    $sessionId = $newSessionId . "_" . $result["id"];

    // set session Id to the one we just created
    session_id($sessionId);

    // Add userId and username to session
    $_SESSION["user_id"] = $result["id"];
    $_SESSION["username"] = htmlspecialchars($result["username"]);
      // Reset session timer since I jsust added user_id and username to session
    $_SESSION["last_regeneration"] = time();

    // header("Location: ../login.php?login=success");
    header("Location: ../../profile.php");


    // Close my Db Connections [Best practice]
    $pdo = null;
    $statement = null;
    die();
  } catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
  }
} else {
  // redirect to login page if the user request isn't right
  header("Location: ../../login.php");
  die();
}
