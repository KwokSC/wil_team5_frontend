<?php
require"check_login.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //get info
    $username = $_POST["username"];
    $password = $_POST["password"];

    //save in (a,b) format
    $data = "$username, $password\n";

    //put in user_data.txt
    file_put_contents("user_data.txt", $data, FILE_APPEND);

    //save username in a variable
    $_SESSION['username'] = $username;
    header("Location: homepage.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Register">
    </form>
    <a href="login.html">
        <button>Log in</button>
    </a>
</body>
</html>

