<?php
session_start();
require_once 'database/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    echo "Aucun identifiant de vidéo fourni.";
    exit;
}

$video_id = $_GET['id'];

// Requête pour récupérer l'URL de la vidéo
$sql = "SELECT title, movie_url FROM videos WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $video_id]);
$video = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$video || empty($video['movie_url'])) {
    echo "Vidéo introuvable ou URL manquante.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($video['title']) ?></title>
    <link rel="stylesheet" href="style/view_style.css">
</head>
<body>

<a href="usergestion/mon_compte.php" class="back-button">← Retour</a>

<video controls autoplay>
    <source src="<?= htmlspecialchars($video['movie_url']) ?>" type="video/mp4">
    Votre navigateur ne supporte pas la lecture vidéo.
</video>

</body>
</html>