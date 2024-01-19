<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    echo "Access denied. Only administrators are allowed to access this page.";
    exit();
}

require './layout/navbar.php';

?>


<div class="container">
    <h1>Welcome to the Dashboard, <?php echo $_SESSION['username']; ?></h1>

    <button type="button" class="btn btn-success mb-3" onclick="toggleAddUserForm()">Add User</button>

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
        </tbody>
    </table>

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
                </div>
            </div>
        </div>
    </div>
</div>

<?php require './layout/footer.php'; ?>