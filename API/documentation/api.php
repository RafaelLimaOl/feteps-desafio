<?php
    require $_SERVER['DOCUMENT_ROOT'].'/Desafio/API/vendor/autoload.php';
    spl_autoload_register('autoloader');
    function autoloader(string $name) {

        if (file_exists('../Controller/'.$name.'.php')){
            require_once '../Controller/'.$name.'.php';
        }
    }

    $openapi = \OpenApi\Generator::scan([$_SERVER['DOCUMENT_ROOT'].'/Desafio/API/controller']);

    header('Content-Type: application/json');
    echo $openapi->toJson();
?>