<?php 
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  
  include_once $_SERVER['DOCUMENT_ROOT'].'/Desafio/API/config/database.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/Desafio/API/controller/user.php';

  $database = new DataBase();
  $db = $database->DbConnection();

  $authToken = new User($db);

  if (!$authToken->AuthUser()) {
    http_response_code(404);
    echo json_encode([
      "message" => "Can't create Auth Token",
    ]);  
  } else {
    http_response_code(200);
    echo json_encode($authToken->AuthUser());
  }

?>