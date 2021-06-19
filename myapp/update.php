<?php
  require_once("const.php");
  require_once("function.php");
  $post_no = $error = $title = $content = '';
  $posts = filter_var_array($_POST);
  $gets = filter_var_array($_GET);
  if(@$posts['submit']){
      //var_dump($_POST);
    // $post_no = strip_tags($_POST['no']); //要らない
    $title = $posts['title'];
    $content = $posts['content'];
    if (!$title){
        $error .= 'タイトルがありません。<br>';
    }
    if (mb_strlen($title) > 80) {
        $error .= 'タイトルが長すぎます。<br>';
    }
    if (!$content){
        $error .= '本文がありません。<br>';
    }
    if (!$error) {
        //var_dump($_POST);
        try {
          $pdo = db_connect();
          $st = $pdo->prepare("UPDATE post SET title=?, content=? WHERE no=?");
          $st->execute(array($posts['title'], $posts['content'], $posts['no']));
        //   var_dump($st->errorInfo()); //エラー出力用(常時出力できるようにするとheader()の前で出力するなと怒られる Cannot modify header information - headers already sent by)
      }catch(Exception $e){
          var_dump($e);
      }
      header('Location: blog_index.php');
      exit();
    }
  } else{
      $post_no = strip_tags($gets['no']);
  }
  require 't_update.php';
?>