<?php
// Database connection settings
$host = 'localhost'; // Localhost for local development
$dbname = 'olympus_gym'; // Database name
$username = 'root'; // Database username for local
$password = ''; // Database password for local

// Uncomment the following lines to connect to a remote database
/*
$host = 'remote_host'; // Remote database host
$dbname = 'remote_dbname'; // Remote database name
$username = 'remote_username'; // Remote database username
$password = 'remote_password'; // Remote database password
*/

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>