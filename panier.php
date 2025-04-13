<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'usergestion/db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<p>Vous devez être connecté pour voir votre panier.</p>";
    exit;
}

$user_id = $_SESSION['user_id'];

// Requête PDO
$sql = "SELECT v.title, v.description, v.price, v.image_url
        FROM cart_items ci
        JOIN videos v ON ci.video_id = v.id
        WHERE ci.user_id = :user_id";

$stmt = $conn->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main_style.css">
    <link rel="stylesheet" href="style/header_style.css">
    <link rel="stylesheet" href="style/footer_style.css">
    <title>Panier</title>
</head>

<body>
    <header>
        <div class="logo">The Sup Movie Base</div>

        <?php if (isset($_SESSION['username'])): ?>
        <div class="welcome-message">
            <?= htmlspecialchars($_SESSION['username']); ?> ! voici votre panier.
        </div>
        <?php endif; ?>

        <nav>
            <a href="usergestion/subscribe.php">Subscribe</a>|
            <a href="usergestion/login.php">Login</a>|
            <a href="../index.php">Accueil</a>
        </nav>

        <div class="search-bar">
            <form action="search.php" method="get">
                <input type="text" name="q" placeholder="Rechercher un film..." required>
                <button type="submit">🔍</button>
            </form>
        </div>
    </header>

    <main>
        <section class="cart-videos">
            <h1>🛒 Mon Panier</h1>
            <div class="results-container">
                <?php if (count($videos) > 0): ?>
                <?php foreach ($videos as $video): ?>
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
                <?php else: ?>
                <p>Votre panier est vide.</p>
                <?php endif; ?>
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