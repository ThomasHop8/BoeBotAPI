<?php

class Database {
    private static $instance = null;
    private $conn;

    private $host = 'localhost';
    private $db_name = 'plankton';
    private $username = 'root';
    private $password = '';

    private function __construct(){
     $this->conn = null;

     try {
      $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
    } catch(PDOException $exception) {
      echo 'Connection error: ' . $exception->getMessage();
    }
  }


  public static function getInstance(){

    if (self::$instance == null) {
        self::$instance = new Database(); 
    }

    return self::$instance;

  }

  public function getConnection() {
    return $this->conn;
  }
}

?>
