<?php

include_once '../header.php';

// echo $_SESSION['username'] . "<br>";
// echo $_SESSION['userid'] . "<br>";

// Redirect if user is not logged in 
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
}

$endpoint = "http://localhost/moodsenseapi/CRUD/posts.php?userId=" . $_SESSION['userid'] . "";

$resource = file_get_contents($endpoint);

$data = json_decode($resource, true);

//echo var_dump($data);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mood Summary</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <?php

    // Loop through the JSON data and separate mood scores into categories
    $happy_scores = array();
    $neutral_scores = array();
    $sad_scores = array();
    foreach ($data as $row) {
        $mood_score = intval($row['mood_score']);
        if ($mood_score >= 7) {
            array_push($happy_scores, $mood_score);
        } else if ($mood_score >= 4 && $mood_score <= 6) {
            array_push($neutral_scores, $mood_score);
        } else if ($mood_score >= 0 && $mood_score <= 3) {
            array_push($sad_scores, $mood_score);
        }
    }
    ?>

    <!-- Add a canvas for chart -->
    <canvas id="mood-chart" style="margin: 0 auto; width: 70%; max-width: 500px; display: block;" width="875"
        height="437" class="chartjs-render-monitor"></canvas>

    <!-- Add buttons to filter date_posted by categories -->
    <div class="button-container" style="text-align: center;">
        <button class="filter-button mt-3" data-filter="last-30-days">Last 30 Days</button>
        <button class="filter-button" data-filter="last-6-months">Last 6 Months</button>
        <button class="filter-button" data-filter="all-dates">All Dates</button>
    </div>

    <!-- Add a label to show total mood scores and average score -->
    <div class="label-container" style="text-align: center;">
        <div id="mood-summary-label">Total Mood Scores: 0 | Average Score: 0.00</div>
    </div>

    <!-- chart.js script - Mood Summary Page -->
    <script>
        // Create the chart.js chart
        var ctx = document.getElementById('mood-chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Happy', 'Neutral', 'Sad'],
                datasets: [{
                    label: 'Happy',
                    data: [<?php echo count($happy_scores); ?>, <?php echo count($neutral_scores); ?>, <?php echo count($sad_scores); ?>],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']

                }]
            },
            options: {
                responsive: true,
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Mood Summary'
                }
            }
        });

        // Load all data and calculate average score on page load
        fetch("http://localhost/moodsenseapi/CRUD/posts.php?userId=<?php echo $_SESSION['userid']; ?>")
            .then(response => response.json())
            .then(data => {
                var happy_scores = 0;
                var neutral_scores = 0;
                var sad_scores = 0;
                for (var i = 0; i < data.length; i++) {
                    var mood_score = parseInt(data[i]['mood_score']);
                    if (mood_score >= 7) {
                        happy_scores++;
                    } else if (mood_score >= 4 && mood_score <= 6) {
                        neutral_scores++;
                    } else if (mood_score >= 0 && mood_score <= 3) {
                        sad_scores++;
                    }
                }
                var total_scores = happy_scores + neutral_scores + sad_scores;
                var average_score = total_scores > 0 ? ((happy_scores * 7) + (neutral_scores * 5) + (sad_scores * 2)) / total_scores : 0;
                var label = document.getElementById('mood-summary-label');
                label.innerHTML = "Total Mood Scores: " + total_scores + " | Average Mood Score: " + average_score.toFixed(2);
            });

        // Add buttons to filter date_posted by categories
        var filterButtons = document.querySelectorAll('.filter-button');
        for (var i = 0; i < filterButtons.length; i++) {
            filterButtons[i].addEventListener('click', function () {
                var filter = this.getAttribute('data-filter');
                var endpoint = "http://localhost/moodsenseapi/CRUD/posts.php?userId=<?php echo $_SESSION['userid']; ?>&filter=" + filter;
                fetch(endpoint)
                    .then(response => response.json())
                    .then(data => {
                        // Update the chart with the new data
                        var happy_scores = 0;
                        var neutral_scores = 0;
                        var sad_scores = 0;
                        for (var j = 0; j < data.length; j++) {
                            var mood_score = parseInt(data[j]['mood_score']);
                            if (mood_score >= 7) {
                                happy_scores++;
                            } else if (mood_score >= 4 && mood_score <= 6) {
                                neutral_scores++;
                            } else if (mood_score >= 0 && mood_score <= 3) {
                                sad_scores++;
                            }
                        }
                        chart.data.datasets[0].data = [happy_scores, neutral_scores, sad_scores];
                        chart.update();

                        // Update the label with the new data
                        var total_scores = happy_scores + neutral_scores + sad_scores;
                        var average_score = total_scores > 0 ? ((happy_scores * 7) + (neutral_scores * 5) + (sad_scores * 2)) / total_scores : 0;
                        var label = document.getElementById('mood-summary-label');
                        label.innerHTML = "Total Mood Scores: " + total_scores + " | Average Score: " + average_score.toFixed(2);
                    });
            });
        }
    </script>

</body>

</html>