<!DOCTYPE html>
<html>
<head>
    <title>Post Campaign</title>
</head>
<body>

<a href="user_homepage.php">Back</a>

<h2>Post Campaign</h2>

    <form action="post_campaign.php" method="post">
    <label for="topic">Topic:</label><br>
    <input type="text" id="topic" name="topic" required><br><br>
    
    <label for="summary">Summary:</label><br>
    <input type="text" id="summary" name="summary" required><br><br>
    
    <label for="picture">Upload Picture:</label><br>
    <input type="file" id="picture" name="picture" accept="image/*" required><br><br>
    
    <input type="submit" value="Submit">
</form>

<script>
    // TODO: Implement post campaign
</script>

</body>
</html>
