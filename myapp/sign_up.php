<?php 
    require_once("const.php");
    require_once("function.php");

    
    $pdo = db_connect();
    try {
        //POSTのValidate
        $user_name = filter_input(INPUT_POST, 'user_name');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        //userのチェック
        if(is_null($user_name)) {
            throw new Exception("user error");
        }
        //emailのチェック
        $emailIsNull = is_null($email); //読みやすくする用↓
        $emailIsFalse = $email === false;
        if($emailIsNull || $emailIsFalse) {
            throw new Exception("email error");
        }
        //passwordのチェック
        if(is_null($password)) {
            throw new Exception("password error");
        }

        //パスワードの正規表現
        if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            throw new Exception("hogehoge");
        }

        //登録処理
        $stmt = $pdo->prepare("insert into users (user_name, email, password) values (?, ?, ?)");
        var_dump($email);
        $stmt->execute([$user_name, $email, $password]);
        // var_dump($pdo->errorInfo());
        //echo '登録完了';  フラッシュメッセージに預けた文をリダイレクト後に表示するようにしたらOK

        // header('Location: t_login.php');

    } catch(Exception $e) {
        echo $e->getMessage();
        exit();
    }

?>