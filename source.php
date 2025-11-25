<?php
// Database configuration
$host = "localhost";      // or 127.0.0.1
$username = "root";       // change if your MySQL username is different
$password = "654321zaq@@!";           // enter your MySQL password here
$database = "account";    // name of your database

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Success message
// echo "Connected successfully";
?>
