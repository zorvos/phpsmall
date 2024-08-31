<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM posts WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Post deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
