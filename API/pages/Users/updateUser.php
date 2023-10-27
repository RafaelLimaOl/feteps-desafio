<?php 
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Allow-Headers: Access-Control-Allow-Methods, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

  include_once $_SERVER['DOCUMENT_ROOT'].'/Desafio/API/config/database.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/Desafio/API/controller/user.php';

  $database = new DataBase();
  $db = $database->DbConnection();

  $updateUser = new User($db);
  $data = json_decode(file_get_contents("php://input"));

  $updateUser->IdUser = $data->IdUser;
  $updateUser->UserName = $data->UserName;
  $updateUser->Email = $data->Email;
  $updateUser->UserPassword = $data->UserPassword;

  if ($updateUser->updateUser()) {
    echo json_encode(array("Message" => "User Updated"));
  } else {
    echo json_encode(array("Message" => "User Not Updated"));
  }

?>