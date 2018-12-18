<?php

function checkAuthor($dbh = null)
{
    $email = $_POST['email'];
    if(!checkEmail($email))
    {
        echo 'incorrect email '.$email;
        exit(0);
    }
    $user = new User();
    $user = $user->where(['email' => $email])->getRow();
//    $sth = $dbh->prepare('SELECT * FROM `users` WHERE email=:email');
//    $sth->bindValue(':email',$email);
//    $sth->execute();
//    $user = $sth->fetch(PDO::FETCH_OBJ);

    if(empty($user))
    {
        $user = new User();
        $user->email = $email;
        $user->save();

//        $sth = $dbh->prepare('INSERT INTO `users` (email) VALUES (:email)');
//        $sth->bindValue(':email',$email);
//        $res = $sth->execute();

//        $user = new stdClass();
        $user->id = $user->lastInsertId();
    }
    return $user;
}

function checkEmail($email)
{
    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
    return (filter_var($email, FILTER_VALIDATE_EMAIL));
}