<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $campaignId = $_POST['campaignId'];
    $status = $_POST['status'];

    if (empty($campaignId)) {
        echo json_encode(['status' => 'error', 'message' => 'campaign ID should not be empty']);
        exit;
    }

    $conn = getDbConnection();

    $stmt = $conn->prepare("UPDATE campaign_info SET status = ? WHERE campaign_id = ?");

    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare statement failed: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param("is", $status, $campaignId);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Change campaign status successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Fail to change campaign status: ' . $stmt->error]);
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'error request']);
}
?>