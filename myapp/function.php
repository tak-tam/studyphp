<?php
    //db接続
    function db_connect(){
        try {     
            //dbn(DataSourceName)
            $dsn = 'mysql:dbname='. DB_NAME. ';host='. DB_HOST. ';charset='. DB_CHARSET;
                //dbh(DataBaseHndle)
                $dbh = new PDO($dsn, DB_USER, DB_PASS,
                [
                    PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES, false,
                    PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC
                ]);
    
            return $dbh;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    //UPDATE
    function update($posts,$title,$content,$post_no) {
        if($posts['name'] == 'post') {
            //投稿記事の更新の場合
            try {
              $pdo = db_connect();
              $sql = "UPDATE post SET title=$title, content=$content WHERE no=$post_no";
              $st = $pdo->prepare($sql);
              $st->execute();
            //   var_dump($st->errorInfo()); //エラー出力用(常時出力できるようにするとheader()の前で出力するなと怒られる Cannot modify header information - headers already sent by)
          }catch(PDOException $e){
              echo $e->getMessage();
          }
        } else {
            //コメントの更新の場合
            try {
              $pdo = db_connect();
              $sql = "UPDATE comment SET name=$title, content=$content WHERE no=$post_no";
              $st = $pdo->prepare($sql);
              $st->execute();
              //   var_dump($st->errorInfo());
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    //DELETE
    function delete($gets) {
        if($gets['name'] == 'post') {
            //記事投稿の場合
            try {
                //ブログデータベースにphpからアクセス
                $pdo = db_connect();
                //pdoオブジェクトでpostテーブルのデータを入手
                $sql = "SELECT * FROM post";
                $st = $pdo->prepare($sql);
                $st->execute();
                //stに消去する対象のオブジェクトを格納(noはGETでユーザが送った値を使用)
                $sql = "DELETE FROM post WHERE no=?";
                $st = $pdo->prepare($sql);
                // var_dump($gets);    //検証用
                //GETで受け取ったnoの値のデータ消去を実行
                $st->execute(array($gets['no']));
                
            } catch(PDOException $e) {  //エラーが出たら受け取る
                $e->getMessage();
            }
        } else {
            //コメント投稿の場合
            try {
                $pdo = db_connect();
                $sql = "SELECT * FROM comment";
                $st = $pdo->prepare($sql);
                $st->execute();
                $sql = "DELETE FROM comment WHERE no=?";
                $st = $pdo->prepare($sql);
                $st->execute(array($gets['no']));
            } catch(PDOException $e) {
                $e->getMessage();
            }
        }
    }

    //記事投稿の入力チェック
    function post_inputCheck($title, $content) {
        $error = '';
        if (!$title){
            $error .= 'タイトルがありません。<br>';
        }
        if (mb_strlen($title) > 80) {
            $error .= 'タイトルが長すぎます。<br>';
        }
        if (!$content){
            $error .= '本文がありません。<br>';
        }
        return $error;
    }
    //コメント投稿の入力チェック
    function comment_inputCheck($name, $content) {
        $error = '';
        if (!$name) {
            $error .= '名前がありません。<br>';
        } 
        if (!$content) {
            $error .= 'コメントがありません。<br>';
        } 
        return $error;
    }
?>