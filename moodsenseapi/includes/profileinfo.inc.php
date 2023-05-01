<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_SESSION['userid'];
    $username = $_SESSION['username'];

    // Getting the data from the form
    $score = htmlspecialchars($_POST["about"], ENT_QUOTES, 'UTF-8');
    $desc = htmlspecialchars($_POST["introtitle"], ENT_QUOTES, 'UTF-8');

    include "../classes/db.classes.php";
    include "../classes/profileinfo.classes.php";
    include "../classes/profileinfocontroller.classes.php";

    $profileInfo = new ProfileInfoController($id, $username);

    $profileInfo->updateProfileInfo($score, $desc);

    // Create a response array for default user mood info
    $response = array(
        "status" => "success",
        "message" => "Profile info updated successfully"
    );

    // Convert response to JSON
    $json_response = json_encode($response);

    // Set content-type header to JSON
    header('Content-Type: application/json');

    // Output the JSON response
    echo $json_response;
}

?>