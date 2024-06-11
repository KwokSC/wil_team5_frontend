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
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
    <header>
        <h1>Welcome</h1>
    </header>
    <div class="button-container">
        <a href="post_campaign.php">Post Campaign</a>
        <a href="index.php">See All Campaigns</a>
    </div>
</body>
</html>