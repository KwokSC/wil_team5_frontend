<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'username and password should not be empty']);
        exit;
    }

    $conn = getDbConnection();

    $stmt = $conn->prepare("INSERT INTO user_info(username, password) VALUES (?, ?, ?)");
    $stmt->bind_param("ss", $username, $password);

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