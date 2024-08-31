<?php
include 'db_connect.php';

$username = $_POST['username'];
$email = $_POST['email'];

$sql = "INSERT INTO users (username, email) VALUES ('$username', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "Novi zapis je uspešno dodat.";
} else {
    echo "Greška: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

