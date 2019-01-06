<?php

class HomeController
{
    function __call($name, $arguments)
    {
        if(preg_match("~^([-_a-zA-Z0-9]+)Action~", $name))
        {
            if(isset($arguments))
                extract($arguments);

//        if(isset($_GET))
//            extract($_GET);

            $actionName = stristr($name, 'Action', true);

            $modelPath = '../models/model'.$actionName.'.php';

            if(file_exists($modelPath)) {
                include $modelPath;
                $model = new $actionName();
            }

            $actionName = lcfirst($actionName);

            $view = new View($actionName);
            $view->display();
        }
        else Router::Error404();
    }

    function IndexAction($params)
    {
        $params = $this->checkParams($params);

        $petition = new Petition();
        $petitions_count = $petition
            ->select('id', 'title', 'description',
                '(select count(*) from signs where status=\'1\' AND signs.petition_id = petitions.id) signs')
            ->getRowsCount();

        $petitions_on_page = 3;
        $total_pages = ceil($petitions_count/$petitions_on_page);

        session_start();
        if($params['id'] > 0) {
            $page = $params['id'] - 1;
        } else {
            $page = array_key_exists('page',$_SESSION) ? $_SESSION['page'] : 0;
        }

        if($page > $total_pages)
            $page = $total_pages;

        $_SESSION['page'] =  $page;

        $petitions = $petition
            ->limit($page * $petitions_on_page, $petitions_on_page)
            ->getRows();

        function shortDescription($string, $length = 700)
        {
            $string = strip_tags($string);
            if (strlen($string) > $length) {

                $stringCut = substr($string, 0, $length);
                $endPoint = strrpos($stringCut, ' ');

                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                $string .= '...';
            }
            return $string;
        }

        foreach ($petitions as $petition) {
            $petition->shortDescription = shortDescription($petition->description);
        }

        $view = new View('index');
        $view->assign('petitions', $petitions);
        $view->assign('current_page', $page+1);
        $view->assign('total_pages', $total_pages);
        $message = '';
        if(array_key_exists('message',$_SESSION)) {
            $message = $_SESSION['message'];
            $_SESSION['message'] = '';
        }
        $view->assign('sessionMessage', $message);

        $title = 'Petitions site';

        $layout = new View('layout');
        $layout->assign('title', $title);
        $layout->assign('logged', isset($_COOKIE['hash']));
        $layout->import('content', $view);
        $layout->display();
    }

    function checkParams($params)
    {
        if(empty($params)) {
            if(!empty($_GET)) {
                $params = $_GET;
            } else {
                return false;
            }
        } else {
            $params['id'] = $params[0];
        }
        return $params;
    }

    function PetitionAction($params)
    {
        $params = $this->checkParams($params);

        $petitionObj = new Petition();
        $petition = $petitionObj->select('petitions.id as pid', 'title', 'description',
            '(select count(*) from signs
 where status=\'1\' AND signs.petition_id = petitions.id) signs',
            'users.email')
            ->join(new User, 'id', 'author_id')
            ->where(['petitions.id' => $params['id']])
            ->getRow();

        if(!$petition) {
            return header('Location: http://'.$_SERVER['HTTP_HOST']);
        }

        $view = new View('petition');
        $view->assign('petition', $petition);
        $view->assign('logged', isset($_COOKIE['hash']));

        $title = $petition->title . ' Petition';

        $layout = new View('layout');
        $layout->assign('title', $title);
        $layout->assign('logged', isset($_COOKIE['hash']));
        $layout->import('content', $view);
        $layout->display();
    }

    function getAuthorizedUser()
    {
        if(isset($_COOKIE['hash'])) {
            $auth = new Auth();
            $auth = $auth->where(['code' => $_COOKIE['hash']])->getRow();
            if($auth) {
                $user = new User();
                $user = $user->where(['id' => $auth->user_id])->getRow();
                if($user) {
                    return $user;
                }
            }
        }
        return false;
    }

