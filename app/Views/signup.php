<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/global.css">
    <link rel="stylesheet" href="public/css/signup.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Inscription</title>
</head>
<body>
    <div class="signup-container container">
        <img src="public/images/logo.png" alt="Logo" class="logo">
        <h1>Créez votre compte</h1>
        <p>Créez un compte pour profiter de toutes les fonctionnalités</p>
        <form id="signup-form" action="public/index.php" method="POST">
            <input type="hidden" name="action" value="signup">
            <div class="form-group">
                <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required>
                <input type="text" id="fullname" name="fullname" placeholder="Nom complet" required>
            </div>
            <input type="email" id="email" name="email" placeholder="Adresse Email" required>
            <input type="password" id="password" name="password" placeholder="Mot de Passe" required>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmer le Mot de Passe" required>
            <div id="error-message"></div>
            <button type="submit">Créer</button>
        </form>
        
    </div>
    <script src="public/js/signup.js"></script>
</body>
</html>