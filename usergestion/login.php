<?php
session_start();
require "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password_input = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password_input, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header("Location: ../index.php");
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/userpage_main_style.css">
    <link rel="stylesheet" href="../style/footer_style.css">
    <link rel="stylesheet" href="../style/header_style.css">
    <link rel="stylesheet" href="../style/form_style.css">
    <title>Connexion</title>
</head>

<body>


    <body>

        <header>
            <div class="logo">MonSiteFictif</div>

            <nav>
                <a href="subscribe.php">S'inscrire</a>|
                <a href="../index.php">Accueil</a>
            </nav>
        </header>

        <main>
            <div class="form-container">
                <h2>Se connecter</h2>
                <form action="login.php" method="POST">
                    <label for="username">Nom d'utilisateur :</label>
                    <input type="text" id="username" name="username" required>

                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>

                    <button type="submit">Se connecter</button>
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
                <p>&copy; 2025 The Sup Movie Base. Tous droits réservés.</p>
            </div>
        </footer>

    </body>

</body>

</html>