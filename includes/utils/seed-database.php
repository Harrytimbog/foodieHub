<?php 

require_once realpath(__DIR__ . "/../../vendor/autoload.php");


use Dotenv\Dotenv;

// Load the .env file from the root folder


// Access environmental variables

if (getenv('CLEARDB_DATABASE_URL')) {
    // Heroku environment variables
    $url = parse_url(getenv('CLEARDB_DATABASE_URL'));
    $db_servername = $url['host'];
    $db_username = $url['user'];
    $db_password = $url['pass'];
    $db_name = substr($url['path'], 1);
  } else {
    // Local development environment variables from .env file
    $dotenv = Dotenv::createImmutable(dirname(__DIR__ . "/../../.env"));
    $dotenv->load();
    $db_servername = $_ENV['DB_SERVERNAME'];
    $db_username = $_ENV['DB_USERNAME'];
    $db_password = $_ENV['DB_PASSWORD'];
    $db_name = $_ENV['DB_NAME'];
    $googleMapApiKey = $_ENV["GOOGLE_MAP_API"];
}

try {

  // connect database

  $pdo = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);

  // Set PDO ERROR MODE TO EXCEPTION

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //////////////////////////////////////// Start Seeding / Populating Database ////////////////////////////////////////////

  // Admin User Data

$adminUser = [
  'username' => 'admin',
  'password' => password_hash('123456', PASSWORD_DEFAULT),
  'email' => 'admin@gmail.com',
  'role' => 'Chef',
];

try {
  // Insert admin user into the Users table

  $sql = "INSERT INTO Users (username, password, email, role, is_admin) VALUES (?, ?, ?, ?, ?)";
  $result = $pdo->prepare($sql);
  $result->execute([$adminUser['username'], $adminUser['password'], $adminUser['email'], $adminUser['role'], true]); // Set is_admin to true for admin user

  echo "Admin user created successfully!";
  
} catch (PDOException $e) {
    echo "Error inserting admin user: " . $e->getMessage();
}



// Create other users
$users = [
    ['username' => 'Timi', 'password' => '123456', 'email' => 'timi@gmail.com', 'role' => 'Viewer'],
    ['username' => 'Grace', 'password' => '123456', 'email' => 'grace@gmail.com', 'role' => 'Viewer'],
    ['username' => 'Ozil', 'password' => '123456', 'email' => 'ozil@gmail.com', 'role' => 'Viewer'],
    ['username' => 'Peter', 'password' => '123456', 'email' => 'peter@gmail.com', 'role' => 'Chef'],
    ['username' => 'John', 'password' => '123456', 'email' => 'john@gmail.com', 'role' => 'Chef'],
    ['username' => 'Flappizy', 'password' => '123456', 'email' => 'flappizy@gmail.com', 'role' => 'Chef'],
    ['username' => 'Kelvin', 'password' => '123456', 'email' => 'kelvin@gmail.com', 'role' => 'Chef'],
    ['username' => 'Kel', 'password' => '123456', 'email' => 'kel@gmail.com', 'role' => 'Chef'],
];

// Sample data for categories
$categories = [
  ['name' => 'General'],
    ['name' => 'Vegan'],
    ['name' => 'Vegetarian'],
    ['name' => 'Gluten-free'],
    ['name' => 'Keto'],
    ['name' => 'Desserts'],
    ['name' => 'Appetizers'],
    ['name' => 'Beverages'],
    ['name' => 'Snacks'],
    ['name' => 'Soups and Stews'],
    ['name' => 'Salads'],
    ['name' => 'Seafood'],
    ['name' => 'Seafood'],
];

