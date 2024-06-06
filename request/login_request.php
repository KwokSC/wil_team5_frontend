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

    $stmt = $conn->prepare("SELECT password, level FROM user_info WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($stored_password, $stored_level);
        $stmt->fetch();

        if ($stored_level == 0) {
            $user_type = 'Normal user';
        } elseif ($stored_level == 1) {
            $user_type = 'Administrator';
        } else {
            $user_type = 'Unknown';
        }

        // Verify password
        if ($password === $stored_password) {
            echo json_encode(['status' => 'success', 'message' => 'login successfully', 'level' => $user_type]);
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