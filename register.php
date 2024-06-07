<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="register-login.css">
    <title>Registration Page</title>
</head>
<body>
<form id="register-form" action="register.php" method="post">
    <h2>Register</h2>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Register">
        <p class="error-message" id="message"></p>
        <p>Already own an account? <a href="login.php">Log in</a></p>
    </form>

    <script>
        document.getElementById('register-form').addEventListener('submit', function (event) {
            event.preventDefault();

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            const xhr = new XMLHttpRequest();

            // Call the request function file to send SQL to AWS database
            xhr.open("POST", "./request/register_request.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    const response = JSON.parse(xhr.responseText);
                    //check if register is successful
                    if(response.status === 'success'){
                        window.location.href = 'user_homepage.php';
                    //show error message
                    }else{
                        document.getElementById('message').innerText = response.message;
                    }
            };

            xhr.send(`username=${username}&password=${password}`);
        });
    </script>
    
</body>
</html>

