<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hardcoded username and password
    $username = "admin";
    $password = "1234";

    // Get the input values
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Check if the input username and password match the hardcoded ones
    if ($inputUsername == $username && $inputPassword == $password) {
        // Store the username in the session and redirect to the view page
        $_SESSION['admin_logged_in'] = true;
        header("Location: view.php");
        exit;
    } else {
        // Invalid login message
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #34495E;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .logo {
            width: 150px; /* Increased logo size */
            height: auto;
            margin-bottom: 20px;
        }
        h2 {
            color: white;
            font-size: 26px; /* Slightly bigger heading */
            margin-bottom: 20px;
        }
        form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            text-align: left;
            color: #2C3E50;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #BDC3C7;
            border-radius: 5px;
            background-color: #ECF0F1;
            color: #2C3E50;
            font-size: 14px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #2980B9;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #1A5276;
        }
        .error {
            color: #E74C3C;
            font-size: 14px;
            margin-bottom: 15px;
        }
       
    </style>
</head>
<body>
    <img src="logo.png" alt="FindCare Logo" class="logo"> <!-- Bigger logo -->
    <h2>Welcome to FindCare Administration</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Login">
    </form>

   
</body>
</html>
