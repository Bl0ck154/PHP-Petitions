<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
    . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$pos = strrchr ($url, '/');
$url = str_replace($pos, '/', $url);
$GLOBALS['url'] = $url;


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