
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
            <?php foreach ($grids as $grid): ?>
            <div class="game-card">
                <h2><?= htmlspecialchars($grid['nom']); ?></h2>
                <p class="creator">Par: <?= htmlspecialchars($grid['id_user']); ?></p>
                <p class="difficulty">
                    <span class="difficulty-circle <?= htmlspecialchars(strtolower($grid['difficulté'])); ?>"></span>
                    <?= htmlspecialchars(ucfirst($grid['difficulté'])); ?>
                </p>
                <p class="estimated-time">Temps estimé: <?= htmlspecialchars($grid['estimated_time']); ?> mins</p>
                <p class="description"><?= htmlspecialchars($grid['description']); ?></p>
                <button>Jouer</button>
            </div>
        <?php endforeach; ?>
            <!-- Add more cards here -->
        </div>
    </div>
    <script src="../public/js/games.js?v=2"></script>

</body>
</html>