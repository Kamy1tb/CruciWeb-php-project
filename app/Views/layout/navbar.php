<nav>
  <div class="nav-left">
    <img src="public/images/logo.png" alt="Logo" class="logo">
  </div>
  <div class="nav-center">
    <ul class="nav-links">
      <li><a href="index.php">Accueil</a></li>
      <li><a href="index.php?action=grids">Jouer</a></li>
      <li><a href="index.php?action=create">Créer</a></li>
      <li><a href="index.php?action=contact">Nous contacter</a></li>
    </ul>
  </div>
  <div class="nav-right" >
  <?php
  if (isset($_SESSION['username'])) {
      $username = htmlspecialchars($_SESSION['username']); 
      echo '<div class="logged-in">
              <span> Bienvenue, '.$username.'!</span>
              <a href="index.php?action=logout" class="logout-button">
                <img src="./public/images/logout.png" alt="Logout Icon">
                <span>Logout</span>
              </a>
            </div>';
  } else {
      echo '<a href="index.php?action=login" class="login-button">Se connecter</a>';
  }
  ?>
</div>
</nav>