// dashboard.js

$(document).ready(function() {
    // Initial data load
    fetchUsers();

    // Set up event listener for add user button
    $("#addUserForm").submit(function(event) {
        event.preventDefault();
        addUser();
    });

    // Set up event listener for update user button
    $("#updateUserForm").submit(function(event) {
        event.preventDefault();
        confirmUpdate();
    });
});

function fetchUsers() {
    // Ajax request to fetch users
    $.ajax({
        type: 'GET',
        url: 'process_pages/fetch_users.php',
        success: function(response) {
            $("#userTable tbody").html(response);
        }
    });
}

function addUser() {
    var newUsername = $("#newUsername").val();
    var newEmail = $("#newEmail").val();
    var newPassword = $("#newPassword").val();

    // Simple validation
    if (newUsername === "" || newEmail === "") {
        alert("Both username and email are required!");
        return;
    }

    // Ajax request to add user
    $.ajax({
        type: 'POST',
        url: 'process_pages/add_user.php',
        data: {
            newUsername: newUsername,
            newEmail: newEmail,
            newPassword: newPassword
        },
        success: function(response) {
            // Hide the "Add User" form
            $("#addUserForm")[0].reset();
            $('#addUserModal').modal('hide');

            // Display success popup
            showSuccessPopup(response);

            // Refresh the user table
            fetchUsers();
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.error(xhr.responseText);
        }
    });
}

function deleteUser(userId) {
    if (confirm("Are you sure you want to delete this user?")) {
        $.ajax({
            type: 'POST',
            url: 'process_pages/delete_user.php',
            data: {
                userId: userId
            },
            success: function(response) {
                showSuccessPopup(response);
                fetchUsers(); // Refresh the user table
            }
        });
    }
}

function updateUser(userId) {
    // Fetch user data for the selected user
    $.ajax({
        type: 'POST',
        url: 'process_pages/get_user.php',
        data: {
            userId: userId
        },
        success: function(response) {
            var user = JSON.parse(response);

            // Populate the update form with user data
            $("#userIdToUpdate").val(user.id);
            $("#updatedUsername").val(user.username);
            $("#updatedEmail").val(user.email);
            $("#updatedPassword").val(""); // Clear the password field
            $("#updateUserModal").modal('show');
        }
    });
}

function confirmUpdate() {
    var userId = $("#userIdToUpdate").val();
    var updatedUsername = $("#updatedUsername").val();
    var updatedPassword = $("#updatedPassword").val();
    var updatedEmail = $("#updatedEmail").val();

    // Simple validation
    if (updatedUsername === "" || updatedEmail === "") {
        alert("Both updated username and email are required!");
        return;
    }

    // Ajax request to update user
    $.ajax({
        type: 'POST',
        url: 'process_pages/update_user.php',
        data: {
            userId: userId,
            updatedUsername: updatedUsername,
            updatedPassword: updatedPassword,
            updatedEmail: updatedEmail
        },
        success: function(response) {
            showSuccessPopup(response);
            fetchUsers(); // Refresh the user table
            cancelUpdate(); // Hide the update form
        }
    });
}

function cancelUpdate() {
    // Reset and hide the update form
    $("#updateUserForm")[0].reset();
    $("#updateUserModal").modal('hide');
}

function toggleAddUserForm() {
    $('#addUserModal').modal('toggle');
}

function showSuccessPopup(message) {
    $("#successModalBody").html(message);
    $("#successModal").modal('show');
}
