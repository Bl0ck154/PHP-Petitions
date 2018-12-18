<?php
 //   var_dump($_POST);
    if(!empty($_POST)) {
        if(isset($_POST['title']) ){

//            require 'db.conf.php';
            // Проверить есть ли автор по $_POST['email']

            require 'check_user.php';
            $user = checkAuthor();

            $petition = new Petition();
            $petition->title = $_POST['title'];
            $petition->description = $_POST['description'];
            $petition->author_id = $user->id;
            $petition->save();

//            $sth = $dbh->prepare('INSERT INTO `petitions` (title, description, author_id) VALUES (:title, :description, :author_id)');
//            $sth->bindValue(':title',$_POST['title']);
//            $sth->bindValue(':description',$_POST['description']);
//            $sth->bindValue(':author_id',$user->id);
//
//            $res = $sth->execute();

//            echo 'Petition #'.$dbh->lastInsertId().' was added!';
            echo 'Petition #'.$petition->lastInsertId().' was added!';
        }

    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add petition</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-md-offset-3">
            <a href="http://<?=$_SERVER['HTTP_HOST']?>">Index</a>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <form method="post" action="add.php">

                <div class="form-group">
                    <input type="text" class="form-control" name="title" placeholder="Title">
                </div>

                <div class="form-group">
                    <textarea name="description" class="form-control" placeholder="Description"></textarea>
                </div>

                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>

                <button class="btn btn-primary" type="submit">Add</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="../js/main.js"></script>
</body>
</html>