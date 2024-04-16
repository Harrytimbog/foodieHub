<?php  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | Password Reset</title>
  <link rel="stylesheet" href="./css/navbar.css">
  <link rel="stylesheet" href="./css/reset-password.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/footer.css">
  <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
  <!-- <link rel="manifest" href="/site.webmanifest"> -->
</head>
<body>
  <!-- Navbar -->
  <?php include("./partials/navbar.php"); ?>
  <!-- Navbar -->

  <div class="container reset-password-page">
    <div class="row justify-content-center">
      <div class="col-6 col-8-md">

        <h1 style="text-align: center">Password Reset</h1>
        <?php include "./partials/user/password-reset.php" ?>
        <p class="mt-5">Back to Login <a href="/login.php">login</a></p>
      </div>
    </div>

  </div>
  <!-- FOOTER -->
  <?php include("./partials/footer.php"); ?>
  <script>
      // Function to show success alert
      function showSuccessAlert() {
          document.getElementById('success-alert').classList.remove('d-none');
      }

      // Check if URL contains success parameter
      const urlParams = new URLSearchParams(window.location.search);
      const successParam = urlParams.get('success');
      if (successParam === '1') {
          // If success parameter is present, show success alert
          showSuccessAlert();
      }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>