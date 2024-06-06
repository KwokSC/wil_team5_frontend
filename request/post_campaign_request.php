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
    $picture = $_POST['picture'];

    $conn = getDbConnection();

    $stmt = $conn->prepare("INSERT INTO campaign_info(campaign_id, topic, summary, picture) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $campaignId, $topic, $summary, $picture);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'User registered successfully']);
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