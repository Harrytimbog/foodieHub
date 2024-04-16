<?php 

require_once realpath(__DIR__ . "/../../vendor/autoload.php");


use Dotenv\Dotenv;

// Load the .env file from the root folder
$dotenv = Dotenv::createImmutable(dirname(__DIR__ . "/../../.env"));
$dotenv->load();

// Access environmental variables
$app_domain = $_ENV['APP_DOMAIN'];

// Session security

ini_set("session.use_only_cookies", 1);
ini_set("session.use_strict_mode", 1);

session_set_cookie_params([
  'lifetime' => 1800,
  'domain' => $app_domain,
  'path' => '/',
  'secure' => true,
  'httponly' => true,
]);

session_start();

if (isset($_SESSION['user_id'])) {
  if (!isset($_SESSION['previous_regeneration'])) {
    regenerate_loggedin_session_id();
  } else {
    $interval = 60 * 30;
    if (time() - $_SESSION["previous_regeneration"] >= $interval) {
      regenerate_loggedin_session_id();
    }
  }
} else {
  if (!isset($_SESSION['previous_regeneration'])) {
    regenerate_session_id();
  } else {
    $interval = 60 * 30;
    if (time() - $_SESSION["previous_regeneration"] >= $interval) {
      regenerate_session_id();
    }
  }
}


// Regenerate session ID for logged in user
function regenerate_loggedin_session_id() {
  // get user id from session
  $user_id = $_SESSION["user_id"];

  $newSessionId = session_create_id();
  $sessionId = $newSessionId . "_" . $user_id;
  session_id($sessionId);

  $_SESSION["previous_regeneration"] = time();
}

// Regenerate session ID every 3 minutes for security purpose
function regenerate_session_id() {
  session_regenerate_id(true);
    $_SESSION["previous_regeneration"] = time();
}