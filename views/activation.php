<?php
//require 'db.conf.php';
$msg='';
if(!empty($_GET['code']) && isset($_GET['code']))
{
    $code = $_GET['code'];

    $sign = new Sign();
    $sign = $sign->where(['activation' => $code])->getRow();

//    $sth = $dbh->prepare('SELECT * FROM `signs` WHERE activation=:activation');
//    $sth->bindValue(':activation',$code);
//    $sth->execute();
//    $sign = $sth->fetch(PDO::FETCH_OBJ);

    if(!empty($sign))
    {
        if($sign->status == '0')
        {
            $sign->status = '1';
            $sign->save();
//            $sth = $dbh->prepare("UPDATE signs SET status='1' WHERE activation=:activation");
//            $sth->bindValue(':activation',$code);
//            $sth->execute();
            $msg="Ваша подпись петиции подтверждена успешно!";
        }
        else
        {
            $msg ="Ваша подпись петиции уже была подтверждена, нет необходимости подтверждать её снова.";
        }
    }
    else
    {
        $msg ="Нет такой петиции";
    }
}
?>

<?=$msg?>