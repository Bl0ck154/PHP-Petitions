<?php

if(!empty($_GET))
{
    $petitionObj = new Petition();
    $petition = $petitionObj->select('petitions.id as pid', 'title', 'description',
'(select count(*) from signs
 where status=\'1\' AND signs.petition_id = petitions.id) signs',
        'users.email')
        ->join(new User, 'id', 'author_id')
        ->where(['petitions.id' => $_GET['id']])
        ->getRow();

//    require 'db.conf.php';
//
//    $sql = "SELECT petitions.id as pid, title, description,
//(select count(*) from signs
// where status='1' AND signs.petition_id = petitions.id) signs,
//        users.email
//        FROM `petitions`
//        JOIN users ON users.id=author_id
//        WHERE petitions.id=:id";
//
//    $sth = $dbh->prepare($sql);
//    $sth->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
//    $sth->execute();
//    $petition = $sth->fetch(PDO::FETCH_OBJ);
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>"<?=$petition->title?>" Petition</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-around">
            <a href="http://<?=$_SERVER['HTTP_HOST']?>">Back to petitions list</a>
        </div>
        <div class="row">
            <div class="col-md-12 petition">
                <h2>Petition "<?=$petition->title?>"</h2>
                <div><?=$petition->description?></div>
                <div class="author h6">Author: <?=$petition->email?></div>
                <div class="col-md-4 offset-md-8">
                <div class="count h6">Signs: <?=$petition->signs?></div>

                <form method="post" action="sign.php?id=<?=$petition->pid?>">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>

                    <input type="submit" value="Sign" class="btn">
                </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>