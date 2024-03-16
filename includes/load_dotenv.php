<?php 

// Open .env file

$dotenv = fopen('../.env', 'r');

if ($dotenv) {
  while (($line = fgets($dotenv)) !== false) {
    $line = trim($line);
    if (!empty($line) && strpos($line, '=') !== false) {
      list($key, $value) = explode('=', $line, 2);
      $_ENV[$key] = $value;
    }
  }
  fclose($dotenv);
}
