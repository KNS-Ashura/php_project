<?php
session_start();
require './usergestion/env.php';

$charset = 'latin1';

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Récupérer les 10 derniers films
$sql = "SELECT * FROM videos ORDER BY id DESC LIMIT 10";
$stmt = $pdo->query($sql);
$recent_videos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSMB</title>
    <link rel="stylesheet" href="style/main_style.css">
    <link rel="stylesheet" href="style/header_style.css">
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
            <a href="usergestion/subscribe.php">Subscribe</a>
            <a href="usergestion/login.php">Login</a>
            <a href="panier.php">Panier</a>
        </nav>

        <div class="search-bar">
            <form action="search.php" method="get">
                <input type="text" name="q" placeholder="Rechercher un film..." required>
                <button type="submit">🔍</button>
            </form>
        </div>
    </header>

    <main>

        <section class="recent-videos">
            <h1>🎬 Films Tendance</h1>
            <div class="results-container">
                <?php foreach ($recent_videos as $video): ?>
                <div class="video-result">
                    <h2><?= htmlspecialchars($video['title']) ?></h2>
                    <p><?= htmlspecialchars($video['description']) ?></p>
                    <?php if (!empty($video['image_url'])): ?>
                    <img src="<?= htmlspecialchars($video['image_url']) ?>" alt="Affiche du film">
                    <?php else: ?>
                    <p>Aucune image disponible.</p>
                    <?php endif; ?>
                    <p>Prix : <?= htmlspecialchars($video['price']) ?> €</p>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
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