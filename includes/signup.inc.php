<?php

if (isset($_POST["submit"])) {
    // Grabs data from the form
    $uid       = $_POST["uid"];
    $pwd       = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $email     = $_POST["email"];

    // Include necessary files and create an instance of the SignupContr class
    include "../dbh.class.php";
    include "../classes/signup.class.php";
    include "../classes/signup-contr.class.php";
    include "../classes/login.class.php";
    include "../classes/login-contr.class.php";
    $signup = new SignupContr($uid, $pwd, $pwdRepeat, $email);

    // Run error handlers and user sign up
    $signup->signupUser();
    $signin = new LoginContr($uid, $pwd);
    // Redirect to the front page with a success message
    header("location: ../homepage.php?error-none");
}