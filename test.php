<?php 

require_once realpath(__DIR__ . "/vendor/autoload.php");

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$googleMapApiKey = $_ENV["GOOGLE_MAP_API"];

// echo $googleMapApiKey;


// Define the address you want to geocode
$address = "1600 Amphitheatre Parkway, Mountain View, CA";

// Construct the Geocoding API request URL
$api_key = $googleMapApiKey;
$geocode_url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($address) . "&key=" . $api_key;

// Send the request to the Geocoding API
$response = file_get_contents($geocode_url);

// Parse the JSON response
$data = json_decode($response);

// Check if the request was successful
if ($data->status == "OK") {
    // Extract latitude and longitude from the response
    $latitude = $data->results[0]->geometry->location->lat;
    $longitude = $data->results[0]->geometry->location->lng;

    // Use the latitude and longitude as needed
    echo "Latitude: " . $latitude . "<br>";
    echo "Longitude: " . $longitude;
} else {
    // Handle the error
    echo "Error: " . $data->status;
}


?>


