<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

// including database and post model
include_once '../config/database.php';
include_once '../models/Post.php';

// Connecting with database 
$database = new Database;
$db = $database->connect();

$post = new Post($db);

echo var_dump($_POST);

if (!empty($_POST['userId']) && !empty($_POST['mood_desc']) && !empty($_POST['mood_score'])) {

    // Get mood_desc and mood_score values from the request body
    $userId = $_POST['userId'];
    $mood_desc = $_POST['mood_desc'];
    $mood_score = $_POST['mood_score'];

    if ($post->create_record($userId, $mood_desc, $mood_score)) {
        echo json_encode(['message' => 'Post Created']);
    } else {
        echo json_encode(['message' => 'Post Not Created']);
    }

} else {
    echo var_dump($_POST); 
    echo json_encode(['message' => 'Missing Parameters']);
}

?>
