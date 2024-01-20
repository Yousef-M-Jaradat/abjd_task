
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
    var newRole = $("input[name='newRole']:checked").val(); // Get the selected role

    // Simple validation
    if (newUsername === "" || newEmail === "" || newPassword === "" || newRole === undefined) {
        alert("All fields are required!");
        return;
    }

    // Ajax request to add user
    $.ajax({
        type: 'POST',
        url: 'process_pages/add_user.php',
        data: {
            newUsername: newUsername,
            newEmail: newEmail,
            newPassword: newPassword,
            newRole: newRole
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
    $.ajax({
        type: 'POST',
        url: 'process_pages/get_user.php',
        data: {
            userId: userId
        },
        success: function(response) {
            var user = JSON.parse(response);

            $("#userIdToUpdate").val(user.id);
            $("#updatedUsername").val(user.username);
            $("#updatedEmail").val(user.email);
            $("#updatedRole").val(user.role);
            $("#updatedPassword").val("");
            $("#updateUserModal").modal('show');
        }
    });
}


function confirmUpdate() {
    var userId = $("#userIdToUpdate").val();
    var updatedUsername = $("#updatedUsername").val();
    var updatedPassword = $("#updatedPassword").val();
    var updatedEmail = $("#updatedEmail").val();
    var updatedRole = $("#updatedRole").val(); 

    console.log(updatedRole);

    if (updatedUsername === "" || updatedEmail === "" || updatedRole === null) {
        alert("Updated username, email, and role are required!");
        return;
    }

    $.ajax({
        type: 'POST',
        url: 'process_pages/update_user.php',
        data: {
            userId: userId,
            updatedUsername: updatedUsername,
            updatedPassword: updatedPassword,
            updatedEmail: updatedEmail,
            updatedRole: updatedRole 
        },
        success: function(response) {
            showSuccessPopup(response);
            fetchUsers(); 
            cancelUpdate(); 
        }
    });
}


function logout() {
    $.ajax({
        type: 'GET',
        url: 'process_pages/logout_process.php',
        success: function(response) {
            location.reload(true);

            window.location.href = 'login.php';
        },
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
