<?php

class View{
    private $path;
    private $data = [];
    private $templates = [];
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
        echo $this->fetch();
    }

    public function import($name, &$template)
    {
        $this->templates[$name] = $template;
    }

    public function fetch()
    {
        foreach ($this->templates as $name => $template) {
            $this->data[$name] = $template->fetch();
        }

        ob_start();
        extract($this->data);
        require $this->path;

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}