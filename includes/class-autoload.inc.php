<?php

spl_autoload_register('myAutoLoader');

function myAutoLoader($className) {
    $url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
    if(str_contains($url, "includes") == true) {
        $path = "../classes/";
    } else {
        $path = "classes/";
    }

    $ext = ".classes.php";
    
    require_once strtolower($path . $className . $ext);
}