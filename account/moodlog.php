<?php

include_once '../header.php';

// echo $_SESSION['username'] . "<br>";
// echo $_SESSION['userid'] . "<br>";

// Redirect if user is not logged in 
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
}

$userId = $_SESSION['userid'];

if (isset($_POST['moodlogsubmit'])) {
    $mood_desc = $_POST['mood_desc'];
    $mood_score = $_POST['mood_score'];

    $postdata = http_build_query([
        'userId' => $userId,
        'mood_desc' => $mood_desc,
        'mood_score' => $mood_score,
    ]);

    $opts = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postdata,
        ]
    ];

    $context = stream_context_create($opts);

    $endpoint = 'http://localhost/moodsenseapi/CRUD/insert.php';

    $resource = file_get_contents($endpoint, false, $context);

    //echo $resource;
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <title>Log a Mood</title>
</head>

<body>

    <div class="text-center mt-3">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="uk-grid-small" style=max-width:500px;margin:auto uk-grid>
            <div class="form-group mt-3">
                <h3>Mood Log</h3>
                <p>Please rate your current mood on a scale of 1 to 10.</p>
                <p>1 being the lowest &amp; 10 being the highest.</p>
                <div class="form-group mt-3">
                    <label for="moodLog" class='mt-3 sr-only'>Mood Log</label>
                    <textarea class="form-control mt-3" name='mood_desc' placeholder="Enter some details..." rows="3"
                        required></textarea>

                    <div class="btn-group mt-3">
                        <button class="btn btn-secondary dropdown-toggle mt-3" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false" id="mood_score_btn">Mood Score</button>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" name="mood_score" data-value="1">1</a></li>
                            <li><a class="dropdown-item" href="#" name="mood_score" data-value="2">2</a></li>
                            <li><a class="dropdown-item" href="#" name="mood_score" data-value="3">3</a></li>
                            <li><a class="dropdown-item" href="#" name="mood_score" data-value="4">4</a></li>
                            <li><a class="dropdown-item" href="#" name="mood_score" data-value="5">5</a></li>
                            <li><a class="dropdown-item" href="#" name="mood_score" data-value="6">6</a></li>
                            <li><a class="dropdown-item" href="#" name="mood_score" data-value="7">7</a></li>
                            <li><a class="dropdown-item" href="#" name="mood_score" data-value="8">8</a></li>
                            <li><a class="dropdown-item" href="#" name="mood_score" data-value="9">9</a></li>
                            <li><a class="dropdown-item" href="#" name="mood_score" data-value="10">10</a></li>
                        </ul>

                    </div>

                    <div class="mt-3" id="mood_score_display">
                        <!-- Hidden input to store the value of the dropdown -->
                        <input type="hidden" name="mood_score" id="mood_score" value="">
                        <label name="mood_score_label" id="mood_score_label"></label>
                    </div>


                    <div class="p-1 mt-3">
                        <div uk-form-custom>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary btn-lg" name="moodlogsubmit">Add Mood
                                    Log</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('ul.dropdown-menu li a').click(function () {
                // Get the selected value
                var selected_value = $(this).data('value');

                // Set the value of the hidden input field
                $('#mood_score').val(selected_value);

                // Update the label to show the selected value
                $('#mood_score_label').text('You selected: ' + selected_value);

                // Update the dropdown button text with the selected value
                $('#mood_score_btn').text('Mood Score: ' + selected_value);
            });
        });

    </script>
</body>


</html>