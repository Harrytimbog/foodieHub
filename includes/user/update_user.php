<?php 

// Check if a session is not already active
include("../utils/start_session.php");

require_once realpath(__DIR__ . "/../../vendor/autoload.php");

use Dotenv\Dotenv;
use Cloudinary\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;

// Load the .env file from the root folder
$dotenv = Dotenv::createImmutable(dirname(__DIR__ . "/../../.env"));
$dotenv->load();

// echo $_ENV['CLOUDINARY_CLOUD_NAME'];
// echo $_ENV['CLOUDINARY_API_KEY'];
// echo $_ENV['CLOUDINARY_API_SECRET'];


// Configure Cloudinary
$cloudinary = new Cloudinary(array(
  "cloud_name" => $_ENV['CLOUDINARY_CLOUD_NAME'],
  "api_key" => $_ENV['CLOUDINARY_API_KEY'],
  "api_secret" => $_ENV['CLOUDINARY_API_SECRET']
));

// Check for user's login status
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  try {
    // GET form data
    include("../utils/db_connection.php");
    include("../utils/auth_check.php");
    $role = $_POST["role"];

    // Handle file upload
    $fileName = $_FILES['photo']['name'];
    $fileTmpName = $_FILES['photo']['tmp_name'];
    $fileSize = $_FILES['photo']['size'];
    $fileError = $_FILES['photo']['error'];

    $allowedFormats = array('jpg', 'jpeg', 'png', 'avif');
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileActualExt = strtolower($fileExt);

    if (in_array($fileActualExt, $allowedFormats)) {
      if ($fileError === 0) {
        if ($fileSize < 1000000) { // 1 MB
          // Upload file to Cloudinary
          $uploadApi = new UploadApi($cloudinary);
          $uploadResult = $uploadApi->upload($fileTmpName);

          // Get the public ID of the uploaded file from the response
          $publicId = $uploadResult['public_id'];

          // Update user's role and photo in the database
          $sql = "UPDATE users SET role = ?, photo = ? WHERE user_id = ?";
          $result = $pdo->prepare($sql);
          $result->execute([$role, $publicId, $_SESSION['user_id']]);

          // Add user's role to SESSION
          $_SESSION["role"] = $role;
          $_SESSION["photo"] = $publicId;

          // Redirect to profile page on update
          header("Location: ../../../../profile.php");
          exit();
        } else {
          throw new Exception("The file is too large");
        }
      } else {
        throw new Exception("There was an error uploading your file: " . $fileError);
      }
    } else {
      throw new Exception("You cannot upload files of this type");
    }
  } catch (PDOException $e) {
    // Handle database errors
    echo "Database Error: " . $e->getMessage();
  } catch (Exception $e) {
    // Handle other errors
    echo "Error: " . $e->getMessage();
  }
}
