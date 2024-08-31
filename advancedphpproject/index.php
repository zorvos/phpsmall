<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Pretraga
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistem za Upravljanje Zadatakima</title>
    <script src="search.js"></script>
</head>
<body>
    <h1>Lista Zadataka</h1>
    <a href="create.php">Dodaj Novi Zadatak</a>
    <a href="logout.php">Odjavi se</a>
    <form id="search-form">
        <input type="text" id="search-input" placeholder="Pretraži zadatke" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Pretraži</button>
    </form>
    <table border="1">
        <tr>
            <th>Naslov</th>
            <th>Opis</th>
            <th>Status</th>
            <th>Akcija</th>
        </tr>
        <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?php echo htmlspecialchars($task['title']); ?></td>
            <td><?php echo htmlspecialchars($task['description']); ?></td>
            <td><?php echo htmlspecialchars($task['status']); ?></td>
            <td>
                <a href="edit.php?id=<?php echo $task['id']; ?>">Izmeni</a>
                <a href="delete.php?id=<?php echo $task['id']; ?>" onclick="return confirm('Da li ste sigurni da želite da obrišete ovaj zadatak?')">Obriši</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
