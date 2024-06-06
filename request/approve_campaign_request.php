<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $campaignId = $_POST['campaignId'];

    if (empty($campaignId)) {
        echo json_encode(['status' => 'error', 'message' => 'campaign ID should not be empty']);
        exit;
    }

    $conn = getDbConnection();

    $stmt = $conn->prepare("UPDATE user_info SET status = 1 WHERE campaign_id = ?");

    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare statement failed: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param("s", $campaignId);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Approve campaign successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Fail to approve campaign: ' . $stmt->error]);
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'error request']);
}
?>