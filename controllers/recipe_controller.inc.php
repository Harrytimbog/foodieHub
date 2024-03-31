<?php 

declare(strict_types= 1);

// Validate that all field are not empty
function is_input_empty(string $title, string $description, string $ingredients, string $instructions, string $address, string $photo) {
  if (empty($title) || empty($description) || empty($ingredients) || empty($instructions || empty($address) || empty($photo))) {
    return true;
  } else {
    return false;
  }
}

// Validate title uniqueness
function is_title_taken(object $pdo, string $title) {
  // get title from the db via the model
  if (find_recipe($pdo, $title)){
    return true;
  } else {
    return false;
  }
}

//////////////////////////////// User actions /////////////////////////////////////////
function create_recipe(object $pdo, string $title, string $description, string $ingredients, string $instructions, string $address, string $photo, string $chef_id) {
  // connect to the model to create user

  set_recipe($pdo, $title, $description, $ingredients, $instructions, $address, $photo, $chef_id);
}