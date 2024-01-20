<?php
require_once '../../database/connection.php';

$result = $conn->query("SELECT * FROM users");

if ($result->num_rows > 0) {
    $number = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$number}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                <td>{$row['password']}</td>
                <td>{$row['role']}</td>
                <td><button class='btn btn-success' onclick=\"updateUser({$row['id']})\">Update</button></td>
                <td><button class='btn btn-danger' onclick=\"deleteUser({$row['id']})\">Delete</button><td>
            </tr>";
        $number++;
    }
} else {
    echo "<tr><td colspan='4'>No users found</td></tr>";
}

$conn->close();
