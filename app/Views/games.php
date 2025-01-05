<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/global.css">
    <link rel="stylesheet" href="public/css/games.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Jeux Créés</title>
</head>
<body>
    <?php include 'layout/navbar.php'; ?>
    <div class="games-container">
        <h1>Jeux Créés</h1>
        <div class="tabs">
            <button class="tab-button" id="all-filter">Toutes les parties</button>
            <?php if (isset($_SESSION['username'])): ?>
                <button class="tab-button" id="user-filter">Parties créées par l'utilisateur</button>
                <button class="tab-button" id="progress-filter">Parties en cours</button>
            <?php endif; ?>
        </div>
        <div class="tab-content">
            <div class="filter-container">
                <select id="sort-by">
                    <option value="" disabled >Trier Par</option>
                    <option value="creation_date" selected>Date de création</option>
                    <option value="difficulté">Difficulté</option>
                </select>
                <select id="sort-order">
                    <option value="" disabled >Ordre</option>
                    <option value="asc" selected>Ascendant</option>
                    <option value="desc">Descendant</option>
                </select>
            </div>
            <div class="cards-container" id="cards-container">
                <!-- Cards will be inserted here by JavaScript -->
            </div>
            <div class="pagination-container" id="pagination-container">
                <!-- Pagination buttons will be inserted here by JavaScript -->
            </div>
        </div>
        
        
    </div>
    <script>
        const phpData = <?php echo json_encode($grids); ?>;
        const username = <?php echo isset($_SESSION['username']) ? json_encode($_SESSION['username']) : 'null'; ?>;
        const grids_saved = <?php echo isset($grids_saved) ? json_encode($grids_saved) : 'null'; ?>;
    </script>
    <script src="public/js/games.js"></script>
</body>
</html>