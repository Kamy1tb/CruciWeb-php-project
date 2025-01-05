<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/global.css?v=2">
    <link rel="stylesheet" href="public/css/404.css">
    <title>Page Non Trouvée</title>
</head>
<body>
    <?php include ($_SERVER['DOCUMENT_ROOT'].'/app/Views/layout/navbar.php'); ?>
    <div class="not-found-container">
        <h1>404</h1>
        <p>Page Non Trouvée</p>
        <a href="index.php" class="button">Retour à l'accueil</a>
    </div>
</body>
</html>