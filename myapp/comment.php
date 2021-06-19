<?php
  require_once("const.php");
  require_once("function.php");
  $post_no = $error = $name = $content = '';
  $posts = filter_var_array($_POST);
  $gets = filter_var_array($_GET);
  if (@$posts['submit']) {
    $post_no = strip_tags($posts['post_no']);
    $name = strip_tags($posts['name']);
    $content = strip_tags($posts['content']);
    if (!$name) $error .= '名前がありません。<br>';
    if (!$content) $error .= 'コメントがありません。<br>';
    if (!$error) {
      $pdo = db_connect();
      $sql = "INSERT INTO comment(post_no,name,content) VALUES(?,?,?)";
      $st = $pdo->prepare($sql);
      $st->execute(array($post_no, $name, $content));
      header('Location: blog_index.php');
      exit();
    }
  } else {
    $post_no = strip_tags($gets['no']);
  }
  require 't_comment.php';
?>