<?php

if($_SERVER["REQUEST_METHOD"] == "POST");
{   
    // Getting the data from the form
    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');
    $passwordRepeat = htmlspecialchars($_POST["passwordRepeat"], ENT_QUOTES, 'UTF-8');

    // Instantiate Signupcontroller class
    include ("../classes/db.classes.php");
    include("../classes/signup.classes.php");
    include("../classes/signupcontroller.classes.php");

    // Create new user
    $signup = new SignupController($username, $email, $password, $passwordRepeat);

    // User signup with error handling
    $signup->signupUser();

    $userId = $signup->fetchUserId($username);

    // Instantiate ProfileInfoController class
    include("../classes/profileinfo.classes.php");
    include("../classes/profileinfocontroller.classes.php");

    // Create default profile info for the user
    $profileInfo = new ProfileInfoController($userId, $username);
    $profileInfo->defaultProfileInfo();

    // Homepage redirection
    header("location: http://localhost/moodsensefinal/login.php");

}