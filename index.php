<?php
    session_start();
    include './dbh.class.php';
    $connection = new Dbh;
    $bdd        = $connection->getConnection();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/styles/styles.css">
    <link rel="icon" type="image/x-icon" href="./assets/img/logo.svg">
    <title>EVENTIFY</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bs-body-bg">
        <div class="container-fluid d-flex align-content-center gap-3">
            <img src="./assets/img/logo.svg" alt="Eventify Logo" width="50" height="50" class="align-self-center">
            <a class="navbar-brand" href="homepage.php">EVENTIFY</a>
        </div>
    </nav>
</header>
    <div class="d-flex justify-content-center p-5 w-100 col-12">
        <div class="text-center">
            <div class="card-header">
                <h1 class="card-title mb-5" id="welcome">Welcome to EVENTIFY where every day is a beautiful event.</h1>
            </div>
            <!-- Button trigger modal Login -->
            <button type="button" id="login-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                LOGIN
            </button>
            <!-- Button trigger modal SignUp -->
            <button type="button" id="signup-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signUp">
                SIGN UP
            </button>
        </div>
    </div>
    <?php
        include './modals/login-modal.php';
        include './modals/signup-modal.php';
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>