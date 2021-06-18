<?php
    try {
        require_once("const.php");
        require_once("function.php");
        //ブログデータベースにphpからアクセス
        $pdo = db_connect();
        //pdoオブジェクトでpostテーブルのデータを入手
        $st = $pdo->query("SELECT * FROM post");
        //変数postにpostテーブルの値を配列で格納
        $posts = $st->fetchAll();   //←これスーパー無駄かも
        //stに消去する対象のオブジェクトを格納(noはGETでユーザが送った値を使用)
        $st = $pdo->prepare("DELETE FROM post WHERE no=?");
        var_dump($_GET);    //検証用
        //GETで受け取ったnoの値のデータ消去を実行
        $st->execute(array($_GET['no']));
        
    } catch(PDOException $e) {  //エラーが出たら受け取る
        var_dump($e);
    }

    require 't_delete.php';
?>