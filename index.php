<?php
    session_start();
    include './dbh.class.php';
    include './temp.php';

    $connection = new Dbh;
    $bdd        = $connection->getConnection();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
  <h1 class="text-center">Welcome to EVENTIFY where every day is a beautiful event.</h1>
<div class="d-flex justify-content-center align-items-center position-absolute top-50 start-50 translate-middle"><!-- Center the content vertically and horizontally -->
  <div class="container text-center"> <!-- Center the content within the container -->
      <!-- Button trigger modal Login -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
      LOGIN
    </button>
    <!-- Button trigger modal SignUp -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signUp">
      SIGN UP
    </button>
  </div>
</div>
<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="loginModalLabel">Connectez vous</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="includes/login.inc.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingUser" placeholder="name@example.com" name="uid" autocomplete="on">
                <label for="floatingUser">Username or Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPass" placeholder="password" name="pwd" autocomplete="on">
                <label for="floatingPass">Password</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">LOGIN</button> <!-- Submit button for login form -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal SignUp-->
<div class="modal fade" id="signUp" tabindex="-1" aria-labelledby="signUpLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="signUpLabel">Connectez vous</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="includes/signup.inc.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingUserSignUp" placeholder="username" name="uid" autocomplete="on">
                <label for="floatingUserSignUp">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingEmailSignUp" placeholder="name@example.com" name="email" autocomplete="on">
                <label for="floatingEmailSignUp">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassSignUp" placeholder="password" name="pwd" autocomplete="on">
                <label for="floatingPassSignUp">Password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingRePassSignUp" placeholder="password" name="pwdRepeat" autocomplete="on">
                <label for="floatingRePassSignUp">Verify Password</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">SIGN UP</button> <!-- Submit button for login form -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>