<?php

require_once '../../database/connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, role, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($userId, $username, $role, $hashedPassword);

    if ($stmt->fetch() && password_verify($password, $hashedPassword)) {
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        $stmt->close();

        $redirectUrl = ($role == 'admin') ? '../pages/dashboard.php' : '../pages/home.php';
        echo json_encode(['success' => true, 'redirectUrl' => $redirectUrl]);
        exit();
    } else {
        $stmt->close();
        echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
        exit();
    }
}

$conn->close();
