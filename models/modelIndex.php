<?php

    new DB();

    $sql = "SELECT id, title, description,
                (select count(*) from signs
                where status='1' AND signs.petition_id = petitions.id) signs
                FROM petitions
                LIMIT 3";

    $sth = DB::getInstance()->prepare($sql);
    $sth->execute();
    $petitions = $sth->fetchAll(PDO::FETCH_OBJ);

    function shortDescription($string)
    {
        $string = strip_tags($string);
        if (strlen($string) > 500) {

            $stringCut = substr($string, 0, 500);
            $endPoint = strrpos($stringCut, ' ');

            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $string .= '...';
        }
        echo $string;
    }