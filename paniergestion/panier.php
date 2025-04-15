<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../database/db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<p>Vous devez être connecté pour voir votre panier.</p>";
    exit;
}

$user_id = $_SESSION['user_id'];


$sql = "SELECT v.id, v.title, v.description, v.price, v.image_url
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
    <link rel="stylesheet" href="../style/main_style.css">
    <link rel="stylesheet" href="../style/header_style.css">
    <link rel="stylesheet" href="../style/footer_style.css">
    <link rel="stylesheet" href="../style/btn_panier_style.css">
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
            <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="usergestion/subscribe.php">Subscribe</a> |
            <a href="usergestion/login.php">Login</a>
            <?php else: ?>
            <a href="../usergestion/mon_compte.php">Gérer mon compte</a> |
            <a href="../index.php">Accueil</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <section class="cart-videos">
            <h1>🛒 Mon Panier</h1>
            <h2>Voici vos articles :</h2>
            <div class="results-container">
                <?php if (count($videos) > 0): ?>
                <?php $total = 0; ?>
                <?php foreach ($videos as $video): ?>
                <?php $total += $video['price']; ?>
                <a href="vid.php?id=<?= urlencode($video['id']) ?>" class="video-result">
                    <h2><?= htmlspecialchars($video['title']) ?></h2>
                    <?php if (!empty($video['image_url'])): ?>
                    <img src="../<?= htmlspecialchars($video['image_url']) ?>" alt="Affiche du film">
                    <?php else: ?>
                    <p>Aucune image disponible.</p>
                    <?php endif; ?>
                    <p>Prix : <?= htmlspecialchars($video['price']) ?> €</p>

                    <form action="retirer_du_panier.php" method="POST">
                        <input type="hidden" name="video_id" value="<?= $video['id'] ?>">
                        <button type="submit" class="delete-from-cart-btn">Retirer du panier</button>
                    </form>
                </a>
                <?php endforeach; ?>
                <section class="panier_infos">
                    <div class="cart-total">
                        <h3>Total : <?= number_format($total, 2, ',', ' ') ?> €</h3>
                    </div>
                    <form action="acheter.php" method="POST">
                        <button type="submit" class="acheter-btn">Acheter</button>
                    </form>
                </section>
                <?php else: ?>
                <p>Votre panier est vide.</p>
                <?php endif; ?>
            </div>
        </section>

        <section>
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