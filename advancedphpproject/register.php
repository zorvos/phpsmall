<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)");
    $stmt->execute(['username' => $username, 'password_hash' => $password_hash]);

    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
</head>
<body>
    <h1>Registrujte se</h1>
    <form method="post">
        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Lozinka:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Registruj se</button>
    </form>
    <a href="login.php">Već imate nalog? Prijavite se</a>
</body>
</html>
