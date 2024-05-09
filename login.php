<?php
require "check_login.php";

//make variable error_message
$error_message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $users = file("user_data.txt", FILE_IGNORE_NEW_LINES);

    // Loop through the file to find a match
    foreach ($users as $user) {
        list($saved_username, $saved_password) = explode(", ", $user);
        // If a match is found, redirect to homepage
        if ($username === $saved_username && $password === $saved_password) {
            $_SESSION['username'] = $username;
            header("Location: homepage.php");
            exit;
        }
    }
    // If no match is found, set an error message
    $error_message = "Invalid username or password."; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="register-login.css">
    <title>Login Page</title>
</head>
<body>
    <form action="login.php" method="post">
    <h2>Login</h2>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Login">
        <p class="error-message"><?php echo $error_message; ?></p>
        <p>Don't have an account? <a href="register.php">Register</a><p>
    </form>
    
</body>
</html>
