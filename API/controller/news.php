<?php

  class News{
    
    private $connection;
    private $dbTable = "News";

    private $Header;
    private $Subtitle;
    private $Content;
    private $Category;
    private $Image;
    private $ImageName;
    private $CreateAt;

    public function __construct($db){
      $this->connection = $db;
    }

    /**
     * @OA\Get(
     *     path="/API/Pages/News/readNews.php",
     *     tags={"News"},
     *     @OA\Response(response="200", description="An example resource")
     * )
   */

    public function getAllNews(){

      $selectQuery = "SELECT * FROM " . $this->dbTable;
      $statement = $this->connection->prepare($selectQuery);
      $statement->execute();
      return $statement;

    }

              /**
       * @OA\Get(
       *     path="/API/Pages/News/readNewsId.php",
       *     tags={"News"},
       *     @OA\Response(response="200", description="An example resource")
       * )
       */

    public function getNewsById(){

      $selectQuery = "SELECT * FROM " . $this->dbTable;
      $statement = $this->connection->prepare($selectQuery);
      $statement->execute();
      return $statement;

    }

              /**
       * @OA\Get(
       *     path="/API/Pages/News/readNewsUser.php",
       *     tags={"News"},
       *     @OA\Response(response="200", description="An example resource")
       * )
       */

    public function getNewsByAuthor(){
      $selectQuery = "SELECT * FROM " . $this->dbTable. "WHERE IdUser = ";
      $statement = $this->connection->prepare($selectQuery);
      $statement->execute();
      return $statement;
    }

              /**
       * @OA\Post(
       *     path="/API/Pages/News/createNews.php",
       *     tags={"News"},
       *     @OA\Response(response="200", description="An example resource")
       * )
       */

    public function createNews(){

      $createQuery = "INSERT * INTO " . $this->dbTable . "(Header, Subtitle, Category, Content, Image, ImageName, CreateAt) VALUES (:Header, :Subtitle, :Content, :Image, :ImageName, :CreateAt)";
      $statement = $this->connection->prepare($createQuery);
      
      $this->Header = htmlspecialchars(strip_tags($this->Header));
      $this->Subtitle = htmlspecialchars(strip_tags($this->Subtitle));
      $this->Category = htmlspecialchars(strip_tags($this->Category));
      $this->Content = htmlspecialchars(strip_tags($this->Content));
      $this->Image = htmlspecialchars(strip_tags($this->Image));
      $this->ImageName = htmlspecialchars(strip_tags($this->ImageName));
      $this->CreateAt = $this->CreateAt;
      
      $statement->execute();
      return $statement;

    }
    
            /**
       * @OA\Put(
       *     path="/API/Pages/News/updateNews.php",
       *     tags={"News"},
       *     @OA\Response(response="200", description="An example resource")
       * )
       */

    public function updateNews(){

      $selectQuery = "SELECT * FROM " . $this->dbTable;
      $statement = $this->connection->prepare($selectQuery);
      $statement->execute();
      return $statement;

    }

              /**
       * @OA\Delete(
       *     path="/API/Pages/News/deleteNews.php",
       *     tags={"News"},
       *     @OA\Response(response="200", description="An example resource")
       * )
       */

    public function deleteNews(){
      $deleteQuery = "";
      $statement = $this->connection->prepare($deleteQuery);
      $statement->execute();
      return $statement;
    }


      
    public function readNews(){

      $selectQuery = "SELECT * FROM " . $this->dbTable;
      $statement = $this->connection->prepare($selectQuery);
      $statement->execute();
      return $statement;

    }

  }
  
?>
