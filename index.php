<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

function __autoload($class)
{
    $path = 'classes/'.$class.'.php';
    if(file_exists($path)) {
        require $path;
    }

    $path = 'classes/orm/'.$class.'.php';
    if(file_exists($path)) {
        require $path;
    }
}

$Router = new Router();