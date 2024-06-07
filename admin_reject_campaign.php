<!DOCTYPE html>
<html>
<head>
    <title>Rejected Campaign</title>
</head>
<body>

<a href="admin_homepage.php">Back</a>

<!-- give all the campaign that have status of reject -->
<h1>Rejected Campaign</h1>
<ul>
    <?php foreach ($campaigns as $campaign): ?>
        <li>
            <h2><?php echo $campaign['topic']; ?></h2>
            <p><?php echo $campaign['summary']; ?></p>
            <img src="<?php echo $campaign['picture']; ?>" alt="<?php echo $campaign['topic']; ?>">
            <!-- Button for Redecide-->
            <form action="update_status.php" method="POST">
                <input type="hidden" name="campaign_id" value="<?php echo $campaign['id']; ?>">
                <input type="hidden" name="new_status" value="1">
                <button type="submit">Reconsider</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>