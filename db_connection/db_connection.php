<?php
// Database connection details
$servername = "localhost"; // Replace with your actual database servername
$username = "root";     // Replace with your actual database username
$password = "";     // Replace with your actual database password
$dbname = "db_intern";           // Replace with your actual database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
