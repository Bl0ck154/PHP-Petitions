<?php

class HomeController
{
    function __call($name, $arguments)
    {
        if(preg_match("~^([-_a-zA-Z0-9]+)Action~", $name))
        {
            if(isset($arguments))
                extract($arguments);

//        if(isset($_GET))
//            extract($_GET);

            $actionName = stristr($name, 'Action', true);

            $modelPath = '../models/model'.$actionName.'.php';

            if(file_exists($modelPath)) {
                include $modelPath;
                $model = new $actionName();
            }

            $actionName = lcfirst($actionName);

            $view = new View($actionName);
            $view->display();
        }
        else Router::Error404();
    }

//    function PetitionAction()
//    {
//        $view = new View('petition');
//        $view->display();
//    }
//
//    function AddAction()
//    {
//        $view = new View('add');
//        $view->display();
//    }
//
//    function SignAction()
//    {
//        $view = new View('sign');
//        $view->display();
//    }
//
//    function ActivationAction()
//    {
//        $view = new View('activation');
//        $view->display();
//    }
}