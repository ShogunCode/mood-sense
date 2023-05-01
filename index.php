<?php

include_once 'header.php';

// echo $_SESSION['username'] . "<br>";
// echo $_SESSION['userid'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">


    <title>Homepage - MoodSense</title>
</head>

<body>

    <div class="px-4 py-5 my-5 text-center">
        <img class="filterblue" src="SVG/moodsense.svg">
        <img class="d-block mx-auto mb-4" src="SVG/moodsenselogo.svg">
        <h1 class="display-5 fw-bold"></h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Welcome to MoodSense, where tracking your mood has never been easier or more
                insightful. We understand that your mental health and well-being are important, which is why we offer
                the most comprehensive and user-friendly mood tracking platform on the market. With MoodSense, you can
                journal your mood as many times as you like, even multiple times a day, to gain a complete understanding
                of your emotional state. Our interactive charts provide a clear and visual representation of your mood
                over time, allowing you to better understand your patterns and gain valuable insights into your mental
                health. Don't settle for less - join MoodSense today and start taking control of your mood and your
                life.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="button" class="btn btn-primary btn-lg px-4 gap-3" style="color:white;"><a
                        href="signup.php" style="color:white;">Sign Up</a></button>
                <button type="button" class="text-white btn btn-outline-secondary btn-lg px-4"><a
                        href="signin.php">Login</a></button>
            </div>
        </div>
    </div>

</body>

</html>