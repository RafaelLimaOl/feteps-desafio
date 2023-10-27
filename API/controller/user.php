<?php

  require $_SERVER['DOCUMENT_ROOT'].'/Desafio/API/vendor/autoload.php';
  use Firebase\JWT\JWT;
  use Firebase\JWT\Key;

  /**
    * @OA\Info(title="Blog API", version="1.0")
    *   @OA\SecurityScheme(
    *     type="http",
    *     description="Authorization with JWT generated tokens",
    *     name="Authorization",
    *     in="header",
    *     scheme="bearer",
    *     bearerFormat="JWT",
    *     securityScheme="bearerToken"
    *   )
  */
  
  class User{

    private $connection;
    private $dbTable = "UserAdmin";

    public $IdUser;
    public $UserName;
    public $Email;
    public $UserPassword;
    public $IdNews;
    protected $key = "randomPassword";

    public function __construct($db){
      $this->connection = $db;
    }

    /**
     * @OA\Get(
     *     path="/Desafio/API/pages/Users/authUser.php",
     *     summary="Generate a Token for Request Validations",
     *     tags={"Tokens"},
     *     @OA\Response(response="200", description="Token Created"),
     *     @OA\Response(response="404", description="Token Not Created")
     * )
    */

    public function AuthUser(){
      try {
        $issueDate = time();
        $expireDate = time()* 3600;
        $payload = array(
          "iss" => "http://localhost/Desafio",
          "aud" => "http://localhost",
          "iat" => $issueDate,
          "exp" => $expireDate,
          "userName" => "Primeiro Usuário"
        );

        $jwtGeneretedToken = JWT::encode($payload, $this->key, 'HS256');
        return[
          "token" => $jwtGeneretedToken,
          "expires" => $expireDate, 
        ];

      } catch (PDOException $e) {
        $e->getMessage();
      }
    }

    /**
     * @OA\Get(
     *     path="/Desafio/API/pages/users/readUser.php",
     *     summary="Get All Users",
     *     tags={"Users"},
     *     @OA\Response(response="200", description="Id, Name, Email and Password"),
     *     security={ {"bearerToken": {} } }
     * )
    */

    public function getAllUser(){

      try {

        $header = apache_request_headers();

        if($header['Authorization']){
          
          $token = str_ireplace('Bearer ', '', $header['Authorization']);
          $decode = JWT::decode($token, new Key($this->key, 'HS256'));

          if (isset($decode->userName) && $decode->userName == "Primeiro Usuário") {
            
            $selectQuery = "SELECT * FROM ".$this->dbTable;
            $statement = $this->connection->prepare($selectQuery);
            $statement->execute();
            return $statement;
          } else {
            return false;
          }
        } else {
          return false;
        }
        exit;
      } catch (PDOException $e){
        echo $e->getMessage();
      }
    }

    /**
     * @OA\POST(
     *     path="/Desafio/API/pages/Users/loginUser.php",
     *     summary="Login Method",
     *     tags={"Users"},
     *     @OA\Parameter(
     *       name="UserName",
     *       in="query",
     *       required=true,
     *       description="The UserName passed"
     *     ),
     *     @OA\Parameter(
     *       name="Email",
     *       in="query",
     *       required=true,
     *       description="The Email passed"
     *     ),
     *     @OA\Parameter(
     *       name="UserPassword",
     *       in="query",
     *       required=true,
     *       description="The Password passed"
     *     ),
     *     @OA\Response(response="200", description="User Succefully Login"),
     *     @OA\Response(response="404", description="User Not Found")
     * )
    */

    public function loginUser(){
      try{
        $loginQuery = "SELECT * FROM ".$this->dbTable." WHERE UserName = ? AND Email = ? AND UserPassword = ?;";
        
        $statement = $this->connection->prepare($loginQuery);

        $statement->bindValue(1, $this->UserName);
        $statement->bindValue(2, $this->Email);
        $statement->bindValue(3, $this->UserPassword);
       
        $statement->execute(); 

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $this->IdUser = $row['IdUser'];
        $this->UserName = $row['UserName'];
        $this->Email = $row['Email'];
        $this->UserPassword = $row['UserPassword'];

        return $statement;

      } catch (PDOException $e){
        echo $e->getMessage();
      }
    }

    /**
     * @OA\Get(
     *     path="/Desafio/API/Pages/Users/readUserId.php",
     *     summary="Get User by ID",
     *     tags={"Users"},
     *     @OA\Parameter(
     *       name="id",
     *       in="query",
     *       required=true,
     *       description="The id passed"
     *     ),
     *     @OA\Response(response="200", description="Id, Name, Email and Password"),
     *     @OA\Response(response="404", description="User Not Found")
     * )
    */
// eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L0Rlc2FmaW8iLCJhdWQiOiJodHRwOi8vbG9jYWxob3N0IiwiaWF0IjoxNjk2MzQxMjc4LCJleHAiOjYxMDY4Mjg2MDA4MDAsInVzZXJOYW1lIjoiUHJpbWVpcm8gVXN1XHUwMGUxcmlvIn0.z8Xyvr3NLkqj5fhGHcO4-MgoKuekutvLtb01AQQtGHs
    public function getUserById(){
      try{
        $selectIdQuery = "SELECT UserName, Email, UserPassword FROM ".$this->dbTable." WHERE IdUser = ? LIMIT 0,1;";
        $statement = $this->connection->prepare($selectIdQuery);
        $statement->bindParam(1, $this->IdUser);
        $statement->execute(); 

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $this->UserName = $row['UserName'];
        $this->Email = $row['Email'];
        $this->UserPassword = $row['UserPassword'];
      } catch (PDOException $e){
        echo $e->getMessage();
      }
    }

    //      *     @OA\RequestBody(
    //  *       @OA\MediaType(
    //  *         mediaType="multipart/form-data",
    //  *         @OA\Schema(
    //  *           @OA\Property(
    //  *             property="UserName",
    //  *             type="string",
    //  *           ),
    //  *           @OA\Property(
    //  *             property="Email",
    //  *             type="string",
    //  *           ),
    //  *           @OA\Property(
    //  *             property="UserPassowrd",
    //  *             type="string",
    //  *           ),
    //  *         ),
    //  *       ),
    //  *     ),
    /**
     * @OA\Post(
     *     path="/Desafio/API/Pages/Users/createUser.php",
     *     summary="Create User Method",
     *     tags={"Users"},
     *     @OA\Parameter(
     *       name="id",
     *       in="query",
     *       required=true,
     *       description="The id passed"
     *     ),
     *     @OA\Parameter(
     *       name="name",
     *       in="query",
     *       required=true,
     *       description="The id passed"
     *     ),
     *     @OA\Parameter(
     *       name="email",
     *       in="query",
     *       required=true,
     *       description="The id passed"
     *     ),
     *     @OA\Parameter(
     *       name="password",
     *       in="query",
     *       required=true,
     *       description="The id passed"
     *     ),
     *     @OA\Response(response="200", description="User Succefully created"),
     *     @OA\Response(response="400", description="User Not Created")
     * )
    */

    public function createUser(){
      try {
        $createQuery = "INSERT INTO " .$this->dbTable. "(UserName, Email, UserPassword) VALUES (:UserName, :Email, :UserPassword)";
        $statement = $this->connection->prepare($createQuery);
        
        $this->UserName = htmlspecialchars(strip_tags($this->UserName));
        $this->Email = htmlspecialchars(strip_tags($this->Email));
        $this->UserPassword = htmlspecialchars(strip_tags($this->UserPassword));
        $this->IdNews = htmlspecialchars(strip_tags($this->IdNews));
        
        $statement->bindValue("UserName", $this->UserName);
        $statement->bindValue("Email", $this->Email);
        $statement->bindValue("UserPassword", $this->UserPassword);
        
        if ($statement->execute()){
          return true;
        }
        printf("Error: %s\n", $statement->error);
        
        return false;

      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    /**
     * @OA\Put(
     *     path="/Desafio/API/Pages/Users/updateUser.php",
     *     summary="Update User Method",
     *     tags={"Users"},
     *     @OA\Response(response="200", description="An example resource")
     * )
    */

    public function updateUser(){
      try{
        $updateQuery = "UPDATE " .$this->dbTable." SET UserName = :UserName, Email = :Email, UserPassword = :UserPassword WHERE IdUser = :IdUser";
        $statement = $this->connection->prepare($updateQuery);

        $this->IdUser = htmlspecialchars(strip_tags($this->IdUser)); 
        $this->UserName = htmlspecialchars(strip_tags($this->UserName));
        $this->Email = htmlspecialchars(strip_tags($this->Email));
        $this->UserPassword = htmlspecialchars(strip_tags($this->UserPassword));
        
        $statement->bindParam(":IdUser", $this->IdUser);
        $statement->bindParam(":UserName", $this->UserName);
        $statement->bindParam(":Email", $this->Email);
        $statement->bindParam(":UserPassword", $this->UserPassword);

        if ($statement->execute()){
          return true;
        }
        printf("Error: %s\n", $statement->error);

        return false;
      } catch (PDOException $e){
        echo $e->getMessage();
      }
    }
    
    /**
     * @OA\Delete(
     *     path="/Desafio/API/Pages/Users/deleteUser.php",
     *     summary="Delete User Method",
     *     tags={"Users"},
     *     @OA\Parameter(
     *       name="IdUser",
     *       in="query",
     *       required=true,
     *       description="The id passed"
     *     ),
     *     @OA\Response(response="200", description="An example resource")
     * )
    */

    public function deleteUser(){
      try{
        $deleteQuery = "DELETE FROM " .$this->dbTable." WHERE IdUser = :IdUser";
        $statement = $this->connection->prepare($deleteQuery);

        $this->IdUser = htmlspecialchars(strip_tags($this->IdUser)); 
        $statement->bindParam(":IdUser", $this->IdUser);

        if ($statement->execute()){
          return true;
        }
        printf("Error: %s\n", $statement->error);

        return false;
      } catch (PDOException $e){
        echo $e->getMessage();
      }
    }
  }
?>