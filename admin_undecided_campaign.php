<!DOCTYPE html>
<html>

<head>
    <title>All Post Campaign</title>
</head>

<body>

    <a href="admin_homepage.php">Back</a>

    <!-- give all the campaign that have status of unset -->
    <h1>Campaign That Need to Be Approved</h1>
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
                        li.innerHTML = `<h2>${campaign.campaign_id}</h2>
                                        <h2>${campaign.topic}</h2>
                                        <p>${campaign.summary}</p>
                                        <img src="${campaign.picture}" alt="${campaign.topic}">
                                        <button id="approve">Approve</button>
                                        <button id="reject">Reject</button>`;

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