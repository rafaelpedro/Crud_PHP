<?php

class Myconnect{
    private $username = "root";
    private $password = "";
    public $conn;

    public function __construct()
    {
        try{
            $this->conn = new PDO('mysql:host=localhost;port=3307;dbname=labproject', $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        }catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }    
    }  

}

?>