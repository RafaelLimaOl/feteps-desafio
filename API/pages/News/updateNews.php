<?php 
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  include_once $_SERVER['DOCUMENT_ROOT'].'/Desafio FETEPS/API/config/database.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/Desafio FETEPS/API/controller/user.php';

  $database = new DataBase();
  $db = $database->DbConnection();

  $items = new User($db);
  $statement = $items->updateUser();
  // $itemsCount = $statement->rowCount();


?>