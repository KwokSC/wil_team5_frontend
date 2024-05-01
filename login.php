<?php
require"check_login.php";

    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $users = file("user_data.txt", FILE_IGNORE_NEW_LINES);

    //loop through the file to find match
    foreach ($users as $user) {
        list($saved_username, $saved_password) = explode(", ", $user);
        //if find go to homepage
        if ($username === $saved_username && $password === $saved_password) {
            $_SESSION['username'] = $username;
            header("Location: homepage.php");
            exit;
        }
    }
    echo "Invalid username or password."; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
    <a href="register.html">
        <button>Register</button>
    </a>
</body>
</html>
