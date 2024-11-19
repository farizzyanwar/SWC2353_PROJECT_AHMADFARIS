<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error reporting

session_start();
include 'db_connect.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (name, email, phone, plan, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $plan, $hashedPassword);

    // Sanitize the form input
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $plan = trim($_POST['plan']);
    $password = trim($_POST['password']); // Get the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Redirect to the success page after successful sign-up
        header("Location: success.php");
        exit();
    } else {
        // Log the error instead of displaying it
        error_log("SQL Error: " . $stmt->error);
        echo "There was an error processing your request. Please try again.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>