<?php
// Establish a connection to the database
$link = mysqli_connect("localhost", "root", "", "findcare_db");

// Check if the connection was successful
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
