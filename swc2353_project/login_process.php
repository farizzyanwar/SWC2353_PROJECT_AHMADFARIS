<?php
session_start();

// Debugging: Log POST data
error_log(print_r($_POST, true)); // This will log the POST data to the PHP error log

// Database connection settings
$host = 'localhost';
$dbname = 'olympus_gym';
$username = 'root';
$password = '';

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and password are set
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Your existing code...
    } else {
        echo "Email and password are required.";
    }
}

// Close the database connection
$conn->close();
?>