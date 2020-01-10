<?php
/*
  Deze klasse zorgt voor het maken van een connectie met de MySQL database. De klasse maakt gebruik van het singleton pattern.
*/
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

  //Deze methode kijkt of er al een instantie van de database klasse is aangemaakt. Als dit zo is dan geeft hij deze instantie terug. Als dit niet zo is, dan wordt er een nieuw database object aangemaakt.
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
