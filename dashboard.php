<?php
session_start();
include 'database2.php';

// Memeriksa apakah pengguna telah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Mengambil data pengguna dari database
$sql = "SELECT * FROM images";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Global styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 20px;
        }

        /* Header styles */
        header {
            background: #50b3a2;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2.5rem;
            text-transform: uppercase;
        }

        header nav {
            margin-top: 10px;
        }

        header nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        header nav ul li {
            display: inline-block;
            margin-right: 20px;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        header nav ul li a:hover {
            color: #e8491d;
        }

        /* Main content styles */
        .dashboard {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .dashboard h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #50b3a2;
            color: #fff;
            text-transform: uppercase;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody tr:hover {
            background-color: #e0e0e0;
        }

        table img {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin: auto;
        }

        /* Button styles */
        .button {
            display: inline-block;
            padding: 8px 16px;
            font-size: 1rem;
            color: #fff;
            background-color: #50b3a2;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #45a089;
        }

        /* Footer styles */
        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
        }

        footer p {
            margin: 0;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            header h1 {
                font-size: 2rem;
            }

            header nav ul li {
                display: block;
                margin-bottom: 10px;
            }

            .dashboard {
                padding: 15px;
            }

            table img {
                max-width: 80px;
                max-height: 80px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Dashboard</h1>
            <nav>
                <ul>
                    <li><a href="dashboard.php">Home</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container dashboard">
        <h1>Image Database</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data Image</th>
                    <th>Waktu</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <?php $urlGambar = $row['image_data']; ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><img src=<?php echo $row['image_data']; ?> alt="Image"></td>
                        <td><?php echo $row['waktu']; ?></td>
                        <td>
                            <a href="update.php?id=<?php echo $row['id']; ?>" class="button">Update</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="button">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; 2024 Dashboard</p>
    </footer>
</body>
</html>

<?php $conn->close(); ?>
