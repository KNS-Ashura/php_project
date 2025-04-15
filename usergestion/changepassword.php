<?php
session_start();
require_once '../database/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../usergestion/login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldPassword = $_POST['old_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Vérification de l'ancien mot de passe
    $stmt = $conn->prepare("SELECT password_hash FROM users WHERE id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($oldPassword, $user['password_hash'])) {
        $_SESSION['password_error'] = "Ancien mot de passe incorrect.";
    } elseif (strlen($newPassword) < 8) {
        $_SESSION['password_error'] = "Le nouveau mot de passe doit contenir au moins 8 caractères.";
    } elseif ($newPassword !== $confirmPassword) {
        $_SESSION['password_error'] = "Les nouveaux mots de passe ne correspondent pas.";
    } else {
        $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE users SET password_hash = :newHash WHERE id = :user_id");
        $update->execute([
            'newHash' => $newHash,
            'user_id' => $user_id
        ]);

        $_SESSION['password_success'] = "Mot de passe mis à jour avec succès.";
    }
}

header('Location: mon_compte.php');
exit;