<?php

// This PHP file controls all the database queries for the signup page

class Signup extends Db
{


    // create user and API key for user
    protected function createUserAndApiKey($username, $email, $password)
    {
        // Generate API Key
        $apiKey = $this->generateApiKey();
    
        // Insert user into users table
        $sql = "INSERT INTO users (users_username, users_email, users_password) VALUES (?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute(array($username, $email, $hashedPassword));
    
        // Get the users_id of the newly created user
        $usersId = $this->fetchUserId($username);
    
        // Insert API Key into moodsense_api table
        $query = 'INSERT INTO moodsense_api (users_id, api_key) VALUES (?, ?)';
        $stmtApi = $this->connect()->prepare($query);
        $stmtApi->execute(array($usersId, $apiKey));
    
        if (!$stmtApi) {
            echo json_encode(array("error" => "sqlerror"));
            $stmtApi = null;
            return false;
        } else {
            $stmtApi = null;
            return true;
        }
    }


    // Prepared statement to protect against SQL injection
    protected function checkUser($username, $email)
    {
        $sql = "SELECT users_id FROM users WHERE users_username = ? OR users_email = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($username, $email))) {
            echo json_encode(array("error" => "sqlerror"));
            $stmt = null;
            exit();
        }

        if ($stmt->rowCount() > 0) {
            $results = false;
            $stmt = null;
            echo json_encode(array("error" => "usernametaken"));
            exit();
        } else {
            $results = true;
        }

        // $results = $stmt->fetchAll();
        return $results;
    }

    protected function getUserId($username)
    {
        $stmt = $this->connect()->prepare("SELECT users_id FROM users WHERE users_username = ?;");

        if (!$stmt->execute(array($username))) {
            echo json_encode(array("error" => "sqlerror"));
            $stmt = null;
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            echo json_encode(array("error" => "getidnouserfound"));
            exit();
        }

        $profileResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $profileResults;
    }

    protected function generateApiKey()
    {
        $key = md5(uniqid(rand(), true));
        return $key;
    }
}