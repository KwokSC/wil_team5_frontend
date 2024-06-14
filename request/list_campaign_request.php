<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $status = isset($_GET['status']) ? $_GET['status'] : null;

    if ($status === null || $status === '') {
        echo json_encode(['status' => 'error', 'message' => 'status should not be empty']);
        exit;
    }
    
    $conn = getDbConnection();

    $stmt = $conn->prepare("SELECT * FROM campaign_info WHERE status = ?");

    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare statement failed: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param("i", $status);
    $stmt->execute();
    $result = $stmt->get_result();

    $campaigns = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $campaigns[] = $row;
        }
    }

    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'campaigns' => $campaigns]);

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'error request']);
}
?>