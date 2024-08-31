<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Post updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT title, content FROM posts WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<form method="post" action="update.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    Title: <input type="text" name="title" value="<?php echo $row['title']; ?>"><br>
    Content: <textarea name="content"><?php echo $row['content']; ?></textarea><br>
    <input type="submit" value="Update Post">
</form>
