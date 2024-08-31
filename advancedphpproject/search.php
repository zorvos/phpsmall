<?php
include 'db.php';
session_start();

$search = $_GET['search'] ?? '';
$query = "SELECT * FROM tasks WHERE user_id = :user_id";
$params = ['user_id' => $_SESSION['user_id']];

if ($search) {
    $query .= " AND (title LIKE :search OR description LIKE :search)";
    $params['search'] = "%$search%";
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($tasks);
?>
