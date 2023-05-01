<?php

// This PHP file controls all the database queries for the signup page

class SignupController extends Signup
{

    // Private variables for the class
    private $username;
    private $email;
    private $password;
    private $passwordRepeat;

    // Constructor for the class
    public function __construct($username, $email, $password, $passwordRepeat)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
    }

    public function signupUser()
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($this->emptyInput() == false) {
            // empty input
            $response = array("error" => "emptyinput");
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
        if ($this->invalidUsername() == false) {
            // invalid username
            $response = array("error" => "invalidusername");
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
        if ($this->invalidEmail() == false) {
            // invalid email
            $response = array("error" => "invalidemail");
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
        if ($this->passwordMatch() == false) {
            // password mismatch
            $response = array("error" => "passwordmismatch");
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
        if ($this->uniqueUserCheck() == false) {
            // username or email already exists
            $response = array("error" => "usernametaken");
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }

        // create user & create api key for user
        if ($this->createUserAndApiKey($username, $email, $password)) {
            exit();
        } else {
            echo json_encode(array("error" => "sqlerror"));
            exit();
        }

    }


    private function emptyInput()
    {
        if (empty($this->username) || empty($this->email) || empty($this->password) || empty($this->passwordRepeat)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // Checking the form data to make sure string contains valid characters
    private function invalidUsername()
    {
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->username)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function passwordMatch()
    {
        if ($this->password !== $this->passwordRepeat) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function uniqueUserCheck()
    {
        if (!$this->checkUser($this->username, $this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    public function fetchUserId($username)
    {
        $userId = $this->getUserId($username);
        return $userId[0]["users_id"];
    }
}