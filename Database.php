<?php

  class Database {
    public $conn;

    private $host = 'localhost';
    private $db_name = 'plankton';
    private $username = 'root';
    private $password = '';

    public function getConnection() {
      $this->conn = null;

      try {
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
      } catch(PDOException $exception) {
        echo 'Connection error: ' . $exception->getMessage();
      }

      return $this->conn;
    }
  }

  ?>
