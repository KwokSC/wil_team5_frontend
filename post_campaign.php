<!DOCTYPE html>
<html>
<head>
    <title>Post Campaign</title>
</head>
<body>

<a href="user_homepage.php">Back</a>

<h2>Post Campaign</h2>

    <form action="post_campaign.php" method="post" enctype="multipart/form-data">
    <label for="topic">Topic:</label><br>
    <input type="text" id="topic" name="topic" required><br><br>
    
    <label for="summary">Summary:</label><br>
    <input type="text" id="summary" name="summary" required><br><br>
    
    <label for="picture">Upload Picture:</label><br>
    <input type="file" id="picture" name="picture" accept="image/*" required><br><br>
    
    <input type="submit" value="Submit">
</form>

<script>
    document.getElementById('post-campaign-form').addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('post_campaign.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                window.location.href = 'user_homepage.php';
            } else {
                document.getElementById('message').innerText = data.message;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>

</body>
</html>
