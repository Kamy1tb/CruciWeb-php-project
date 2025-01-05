<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneau d'administration</title>
    <link rel="stylesheet" href="/public/css/admin.css">
    <link rel="stylesheet" href="/public/css/global.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <nav>
        <div class="nav-left">
            <img src="public/images/logo.png" alt="Logo" class="logo">
        </div>
        <div class="nav-center">
            <h2>Panneau d'administration</h2>
        </div>
        <div class="nav-right" >
        <?php
        echo '  <a href="index.php?action=logout" class="logout-button">
                    <img src="./public/images/logout.png" alt="Logout Icon">
                    <span>Logout</span>
                </a>
            ';
        ?>
        </div>
    </nav>
    
    <div class="admin-menu">
        <h2>Users</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        <?php if (!empty($users)) : ?>
            <?php foreach ($users as $user) : ?>
                <?php if ($user['username'] === 'admin_cruciweb') continue; ?>  <!-- Skip this user if the username is 'admin_cruciweb' -->

                <tr>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['full_name']) ?></td>
                    <td><?= htmlspecialchars($user['mail']) ?></td>
                    <td>
                        <a href="/index.php?action=delete_user&username=<?= urlencode($user['username']) ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>

        </table>

        <h2>Grids</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Créateur</th>
                        <th>Nom Createur</th>
                        <th>Créé a</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($grids)) : ?>
                        <?php foreach ($grids as $grid) : ?>
                            <tr>
                                <td><?= htmlspecialchars($grid['id_grille']) ?></td>
                                <td><?= htmlspecialchars($grid['id_user']) ?></td>
                                <td><?= htmlspecialchars($grid['nom']) ?></td>
                                <td><?= htmlspecialchars($grid['date']) ?></td>
                                <td><?= htmlspecialchars($grid['description']) ?></td>
                                <td>
                                    <a href="/index.php?action=delete_grid&gridId=<?= urlencode($grid['id_grille']) ?>">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4">No grids found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
    </div>
    

    <script src="/public/js/admin.js"></script>
</body>
</html>
