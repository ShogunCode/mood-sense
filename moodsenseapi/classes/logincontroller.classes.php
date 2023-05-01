<?php

// This PHP file controls all the database queries for the login page

class LoginController extends Login
{
    // Private variables for the class
    private $username;
    private $password;


    // Constructor for the class
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function loginUser()
    { {
            if ($this->emptyInput() == false) {
                // empty input
                $response = array("error" => "emptyinput");
                echo json_encode($response);
                exit();
            }
        }

        // get user
        $this->getUser($this->username, $this->password);

    }

    private function emptyInput()
    {
        if (empty($this->username) || empty($this->password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }


}