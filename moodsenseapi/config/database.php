<?php 

class Database {

    private $host = "localhost";
    private $db_name = "pdomoodsense";
    private $username = "root";
    private $password = "";
    private $conn = null;

    public function connect(){
        try 
        {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }
        catch(PDOException $exception)
        {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }


}