// Sample data for recipes
$recipes = [
    ['title' => 'Scrambled Eggs', 'description' => 'Delicious scrambled eggs recipe', 'ingredients' => 'Eggs, Salt, Pepper', 'instructions' => '1. Crack eggs into a bowl. 2. Beat eggs. 3. Cook eggs in a pan.'],
    ['title' => 'Chicken Salad', 'description' => 'Healthy chicken salad recipe', 'ingredients' => 'Chicken, Lettuce, Tomato, Cucumber', 'instructions' => '1. Cook chicken. 2. Chop vegetables. 3. Mix chicken and vegetables.'],
    [
        'title' => 'Margherita Pizza',
        'description' => 'Classic Italian pizza with tomato, mozzarella, and basil',
        'ingredients' => '1 pizza dough, 1/2 cup pizza sauce, 1 cup fresh mozzarella cheese, sliced, 2 ripe tomatoes, sliced, Fresh basil leaves, Olive oil, Salt and pepper to taste',
        'instructions' => '1. Preheat oven to 475°F (245°C). 2. Roll out pizza dough on a floured surface into a round shape. 3. Transfer dough to a pizza stone or baking sheet. 4. Spread pizza sauce evenly over the dough. 5. Arrange mozzarella cheese and tomato slices on top. 6. Drizzle with olive oil and season with salt and pepper. 7. Bake for 10-12 minutes or until crust is golden brown and cheese is bubbly. 8. Remove from oven, sprinkle with fresh basil leaves, and serve hot.'
    ],
    [
        'title' => 'Vegetable Stir-Fry',
        'description' => 'Healthy stir-fried vegetables with tofu in a savory sauce',
        'ingredients' => '1 block tofu, 2 cups mixed vegetables (bell peppers, broccoli, carrots, snap peas), 2 cloves garlic, minced, 1 tablespoon ginger, minced, 2 tablespoons soy sauce, 1 tablespoon sesame oil, 1 tablespoon cornstarch, 1/4 cup vegetable broth or water, Cooked rice or noodles for serving',
        'instructions' => '1. Press tofu to remove excess moisture, then cut into cubes. 2. Heat sesame oil in a large skillet over medium heat. 3. Add tofu cubes and cook until golden brown on all sides. Remove from skillet and set aside. 4. In the same skillet, add mixed vegetables and stir-fry until tender-crisp. 5. Add minced garlic and ginger, and cook for another minute. 6. In a small bowl, whisk together soy sauce, cornstarch, and vegetable broth. 7. Pour sauce over vegetables and tofu, and cook until thickened. 8. Serve stir-fry over cooked rice or noodles.'
    ],
    [
        'title' => 'Chocolate Chip Cookies',
        'description' => 'Classic homemade chocolate chip cookies',
        'ingredients' => '1 cup (2 sticks) unsalted butter, 1 cup granulated sugar, 1 cup packed brown sugar, 2 large eggs, 1 teaspoon vanilla extract, 3 cups all-purpose flour, 1 teaspoon baking soda, 1/2 teaspoon salt, 2 cups semisweet chocolate chips',
        'instructions' => '1. Preheat oven to 350°F (175°C). 2. In a large mixing bowl, cream together butter, granulated sugar, and brown sugar until light and fluffy. 3. Beat in eggs one at a time, then stir in vanilla. 4. Combine flour, baking soda, and salt; gradually add to the creamed mixture and mix well. 5. Stir in chocolate chips. 6. Drop by rounded tablespoonfuls onto ungreased baking sheets. 7. Bake for 10-12 minutes or until golden brown. 8. Allow cookies to cool on baking sheet for 5 minutes before transferring to wire racks to cool completely.'
    ],
    [
        'title' => 'Caesar Salad',
        'description' => 'Classic Caesar salad with homemade dressing',
        'ingredients' => '1 head romaine lettuce, 1/2 cup Caesar dressing, 1/4 cup grated Parmesan cheese, 1 cup croutons, Salt and pepper to taste',
        'instructions' => '1. Wash and chop romaine lettuce into bite-sized pieces. 2. In a large bowl, toss lettuce with Caesar dressing until evenly coated. 3. Sprinkle grated Parmesan cheese and croutons over the salad. 4. Season with salt and pepper to taste. 5. Serve immediately.'
    ],
    [
        'title' => 'Grilled Salmon with Lemon and Dill',
        'description' => 'Healthy and flavorful grilled salmon fillets with a zesty lemon and dill marinade.',
        'ingredients' => '4 salmon fillets, 1/4 cup olive oil, 2 tablespoons lemon juice, 2 cloves garlic, minced, 2 tablespoons fresh dill, chopped, Salt and pepper to taste, Lemon slices for garnish',
        'instructions' => '1. In a small bowl, whisk together olive oil, lemon juice, minced garlic, chopped dill, salt, and pepper. 2. Place salmon fillets in a shallow dish and pour marinade over them. 3. Cover and refrigerate for at least 30 minutes. 4. Preheat grill to medium-high heat. 5. Remove salmon from marinade and discard excess marinade. 6. Grill salmon fillets for 4-5 minutes per side, or until fish flakes easily with a fork. 7. Garnish with lemon slices and additional dill before serving.'
    ],
    [
        'title' => 'Quinoa Salad with Roasted Vegetables',
        'description' => 'Nutritious quinoa salad packed with roasted vegetables and a tangy vinaigrette dressing.',
        'ingredients' => '1 cup quinoa, 2 cups water or vegetable broth, 2 cups mixed vegetables (bell peppers, zucchini, cherry tomatoes), 2 tablespoons olive oil, 1 tablespoon balsamic vinegar, 1 teaspoon Dijon mustard, Salt and pepper to taste, Fresh parsley for garnish',
        'instructions' => '1. Preheat oven to 400°F (200°C). 2. Rinse quinoa under cold water and drain. 3. In a medium saucepan, bring water or vegetable broth to a boil. Add quinoa, reduce heat to low, cover, and simmer for 15-20 minutes, or until quinoa is cooked and water is absorbed. 4. Meanwhile, toss mixed vegetables with olive oil, balsamic vinegar, Dijon mustard, salt, and pepper on a baking sheet. 5. Roast vegetables in preheated oven for 20-25 minutes, or until tender and slightly caramelized. 6. In a large bowl, combine cooked quinoa and roasted vegetables. 7. Serve quinoa salad warm or chilled, garnished with fresh parsley.'
    ],

];

