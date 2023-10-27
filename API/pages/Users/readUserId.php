<?php 
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  include_once $_SERVER['DOCUMENT_ROOT'].'/Desafio/API/config/database.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/Desafio/API/controller/user.php';

  $database = new DataBase();
  $db = $database->DbConnection();

  $readId = new User($db);

  $readId->IdUser = isset($_GET['id']) ? $_GET['id']: die();

  $readId->getUserById();

  $arrayUser = array(
    'IdUser' => $readId->IdUser,
    'UserName' => $readId->UserName,
    'Email' => $readId->Email,
    'UserPassword' => $readId->UserPassword,
  );

  print_r(json_encode($arrayUser));

?>
