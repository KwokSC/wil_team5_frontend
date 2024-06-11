<!DOCTYPE html>
<html>

<head>
    <title>Approved Campaign</title>
</head>

<body>

    <a href="admin_homepage.php">Back</a>

    <h1>Approved Campaign</h1>
    <!-- oh all the campaign that have status of approve -->
    <!-- give all the campaign that have status of approve -->
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
                                        <img src="${campaign.picture}" alt="${campaign.topic}">
                                        <button id="reconsider">Reconsider</button>`;

                        // Here to obtain the withdraw button element and add click listener
                        const reconsiderBtn = li.querySelector("#reconsider");
                        reconsiderBtn.addEventListener("click", function () {
                            fetch("./request/change_campaign_request.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/x-www-form-urlencoded"
                                },
                                body: new URLSearchParams({
                                    'campaignId': campaign.campaign_id,
                                    'status': -1
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