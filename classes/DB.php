<?php

class DB
{
    private static $pdo;
    function __construct()
    {
        $user = $password = '';
        if(!isset($host) && !isset($db)) {
            $config = require 'dbconfig.php';
            extract($config);
        }

        self::$pdo = new PDO('mysql:host='.$host.';dbname='.$db, $user, $password);
    }

    static function getInstance()
    {
        return self::$pdo;
    }
}