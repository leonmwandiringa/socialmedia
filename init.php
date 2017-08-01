<?php

//the only file which will be included in all files using autoload function
session_start();

// diplaying errors


$GLOBALS['cred'] = array(


    "mysql"=>array(

        "host"=>"127.0.0.1",
        "username"=> "mogino",
        "password"=> "Mogino101",
        "dbname"=> "mogino"
    )

);

spl_autoload_register(function($class){

    require_once "classes/".$class.".php";

});

require_once "includes/constants.php";

 errors::display();


?>