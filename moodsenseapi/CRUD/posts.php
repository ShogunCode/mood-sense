<?php

error_reporting(E_ALL);
ini_set('display_error', 1);

// Headers
Header('Access-Control-Allow-Origin: *');
Header('Content-Type: application/json');
Header('Access-Control-Allow-Method: POST');

// including database and post model
include_once('../config/database.php');
include_once('../models/Post.php');

// Connecting with database 
$database = new Database;
$db = $database->connect();

$post = new Post($db);

// // Check for API key before proceeding
// $apiKey = isset($_SERVER['HTTP_X_API_KEY']) ? $_SERVER['HTTP_X_API_KEY'] : null;

// Get user ID from URL parameter
$userId = isset($_GET['userId']) ? $_GET['userId'] : null;

// // Check API key and get result
// $result = $post->validateApiKey($apiKey);

// if (!$result) {
//     // API key is invalid, return error response
//     $userId = array(isset($_GET['userId']) ? $_GET['userId'] : null);
//     header('Content-Type: application/json');
//     echo json_encode($userId);
//     $apiKey = array(isset($_GET['HTTP_X_API_KEY']) ? $_GET['HTTP_X_API_KEY'] : null);
//     header('Content-Type: application/json');
//     echo json_encode($apiKey);
//     $response = array("error" => "invalidapikey");
//     header('Content-Type: application/json');
//     echo json_encode($response);
//     exit();
// }

$posts = $post->readPosts();

// if there is posts in the database
if (count($posts) > 0) {

    $api_response = [];

    foreach ($posts as $row) {
        array_push($api_response, $row);
    }

    $response = json_encode($api_response);

    if (!empty($response)) {
        echo $response;
    } else {
        echo json_encode(['message' => 'No Posts Found']);
    }
} else {
    echo json_encode(['message' => 'No Matching Rows Found']);
}

?>