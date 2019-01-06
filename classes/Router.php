<?php

class Router{
    function __construct()
    {
        $uri = $_SERVER['REQUEST_URI'];

        $pos = strpos($uri, '?');
        if($pos !== false)
        {
            $params = substr($uri, $pos+1);
            parse_str($params, $_GET);
        }
        if($pos == false)
        {
            $pos = strlen($uri);
        }
        $uri = substr($uri, 0, $pos);

        $routes = include('routes.php');

        foreach ($routes as $pattern => $route)
        {
            if(preg_match("~^$pattern~", $uri))
            {
                $result = preg_replace("~^$pattern~", $route, $uri, 1);

                $params = explode('/', $result);

                $controller = ucfirst(array_shift($params))."Controller";
                $action = ucfirst(array_shift($params))."Action";
            }
        }

        if($result == false)
        {
            echo 'URI not found';
            exit;
        }

//        echo 'Controller: '.$controller.'<br>';
//        echo 'Action: '.$action.'<br>';
//        echo 'Parameters: ';
//        foreach ($params as $key => $val) {
//            echo '['.$key.'] = '.$val.' <br> ';
//        }

        $path = 'controllers/'.$controller.'.php';

        $params = array_filter($params, function($value) { return $value !== ''; }); // remove empty values

        if(file_exists($path))
        {
            require $path;
            $controllerObj = new $controller();

//            if(method_exists($controllerObj, $action))
            $controllerObj->$action($params);

        }
        else self::Error404();
    }
    static function Error404()
    {
    //    $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
   //     header('Location:'.$host.'404');
    }
}