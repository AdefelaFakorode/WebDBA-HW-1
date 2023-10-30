<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "mbb";

// Create a connection to the MySQL database using MySQLi
$conn = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
