<?php

    $petition = new Petition();
    $petitions = $petition
        ->select('id', 'title', 'description',
'(select count(*) from signs where status=\'1\' AND signs.petition_id = petitions.id) signs')
        ->limit()
        ->getRows();

//    require 'db.conf.php';
//    $sql = "SELECT id, title, description,
//            (select count(*) from signs
//            where status='1' AND signs.petition_id = petitions.id) signs
//            FROM petitions
//            LIMIT 3";
//
//    $sth = $dbh->prepare($sql);
//    $sth->execute();
//    $petitions = $sth->fetchAll(PDO::FETCH_OBJ);

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
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Petitions</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-around">
            <a class="btn btn-primary" href="add.php">Add petition</a>
        </div>

        <div>
            <?php
           // $petition = new Petition();
           // print_r($petition->where(['id' => '2', 'title' => 'Second'])
          //  ->execute());

//            $petition->select('id','title');
//            print_r($petition->execute());

 //           $petition->remove();
//            $petition->title = "last petition";
//            $petition->author_id = 3;
//            $petition->save();
            ?>
        </div>

        <? foreach ($petitions as $petition) {?>
        <div class="petition-block" id="petition-<?=$petition->id?>">
            <div class="card m-4">
                <div class="card-body row">
                    <div class="col-sm-12">
                        <div class="d-flex justify-content-between">
                            <div class="h5">
                                <?=$petition->title?>
                            </div>
                            <div class="card-signs">
                                Signs: <?=$petition->signs?>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="card-message">
                                <?shortDescription($petition->description)?>
                            </div>
                            <div>
                                <a class="btn btn-outline-primary btn-sm" href="petition.php?id=<?=$petition->id?>">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?}?>

    </div>
</body>
</html>