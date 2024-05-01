<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // If user is logged in show username
    $username = $_SESSION['username'];
    echo "Welcome, $username! <br>";
    echo '<a href="logout.php">Logout</a>';
} else {
    // If user is not logged in show login and register button
    echo '<a href="login.php">Login</a> | <a href="register.php">Register</a>';
}
?>
