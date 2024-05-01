<?php
session_start();
// Check if the user is logged in
if (isset($_SESSION['username'])) {
    //if yes redirect to homepage
    header("Location: homepage.php");
}
?>