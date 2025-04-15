<?php
session_start();
require 'database/db.php';

if (!isset($_GET['id'])) {
    echo "Aucun film sélectionné.";
    exit;
}

$video_id = $_GET['id'];

$stmt = $conn->prepare("
    SELECT v.*, 
           d.name AS director_name, 
           a1.name AS actor1_name, 
           a2.name AS actor2_name, 
           a3.name AS actor3_name
    FROM videos v
    LEFT JOIN directors d ON v.director_id = d.id
    LEFT JOIN actors a1 ON v.actor_1_id = a1.id
    LEFT JOIN actors a2 ON v.actor_2_id = a2.id
    LEFT JOIN actors a3 ON v.actor_3_id = a3.id
    WHERE v.id = ?
");

$stmt->execute([$video_id]);
$video = $stmt->fetch();

if (!$video) {
    echo "Film non trouvé.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($video['title']) ?></title>
    <link rel="stylesheet" href="style/header_style.css">
    <link rel="stylesheet" href="style/footer_style.css">
    <link rel="stylesheet" href="style/vid_style.css">
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

        <div class="search-bar">
            <form action="search.php" method="get">
                <input type="text" name="q" placeholder="Rechercher un film..." required>
                <button type="submit">🔍</button>
            </form>
        </div>
    </header>

    <main>
        <h1><?= htmlspecialchars($video['title'])?></h1>
        <img src="<?= htmlspecialchars($video['image_url']) ?>" alt="Affiche du film" style="max-width: 300px;">
        <video width="640" height="360" controls>
            <source src="<?= htmlspecialchars($video['trailer_url']) ?>" type="video/mp4">
        </video>
        <p><strong>Description :</strong> <?= nl2br(htmlspecialchars($video['description'])) ?></p>
        <p><strong>Prix :</strong> <?= htmlspecialchars($video['price']) ?> €</p>
        <p><strong>Catégorie :</strong> <?= htmlspecialchars($video['category']) ?></p>
        <p><strong>Réalisateur :</strong> <?= htmlspecialchars($video['director_name'] ?? 'Inconnu') ?></p>
        <p><strong>Acteurs :</strong></p>
        <ul>
            <li><?= htmlspecialchars($video['actor1_name'] ?? 'Inconnu') ?></li>
            <li><?= htmlspecialchars($video['actor2_name'] ?? 'Inconnu') ?></li>
            <li><?= htmlspecialchars($video['actor3_name'] ?? 'Inconnu') ?></li>
        </ul>
        <?php if (isset($_SESSION['user_id'])): ?>
        <form action="paniergestion/ajouter_au_panier.php" method="post">
            <input type="hidden" name="video_id" value="<?= $video_id ?>">
            <button type="submit" class="add-to-cart-btn">Ajouter au panier</button>
        </form>
        <?php else: ?>
        <button class="add-to-cart-btn"
            onclick="alert('Vous devez être connecté pour ajouter un film au panier.'); window.location.href='usergestion/login.php';">
            Ajouter au panier
        </button>
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