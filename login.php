<?php
session_start();
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Menyimpan informasi pengguna dalam sesi
            $_SESSION['username'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid password.'); window.location.href='index.html';</script>";
        }
    } else {
        echo "<script>alert('No user found with this email.'); window.location.href='register.html';</script>";
    }
}
$conn->close();
?>
