<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
    } else {
        $error = "Nevažeće korisničko ime ili lozinka.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prijava</title>
</head>
<body>
    <h1>Prijavite se</h1>
    <form method="post">
        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Lozinka:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Prijavite se</button>
    </form>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <a href="register.php">Nemate nalog? Registrujte se</a>
</body>
</html>
