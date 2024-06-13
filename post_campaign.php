<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // If user is logged in show username
    $username = $_SESSION['username'];
    echo '
    <nav class="nav nav-top">
        <ul class="nav-list">
            <li>Welcome, ' . $username . '!</li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>';
}else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Post Campaign</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>

    <header>
        <h2>Post Campaign</h2>
    </header>


    <form id="post-campaign-form" action="post_campaign.php" method="post" enctype="multipart/form-data">
        <label for="topic">Topic:</label>
        <input type="text" id="topic" name="topic" required><br>

        <label for="summary">Summary:</label>
        <textarea type="text" id="summary" name="summary" required></textarea><br>

        <label for="picture">Upload Picture:</label>
        <input type="file" id="picture" name="picture" accept="image/*" required><br>

        <button type="submit">Submit</button>
    </form>

    <script>
        document.getElementById('post-campaign-form').addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('./request/post_campaign_request.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        window.location.href = 'user_homepage.php';
                    } else {
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