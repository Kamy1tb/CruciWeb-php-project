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
        <div class="filter-container">
            <label for="sort-by">Trier par:</label>
            <select id="sort-by">
                <option value="creation_date">Date de création</option>
                <option value="difficulté">Difficulté</option>
            </select>
            <label for="sort-order">Ordre:</label>
            <select id="sort-order">
                <option value="asc">Ascendant</option>
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
    <script>
        const phpData = <?php echo json_encode($grids); ?>;
    </script>
    <script src="js/games.js"></script>
</body>
</html>