<?php
session_start();

// Destroy and unset all the session
session_unset();
session_destroy();

// Redirect to the homepage
header("Location: homepage.php");
exit;
?>
