<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/global.css">
    <link rel="stylesheet" href="public/css/board.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Jeu de Mots Croisés</title>
</head>
<body>
    <?php include 'layout/navbar.php'; ?>
    <div class="board-container container">
        <div class="info-container">
        <?php 
            echo '
            <div class="general-info">
                <h2>'.$grid['nom'].'</h2>
                <p class="difficulty">
                <span class="difficulty-circle '.$grid['difficulté'].'"></span>'.$grid['difficulté'].'
            </p>
             
            <p class="estimated-time">Temps estimé: '.$grid['estimated_time'].' mins</p>
            </div>
            <p class="creator">Par : '.$grid['id_user'].'</p>
            <p class="description">'.$grid['description'].'</p>';
        ?>  
        </div>
        <div id="app">
            <div id="left-container">
                <div id="grid-wrapper">
                    <div id="grid-container">
                        <!-- La grille des mots croisés sera générée ici -->
                    </div>
                </div>
                <div id="controls">
                    <button id="horizontal" class="active">Horizontal</button> 
                    <button id="vertical">Vertical</button>
                </div>
            </div>
            
            <div id="right-container"> 
                <div id="clues-container">
                <div>
                    <h2>Horizontalement</h2>
                    <div id="horizontal-clues">
                        <!-- Les indices horizontaux seront affichés ici -->
                    </div>
                </div>
                <div>
                <h2>Verticalement</h2>
                    <div id="vertical-clues">
                        <!-- Les indices verticaux seront affichés ici -->
                    </div>
                </div>
            </div>
            <div id="session-controls">
                <?php if (isset($_SESSION['username'])): ?>
                    <button id="save-solution">Sauvgarder</button>
                <?php endif; ?>
                <button id="submit-solution">Valider</button>
            </div></div>
           
    </div>
    <div id="congratulations-modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Félicitations!</h2>
            <p>La solution est correcte !</p>
        </div>
    </div>
    <script>
        const grid = <?php echo json_encode($grid); ?>;
        const userProgress = <?= json_encode($progress) ?>;

    </script>
    <script src="public/js/board.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
</body>
</html>