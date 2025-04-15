<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../database/db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<p>Vous devez être connecté pour voir vos achats.</p>";
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT v.id, v.title, v.description, v.price, v.image_url
        FROM purchased_video pv
        JOIN videos v ON pv.video_id = v.id
        WHERE pv.user_id = :user_id";

$stmt = $conn->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$purchased_videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon compte</title>
    <link rel="stylesheet" href="../style/main_style.css">
    <link rel="stylesheet" href="../style/header_style.css">
    <link rel="stylesheet" href="../style/footer_style.css">
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
            <a href="../paniergestion/panier.php">Panier</a> |
            <a href="../index.php">Accueil</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <section class="cart-videos">
            <h1>🎥 Mes achats</h1>
            <h2>Films achetés :</h2>

            <div class="results-container">
                <?php if (count($purchased_videos) > 0): ?>
                <?php foreach ($purchased_videos as $video): ?>
                <a href="../view.php?id=<?= urlencode($video['id']) ?>" class="video-result">
                    <h2><?= htmlspecialchars($video['title']) ?></h2>
                    <?php if (!empty($video['image_url'])): ?>
                    <img src="../<?= htmlspecialchars($video['image_url']) ?>" alt="Affiche du film">
                    <?php else: ?>
                    <p>Aucune image disponible.</p>
                    <?php endif; ?>
                    <p><?= htmlspecialchars($video['description']) ?></p>
                    <p class="watch">| cliquer sur le film pour le regarder |</p>
                </a>
                <?php endforeach; ?>
                <?php else: ?>
                <p>Vous n'avez encore acheté aucun film.</p>
                <?php endif; ?>
            </div>
        </section>

        <?php if (!empty($_SESSION['password_error'])): ?>
        <p style="color: red; text-align:center;"><?= htmlspecialchars($_SESSION['password_error']) ?></p>
        <?php unset($_SESSION['password_error']); ?>
        <?php elseif (!empty($_SESSION['password_success'])): ?>
        <p style="color: green; text-align:center;"><?= htmlspecialchars($_SESSION['password_success']) ?></p>
        <?php unset($_SESSION['password_success']); ?>
        <?php endif; ?>

        <section class="password-change">
            <h2>Changer mon mot de passe</h2>

            <?php if (!empty($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php elseif (!empty($success)): ?>
            <p style="color: green;"><?= htmlspecialchars($success) ?></p>
            <?php endif; ?>

            <form method="POST" action="changepassword.php">
                <label for="old_password">Ancien mot de passe :</label>
                <input type="password" name="old_password" id="old_password" required>

                <label for="new_password">Nouveau mot de passe :</label>
                <input type="password" name="new_password" id="new_password" required>

                <label for="confirm_password">Confirmer le nouveau mot de passe :</label>
                <input type="password" name="confirm_password" id="confirm_password" required>

                <button type="submit">Mettre à jour le mot de passe</button>
            </form>
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