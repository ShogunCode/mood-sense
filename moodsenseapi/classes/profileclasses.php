<?php

class ProfileInfo extends Db
{

    protected function setProfileInfo($profileScore, $profileDesc, $userId)
    {
        $stmt = $this->connect()->prepare("INSERT INTO mood_log (mood_score, mood_desc, users_id) VALUES (?, ?, ?);");

        if (!$stmt->execute(array($profileScore, $profileDesc, $userId))) {
            $error = "Error: " . $stmt->errorInfo()[2];
            $stmt = null;
            echo json_encode(array("error" => $error));
            exit();
        }

        echo json_encode(array("success" => "Profile info added successfully."));
        $stmt = null;

    }

}

?>