<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/main_style.css">
    <link rel="stylesheet" href="../style/footer_style.css">
    <link rel="stylesheet" href="../style/header_style.css">
    <link rel="stylesheet" href="../style/form_style.css">
    <title>Subscribe</title>
</head>

<body>

    <header>
        <div class="logo">MonSiteFictif</div>

        <?php if (isset($_SESSION['username'])): ?>
        <div class="welcome-message">
            Bienvenue, <?= htmlspecialchars($_SESSION['username']); ?> !
        </div>
        <?php endif; ?>

        <!-- liste des liens -->
        <nav>
            <a href="usergestion\subscribe.php">Subscribe</a>
            <a href="usergestion\login.php">Login</a>
        </nav>

        <div class="search-bar">
            <input type="text" placeholder="Rechercher...">
            <button>🔍</button>
        </div>
    </header>

    <main>
        <div class="form-container">
            <h2>Créer un nouvel utilisateur</h2>
            <form action="create_user.php" method="POST">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Créer un compte</button>
            </form>
        </div>
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
            <p>&copy; 2025 MonSiteFictif. Tous droits réservés.</p>
        </div>
    </footer>



</body>

</html>