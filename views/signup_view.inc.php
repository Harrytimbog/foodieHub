<?php 

declare(strict_types= 1);

function auth_inputs() {
    if (isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["signup_errors"]["username_taken"])) {
      echo '<input type="text" class="person-icon" name="username" placeholder="Username"  value="'. $_SESSION["signup_data"]["username"] .'" required>';
    } else {
      echo '<input type="text" class="person-icon" name="username" placeholder="Username" required>';
    }

    if (isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["signup_errors"]["email_used"]) && !isset($_SESSION["signup_errors"]["invalid_email"])) {
      echo '<input type="email" class="email-icon" name="email" placeholder="E-mail"  value="'. $_SESSION["signup_data"]["email"] .'" required>';
    } else {
      echo '<input type="email" class="email-icon" name="email" placeholder="E-mail" required>';
    }

    echo '<select name="role" id="role">
        <option value="Viewer">Viewer</option>
        <option value="Chef">Chef</option>
    </select>';

    echo '<input type="password" class="password-icon" name="password" placeholder="Password" required>';
}

function check_auth_errors() {
  if (isset($_SESSION['signup_errors'])) {
    $errors = $_SESSION['signup_errors'];
    // echo "<br>";

    foreach ($errors as $error) {
      echo '<p>' . $error . '</p>';
    }

    // Delete this errors from session because it isn't needed anymore
    unset($_SESSION['signup_errors']);
  } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
    // echo '<br>';
    echo '<p>Signup success!</p>';
  }
}