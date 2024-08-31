<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'] ?? null;

// Proverava da li zadatak pripada trenutnom korisniku
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id AND user_id = :user_id");
$stmt->execute(['id' => $id, 'user_id' => $_SESSION['user_id']]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$task) {
    echo "Zadatak nije pronađen ili nemate dozvolu za pristup.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE tasks SET title = :title, description = :description, status = :status WHERE id = :id AND user_id = :user_id");
    $stmt->execute(['title' => $title, 'description' => $description, 'status' => $status, 'id' => $id, 'user_id' => $_SESSION['user_id']]);

    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Izmeni Zadatak</title>
</head>
<body>
    <h1>Izmeni Zadatak</h1>
    <form method="post">
        <label for="title">Naslov:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
        <br>
        <label for="description">Opis:</label>
        <textarea id="description" name="description"><?php echo htmlspecialchars($task['description']); ?></textarea>
        <br>
        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="pending" <?php echo $task['status'] == 'pending' ? 'selected' : ''; ?>>Na čekanju</option>
            <option value="completed" <?php echo $task['status'] == 'completed' ? 'selected' : ''; ?>>Završeno</option>
        </select>
        <br>
        <button type="submit">Ažuriraj</button>
    </form>
    <a href="index.php">Nazad na Listu</a>
</body>
</html>
