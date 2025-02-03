<?php
session_start();
require_once('db.php'); // Ensure this connects to your database

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Fetch user data from the database
$query = "SELECT * FROM user_data ORDER BY createdAt DESC";
$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ECF0F1;
            color: #2C3E50;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #2C3E50;
            padding: 15px;
            text-align: center;
            color: white;
        }
        .header a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
            font-size: 18px;
        }
        .header a:hover {
            text-decoration: underline;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #BDC3C7;
        }
        th {
            background-color: #2980B9;
            color: white;
        }
        td {
            background-color: #ECF0F1;
            color: #2C3E50;
        }
        tr:nth-child(even) td {
            background-color: #F9F9F9;
        }
        tr:hover {
            background-color: #D5D8DC;
        }
        .footer {
            background-color: #2C3E50;
            color: white;
            text-align: center;
            padding: 10pd;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>

    <div class="header">
        <a href="view.php">User Information</a>
        <a href="clinic.php">Clinic Information</a>
        <a href="aboutus.php">About Us</a>
        <a href="logout.php">Logout</a>
    </div>

    <h1 style="text-align:center; padding-top: 20px;">User Information</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
                <th>Time</th>
                <th>Location</th>
                <th>User Agent</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><a href="mailto:<?= htmlspecialchars($row['email']) ?>"><?= htmlspecialchars($row['email']) ?></a></td>
                <td><?= htmlspecialchars($row['date']) ?></td>
                <td><?= htmlspecialchars($row['time']) ?></td>
                <td><?= htmlspecialchars($row['location']) ?></td>
                <td><?= htmlspecialchars($row['userAgent']) ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="footer">
        <p>&copy; 2025 FindCare. All rights reserved.</p>
    </div>

</body>
</html>
