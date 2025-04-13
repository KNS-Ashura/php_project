<?php
session_start();
require 'usergestion/db.php';

if (!isset($_GET['id'])) {
    echo "Aucun film sélectionné.";
    exit;
}

$video_id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM videos WHERE id = ?");
$stmt->execute([$video_id]);
$video = $stmt->fetch();

if (!$video) {
    echo "Film non trouvé.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1><?= htmlspecialchars($video['title']) ?></h1>
    <p><?= htmlspecialchars($video['description']) ?></p>
    <?php if (!empty($video['image_url'])): ?>
    <img src="<?= htmlspecialchars($video['image_url']) ?>" alt="Affiche du film">
    <?php endif; ?>
    <p>Prix : <?= htmlspecialchars($video['price']) ?> €</p>
</body>


</html>