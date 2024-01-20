<?php

require_once '../../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $email = $_POST['email'];
    $role = 'customer';

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit();
    }

    // Check if username is unique
    $checkUsernameStmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $checkUsernameStmt->bind_param("s", $username);
    $checkUsernameStmt->execute();
    $checkUsernameStmt->bind_result($usernameCount);
    $checkUsernameStmt->fetch();
    $checkUsernameStmt->close();

    if ($usernameCount > 0) {
        echo "Username is already taken!";
        exit();
    }

    // Check if email is unique
    $checkEmailStmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailStmt->bind_result($emailCount);
    $checkEmailStmt->fetch();
    $checkEmailStmt->close();

    if ($emailCount > 0) {
        echo "Email is already registered!";
        exit();
    }

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "Passwords do not match!";
        exit();
    }

    // Proceed with user registration
    if (empty($username) || empty($password) || empty($email)) {
        echo "All fields are required!";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $hashedPassword, $email, $role);

        if ($stmt->execute()) {
            // Registration successful
            echo "success";
        } else {
            echo "Error during registration.";
        }

        $stmt->close();
    }
}

$conn->close();
?>
