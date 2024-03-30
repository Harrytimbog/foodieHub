<?php 

declare(strict_types= 1);

function check_add_category_errors() {
  if (isset($_SESSION['category_errors'])) {
    $errors = $_SESSION['category_errors'];
    // echo "<br>";

    foreach ($errors as $error) {
      echo '<p>' . $error . '</p>';
    }

    // Delete this errors from session because it isn't needed anymore
    unset($_SESSION['category_errors']);
  } else if (isset($_GET["category"]) && $_GET["category"] === "success") {
    // echo '<br>';
    echo '<p>Recipe successfully created!</p>';
  }
}