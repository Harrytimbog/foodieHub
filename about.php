<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodieHub | About Us</title>
  <link rel="stylesheet" href="/css/navbar.css">
  <link rel="stylesheet" href="/css/about-us.css">
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

  <!-- ABOUT US SECTION -->

  <!-- About Section -->
  <section class="about-section py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h2 class="about-header">Welcome to FoodieHub!</h2>
          <p class="lead">Discover, Organize, and Share Your Culinary Adventures</p>
          <p>Welcome to FoodieHub, your ultimate destination for exploring, organizing, and sharing delicious recipes.
            We're passionate about food and excited to help you on your culinary journey.</p>
        </div>

        <div class="col-md-6">
          <img src="./images/recipe03.avif" alt="Recipe Book" class="img-fluid">
        </div>
      </div>
      <div class="row mt-5 align-items-center">
        <div class="col-md-6">
          <video width="600" height="600" controls autoplay>
            <source src="./images/meal.mp4" type="video/mp4">
          </video>
        </div>
        <div class="col-md-6">
          <h2 class="about-header">Our Mission</h2>
          <p>At FoodieHub, our mission is simple: to inspire and empower food lovers like you to discover new recipes,
            organize your favorites, and share your passion for cooking with others. We believe that food has the power
            to bring people together, spark creativity, and create unforgettable memories. Our aim is to provide you
            with the tools and resources you need to unleash your inner chef and embark on culinary adventures that
            delight your taste buds and nourish your soul.</p>
        </div>
      </div>
      <div class="row mt-5 align-items-center">
        <div class="col-md-6">
          <h2 class="about-header">What We Offer</h2>
          <h5>Recipe Discovery</h5>
          <p>With FoodieHub, you'll gain access to a diverse collection of recipes from around the globe. Whether
            you're craving comforting classics, exploring exotic cuisines, or seeking healthy meal ideas, we've got
            something for everyone. Browse through our curated recipe collections, search for specific dishes, or get
            inspired by seasonal ingredients and trending flavors.</p>
          <h5>Recipe Organization</h5>
          <p>Tired of endless recipe searches and cluttered kitchen counters? FoodieHub makes it easy to organize your
            favorite recipes in one convenient place. Create personalized recipe collections, add tags and notes to
            customize your recipes, and access your culinary creations anytime, anywhere. Say goodbye to recipe chaos
            and hello to stress-free cooking!</p>
          <h5>Recipe Sharing</h5>
          <p>Food is meant to be shared, and with FoodieHub, you can easily share your favorite recipes with friends,
            family, and fellow food enthusiasts. Whether you're hosting a dinner party, planning a potluck, or simply
            looking to exchange culinary inspiration, our sharing features make it simple and fun. Spread the joy of
            cooking and connect with others through the universal language of food.</p>
        </div>
        <div class="col-md-6">
          <img src="./images/recipe04.avif" alt="Recipe Book" class="img-fluid">
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-md-12">
          <h2 class="about-header">Our Team</h2>
          <p>Behind FoodieHub is a dedicated team of food enthusiasts, designers, and developers who are passionate
            about creating a seamless and enjoyable experience for our users. We're committed to continuous
            improvement, innovation, and building a vibrant community of food lovers. Meet the faces behind FoodieHub
            and learn more about our team members <a href="#">here</a>.</p>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-md-12">
          <h2 class="about-header">Get in Touch</h2>
          <p>We'd love to hear from you! Whether you have questions, feedback, or just want to share your latest
            culinary creation, we're here for you. Reach out to us via email, social media, or through our website –
            we're always eager to connect with fellow foodies and help you make the most of your FoodieHub experience.
          </p>
          <p>Thank you for choosing FoodieHub – let's embark on a delicious journey together!</p>
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
