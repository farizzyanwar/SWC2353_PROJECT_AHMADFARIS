<?php
// Check if session is already started
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session if not already started
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Olympus Gym</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>

<header class="header">
    <div class="nav__header">
        <div class="nav__logo">
            <a href="index.html"><img src="assets/logo.png" alt="logo" width="150" height="154" />OLYMPUS STRENGTH GYM</a>
        </div>
        <ul class="nav__links">
            <li class="link"><a href="index.html">Home</a></li>
            <li class="link"><a href="about.html">About</a></li>
            <li class="link"><a href="classes.html">Classes</a></li>
            <li class="link"><a href="trainers.html">Trainers</a></li>
            <li class="link"><a href="pricing.html">Pricing</a></li>
            <li class="link"><a href="contact.html">Contact Us</a></li>
        </ul>
    </div>
</header>

<div class="section__container dashboard-container">
    <h1>Welcome to Your Dashboard!</h1>
    <p class="welcome-message">
        Hello, <?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Guest'; ?>! You are now logged in.
    </p>
<br>
    <div class="dashboard-buttons">
        <button class="btn" onclick="window.location.href='classes.html'">View Classes</button>
        <button class="btn" onclick="window.location.href='pricing.html'">Membership Plans</button>
        <button class="btn" onclick="window.location.href='contact.html'">Contact Us</button>
        <button class="btn" onclick="window.location.href='logout.php'">Log Out</button>
        <button class="btn" onclick="window.location.href='index.html'">Home</button>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
  <div class="section__container footer__container">
    <div class="footer__col">
      <div class="footer__logo">
        <p><a href="index.html"><img src="assets/logo.png" alt="logo" width="92" height="90"> OLYMPUS</a></p>
      </div>
      <br>
      <p>Become the best version of yourself with Olympus Strength Gym. Join us today and experience fitness like never before.</p>
      <div class="footer__socials">
        <a href="#"><i class="ri-facebook-fill"></i></a>
        <a href="#"><i class="ri-instagram-line"></i></a>
        <a href="#"><i class="ri-twitter-fill"></i></a>
      </div>
    </div>
    <div class="footer__col">
      <h4>Quick Links</h4>
      <br>
      <ul>
        <li><a href="about.html">About Us</a></li>
        <li><a href="classes.html">Classes</a></li>
        <li><a href="trainers.html">Trainers</a></li>
        <li><a href="pricing.html">Pricing</a></li>
      </ul>
    </div>
    <div class="footer__col">
      <h4>Contact Us</h4>
      <br>
      <p>123 Fitness Street, Muscle City, CA 45678</p>
      <p>Email: info@olympusgym.com</p>
      <p>Phone: +1 (234) 567-8901</p>
    </div>
  </div>
  <div class="footer__bar" style="text-align: center;"> <!-- Centering the button in the footer bar -->
  <p>&copy; 2023 Olympus Strength Gym. All rights reserved.</p>
  </div>
</footer>

</body>
</html>