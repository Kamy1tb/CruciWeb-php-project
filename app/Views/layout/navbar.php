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
  // Vérifier si 'username' est dans $_POST et non vide
  if (isset($_SESSION['username'])) {
      // Récupérer et afficher le nom d'utilisateur
      $username = htmlspecialchars($_SESSION['username']); // Sécuriser l'entrée
      echo '<div class="logged-in">
              <span> Bienvenue, '.$username.'!</span>
              <a href="index.php?action=logout" class="logout-button">
                <img src="./public/images/logout.png" alt="Logout Icon">
                <span>Logout</span>
              </a>
            </div>';
  } else {
      // Si 'username' n'existe pas, afficher le lien de connexion
      echo '<a href="index.php?action=login" class="login-button">Se connecter</a>';
  }
  ?>
</div>
</nav>