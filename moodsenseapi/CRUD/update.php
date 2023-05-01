<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Headers
Header('Access-Control-Allow-Origin: *');
Header('Content-Type: application/json');
Header('Access-Control-Allow-Methods: POST');

// including database and post model
include_once('../config/database.php');
include_once('../models/Post.php');

// Connecting with database 
$database = new Database;
$db = $database->connect();

$post = new Post($db);
$data = json_decode(file_get_contents("php://input"));

if(isset($data)){
    // updating users mood description
    $params = [
        'mood_log_id' => $data->mood_log_id,
        'mood_desc' => $data->mood_desc,
       

    ];

    if($post->update($params)){
        echo json_encode(['message' => 'Post Updated']);
    }
}