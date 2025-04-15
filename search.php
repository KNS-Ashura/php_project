<?php
session_start();
require './usergestion/env.php';
require './usergestion/db.php';

$results = [];
$searchType = '';
$searchValue = '';

if (isset($_GET['q']) && trim($_GET['q']) !== '') {
    $searchValue = trim($_GET['q']);
    $searchType = 'titre';
    $sql = "SELECT * FROM videos WHERE title LIKE :query";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['query' => '%' . $searchValue . '%']);
    $results = $stmt->fetchAll();
} elseif (isset($_GET['category']) && trim($_GET['category']) !== '') {
    $searchValue = trim($_GET['category']);
    $searchType = 'catégorie';
    $sql = "SELECT * FROM videos WHERE category = :category";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['category' => $searchValue]);
    $results = $stmt->fetchAll();
} elseif (isset($_GET['director']) && trim($_GET['director']) !== '') {
    $searchValue = trim($_GET['director']);
    $searchType = 'réalisateur';

    $sql = "SELECT videos.*, directors.name AS director_name
            FROM videos
            INNER JOIN directors ON videos.director_id = directors.id
            WHERE directors.name LIKE :director";
    

    $stmt = $conn->prepare($sql);

    $stmt->execute(['director' => '%' . $searchValue . '%']);
    
    $results = $stmt->fetchAll();
} else {
    echo "caca";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche</title>
    <link rel="stylesheet" href="style/main_style.css">
    <link rel="stylesheet" href="style/header_style_2.css">
    <link rel="stylesheet" href="style/footer_style.css">
</head>

<body>
<header>
        <div class="logo">The Sup Movie Base</div>

        <?php if (isset($_SESSION['username'])): ?>
        <div class="welcome-message">
            Bienvenue, <?= htmlspecialchars($_SESSION['username']); ?> !
        </div>
        <?php endif; ?>

        <nav>
            <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="usergestion/subscribe.php">Subscribe</a> |
            <a href="usergestion/login.php">Login</a>
            <?php else: ?>
            <a href="paniergestion/panier.php">Panier</a> |
            <a href="usergestion/mon_compte.php">Gérer mon compte</a> |
            <a href="../index.php">Accueil</a> |
            <a href="usergestion/logout.php">Déconnexion</a>
            <?php endif; ?>
        </nav>

        <section class="category-bar">
            <div class="category-description">
                <p>Découvrez nos films par catégorie !</p>
            </div>
            <div class="category-buttons">
                <a href="search.php?category=drama" class="category-button">Drama</a>
                <a href="search.php?category=action" class="category-button">Action</a>
            </div>

            <div class="search-bar">
                <form action="search.php" method="get">
                    <input type="text" name="q" placeholder="Rechercher un film..." required>
                    <button type="submit">🔍</button>
                </form>
            </div>

            <div class="search-bar">
                <form action="search.php" method="get">
                    <input type="text" name="director" placeholder="Rechercher par réalisateur..." required>
                    <button type="submit">🎬</button>
                </form>
            </div>
        </section>
    </header>

    <main>
        <?php if ($searchValue !== '' && $searchType !== ''): ?>
            <h1>Résultats de la recherche par <?= $searchType ?> : "<?= htmlspecialchars($searchValue) ?>"</h1>
        <?php else: ?>
            <p>Aucune recherche effectuée.</p>
        <?php endif; ?>

        <?php if (!empty($results)): ?>
            <div class="results-container">
                <?php foreach ($results as $video): ?>
                    <a href="vid.php?id=<?= urlencode($video['id']) ?>" class="video-result">
                        <h2><?= htmlspecialchars($video['title']) ?></h2>
                        <?php if (!empty($video['image_url'])): ?>
                            <img src="<?= htmlspecialchars($video['image_url']) ?>" alt="Affiche du film">
                        <?php else: ?>
                            <p>Aucune image disponible.</p>
                        <?php endif; ?>
                        <p>Prix : <?= htmlspecialchars($video['price']) ?> €</p>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php elseif ($searchValue !== ''): ?>
            <p>Aucun film trouvé pour "<?= htmlspecialchars($searchValue) ?>"</p>
        <?php endif; ?>
    </main>

    <footer>
        <div class="footer-contact">
            <h3>Contact</h3>
            <p>Téléphone : +33 1 23 45 67 89</p>
            <p>Email : contact@exemple.com</p>
            <p>Adresse : 123 Rue Imaginaire, 75000 Paris, France</p>
        </div>

        <div class="footer-social">
            <h3>Suivez-nous</h3>
            <p>
                <a href="#">YouTube</a> |
                <a href="#">Instagram</a> |
                <a href="#">Facebook</a> |
                <a href="#">Twitter</a>
            </p>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 The Sup Movie Base. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>