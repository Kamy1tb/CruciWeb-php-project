<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css?v=2">
    <link rel="stylesheet" href="css/landing.css">
    <title>Accueil</title>
</head>
<body>
    <?php include 'layout/navbar.php'; ?>
    <div class="landing-container">
        <div class="left-section">
            <h1>Mettez vos méninges à l'épreuve !</h1>
            <p>Découvrez une activité classique et captivante qui stimule votre esprit tout en vous amusant. Complétez les grilles en trouvant les mots qui correspondent aux indices donnés.</p>
            <div class="buttons">
                <a href="../public/index.php?action=signup" class="button create-account-button">
                    Créez un compte
                    <img src="../public/images/right-arrow.png" alt="Arrow Icon">
                </a>
                <a href="../public/index.php?action=login" class="button login-button">
                    Se connecter
                    <img src="../public/images/right-arrow.png" alt="Arrow Icon">
                </a>
            </div>
            <a href="games.php" class="button play-button">Jouez dès maintenant !</a>
        </div>
        <div class="right-section">
            <img src="../public/images/home.png" alt="Image" class="landing-image">
        </div>
    </div>
</body>
</html>