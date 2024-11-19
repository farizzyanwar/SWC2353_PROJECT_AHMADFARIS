<?php
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection settings
$host = 'localhost';
$dbname = 'olympus_gym';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userId, $hashedPassword);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Credentials are correct, set session variables
            $_SESSION['user_id'] = $userId;
            $_SESSION['email'] = $email;

            // Set a success message
            $_SESSION['success_message'] = "You are now logged in!";

            // Redirect to a protected page (e.g., dashboard)
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Olympus Gym</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="section__container">
        <h1>Login to Olympus Gym</h1>
        <form action="" method="POST" class=" login__form">
            <div class="form__group">
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form__group">
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>
            <div class="form__group">
                <button type="submit" class="btn">Log In</button>
            </div>
        </form>
        <p class="redirect">Don't have an account? <a href="signup.html">Sign up here</a>.</p>
        <div class="form__group">
            <button onclick="window.history.back();" class="btn go-back-btn">Go Back</button>
        </div>
    </div>
</body>
</html>