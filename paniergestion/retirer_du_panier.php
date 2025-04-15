<?php
session_start();
require_once '../usergestion/db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<p>Vous devez être connecté pour voir votre panier.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['video_id'])) {
    $video_id = $_POST['video_id'];
    $user_id = $_SESSION['user_id'];

    // Vérifier si la vidéo est présente dans le panier de l'utilisateur
    $sql = "SELECT * FROM cart_items WHERE video_id = :video_id AND user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['video_id' => $video_id, 'user_id' => $user_id]);
    $video_in_cart = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($video_in_cart) {
        // Si la vidéo est présente dans le panier, la supprimer
        $sql = "DELETE FROM cart_items WHERE video_id = :video_id AND user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['video_id' => $video_id, 'user_id' => $user_id]);

        // Redirection vers le panier
        header("Location: panier.php");
        exit;
    } else {
        echo "<p>La vidéo n'a pas été trouvée dans votre panier.</p>";
    }
} else {
    echo "<p>Erreur : Paramètre 'video_id' manquant ou méthode incorrecte.</p>";
}
?>
