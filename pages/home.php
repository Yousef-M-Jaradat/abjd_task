<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userName = $_SESSION['username'];
require './layout/navbar.php';

?>


<div class="container">
    <h1>Welcome to Your Home Page, <?php echo $userName; ?>!</h1>

    <div class="center-buttons">
        <div class="btn-container">
            <a href="login.php" class="btn btn-primary">Login</a>

            <a href="register.php" class="btn btn-success">Register</a>
        </div>
    </div>
</div>

<?php require './layout/footer.php'; ?>