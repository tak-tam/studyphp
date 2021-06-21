<?php
  require_once("const.php");
  require_once("function.php");
  $post_no = $error = $title = $content = '';
  $posts = filter_var_array($_POST);
  $gets = filter_var_array($_GET);
  if(@$posts['submit']){
      //var_dump($_POST);
    $post_no = strip_tags($posts['no']);
    $title = $posts['title'];
    $content = $posts['content'];
    //投稿の入力チェック
    $error = post_inputCheck($title, $content);
    if (!$error) {
        //var_dump($_POST);
        try {
          $pdo = db_connect();
          $sql = "UPDATE post SET title=$title, content=$content WHERE no=$post_no";
          $st = $pdo->prepare($sql);
          $st->execute();
        //   var_dump($st->errorInfo()); //エラー出力用(常時出力できるようにするとheader()の前で出力するなと怒られる Cannot modify header information - headers already sent by)
      }catch(PDOException $e){
          echo $e->getMessage();
      }
      header('Location: blog_index.php');
      exit();
    }
  } else{
      $post_no = strip_tags($gets['no']);
  }
  require 't_update.php';
?>