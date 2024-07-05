<?php
session_start();
include 'database2.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check if user ID is received
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch user data from database
    $sql = "SELECT * FROM images WHERE id='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
} else {
    header("Location: dashboard.php");
    exit();
}

// Process update form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize input if needed
    $image_data = $_POST['image_data'];
    $waktu = $_POST['waktu'];

    // Update user data in the database
    $sql = "UPDATE images SET image_data='$image_data', waktu='$waktu' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        /* Additional inline styles if needed */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container label {
            display: block;
            margin-bottom: 10px;
        }

        .container input[type="text"],
        .container input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update User</h1>
        <form action="update.php?id=<?php echo $id; ?>" method="post">
            <label for="image_data">Image Data:</label>
            <input type="text" id="image_data" name="image_data" value="<?php echo $row['image_data']; ?>" required>
            <br>
            <label for="waktu">Waktu:</label>
            <input type="text" id="waktu" name="waktu" value="<?php echo $row['waktu']; ?>" required>
            <br>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
