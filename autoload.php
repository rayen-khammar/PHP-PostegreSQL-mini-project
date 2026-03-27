<?php
function load($className){
    $path="classes/".$className.".php"; 
    if(file_exists($path)){
        require_once($path);}
    else{
        die("Autoload error: Class $className not found.");}
}
spl_autoload_register('load');

