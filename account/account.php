<?php

include_once '../header.php';

// If the user is not logged in redirect to the login page
if (!isset($_SESSION['userid'])) {
    header('Location: ../login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <title>Account Page</title>
</head>

<body>

    <div class="text-center">
        <h1 class="mt-3 mb-3 font-weight-normal">Account Main Page</h1>
        <h2 class="blockquote mb-0 p-3">Welcome <?php echo $_SESSION['username'] ?>!</h2>
        <div class="form-group mt-3">
            <a href="moodlog.php" type="button" class="btn btn-primary btn-lg">Log a Mood Entry</a>
        </div>
        <div class="form-group mt-3">
            <a href="moodlist.php" type="button" class="btn btn-outline-primary btn-lg">View Previous Mood Logs</a>
        </div>
        <div class="form-group mt-3">
            <a href="moodsummary.php" type="button" class="btn btn-primary btn-lg" >View Mood Statistics</a>
        </div>
    </div>

</body>