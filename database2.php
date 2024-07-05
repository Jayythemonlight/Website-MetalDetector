<?php
$servername = "192.168.100.87";
$username = "root";
$password = "root123";
$dbname = "esp32cam";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
