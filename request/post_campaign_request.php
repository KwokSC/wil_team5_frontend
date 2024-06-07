<?php
include '../config.php';

function generateUuid() {
    $bytes = random_bytes(16);
    $uuid = bin2hex($bytes);
    return substr($uuid, 0, 6);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $campaignId = generateUuid();
    $topic = $_POST['topic'];
    $summary = $_POST['summary'];
    $file_name = $_FILES['picture']['name'];
    $file_tmp = $_FILES['picture']['tmp_name'];
    $upload_dir = 'image/';
    $file_location = $upload_dir . $file_name;
    move_uploaded_file($file_tmp, $file_location);

    $conn = getDbConnection();

    $stmt = $conn->prepare("INSERT INTO campaign_info(campaign_id, topic, summary, picture) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $campaignId, $topic, $summary, $file_location);

    if ($stmt->execute()) {
        header("Refresh: 1; URL=user_homepage.php");
        echo json_encode(['status' => 'success', 'message' => 'Post successfully']);
        
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User registration failed: ' . $stmt->error]);
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'error request']);
}
?>