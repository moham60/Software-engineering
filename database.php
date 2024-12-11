<?php
// Database configuration
$servername = "localhost"; // Change if your database server is on a different host
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$dbname = "Scheduling_Project";  // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>