
<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  include_once $_SERVER['DOCUMENT_ROOT'].'/Desafio FETEPS/API/config/database.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/Desafio FETEPS/API/controller/news.php';

  $database = new DataBase();
  $db = $database->DbConnection();

  $read = new News($db);
  $result = $read->getAllNews();
  $itemsCount = $result->rowCount();

  if ($itemsCount > 0) {
    http_response_code(200);
    $readArray = array();
    $readArray['response'] = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $response = array(
        'IdNews' => $IdNews,
        'Header' => $Header,
        'Subtitle' => $Subtitle,
        'Content' => $Content,
        'Image' => $Image,
        'ImageName' => $ImageName,
        'ImageId' => $ImageId,
        'CreatedAt' => $CreatedAt,
        'IdUser' => $IdUser,
      );
      array_push($readArray['response'], $response);
    }
    echo json_encode($readArray);
  }
  else{
    http_response_code(404);
    echo json_encode(
      array(
        "Title"=>"Failed",
        "Message"=>"No Data found"
      )
    );
  }

?>