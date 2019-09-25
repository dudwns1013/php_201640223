<?php

spl_autoload_register(function($className){
    //echo $className."<br>";
    $filename = $className.".php";
    //echo $filename."<br>";
    if(file_exists($filename)){
        require $filename;
    }
});