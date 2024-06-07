<!DOCTYPE html>
<html>
<head>
    <title>All Post Campaign</title>
</head>
<body>

<a href="admin_homepage.php">Back</a>

<!-- give all the campaign that have status of unset -->
<h1>Campaign That Need to Be Approved</h1>
<ul>
    <?php foreach ($campaigns as $campaign): ?>
        <li>
            <h2><?php echo $campaign['topic']; ?></h2>
            <p><?php echo $campaign['summary']; ?></p>
            <img src="<?php echo $campaign['picture']; ?>" alt="<?php echo $campaign['topic']; ?>">
            <!-- Button for Approve-->
            <form action="update_status.php" method="POST">
                <input type="hidden" name="campaign_id" value="<?php echo $campaign['id']; ?>">
                <input type="hidden" name="new_status" value="1">
                <button type="submit">Approve</button>
            </form>
            <!-- Button for reject -->
            <form action="update_status.php" method="POST">
                <input type="hidden" name="campaign_id" value="<?php echo $campaign['id']; ?>">
                <input type="hidden" name="new_status" value="2">
                <button type="submit">Reject/button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>