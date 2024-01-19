<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

// Check if the user has the 'admin' role
if ($_SESSION['role'] !== 'admin') {
    echo "Access denied. Only administrators are allowed to access this page.";
    exit();
}

// If the user is logged in and has the 'admin' role, continue to render the dashboard
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src=""></script>
</head>

<body>

    <h1>Welcome to the Dashboard, Admin!</h1>

    <table id="userTable" border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- User data will be displayed here -->
        </tbody>
    </table>

    <br>

    <form id="addUserForm">
        <label for="newUsername">New Username:</label>
        <input type="text" id="newUsername" name="newUsername" required>
        <br>

        <label for="newPassword">New Password:</label>
        <input type="password" id="newPassword" name="newPassword" required>
        <br>

        <label for="newEmail">New Email:</label>
        <input type="email" id="newEmail" name="newEmail" required>
        <br>

        <button type="button" onclick="addUser()">Add User</button>
    </form>

    <form id="updateUserForm" style="display:none;">
        <input type="hidden" id="userIdToUpdate" name="userIdToUpdate">
        <label for="updatedUsername">Updated Username:</label>
        <input type="text" id="updatedUsername" name="updatedUsername" required>
        <br>

        <label for="updatedPassword">Updated Password:</label>
        <input type="password" id="updatedPassword" name="updatedPassword">
        <br>

        <label for="updatedEmail">Updated Email:</label>
        <input type="email" id="updatedEmail" name="updatedEmail" required>
        <br>

        <button type="button" onclick="confirmUpdate()">Update User</button>
        <button type="button" onclick="cancelUpdate()">Cancel</button>
    </form>

    <div id="response"></div>

</body>

</html>