    function sendEmail($to, $subject, $body)
    {
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

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        } else {
            return true;
        }
    }
    function SignAction($params)
    {
        $params = $this->checkParams($params);

        $user = $this->getAuthorizedUser();
        if(!$user) {
            return header('Location: auth.php');
        }

        $petition_id = $_GET['id'];
        if (isset($petition_id)) {
            $email = $user->email;
            $activation = md5($email . time());

            $sign = new Sign();
            $sign->petition_id = $petition_id;
            $sign->user_id = $user->id;
            $sign->status = '0';
            $sign->activation = $activation;
            $sign->save();

            $url = $_SERVER['HTTP_HOST'];
            $res = $this->sendEmail($email, 'Petition sign confirmation',
                '<html>
<body>Please, confirm your sign.
<br/>Click the link: <br/>
<a href="http://' . $url . '/activation/' . $activation . '">' . $url . '/activation/' . $activation . '</a>
</body>
</html>');
            if($res) {
                echo 'Confirmation mail was sent! Please check your Email.';
            }
        }
    }

    function LogoutAction($params)
    {
        if(isset($_COOKIE['hash'])) {
            $auth = new Auth();
            $auth->where(['code' => $_COOKIE['hash']])->remove();
            setcookie('hash', '', time() - 300);
            header('Location: index.php');
        }
    }

    function AuthAction($params)
    {
        if(isset($_COOKIE['hash'])) {
            header('Location: index.php');
        }

        $params = $this->checkParams($params);

        function generateCode($length=6) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
            $code = "";
            $clen = strlen($chars) - 1;
            while (strlen($code) < $length) {
                $code .= $chars[mt_rand(0,$clen)];
            }
            return $code;
        }

        function setHash($user_id) {
            $hash = md5(generateCode(10));
            $auth = new Auth();
            $auth->where(['user_id' => $user_id])->getRow();
            $auth->user_id = $user_id;
            $auth->code = $hash;
            if($auth->save()) {
                setcookie('hash', $hash, time()+60*60*24*30);
            } else { echo 'hash set error'; }
        }

        $email = '';
        if(!empty($_POST)) {
            $email = $_POST['email'];
            if(!empty($email) && !empty($_POST['password'])) {
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo 'Incorrect email';
                    return header('Location: index.php');
                }
                $user = new User();
                $user = $user->where(['email' => $email])->getRow();
                if(!$user) {
                    // registration
                    $user = new User();
                    $user->email = $email;
                    $user->password = md5($_POST['password']);
                    if($user->save()) {
                        setHash($user->lastInsertId());
                        session_start();
                        $_SESSION['message'] = 'You have registered new account!';
                        return header('Location: http://'.$_SERVER['HTTP_HOST']);
                    }
                } else {
                    if($user->password === md5($_POST['password'])) {
                        setHash($user->id);
                        session_start();
                        $_SESSION['message'] = 'Login success!';
                        return header('Location: http://'.$_SERVER['HTTP_HOST']);
                    } else {
                        echo 'Wrong password!';
                    }
                }
            }
        }

        $view = new View('auth');
        $view->assign('email', $email);

        $title ='Auth page';

        $layout = new View('layout');
        $layout->assign('title', $title);
        $layout->assign('logged', isset($_COOKIE['hash']));
        $layout->import('content', $view);
        $layout->display();
    }

    function AddAction($params)
    {
        $params = $this->checkParams($params);

        $user = $this->getAuthorizedUser();
        if(!$user) {
            return header('Location: auth.php');
        }

        if(!empty($_POST)) {
            if(isset($_POST['title']) && isset($_POST['description'])) {
                $petition = new Petition();
                $petition->title = $_POST['title'];
                $petition->description = $_POST['description'];
                $petition->author_id = $user->id;
                $petition->save();

                session_start();
                $_SESSION['message'] = 'Petition #'.$petition->lastInsertId().' was added!';
                return header('Location: http://'.$_SERVER['HTTP_HOST']);
            }
        }

        $view = new View('add');

        $title ='Add petition';

        $layout = new View('layout');
        $layout->assign('title', $title);
        $layout->assign('logged', isset($_COOKIE['hash']));
        $layout->import('content', $view);
        $layout->display();
    }

    function ActivationAction()
    {
        $msg='';
        if(!empty($_GET['code']) && isset($_GET['code']))
        {
            $code = $_GET['code'];

            $sign = new Sign();
            $sign = $sign->where(['activation' => $code])->getRow();

            if(!empty($sign))
            {
                if($sign->status == '0')
                {
                    $sign->status = '1';
                    $sign->save();
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

            echo $msg;
        }
    }

    function RecoverAction($params)
    {
        if(isset($_COOKIE['hash'])) {
            header('Location: index.php');
        }

        $params = $this->checkParams($params);

        $email = '';
        if($_POST && array_key_exists('email', $_POST)) {
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo 'Incorrect email';
            } else {
                $user = new User();
                $user = $user->where(['email' => $email])->getRow();
                if (!$user) {
                    echo 'User not registered';
                } else {
                    $url = $_SERVER['HTTP_HOST'];
                    $activation = md5($email . time());

                    $recover = new Recover();
                    $recover->user_id = $user->id;
                    $recover->code = $activation;
                    if(!$recover->save()) {
                        throw new Exception('recover save error');
                    }

                    $res = $this->sendEmail($email, 'Password recover',
                        '<html>
<body>Please, click the link to set new password
<br/>Click the link: <br/>
<a href="http://' . $url . '/recover/' . $activation . '">' . $url . '/recover/' . $activation . '</a>
</body>
</html>');
                    if($res) {
                        echo 'Please check your Email.';
                    }
                }
            }
        } elseif(!empty($params) && !empty($params['id'])) {
            if($_POST) {
                if($_POST['password'] != $_POST['cpassword']) {
                    echo 'Password must be the same!';
                    $recover = true;
                } else {
                    session_start();
                    if($_SESSION['user_id']) {
                        $user = new User($_SESSION['user_id']);
                        $user->password = md5($_POST['password']);
                        if($user->save()) {
                            $_SESSION['message'] = 'Password successfully changed!';
                            return header('Location: http://'.$_SERVER['HTTP_HOST']);
                        }
                    }
                }
            } else {
                $recover = new Recover();
                $recover = $recover->where(['code' => $params['id']])->getRow();

                if ($recover) {
                    session_start();
                    $_SESSION['user_id'] = $recover->user_id;
                    $recover->remove();
                }
            }
            if ($recover) {
                $view = new View('newpassword');
                $view->display();
                return;
            }
        }

        $view = new View('recover');
        $view->assign('email',$email);

        $title ='Recover password';

        $layout = new View('layout');
        $layout->assign('title', $title);
        $layout->assign('logged', isset($_COOKIE['hash']));
        $layout->import('content', $view);
        $layout->display();
    }
}