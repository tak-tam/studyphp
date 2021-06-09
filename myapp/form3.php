<?php
    session_start();

    if(isset($_POST['token'], $_SESSION['token']) && ($_POST['token'] === $_SESSION['token'])){
        unset($_SESSION['token']);

        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $subject = $_SESSION['subject'];
        $body = $_SESSION['body'];
        
        $dsn = 'mysql:dbname=contact_form;host=mysql;char=utf8';
        $user = 'root';
        $password = 'root';

        $dbh = new PDO($dsn, $user, $password);
        $dbh->query('SET NAMES utf8');
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $sql = 'INSERT INTO inquiries (name, email, subject, body) VALUES (?, ?, ?, ?)';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $name, PDO::PARAM_STR);
        $stmt->bindValue(2, $email, PDO::PARAM_STR);
        $stmt->bindValue(3, $subject, PDO::PARAM_STR);
        $stmt->bindValue(4, $body, PDO::PARAM_STR);
        $stmt->execute();

        $dbh = null;

        $_SESSION = array();
        if(ini_get("session.use_cookies")){
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 4200, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
            session_destroy();
        }
    }else{
        header('Location:http://localhost:8080/form1.php');
        exit();
    }
?>

<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>完了画面-お問い合わせ</title>
    </head>
    <body>
        <p>お問い合わせありがとうございます。</p>
    </body>
</html>