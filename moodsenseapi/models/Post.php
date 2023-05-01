<?php

error_reporting(E_ALL);
ini_set('display_error', 1);

include "../classes/db.classes.php";

class Post extends Db
{

    // Post Properties
    // id-> mood_log_id
    public $mood_log_id;
    // category id -> mood_score
    public $mood_score;
    public $title;
    // description -> mood_desc
    public $mood_desc;
    // created_at -> date_posted
    public $date_posted;


    // Database Data 
    private $conn;
    private $table = 'mood_log';

    private $apiTable = 'moodsense_api';

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function readPosts()
    {
        $query = 'SELECT mood_log_id, mood_score, mood_desc, date_posted FROM ' . $this->table . ' WHERE users_id = :userid ORDER BY mood_log_id DESC';

        $userId = isset($_GET['userId']) ? $_GET['userId'] : null;

        $post = $this->conn->prepare($query);

        $post->bindParam(':userid', $userId);

        $post->execute();

        return $post->fetchAll(PDO::FETCH_ASSOC);
    }

    // method to read single row in database 
    // needs the id specified
    public function read_single_post($mood_log_id)
    {
        $this->mood_log_id = $mood_log_id;

        $query = 'SELECT mood_score, mood_desc FROM ' . $this->table . ' 
        WHERE mood_log_id=? LIMIT 0,1';

        $post = $this->conn->prepare($query);

        $post->bindValue('mood_log_id', $this->mood_log_id, PDO::PARAM_INT);

        $post->execute();

        return $post;
    }

    // method to create new record in database
    public function create_record($userId, $mood_desc, $mood_score)
    {
        try {
            // Query to insert data
            $query = 'INSERT INTO ' . $this->table . ' SET users_id=:userId, mood_desc=:mood_desc, mood_score=:mood_score';

            $post = $this->conn->prepare($query);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $post->bindParam(':userId', $userId, PDO::PARAM_INT);
            $post->bindValue(':mood_desc', $mood_desc, PDO::PARAM_STR);
            $post->bindValue(':mood_score', $mood_score, PDO::PARAM_INT);

            if ($post->execute()) {
                return true;
            }
            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // method to update record in database
    public function update($params)
    {
        try {
            // Assigning Values
            $this->mood_log_id = $params['mood_log_id'];
            $this->mood_desc = $params['mood_desc'];

            // Query to update data
            $query = 'UPDATE ' . $this->table . ' SET mood_desc=:mood_desc WHERE mood_log_id=:mood_log_id';

            $post = $this->conn->prepare($query);

            $post->bindValue('mood_desc', $this->mood_desc, PDO::PARAM_STR);
            $post->bindValue('mood_log_id', $this->mood_log_id, PDO::PARAM_INT);

            if ($post->execute()) {
                return true;
            }
            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    // method to delete record in database
    public function delete($mood_log_id)
    {

        try {
            // Assigning Values
            $this->mood_log_id = $mood_log_id;

            // Query to update data
            $query = 'DELETE FROM ' . $this->table . ' WHERE mood_log_id=:mood_log_id';

            $post = $this->conn->prepare($query);

            $post->bindValue('mood_log_id', $this->mood_log_id, PDO::PARAM_INT);

            if ($post->execute()) {
                return true;
            }
            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    // Function to validate API key
    function validateApiKey($apiKey)
    {
        $query = 'SELECT api_key FROM ' . $this->apiTable . ' WHERE users_id = 23';

        // your database query here
        $stmt = $this->connect()->prepare($query);
        //$stmt->bindParam(':userid', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['api_key'] === $apiKey) {
            // API key is valid, allow request to proceed
            return true;
        } else {
            // API key is invalid, return error response
            return false;
        }
    }


}