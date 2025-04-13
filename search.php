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

$results = [];
$escapedQuery = '';

if (isset($_GET['q'])) {
    $query = trim($_GET['q']);
    $escapedQuery = htmlspecialchars($query);

    $sql = "SELECT * FROM videos WHERE title LIKE :query";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['query' => '%' . $query . '%']);
    $results = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche</title>
    <link rel="stylesheet" href="style/main_style.css">
    <link rel="stylesheet" href="style/header_style.css">
    <link rel="stylesheet" href="style/footer_style.css">
</head>

<body>
    <header>
        <div class="logo">The Sup Movie Base</div>

        <?php if (isset($_SESSION['username'])): ?>
        <div class="welcome-message">
            <?= htmlspecialchars($_SESSION['username']); ?> ! Voici le résultat de votre recherche.
        </div>
        <?php else: ?>
        <div class="welcome-message">
            Voici le résultat de votre recherche.
        </div>
        <?php endif; ?>


        <nav>
            <a href="usergestion/subscribe.php">Subscribe</a>
            <a href="usergestion/login.php">Login</a>
            <?php if (isset($_SESSION['user_id'])): ?>
            <a href="panier.php">Panier</a>
            <?php else: ?>
            <a href="usergestion/subscribe.php"
                onclick="alert('Veuillez vous inscrire ou vous connecter pour accéder au panier.');">Panier</a>
            <?php endif; ?>
            <a href="../index.php">Accueil</a>
            <a href="usergestion/logout.php">Deconnexion</a>
        </nav>

        <div class="search-bar">
            <form action="search.php" method="get">
                <input type="text" name="q" placeholder="Rechercher un film..." required>
                <button type="submit">🔍</button>
            </form>
        </div>
    </header>


    <main>
        <?php if (!empty($escapedQuery)): ?>
        <h1>Résultats de la recherche pour : "<?= $escapedQuery ?>"</h1>

        <?php if ($results && count($results) > 0): ?>
        <div class="results-container">
            <?php foreach ($results as $video): ?>
                <a href="vid.php?id=<?= urlencode($video['id']) ?>" class="video-result">
                <h2><?= htmlspecialchars($video['title']) ?></h2>
                <p><?= htmlspecialchars($video['description']) ?></p>
                <?php if (!empty($video['image_url'])): ?>
                <img src="<?= htmlspecialchars($video['image_url']) ?>" alt="Affiche du film">
                <?php else: ?>
                <p>Aucune image disponible.</p>
                <?php endif; ?>
                <p>Prix : <?= htmlspecialchars($video['price']) ?> €</p>
                </a>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <p>Aucun film trouvé pour "<?= $escapedQuery ?>".</p>
        <?php endif; ?>
        <?php else: ?>
        <p>Aucune recherche effectuée.</p>
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