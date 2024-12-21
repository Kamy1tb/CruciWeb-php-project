<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <table >
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id_user']) ?></td>
                        <td><?= htmlspecialchars($user['full_name']) ?></td>
                        <td><?= htmlspecialchars($user['mail']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Aucun utilisateur trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="../public/index.php?action=login">Se connecter</a>
</body>
</html>
