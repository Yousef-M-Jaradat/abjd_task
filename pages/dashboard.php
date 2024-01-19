<!-- dashboard.php -->

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirect to the login page if not logged in
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/dashboard.css">
    <link rel="stylesheet" href="../public/css/styles.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/dashboard.js"></script>
</head>

<body>

    <div class="container">
        <h1>Welcome to the Dashboard, Admin!</h1>

        <!-- Add User Button -->
        <button type="button" class="btn btn-success mb-3" onclick="toggleAddUserForm()">Add User</button>

        <!-- Add User Form Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Add User Form -->
                        <form id="addUserForm">
                            <div class="form-group">
                                <label for="newUsername">New Username:</label>
                                <input type="text" class="form-control" id="newUsername" name="newUsername" required>
                            </div>

                            <div class="form-group">
                                <label for="newPassword">New Password:</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                            </div>

                            <div class="form-group">
                                <label for="newEmail">New Email:</label>
                                <input type="email" class="form-control" id="newEmail" name="newEmail" required>
                            </div>

                            <button type="button" class="btn btn-primary" onclick="addUser()">Add User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Table -->
        <table class="table" id="userTable">
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

        <!-- Update User Form (Initially Hidden) -->
        <div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="updateUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateUserModalLabel">Update User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="updateUserForm">
                            <input type="hidden" id="userIdToUpdate" name="userIdToUpdate">
                            <div class="form-group">
                                <label for="updatedUsername">Updated Username:</label>
                                <input type="text" class="form-control" id="updatedUsername" name="updatedUsername" required>
                            </div>

                            <div class="form-group">
                                <label for="updatedPassword">Updated Password:</label>
                                <input type="password" class="form-control" id="updatedPassword" name="updatedPassword">
                            </div>

                            <div class="form-group">
                                <label for="updatedEmail">Updated Email:</label>
                                <input type="email" class="form-control" id="updatedEmail" name="updatedEmail" required>
                            </div>

                            <button type="button" class="btn btn-success" onclick="confirmUpdate()">Update User</button>
                            <button type="button" class="btn btn-secondary" onclick="cancelUpdate()">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Response Modal -->
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Success</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="successModalBody">
                        <!-- Success message will be displayed here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>