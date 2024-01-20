<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/dashboard.js"></script>
    <script src="../public/js/register.js"></script>
    <script src="../public/js/login.js"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark ">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <li class="nav-item">
                        <button type="button" class="btn btn-outline-light" onclick="logout()">Logout</button>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a href="login.php" class="btn btn-outline-light">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="register.php" class="btn btn-outline-light">Register</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>