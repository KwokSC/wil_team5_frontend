<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $campaignId = $_GET['campaignId'];

    if (empty($campaignId)) {
        echo json_encode(['status' => 'error', 'message' => 'campaignId should not be empty']);
        exit;
    }

    $conn = getDbConnection();

    $stmt = $conn->prepare("SELECT * FROM campaign_info WHERE campaign_id = ?");

    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare statement failed: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param("s", $campaignId);
    $stmt->execute();
    $result = $stmt->get_result();

    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'campaign' => $result]);

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'error request']);
}
?>