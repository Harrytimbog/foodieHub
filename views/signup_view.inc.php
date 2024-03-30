<?php 

declare(strict_types= 1);

function auth_inputs() {
    echo '<div class="mb-3">';
    echo '<label for="username" class="form-label">Username</label>';
    if (isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["signup_errors"]["username_taken"])) {
        echo '<input type="text" name="username" class="form-control" id="username" placeholder="Username" value="'. $_SESSION["signup_data"]["username"] .'" required>';
    } else {
        echo '<input type="text" name="username" class="form-control" id="username" placeholder="Username" required>';
    }
    echo '</div>';

    echo '<div class="mb-3">';
    echo '<label for="email" class="form-label">Email address</label>';
    if (isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["signup_errors"]["email_used"]) && !isset($_SESSION["signup_errors"]["invalid_email"])) {
        echo '<input type="email" name="email" class="form-control" id="email" placeholder="E-mail" value="'. $_SESSION["signup_data"]["email"] .'" required>';
    } else {
        echo '<input type="email" name="email" class="form-control" id="email" placeholder="E-mail" required>';
    }
    echo '<div id="emailHelp" class="form-text">We\'ll never share your email with anyone else.</div>';
    echo '</div>';

    echo '<div class="mb-3">';
    echo '<label for="role" class="form-label">Role</label>';
    echo '<select name="role" id="role" class="form-select">';
    echo '<option value="Viewer" ' . (isset($_SESSION["signup_data"]["role"]) && $_SESSION["signup_data"]["role"] === "Viewer" ? 'selected' : '') . '>Viewer</option>';
    echo '<option value="Chef" ' . (isset($_SESSION["signup_data"]["role"]) && $_SESSION["signup_data"]["role"] === "Chef" ? 'selected' : '') . '>Chef</option>';
    echo '</select>';
    echo '</div>';

    echo '<div class="mb-3">';
    echo '<label for="password" class="form-label">Password</label>';
    echo '<input type="password" name="password" class="form-control" id="password" placeholder="Password" required>';
    echo '</div>';
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