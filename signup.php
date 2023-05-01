<?php

include_once('header.php');

if(isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
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


    <title>Sign Up</title>
</head>

<body>

<?php

include_once 'header.php'

?>

    <div class="signup-form text-center">
        <form method="post" action="../moodsenseapi/includes/signup.include.php" style="max-width:500px;margin:auto">
            <h1 class="mt-3 mb-3 font-weight-normal">Sign Up</h1>
            <p>Please fill in this form to create an account!</p>
            <hr>
            <div class="form-group">
                <div class="row">
                    <div class="form-group mt-3">
                        <input type="text" class="form-control" name="username" placeholder="Username"
                            required="required">
                        <div class="form-group mt-3">
                            <input type="email" class="form-control" name="email" placeholder="Email"
                                required="required">
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                required="required">
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" class="form-control" name="passwordRepeat"
                                placeholder="Confirm Password" required="required">
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-check-label"><input type="checkbox" required="required"> I accept the <a
                                    href="termsofuse.php">Terms of Use</a> &amp; <a href="privacy.php">Privacy
                                    Policy</a></label>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary btn-lg" name="signupsubmit">Sign Up</button>
                        </div>
        </form>
        <form style="max-width:500px;margin:auto">
            <div class="hint-text mt-3">Already have an account? <a href="signin.php">Login here</a></div>

    </div>

</body>

</html>