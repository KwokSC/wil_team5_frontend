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
    <link rel="stylesheet" type="text/css" href="homepage.css">
</head>
<body>
    <header>
        <h1>Welcome</h1>
    </header>
    <div class="button-container">
        <a href="admin_undecided_campaign.php">see campaign that needed approve</a>
        <a href="admin_approve_campaign.php">see campaign that have been approved</a>
        <a href="admin_reject_campaign.php">see campaign that have not been approved</a>
    </div>
</body>
</html>