<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="register-login.css">
    <title>Login Page</title>
</head>

<body>
    <form id="login-form" action="login.php" method="post">
        <h2>Login</h2>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Login">
        <p class="error-message" id="message"></p>
        <!-- <p id="level"> -->
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </form>
    <script>
        document.getElementById('login-form').addEventListener('submit', function (event) {
            event.preventDefault();

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            const xhr = new XMLHttpRequest();

            // Call the request function file to send SQL to AWS database
            xhr.open("POST", "./request/login_request.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    const response = JSON.parse(xhr.responseText);
                    //check level of user when login credential is recognised
                    if(response.status === 'success'){
                        if(response.level === 'Normal user') {
                            window.location.href = 'user_homepage.php';
                        }
                        else if (response.level === 'Administrator'){
                            window.location.href = 'admin_homepage.php';
                        }
                    }
                    //show error message
                    else{
                        document.getElementById('message').innerText = response.message;
                    }
                    // document.getElementById('level').innerText = "The user level is: " + response.level;
                }
            };

            xhr.send(`username=${username}&password=${password}`);
        });
    </script>
</body>

</html>