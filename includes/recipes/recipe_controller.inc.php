<?php 

declare(strict_types= 1);

// Validate that all field are not empty
function is_input_empty(string $title, string $description, string $ingredients, string $instructions) {
  if (empty($title) || empty($description) || empty($ingredients) || empty($instructions)) {
    return true;
  } else {
    return false;
  }
}

//////////////////////////////// User actions /////////////////////////////////////////
function create_recipe(object $pdo, string $title, string $description, string $ingredients, string $instructions, string $chef_id) {
  // connect to the model to create user

  set_recipe($pdo, $title, $description, $ingredients, $instructions, $chef_id);
}