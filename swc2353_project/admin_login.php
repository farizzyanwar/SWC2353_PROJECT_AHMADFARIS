<?php
session_start();
include 'db_connect.php'; // Include your database connection

$error_message = ""; // Initialize error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT id, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if the admin exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($adminId, $storedPassword);
        $stmt->fetch();

        // Verify the password (compare plain text)
        if ($password === $storedPassword) {
            // Credentials are correct, set session variables
            $_SESSION['admin_id'] = $adminId;
            $_SESSION['username'] = $username;

            // Redirect to the admin dashboard
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "Invalid username or password.";
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
    <title>Admin Login - Olympus Strength Gym</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="section__container">
    <h1>Admin Login</h1>
    <form action="" method="POST">
        <div class="form__group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        
        <div class="form__group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <button type="submit" class="btn">Log In</button>
    </form>
    
    <?php if (!empty($error_message)): ?>
        <p class="error-message" style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
</div>
</body>
</html>