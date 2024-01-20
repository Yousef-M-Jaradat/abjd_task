function registerUser() {
    var username = $("#username").val();
    var password = $("#password").val();
    var confirmPassword = $("#confirmPassword").val();
    var email = $("#email").val();

    // Simple client-side validation
    if (username === "" || password === "" || confirmPassword === "" || email === "") {
        $("#registerErrorMessage").html("All fields are required!");
        return;
    }

    // Check if passwords match
    if (password !== confirmPassword) {
        $("#registerErrorMessage").html("Passwords do not match!");
        return;
    }

    // Validate email format
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        $("#registerErrorMessage").html("Invalid email format!");
        return;
    }

    // Ajax request to register user
    $.ajax({
        type: 'POST',
        url: 'process_pages/register_process.php',
        data: {
            username: username,
            password: password,
            confirmPassword: confirmPassword,
            email: email
        },
        success: function (response) {
            if (response === 'success') {
                window.location.href = 'login.php'; // Redirect to the login page
            } else {
                // Display the error message in the designated element
                $("#registerErrorMessage").html(response);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
