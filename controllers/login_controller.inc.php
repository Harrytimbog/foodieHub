<?php 

declare(strict_types= 1);


// Check if user input is empty

function is_login_input_empty(string $email, string $password) {
  if (empty($email) || empty($password)) {
    return true;
  } else {
    return false;
  }
}

// Check if email the user passed is incorrect
function is_email_incorrect(bool|array $result) {
 if (!$result) {
  return true;
 } else {
  return false;
 }
}

// Check if password the user passed is incorrect
function is_password_incorrect(string $password, string $hashedPassword) {
  // check if hashed password is the same as the one the user sent 
 if (!password_verify($password, $hashedPassword)) {
  return true;
 } else {
  return false;
 }
}