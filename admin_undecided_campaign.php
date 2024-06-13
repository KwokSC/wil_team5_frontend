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
            <li><a href="admin_homepage.php">Back</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>';
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>All Post Campaign</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>

    <!-- give all the campaign that have status of unset -->
    <header>
        <h1>Campaign Waitlist</h1>
    </header>

    <ul id="campaign-list">
    </ul>

    <script>
        // This is the script for loading all approved campaigns and add button click listener.
        document.addEventListener("DOMContentLoaded", function () {
            // send GET request to obtain all approved campaigns
            fetch("./request/list_campaign_request.php?status=-1", {
                method: 'GET'
            })
                .then(response => response.json())
                .then(data => {
                    const campaignList = document.getElementById("campaign-list");
                    const campaigns = data.campaigns;
                    // After obtain the result, create <li> elements and add them to the <ul>
                    campaigns.forEach(campaign => {
                        const li = document.createElement("li");
                        li.innerHTML = `<div class="text">
                                        <p>ID: ${campaign.campaign_id}</p>
                                        <h2>${campaign.topic}</h2>
                                        <p>${campaign.summary}</p>
                                        </div>
                                        <img src="${campaign.picture}" alt="${campaign.topic}">
                                        <div class="button-container">
                                        <button id="approve">Approve</button>
                                        <button id="reject">Reject</button>
                                        </div>`;

                        // Here to obtain the approve button element and add click listener
                        const approveBtn = li.querySelector("#approve");
                        approveBtn.addEventListener("click", function () {
                            fetch("./request/change_campaign_request.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/x-www-form-urlencoded"
                                },
                                body: new URLSearchParams({
                                    'campaignId': campaign.campaign_id,
                                    'status': 1
                                })
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'success') {
                                        alert("Approve the campaign " + campaign.campaign_id + " successfully.");
                                        location.reload();
                                    } else {
                                        alert("Failed to update status: " + data.message);
                                    }
                                })
                                .catch(error => {
                                    console.error("Error:", error);
                                });
                        });

                        // Here to obtain the reject button element and add click listener
                        const rejectBtn = li.querySelector("#reject");
                        rejectBtn.addEventListener("click", function () {
                            fetch("./request/change_campaign_request.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/x-www-form-urlencoded"
                                },
                                body: new URLSearchParams({
                                    'campaignId': campaign.campaign_id,
                                    'status': 0
                                })
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'success') {
                                        alert("reject the campaign " + campaign.campaign_id + " successfully.");
                                    } else {
                                        alert("Failed to update status: " + data.message);
                                    }
                                })
                                .catch(error => {
                                    console.error("Error:", error);
                                });
                        });

                        campaignList.appendChild(li);
                    });
                })
                .catch(error => console.error("Error fetching data:", error));
        });
    </script>
</body>

</html>