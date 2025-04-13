<?php
session_start();
require 'usergestion/db.php';

if (!isset($_GET['id'])) {
    echo "Aucun film sélectionné.";
    exit;
}

$video_id = $_GET['id'];

// Préparer la requête SQL pour récupérer les informations du film avec les jointures
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
</head>

<body>
    <h1><?= htmlspecialchars($video['title']) ?></h1>
    <img src="<?= htmlspecialchars($video['image_url']) ?>" alt="Affiche du film" style="max-width: 300px;">
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
</body>

</html>
