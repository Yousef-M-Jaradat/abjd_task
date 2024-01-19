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
        if ($role == 'admin') {
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $stmt->close();
            echo '<script>window.location.href="../pages/dashboard.php";</script>';
            exit();
        } else {
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'user';
            $stmt->close();
            echo '<script>window.location.href="../pages/home.php";</script>';
            exit();
        }
    } else {
        $stmt->close();
        echo '<script>window.location.href="../pages/login.html";</script>';
        exit();
    }
}

$conn->close();
