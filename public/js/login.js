function loginUser() {
    var username = $("#username").val();
    var password = $("#password").val();

    // Simple validation
    if (username === "" || password === "") {
        alert("Both username and password are required!");
        return;
    }

    // Ajax request to log in user
    $.ajax({
        type: 'POST',
        url: 'process_pages/login_process.php',
        data: {
            username: username,
            password: password,
        },
        success: function (response) {
            $("#response").html(response);
        }
    });
}
