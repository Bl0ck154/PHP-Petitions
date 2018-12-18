<?php

try {
    $dbh = new PDO('mysql:host=91.217.9.155;dbname=krivbass_itstep', 'krivbass_itstep', '9300459');
} catch (PDOException $e){
    echo $e->getMessage();
    exit();
}
