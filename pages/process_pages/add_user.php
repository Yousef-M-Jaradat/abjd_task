<?php
require_once '../../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];
    $newEmail = $_POST['newEmail'];

    if (empty($newUsername) || empty($newPassword) || empty($newEmail)) {
        echo "All fields are required!";
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $newUsername, $hashedPassword, $newEmail);

        if ($stmt->execute()) {
            echo "User added successfully!";
        } else {
            echo "Error adding user.";
        }

        $stmt->close();
    }
}
$conn->close();

