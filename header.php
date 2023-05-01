<?php
// This is the header file that is included in all pages
// It contains the navigation bar, that is dynamic depending on if the user is logged in
// If the user is logged in the navigation bar will display the account(user's username) and logout buttons/links
// The User's username is displayed in the navigation bar by using the session variable $_SESSION['username'] & first char is 
// capitalized using ucfirst()

session_start();

// This is the header file that is included in all pages 
// Images & CSS
$imageUrl = 'http://localhost/moodsensefinal/SVG/moodsenselogo.svg';
$style = 'http://localhost/moodsensefinal/style.css';

// Links for nav bar
$home = 'http://localhost/moodsensefinal/index.php';
$account = 'http://localhost/moodsensefinal/account/account.php';
$logout = 'http://localhost/moodsensefinal/logout.php';
$login = 'http://localhost/moodsensefinal/login.php';
$signup = 'http://localhost/moodsensefinal/signup.php';
$accountimage= 'http://localhost/moodsensefinal/SVG/account.svg';

?>

<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="index.php" class="d-flex align-items-center me-md-auto text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap"></use>
            </svg>
            <img class="logo" src="<?php echo $imageUrl ; ?>">
        </a>

        <ul class="nav nav-pills">

            <?php

            if (isset($_SESSION['username'])) {
                $username = ucfirst($_SESSION['username']);
                ?>
                <li class="nav-item"><a href="<?php echo $home ; ?>" class="nav-link active" aria-current="page">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                <li class="nav-item"><a href="<?php echo $account ; ?>" class="nav-link"> <?php echo $username .' ' ; ?><img class="" src='<?php echo $accountimage ?>'></a></li>
                <li class="nav-item"><a href="<?php echo $logout ; ?>"class="nav-link">Logout</a></li>
                <?php
            } else {
                ?>
                <li class="nav-item"><a href="<?php echo $home ; ?>" class="nav-link active" aria-current="page">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                <li class="nav-item"><a href="<?php echo $login ; ?>" class="nav-link">Sign In</a></li>
                <li class="nav-item"><a href="<?php echo $signup ; ?>" class="nav-link">Sign Up</a></li>
                <?php
            }


            ?>

        </ul>
    </header>
</div>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="<?php echo $style ; ?>">
</head>

</html>