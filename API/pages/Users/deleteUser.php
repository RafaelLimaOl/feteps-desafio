<?php 
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  include_once $_SERVER['DOCUMENT_ROOT'].'/Desafio/API/config/database.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/Desafio/API/controller/user.php';

  $database = new DataBase();
  $db = $database->DbConnection();

  $deleteUser = new User($db);
  $data = json_decode(file_get_contents("php://input"));

  $deleteUser->IdUser = $data->IdUser;

  if ($deleteUser->deleteUser()) {
    echo json_encode(array("Message" => "User Deleted"));
  } else {
    echo json_encode(array("Message" => "User Not Deleted"));
  }

?>