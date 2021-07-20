<?php

    require_once("const.php");
    require_once("function.php");

    session_start();
    //POSTのvalidate
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');

    //DB内でPOSTされたメールアドレスを検索
    try {
        $pdo = db_connect();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        var_dump($stmt->errorInfo());
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //emailがDB内に存在しているか確認
        if (!isset($row['email'])) {
            echo 'メールアドレス又はパスワードが間違っています。';
            return false;
        }
        //パスワード確認後sessionにメールアドレスを渡す
        if (password_verify($password, $row['password'])) {
            session_regenerate_id(true); //session_idを新しく生成し、置き換える
            $_SESSION['EMAIL'] = $row['email']; //別ファイルでログイン確かめる用
            echo 'ログインしました';
        } else {
            echo 'メールアドレス又はパスワードが間違っています。';
            return false;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>