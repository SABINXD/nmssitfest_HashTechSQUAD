<?php
// Database configuration
$host = "localhost";
$user = "root";
$pass = "";
$db = "login_system"; // Change this to your desired database name

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Failed to connect to database: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8");
?>