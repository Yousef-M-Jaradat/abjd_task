<?php
require_once '../../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'];

    $stmt = $conn->prepare("SELECT id, username, email ,password FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($id, $username, $email, $password);

    $user = array();

    if ($stmt->fetch()) {
        $user['id'] = $id;
        $user['username'] = $username;
        $user['email'] = $email;
        $user['password'] = $password;
    }

    echo json_encode($user);

    $stmt->close();
}

$conn->close();
