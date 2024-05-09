<?php
session_start();

// Destroy and unset all the session
session_unset();
session_destroy();

// Redirect to the homepage after 5 seconds
header("Refresh: 5; URL=homepage.php");

// Display message and exit
echo '<div class="text">';
echo '<p>You have logged out. If you are not redirected in 5 seconds, please click the button below.</p>';
echo '<a href="homepage.php">Go to Homepage</a>';
echo '</div>';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <link rel="stylesheet" type="text/css" href="logout.css">
</head>
</html>
<?php
exit;
?>