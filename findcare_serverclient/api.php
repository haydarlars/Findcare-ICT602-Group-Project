<?php

require_once('db.php'); // Ensure db.php properly connects to your database

// Debugging - Log received POST data
file_put_contents("debug_log.txt", date("Y-m-d H:i:s") . " - Received: " . print_r($_POST, true) . "\n", FILE_APPEND);

// Validate request
if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['comments']) || !isset($_POST['location'])) {
    die("Error: Incomplete HTTP request");
}

// Sanitize inputs
$POSTV = filter_input_array(INPUT_POST, [
    'name' => FILTER_SANITIZE_STRING,
    'email' => FILTER_SANITIZE_EMAIL,
    'comments' => FILTER_SANITIZE_STRING,
    'location' => FILTER_SANITIZE_STRING
]);

$name = $POSTV['name'];
$email = $POSTV['email'];
$comments = $POSTV['comments'];
$location = $POSTV['location']; // Ensure this field exists in your database

$addr = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'];
$date = date("Y-m-d H:i:s"); // Current timestamp

// Validate input length
if (strlen($name) < 3 || strlen($comments) < 5) {
    die("Error: Please fill in the form correctly");
}

// Database Connection Check
if (!$link) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Prepare SQL statement
$query = "INSERT INTO comments (name, email, ip_address, date, user_agent, comments, location)
          VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, "sssssss", $name, $email, $addr, $date, $agent, $comments, $location);

// Execute query
if (mysqli_stmt_execute($stmt)) {
    echo "Comments posted successfully";
} else {
    echo "Database Error: " . mysqli_error($link);
    file_put_contents("debug_log.txt", "Database Error: " . mysqli_error($link) . "\n", FILE_APPEND);
}

mysqli_stmt_close($stmt);
mysqli_close($link);

?>
