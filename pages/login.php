<?php require './layout/navbar.php'; ?>

<div class="container mt-5">
    <div class="card col-md-6 offset-md-3">
        <img src="../public/image/Outlook-dlqy2rut.png" class="card-img-top m-auto" alt="Login Image" style="width: 200px;">
        <div class="card-header text-white text-center">
            <h4>User Login</h4>
        </div>
        <div class="card-body">
            <form id="loginForm" method="post">
                <div id="loginErrorMessage" style="color: red;"></div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="button" class="btn btn-block" onclick="loginUser()">Login</button>
            </form>
        </div>
    </div>
    <div id="response" class="mt-3"></div>
</div>

<?php require './layout/footer.php'; ?>
