<?php
require_once '../../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'];
    $updatedUsername = $_POST['updatedUsername'];
    $updatedPassword = $_POST['updatedPassword'];
    $updatedEmail = $_POST['updatedEmail'];

    if (empty($updatedUsername) || empty($updatedEmail)) {
        echo "Both updated username and email are required!";
    } else {
        if (!empty($updatedPassword)) {
            $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
            $hashedPassword = password_hash($updatedPassword, PASSWORD_DEFAULT);
            $stmt->bind_param("sssi", $updatedUsername, $updatedEmail, $hashedPassword, $userId);
        } else {
            $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
            $stmt->bind_param("ssi", $updatedUsername, $updatedEmail, $userId);
        }

        if ($stmt->execute()) {
            echo "User updated successfully!";
        } else {
            echo "Error updating user.";
        }

        $stmt->close();
    }
}

$conn->close();
