<?php

// This PHP file controls all the database queries for the signup page

class Login extends Db
{

    protected function getUser($username, $password)
    {
        $sql = "SELECT users_password FROM users WHERE users_username = ? OR users_email = ?;";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($username, $password))) {
            $error = "Error: " . $stmt->errorInfo()[1];
            echo json_encode(array("error" => $error));
            $stmt = null;
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            $error = "No user found";
            echo json_encode(array("error" => $error));
            exit();
        }

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPassword = password_verify($password, $results[0]['users_password']);

        if ($checkPassword == false) {
            $stmt = null;
            $error = "Incorrect password";
            echo json_encode(array("error" => $error));
            exit();
        } elseif ($checkPassword == true) {
            $sql = "SELECT * FROM users WHERE users_username = ? OR users_email = ? AND users_password = ?;";
            $stmt = $this->connect()->prepare($sql);

            if (!$stmt->execute(array($username, $username, $password))) {
                $error = "Error: " . $stmt->errorInfo()[2];
                echo json_encode(array("error" => $error));
                $stmt = null;
                exit();
            }

            if($stmt->rowCount() == 0){
                $stmt = null;
                $error = "No user found";
                echo json_encode(array("error" => $error));
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();

            $_SESSION['username'] = $user[0]['users_username'];
            $_SESSION['userid'] = $user[0]['users_id'];

            $stmt = null;

            $success = "Logged in successfully";
            echo json_encode(array("success" => $success));
        }
    }
}

?>
