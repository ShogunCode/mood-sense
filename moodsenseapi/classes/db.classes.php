<?php

class Db{

    protected function connect(){

        try {
            $username = "root";
            $password = "";
            $conn = new PDO('mysql:host=localhost;dbname=pdomoodsense', $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            // Display error message
            print("Error!: " . $e->getMessage() . "<br/>");
            die();
        }

    }

}