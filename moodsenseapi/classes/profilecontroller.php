<?php

class ProfileInfoController extends ProfileInfo {

    private $userId;
    private $username;

    public function __construct($userId, $username)
    {
        $this->userId = $userId;
        $this->username = $username;
    }

    // This method sets the default profile information for the user
    public function defaultProfileInfo() {
        $profileScore = "10";
        $profileDesc = "Hello, " . $this->username . "! This is an example mood log, you can edit or delete this entry to get started with your account.";
        $this->setProfileInfo($profileScore, $profileDesc, $this->userId);
    }

}
