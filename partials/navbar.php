<?php 

// Check session status (start one or use an existing one)

// include("./includes/utils/start_session.php");
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

// Check if user is an admin

$isUserAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1;

// Check if the user is logged in
$isUserLogged = isset($_SESSION['user_id']);

// Set link dynamically
$profileLink = $isUserLogged ? '<li><a href="../profile.php">Profile</a></li>' : "";
$adminUserLink = $isUserAdmin ? '<li><a href="../admin-dashboard.php">Dashboard</a></li>' : "";
$recipesLink = $isUserLogged ? '<li><a href="../recipes.php">Recipes</a></li>' : "";
$loginLink = $isUserLogged ? "" : '<li><a href="../login.php">Login</a></li>';

$registerLink = $isUserLogged ? "" : '<li><a href="../signup.php">Register</a></li>';
$logoutLink = $isUserLogged ? '<li><a href="../includes/logout.inc.php">Logout</a></li>' : "";

?>
<header class="navbar">
  <div class="navbar-content">
    <a href="/">
      <!-- <img id="logo" src="https://kitt.lewagon.com/placeholder/users/harrytimbog" alt="FoodieHub logo"> -->
      <h3 style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">FoodieHub</h3>
    </a>
    <nav class="nav">
      <ul class="nav-links">
        <?php echo $adminUserLink; ?>
        <li>
          <a href="../about.php">About</a>
        </li>
        <li>
          <a href="#">Contact us</a>
        </li>
        <?php echo $loginLink; ?>
        <?php echo $registerLink; ?>
        <?php echo $profileLink; ?>
        <?php echo $recipesLink; ?>
        <?php echo $logoutLink; ?>
        <img id="user-avatar" src="https://kitt.lewagon.com/placeholder/users/harrytimbog" alt="User">
      </ul>
      <img id="menu-btn" src="/images/icons/menu.png" alt="menu">
  </div>
  </nav>
</header>
