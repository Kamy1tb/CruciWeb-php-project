<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/global.css">
    <link rel="stylesheet" href="../public/css/board.css">
    <title>Jeu de Mots Croisés</title>
</head>
<body>
    <?php include 'layout/navbar.php'; ?>
    <div class="board-container container">
        <h1>Jeu de Mots Croisés</h1>
        <div id="app">
            <div id="grid-wrapper">
                <div id="grid-container">
                    <!-- La grille des mots croisés sera générée ici -->
                </div>
            </div>
            <div id="controls">
                <button id="toggle-direction">Changer la direction</button>
                <button id="submit-solution">Soumettre la solution</button>
                <button id="clear-cells">Effacer toutes les cases</button>
            </div></div>
            
            <div id="clues-container">
              <div>
                <h2>Indices Horizontaux</h2>
                <div id="horizontal-clues">
                    <!-- Les indices horizontaux seront affichés ici -->
                </div>
              </div>
              <div>
              <h2>Indices Verticaux</h2>
                <div id="vertical-clues">
                    <!-- Les indices verticaux seront affichés ici -->
                </div>
              </div>
                
            </div>
    </div>
    <script src="../public/js/board.js"></script>
</body>
</html>