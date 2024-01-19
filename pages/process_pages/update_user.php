<?php
require_once '../../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'];
    $updatedUsername = $_POST['updatedUsername'];
    $updatedPassword = $_POST['updatedPassword'];
    $updatedEmail = $_POST['updatedEmail'];

    // Simple validation
    if (empty($updatedUsername) || empty($updatedEmail)) {
        echo "Both updated username and email are required!";
    } else {
        // Perform user update
        if (!empty($updatedPassword)) {
            // If a new password is provided, update both username, email, and password
            $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
            $hashedPassword = password_hash($updatedPassword, PASSWORD_DEFAULT);
            $stmt->bind_param("sssi", $updatedUsername, $updatedEmail, $hashedPassword, $userId);
        } else {
            // If no new password is provided, update only username and email
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
