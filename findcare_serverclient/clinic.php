<?php
session_start();
require_once('db.php'); // Ensure this connects to your database

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Handle form submission to add new clinic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $longitude = filter_input(INPUT_POST, 'longitude', FILTER_SANITIZE_STRING);
    $latitude = filter_input(INPUT_POST, 'latitude', FILTER_SANITIZE_STRING);

    if (!empty($name) && !empty($longitude) && !empty($latitude)) {
        $query = "INSERT INTO clinics (name, longitude, latitude) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "sss", $name, $longitude, $latitude);

        if (mysqli_stmt_execute($stmt)) {
            $successMessage = "Clinic added successfully!";
        } else {
            $errorMessage = "Error: " . mysqli_error($link);
        }

        mysqli_stmt_close($stmt);
    } else {
        $errorMessage = "Please fill in all fields!";
    }
}

// Fetch clinics from the database
$query = "SELECT * FROM locations ORDER BY id DESC";
$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic List</title>
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
        .container {
            width: 80%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
        tr:nth-child(even) {
            background-color: #F9F9F9;
        }
        .form-container {
            margin-top: 20px;
            padding: 15px;
            background: #f4f4f4;
            border-radius: 5px;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #BDC3C7;
            border-radius: 5px;
        }
        input[type="submit"] {
            background: #2980B9;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #1F618D;
        }
        .message {
            padding: 10px;
            text-align: center;
            color: white;
            margin-top: 10px;
            border-radius: 5px;
        }
        .success { background-color: #27AE60; }
        .error { background-color: #E74C3C; }
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

    <div class="container">
        <h1 style="text-align:center;">Clinic Information</h1>

        <?php if (isset($successMessage)) echo "<div class='message success'>$successMessage</div>"; ?>
        <?php if (isset($errorMessage)) echo "<div class='message error'>$errorMessage</div>"; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Clinic Name</th>
                    <th>Longitude</th>
                    <th>Latitude</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['longitude']) ?></td>
                    <td><?= htmlspecialchars($row['latitude']) ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <h2 style="text-align:center;">Add New Clinic</h2>
        <div class="form-container">
            <form action="clinic.php" method="post">
                <input type="text" name="name" placeholder="Clinic Name" required>
                <input type="text" name="longitude" placeholder="Longitude" required>
                <input type="text" name="latitude" placeholder="Latitude" required>
                <input type="submit" value="Add Clinic">
            </form>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2025 FindCare. All rights reserved.</p>
    </div>

</body>
</html>
