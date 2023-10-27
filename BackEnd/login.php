<?php

	session_start();
  include_once("../API/config/database.php");

  if ( isset($_POST['UserName']) && isset($_POST['Email']) && isset($_POST['UserPassword']) ) {

    function validData($data){

      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      
      return $data;
    }
    
    $UserName = validData($_POST['UserName']);
    $Email = validData($_POST['Email']);
    $UserPassword = validData($_POST['UserPassword']);
    $HashPassword = md5($UserPassword);
    
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

      $data = json_decode(file_get_contents("http://localhost/Desafio/API/pages/Users/loginUser.php?name=".$UserName."&email=".$Email."&password=".$UserPassword, false, $context));

      if ($data) {
        
        if (!isset($_SESSION)) {
          session_start();
        }

        $_SESSION['UserName'] = $data['UserName'];

        header("Location: ../FrontEnd/admin-page.html");
      } else { 
        header("Location: ../FrontEnd/form.php");
       }

    }
  } else {
    header("Location: ../FrontEnd/form.php");
  }

?>

