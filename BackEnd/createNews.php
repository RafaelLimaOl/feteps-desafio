<?php

  include_once("../API/config/database.php");

  if ( isset($_POST['Header']) && isset($_POST['Subtitle']) && isset($_POST['Category']) && isset($_POST['Content']) && isset($_POST['Image']) && isset($_POST['ImageName']) ) {

  function validData($data){

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    
    return $data;
  }
  
  $Header = validData($_POST['Header']);
  $Subtitle = validData($_POST['Subtitle']);
  $Category = validData($_POST['Category']);
  $Content = validData($_POST['Content']);
  $Image = validData($_POST['Image']);
  $ImageName = validData($_POST['ImageName']);
  
  if ((empty($UserName))) {
    header("Location: ../FrontEnd/form.php?loginError=Nome é obrigatório!");
  } else if (empty($Email)) {
    header("Location: ../FrontEnd/form.php?loginError=Email é obrigatório!");
  } else if (empty($UserPassword)){
    header("Location: ../FrontEnd/form.php?loginError=Senha é obrigatória!");
  }
  else {

    $options = [
      "http" => [
        "method" => "PATCH",
        "header" => "Content-type: application/json; charset=UTF-8",
      ]
    ];


    $context = stream_context_create($options);

    $data = "http://localhost/Desafio/API/pages/News/createNews.php?name=".$UserName."&email=".$Email."&password=".$UserPassword;

  }
}

?>