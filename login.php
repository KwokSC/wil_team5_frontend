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
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </form>
    <script>
        document.getElementById('login-form').addEventListener('submit', function (event) {
            event.preventDefault();

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            fetch('./request/login_request.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'username': username,
                    'password': password
                })
            })
                .then(response => response.json())
                .then(data => {
                    // Check if login is successful
                    if (data.status === 'success') {
                        if (data.level === 'Normal user') {
                            window.location.href = 'user_homepage.php';
                        } else if (data.level === 'Administrator') {
                            window.location.href = 'admin_homepage.php';
                        }
                    } else {
                        // Show error message
                        document.getElementById('message').innerText = data.message;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

    </script>
</body>

</html>