<?php
session_start();
require_once '../database/db.php';

if (!isset($_SESSION['user_id'])) {
    echo "Vous devez être connecté pour acheter.";
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT video_id FROM cart_items WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($items)) {
    echo "Votre panier est vide.";
    exit;
}

foreach ($items as $item) {
    $insert_sql = "INSERT INTO purchased_video (user_id, video_id) VALUES (:user_id, :video_id)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->execute([
        'user_id' => $user_id,
        'video_id' => $item['video_id']
    ]);
}

$delete_sql = "DELETE FROM cart_items WHERE user_id = :user_id";
$delete_stmt = $conn->prepare($delete_sql);
$delete_stmt->execute(['user_id' => $user_id]);

header("Location: panier.php");
exit;
?>