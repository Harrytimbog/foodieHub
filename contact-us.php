<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | Contact Us</title>
  <link rel="stylesheet" href="/css/navbar.css">
  <link rel="stylesheet" href="/css/contact-us.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/footer.css">
  <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
  <!-- <link rel="manifest" href="/site.webmanifest"> -->

</head>

<body>
  <!-- NAVBAR -->
  <?php include("./partials/navbar.php") ?>

  <!-- CONTACT SECTION -->
  <section class="contact-section py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2 class="contact-header">Contact Us</h2>
          <p class="lead">Have a question or feedback? We'd love to hear from you!</p>
          <form action="#" method="post">
            <div class="mb-3">
              <label for="name" class="form-label">Your Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Your Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Your Message</label>
              <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <div class="col-md-6">
          <h2 class="contact-header">Get in Touch</h2>
          <p>Have questions or need assistance? Reach out to us using the contact form or the information provided
            below:</p>
          <ul class="list-unstyled">
            <li><strong>Email:</strong> info@foodiehub.com</li>
            <li><strong>Phone:</strong> +1 (123) 456-7890</li>
            <li><strong>location:</strong> 123 Main Street, City, Country</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <?php include("./partials/footer.php") ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
