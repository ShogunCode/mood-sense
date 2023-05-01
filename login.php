<?php

include_once 'header.php';

// echo $_SESSION['username'] . "<br>";
// echo $_SESSION['userid'];

?>

<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Sign In</title>
</head>

<body>

    <div class="text-center mt-3">
        <form style="max-width:500px;margin:auto" action="../moodsenseapi/includes/login.includes.php" method="post">
            <h1 class="mt-3 mb-3 font-weight-normal">Please Sign In</h1>
            <p>Nice to see you back again!</p>
            <hr>
            <label for="username" class="mt-3 sr-only">Username</label>
            <input type="text" name="username" placeholder="Username" id="username" class="form-control" required
                autofocus>
            <label for="password" class="mt-3 sr-only">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" class="form-control">
            <div class="mt-3 checkbox">
                <input type="checkbox" value="remember-me"> Remember Me
            </div>
            <div class="mt-3">
                <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Login">Sign In</a></button>
            </div>
        </form>
    </div> 

</body>

</html>