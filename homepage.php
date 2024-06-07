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
    <ul id="campaign-list">

    </ul>

    <script>
        // This is the script for loading all approved campaigns and add button click listener.
        document.addEventListener("DOMContentLoaded", function () {
            // send GET request to obtain all approved campaigns
            fetch("./request/list_campaign_request.php?status=1", {
                method: 'GET'
            })
                .then(response => response.json())
                .then(data => {
                    const campaignList = document.getElementById("campaign-list");
                    const campaigns = data.campaigns;
                    // After obtain the result, create <li> elements and add them to the <ul>
                    campaigns.forEach(campaign => {
                        const li = document.createElement("li");
                        li.innerHTML = `<h2>${campaign.campaign_id}</h2>
                                        <h2>${campaign.topic}</h2>
                                        <p>${campaign.summary}</p>
                                        <img src="${campaign.picture}" alt="${campaign.topic}">`;
                        campaignList.appendChild(li);
                    });
                })
                .catch(error => console.error("Error fetching data:", error));
        });
    </script>

</body>
<footer>
    <nav class="nav"></nav>
</footer>

</html>