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

    $stmt = $conn->prepare("SELECT password FROM user_info WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($stored_password);
        $stmt->fetch();

        // Verify password
        if ($password === $stored_password) {
            echo json_encode(['status' => 'success', 'message' => 'login successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'wrong password']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'user not existed']);
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'error request']);
}
?>