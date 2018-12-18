<?php
if(!empty($_POST)) {
    $petition_id = $_GET['id'];
    if(isset($petition_id)) {

 //       require 'db.conf.php';
        // Проверить есть ли автор по $_POST['email']

        require 'check_user.php';
        $user = checkAuthor();

        $email = $_POST['email'];
        $activation = md5($email.time());

        $sign = new Sign();
        $sign->petition_id = $petition_id;
        $sign->user_id = $user->id;
        $sign->status = '0';
        $sign->activation = $activation;
        $sign->save();

//        $sth = $dbh->prepare('INSERT INTO `signs` (petition_id, user_id, status, activation)
//VALUES (:petition_id, :user_id, :status, :activation)');
//        $sth->bindValue(':petition_id', $petition_id);
//        $sth->bindValue(':user_id', $user->id);
//        $sth->bindValue(':status', '0');
//        $sth->bindValue(':activation', $activation);
//        $res = $sth->execute();

        $to = $email;

        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = 's04.webhost1.ru';
        $mail->SMTPAuth = true;
        $mail->Username = 'petitions@itstep.fun'; // логин
        $mail->Password = '9300459'; // пароль
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('petitions@itstep.fun'); // Ваш Email
        $mail->addAddress($to); // Email получателя

        $url = $_SERVER['HTTP_HOST'];
        $mail->isHTML(true);
        $mail->Subject = 'Petition sign confirmation';
        $mail->Body    = '<html>
<body>Please, confirm your sign.
<br/>Click the link: <br/>
<a href="http://'.$url.'/activation/'.$activation.'">'.$url.'/activation/'.$activation.'</a>
</body>
</html>';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Confirmation mail was sent! Please check your Email.';
        }
    }
}
?>