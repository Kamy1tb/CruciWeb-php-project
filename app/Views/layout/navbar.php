<nav>
  <div class="nav-left">
    <img src="../public/images/logo.png" alt="Logo" class="logo">
  </div>
  <div class="nav-center">
    <ul class="nav-links">
      <li><a href="../public/index.php">Accueil</a></li>
      <li><a href="../public/index.php?action=play">Jouer</a></li>
      <li><a href="../app/Views/create.php">Créer</a></li>
      <li><a href="../app/Views/contact.php">Nous contacter</a></li>
    </ul>
  </div>
  <div class="nav-right" >
  <?php
  // Vérifier si 'username' est dans $_POST et non vide
  if (isset($_SESSION['username'])) {
      // Récupérer et afficher le nom d'utilisateur
      $username = htmlspecialchars($_SESSION['username']); // Sécuriser l'entrée
      echo "Bienvenue, $username!";
  } else {
      // Si 'username' n'existe pas, afficher le lien de connexion
      echo '<a href="../public/index.php?action=login" class="login-button">Se connecter</a>';
  }
  ?>
</div>
</nav>