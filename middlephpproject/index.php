<?php
include 'db.php';

$sql = "SELECT id, title, content, created_at FROM posts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<h2>" . $row["title"]. "</h2><p>" . $row["content"]. "</p><small>Posted on " . $row["created_at"]. "</small><hr>";
    }
} else {
    echo "0 results";
}
?>
