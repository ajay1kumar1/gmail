<?php
class Database{
 
    // specify your own database credentials
    private $host = "localhost";
    private $dbName = "gmail_db";
    private $username = "root";
    private $password = "root";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new mysqli($this->host, $this->username, $this->password,$this->dbName);
            
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>