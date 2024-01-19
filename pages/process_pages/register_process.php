<?php
require_once '../../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Basic validation
    if (empty($username) || empty($password) || empty($email)) {
        echo "All fields are required!";
    } else {
        // Perform registration (You should add more security measures here)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashedPassword, $email);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error during registration.";
        }

        $stmt->close();
    }
}
?>
