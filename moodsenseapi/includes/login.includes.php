<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Getting the data from the form
    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');


    // Instantiate Signupcontroller class
    include("../classes/db.classes.php");
    include("../classes/login.classes.php");
    include("../classes/logincontroller.classes.php");
    $login = new LoginController($username, $password);

    // User signup with error handling
    $login->loginUser();

    // Success message as JSON data
    echo json_encode(array("message" => "login success"));

    // Successful login redirection
    header("location: http://localhost/moodsensefinal/account/account.php");

    exit();
}

?>