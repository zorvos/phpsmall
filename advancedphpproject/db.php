<?php
$host = 'localhost';
$db = 'task_manager';
$user = 'root';
$pass = '';

// Kreirajte PDO instancu
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Konekcija nije uspela: ' . $e->getMessage();
}
?>