// create data for favorites
$favorites = [
    ['user_id' => 2, 'recipe_id' => 1],
    ['user_id' => 3, 'recipe_id' => 2],
    ['user_id' => 4, 'recipe_id' => 3],
    ['user_id' => 5, 'recipe_id' => 4],
    ['user_id' => 6, 'recipe_id' => 5],
    ['user_id' => 7, 'recipe_id' => 6],
    ['user_id' => 8, 'recipe_id' => 7],
];

// Insert users

try {
  foreach ($users as $user) {
      $sql = "INSERT INTO Users (username, password, email, role) VALUES (?, ?, ?, ?)";
      $result = $pdo->prepare($sql);
      $result->execute([$user['username'], $user['password'], $user['email'], $user['role']]);
  }
  
  // Insert categories
  foreach ($categories as $category) {
      $sql = "INSERT INTO Categories (name) VALUES (?)";
      $result = $pdo->prepare($sql);
      $result->execute([$category['name']]);
  }
  
  // Insert recipes
  foreach ($recipes as $recipe) {
      $sql = "INSERT INTO Recipes (title, description, ingredients, instructions, chef_id, category_id) VALUES (?, ?, ?, ?, ?, ?)";
      $result = $pdo->prepare($sql);
      $result->execute([$recipe['title'], $recipe['description'], $recipe['ingredients'], $recipe['instructions'], 1, 1]);
  }
} catch (PDOException $e) {
    echo "Error inserting admin user: " . $e->getMessage();
}




echo " ####################  Finished Seeding Database";

////////////////////////////////////////////// Finished Seeding Database //////////////////////////////////////
} catch (PDOException $e) {
  echo "Error occured while populating tables " . $e->getMessage();
  die("Error occured while populating tables " . $e->getMessage());
}
