<?php
require_once '../../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];
    $newEmail = $_POST['newEmail'];
    $newRole = $_POST['newRole'];

    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit();
    }

    $checkUsernameStmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $checkUsernameStmt->bind_param("s", $newUsername);
    $checkUsernameStmt->execute();
    $checkUsernameStmt->bind_result($usernameCount);
    $checkUsernameStmt->fetch();
    $checkUsernameStmt->close();

    if ($usernameCount > 0) {
        echo "Username is already taken!";
        exit();
    }

    $checkEmailStmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $checkEmailStmt->bind_param("s", $newEmail);
    $checkEmailStmt->execute();
    $checkEmailStmt->bind_result($emailCount);
    $checkEmailStmt->fetch();
    $checkEmailStmt->close();

    if ($emailCount > 0) {
        echo "Email is already registered!";
        exit();
    }

    if (empty($newUsername) || empty($newPassword) || empty($newEmail) || empty($newRole)) {
        echo "Username, Password, Email, and Role are required!";
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $insertStmt = $conn->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
        $insertStmt->bind_param("ssss", $newUsername, $hashedPassword, $newEmail, $newRole);

        if ($insertStmt->execute()) {
            echo "User added successfully!";

            if ($newRole === 'admin') {
                echo "Admin user created!";
            } else {
                echo "Customer user created!";
            }
        } else {
            echo "Error adding user.";
        }

        $insertStmt->close();
    }
}

$conn->close();
