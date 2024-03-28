<?php 

declare(strict_types= 1);

function check_add_recipe_errors() {
  if (isset($_SESSION['recipe_errors'])) {
    $errors = $_SESSION['recipe_errors'];
    // echo "<br>";

    foreach ($errors as $error) {
      echo '<p>' . $error . '</p>';
    }

    // Delete this errors from session because it isn't needed anymore
    unset($_SESSION['recipe_errors']);
  } else if (isset($_GET["recipe"]) && $_GET["recipe"] === "success") {
    // echo '<br>';
    echo '<p>Recipe successfully created!</p>';
  }
}