function registerUser() {
    var username = $("#username").val();
    var password = $("#password").val();
    var email = $("#email").val();

    // Simple validation
    if (username === "" || password === "" || email === "") {
        alert("All fields are required!");
        return;
    }

    // Ajax request to register user
    $.ajax({
        type: 'POST',
        url: 'process_pages/register_process.php',
        data: {
            username: username,
            password: password,
            email: email
        },
        success: function (response) {
            $("#response").html(response);
        }
    });
}
