<?php 

declare(strict_types= 1);

// Display username of a logged in user
function display_username() {
  if (isset($_SESSION["user_id"])) {
    echo "You are signed into FoodieHub as " . $_SESSION["username"];
  } else {
    echo "You haven't signed into FoodieHub";
  }
}

function check_login_errors() {
  if (isset($_SESSION["login_errors"])) {
    $errors = $_SESSION["login_errors"];

    echo "<br>";

    foreach ($errors as $error) {
      echo '<p>'. $error .'</p>';
    }

    // clean out unneeded error variables
    unset($_SESSION["login_errors"]);
  } else if (isset($_GET['login']) && $_GET['login'] === "success") {
    echo '<br>';
    echo '<p class="form-success">Login Success</p>';
  }
}