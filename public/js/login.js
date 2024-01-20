function loginUser() {
    var username = $("#username").val();
    var password = $("#password").val();

    // Simple client-side validation
    if (username === "" || password === "") {
        $("#loginErrorMessage").html("Both username and password are required!");
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
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                window.location.href = response.redirectUrl;
            } else {
                $("#loginErrorMessage").html(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
