<?php
session_start();
require '../usergestion/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: usergestion/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['video_id'])) {
    $user_id = $_SESSION['user_id'];
    $video_id = intval($_POST['video_id']);

    // Vérifier si l'élément est déjà dans le panier
    $check = $conn->prepare("SELECT * FROM cart_items WHERE user_id = ? AND video_id = ?");
    $check->execute([$user_id, $video_id]);

    if ($check->rowCount() === 0) {
        $stmt = $conn->prepare("INSERT INTO cart_items (user_id, video_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $video_id]);
    }

    header("Location: panier.php");
    exit;
} else {
    echo "Requête invalide.";
}
?>