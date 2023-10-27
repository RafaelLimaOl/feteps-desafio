<?php 

  class DataBase{

    private $host = "localhost";
    private $dbName = "blog-php";
    private $userName = "root";
    private $password = "";

    public $connection;

    public function DbConnection(){
      $this->connection = null;
      try {
        $this->connection = new PDO("mysql:host=".$this->host.";dbname=".$this->dbName, $this->userName, $this->password);
      } catch (PDOException $exeception) {
        echo "Connection Falied!";
        $exeception->getMessage();
      }
      return $this->connection;
    }
  }

?>