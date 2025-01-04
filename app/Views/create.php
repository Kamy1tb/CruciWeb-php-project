<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/global.css">
    <link rel="stylesheet" href="../public/css/create.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Créer une grille</title>
</head>
<body>
    <?php include 'layout/navbar.php'; ?>
    <div class="create-container">
        <h1>Création d'une nouvelle grille</h1>
        <div class="step-indicator">
            <div class="step">1</div>
            <div class="separator"></div>
            <div class="step">2</div>
            <div class="separator"></div>
            <div class="step">3</div>
        </div>
        <form id="create-form">
            <div class="form-step" id="step1">
                <div class="form-group"> 
                    <input type="text" id="grid-name" name="grid-name" placeholder="Nom de la grille" required>

                    <select id="difficulty" name="difficulty" required>
                        <option value="" disabled selected>Difficulté</option>
                        <option value="facile">facile</option>
                        <option value="moyen">moyen</option>
                        <option value="difficile">difficile</option>
                    </select>

                </div>
                
                <div class="form-group"> 
                    <select id="height" name="height" required>
                        <option value="" disabled selected>Hauteur</option>
                        <?php for ($i = 5; $i <= 15; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>

                    <select id="width" name="width" required>
                        <option value="" disabled selected>Largeur</option>
                        <?php for ($i = 5; $i <= 15; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>

                </div>

                <div class="slider-group">
                    <label for="estimated-time">Temps estimé:</label>
                    <input type="range" id="estimated-time" name="estimated-time" min="3" max="120" step="1" value="3" oninput="document.getElementById('output').textContent = this.value">
                    <div><span id="output">3</span> minutes</div>
                </div>

                <textarea id="description" name="description" placeholder="Description" required></textarea>

                <button type="button" onclick="nextStep()">Suivant</button>
            </div>
            <div class="form-step" id="step2" style="display:none;">
                <h2>Cliquez sur les cases noires</h2>
                <div id="grid-container"></div>
                <button type="button" onclick="prevStep()">Précédent</button>
                <button type="button" onclick="nextStep()">Suivant</button>
            </div>
            <div class="form-step" id="step3" style="display:none;">
                <div class="step3-container">
                    <div id="grid-container-step3"></div>
                    <div class="clues-container">
                        <h2>Créer des indices</h2>
                        <div id="clues-form"></div>
                    </div>
                </div>
                <button type="button" onclick="prevStep()">Précédent</button>
                <button type="button" id="submit-button">Soumettre</button>
            </div>
        </form>
    </div>
    <script src="../public/js/create.js"></script>
</body>
</html>