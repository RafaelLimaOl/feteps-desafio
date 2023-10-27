<?php 
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  include_once $_SERVER['DOCUMENT_ROOT'].'/Desafio FETEPS/API/config/database.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/Desafio FETEPS/API/controller/news.php';

  $database = new DataBase();
  $db = $database->DbConnection();

  $items = new News($db);
  // $statement = $items->createNews();
  $itemsCount = $statement->rowCount();


?>