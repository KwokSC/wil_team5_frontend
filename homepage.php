<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // If user is logged in show username
    $username = $_SESSION['username'];
    echo '
    <nav class="nav nav-top">
        <ul class="nav-list">
            <li><a href="user_homepage.php">Dashboard</a></li>
            <li>Welcome, ' . $username . '!</li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>';
} else {
    // If user is not logged in show login and register button
    echo '
    <nav class="nav nav-top">
        <ul class="nav-list">
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
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
        <h1>Campaign</h1>
    </header>
    <ul>
    <?php foreach ($campaigns as $campaign): ?>
        <li>
            <h2><?php echo $campaign['topic']; ?></h2>
            <p><?php echo $campaign['summary']; ?></p>
            <img src="<?php echo $campaign['picture']; ?>" alt="<?php echo $campaign['topic']; ?>">
        </li>
    <?php endforeach; ?>
</ul>

</body>
<footer>
        <nav class="nav"></nav>
    </footer>
</html>
