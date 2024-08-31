<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'] ?? null;

// Proverava da li zadatak pripada trenutnom korisniku
$stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id AND user_id = :user_id");
$stmt->execute(['id' => $id, 'user_id' => $_SESSION['user_id']]);

header('Location: index.php');
?>
