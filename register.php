<?php
include 'database.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password_plain = $_POST['password']; // Password asli dalam plain text

// Hash password menggunakan PASSWORD_DEFAULT (saat ini bcrypt)
$password_hashed = password_hash($password_plain, PASSWORD_DEFAULT);

// Menggunakan prepared statement untuk keamanan dan menghindari SQL injection
$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password_hashed);

if ($stmt->execute() === TRUE) {
    echo "Registration successful. <a href='index.html'>Login here</a>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>