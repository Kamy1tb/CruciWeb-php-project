<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/global.css?v=2">
    <link rel="stylesheet" href="../public/css/login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Se connecter</title>
</head>
<body>
    <div class="login-container container">
        <img src="../public/images/logo.png" alt="Logo" class="logo">
        <h1>Se connecter</h1>
        <form id="login-form" action="../public/index.php" method="POST">
            <input type="hidden" name="action" value="login">
            <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <div id="error-message"></div>
    </div>
    <script src="../public/js/login.js?v=2"></script>
</body>
</html>