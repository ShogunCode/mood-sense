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

if (isset($_GET['id'])) {

    $data = $post->read_single_post($_GET['id']);

    echo json_encode($data);

    if ($data->rowCount()) {
        //$posts = [];
        while ($row = $data->fetch(PDO::FETCH_OBJ)) {

            print_r($row);

            // $posts[$row->id] = [
            //     'id' => $row->id,
            //     'categoryName' => $row->category,
            //     'description' => $row->description,
            //     'title' => $row->title,
            //     'created_at' => $row->created_at,
            // ];
        }
        echo json_encode($posts);
    } else {
        echo json_encode(['message' => 'No post data found']);
    }

}