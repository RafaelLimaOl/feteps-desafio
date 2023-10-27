<?php 
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  include_once $_SERVER['DOCUMENT_ROOT'].'/Desafio/API/config/database.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/Desafio/API/controller/user.php';

  $database = new DataBase();
  $db = $database->DbConnection();

  $loginUser = new User($db);

  $loginUser->UserName = isset($_GET['UserName']) ? $_GET['UserName']: die();
  $loginUser->Email = isset($_GET['Email']) ? $_GET['Email']: die();
  $loginUser->UserPassword = isset($_GET['UserPassword']) ? $_GET['UserPassword']: die();
  
  $loginUser->loginUser();

  $loginArray = [
    "IdUser" => $loginUser->IdUser,
    "UserName" => $loginUser->UserName,
    "Email" => $loginUser->Email,
    "UserPassword" => $loginUser->UserPassword,
  ];

  print_r(json_encode($loginArray));

?>