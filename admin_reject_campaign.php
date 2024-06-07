<!DOCTYPE html>
<html>

<head>
    <title>Rejected Campaign</title>
</head>

<body>

    <a href="admin_homepage.php">Back</a>

    <!-- give all the campaign that have status of reject -->
    <h1>Rejected Campaign</h1>
    <ul id="campaign-list">
    </ul>

    <script>
        // This is the script for loading all rejected campaigns and add button click listener.
        document.addEventListener("DOMContentLoaded", function () {
            // send GET request to obtain all approved campaigns
            fetch("./request/list_campaign_request.php?status=0", {
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
                                        <img src="${campaign.picture}" alt="${campaign.topic}">
                                        <button id="reject">Reject</button>`;

                        // Here to obtain the withdraw button element and add click listener
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
                                        alert("Reject the campaign " + campaign.campaign_id + " successfully.");
                                        location.reload();
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