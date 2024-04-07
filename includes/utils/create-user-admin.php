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
}

try {
    // connect database
    $pdo = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);

    // Set PDO ERROR MODE TO EXCEPTION
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Update the first user to be an admin
    $sql_update_admin = "UPDATE Users
                        SET is_admin = TRUE
                        WHERE user_id = (
                            SELECT user_id
                            FROM (
                                SELECT user_id
                                FROM Users
                                ORDER BY user_id ASC
                                LIMIT 1
                            ) AS first_user
                        )";

    $pdo->exec($sql_update_admin);

    echo "First user has been made an admin successfully.";
} catch (PDOException $e) {
    echo "Error occurred: " . $e->getMessage();
}
?>
