<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

// Kreiranje konekcije
$conn = new mysqli($servername, $username, $password, $dbname);

// Provera konekcije
if ($conn->connect_error) {
    die("Konekcija nije uspela: " . $conn->connect_error);
}
?>
