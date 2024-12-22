
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/games.css">
    <title>Jeux Créés</title>
</head>
<body>
    <?php include 'layout/navbar.php'; ?>
    <div class="games-container">
        <h1>Jeux Créés</h1>
        <div class="cards-container">
            <!-- Example card -->
            <div class="game-card">
                <h2>Nom du Jeu</h2>
                <p class="creator">Par: Raid_ber</p>
                <p class="difficulty"><span class="difficulty-circle facile"></span>Facile</p>
                <p class="estimated-time">Temps estimé: 15 mins</p>
                <p class="description">Cette grille mettra à l’épreuve votre vocabulaire et vos connaissances générales.</p>
                <button>Jouer</button>
            </div>
            <div class="game-card">
                <h2>Nom du Jeu</h2>
                <p class="creator">Par: Raid_ber</p>
                <p class="difficulty"><span class="difficulty-circle moyen"></span>moyen</p>
                <p class="estimated-time">Temps estimé: 15 mins</p>
                <p class="description">Cette grille mettra à l’épreuve votre vocabulaire et vos connaissances générales.</p>
                <button>Jouer</button>
            </div>
            <div class="game-card">
                <h2>Nom du Jeu</h2>
                <p class="creator">Par: Raid_ber</p>
                <p class="difficulty"><span class="difficulty-circle facile"></span>Facile</p>
                <p class="estimated-time">Temps estimé: 15 mins</p>
                <p class="description">Cette grille mettra à l’épreuve votre vocabulaire et vos connaissances générales.</p>
                <button>Jouer</button>
            </div>
            <!-- Add more cards here -->
        </div>
    </div>
    <script src="../public/js/games.js?v=2"></script>
</body>
</html>