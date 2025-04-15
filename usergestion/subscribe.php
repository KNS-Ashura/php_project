<?php
require '../database/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Adresse email invalide.";
    }
    elseif ($password !== $confirm_password) {
        $error = "Les mots de passe ne correspondent pas.";
    }

    else {
        $check = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $check->execute(['email' => $email]);
        if ($check->fetchColumn() > 0) {
            $error = "Un compte existe déjà avec cette adresse email.";
        }
    }

    if (!$error) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO users (username, email, password_hash) 
                    VALUES (:username, :email, :password_hash)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password_hash', $password_hash);
            $stmt->execute();
            header('Location: login.php');
            exit();
        } catch (PDOException $e) {
            $error = "Erreur lors de la création du compte : " . $e->getMessage();
        }
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
    <title>Inscription</title>
</head>

<body>

    <header>
        <div class="logo">The Sup Movie Base</div>

        <nav>
            <a href="login.php">Se connecter</a>|
            <a href="../index.php">Accueil</a>
        </nav>
    </header>

    <main>
    <div class="form-container">
        <h2>Créer un nouvel utilisateur</h2>

        <?php if (!empty($error)): ?>
            <p style="color: red; font-weight: bold;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form action="subscribe.php" method="POST">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirmer le mot de passe :</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

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
            <p>&copy; 2025 The Sup Movie Base. Tous droits réservés.</p>
        </div>
    </footer>

</body>

</html>