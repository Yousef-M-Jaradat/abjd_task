<?php
require_once '../../database/connection.php';

$result = $conn->query("SELECT * FROM users");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                <td>{$row['password']}</td>
                <td><button onclick=\"updateUser({$row['id']})\">Update</button></td>
                <td><button onclick=\"deleteUser({$row['id']})\">Delete</button><td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No users found</td></tr>";
}

$conn->close();
