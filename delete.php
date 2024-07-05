<?php
session_start();
include 'database2.php';

// Memeriksa apakah pengguna telah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Memeriksa apakah ID pengguna telah diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM images WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    header("Location: dashboard.php");
    exit();
}
?>

<?php $conn->close(); ?>
