<?php 

declare(strict_types= 1);

// Validate that all field are not empty
function is_input_empty(string $name) {
  if (empty($name)) {
    return true;
  } else {
    return false;
  }
}

//////////////////////////////// User actions /////////////////////////////////////////
function create_category(object $pdo, string $name) {
  // connect to the model to create user

  set_category($pdo, $name);
}