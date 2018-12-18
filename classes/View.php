<?php

class View{
    private $path;
    private $data = [];
    public function __construct($name)
    {
        $this->path = 'views/'.$name.'.php';
        if(!file_exists($this->path)) {
            Router::Error404();
            die();
        }
         //   throw new Error($this->path.' not exists!');
    }

    public function assign($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function display()
    {
        extract($this->data);
        require $this->path;
    }
}