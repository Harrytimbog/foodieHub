<?php 

// Check for request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Check for email and password from user request
  $email = $_POST["email"];
  $password = $_POST["password"];

  try {
    // import model, controller
    require_once "../utils/db_connection.php";
    require_once "../../models/login_model.inc.php";
    require_once "../../controllers/login_controller.inc.php";

    // ERROR HANDLERS
    // Create Errors array
    $errors = [];
    // Check for email and password from user request

    if (is_login_input_empty($email, $password)) {
      $errors["empty_input"] = "Fill in all fields!";
    }

    // Get user from the database via the model

    $result = find_user($pdo, $email);

    if (is_email_incorrect($result)) {
      $errors["login_input_incorrect"] = "Incorrect email!";
    }

    if (!is_email_incorrect($result) && is_password_incorrect($password, $result['password'])) {
      $errors["login_input_incorrect"] = "Incorrect login info!";      
    }

    // Start session
    require_once '../utils/session_config.php'; // Because I created a safer way to start a session in this required file.
    
    // Check errors array
    if ($errors) {
      $_SESSION["login_errors"] = $errors;
      header("Location: ../../../../login.php");
      die();
    }

    // Create an entirely new ID which has the userId attached
    $newSessionId = session_create_id();
    $sessionId = $newSessionId . "_" . $result["user_id"];

    // set session Id to the one we just created
    session_id($sessionId); // This line is causing the error
    
    // Add userId, email and user's role to session
    $_SESSION["user_id"] = $result["user_id"];
    $_SESSION["email"] = htmlspecialchars($result["email"]);
    $_SESSION["role"] = $result["role"];
    $_SESSION["is_admin"] = $result["is_admin"];
    $_SESSION["last_regeneration"] = time();

    header("Location: ../../../../profile.php");

    // Close my Db Connections [Best practice]
    $pdo = null;
    $statement = null;
    die();
  } catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
  }
} else {
  // redirect to login page if the user request isn't right
  header("Location: ../../../../login.php");
  die();
}

?>
