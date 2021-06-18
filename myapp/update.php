<?php
  require_once("const.php");
  require_once("function.php");
  $post_no = $error = $title = $content = '';
  if (@$_POST['submit']) {
    $no = strip_tags($_POST['no']);
    $title = $_POST['title'];
    $content = $_POST['content'];
    if (!$title) $error .= 'タイトルがありません。<br>';
    if (mb_strlen($title) > 80) $error .= 'タイトルが長すぎます。<br>';
    if (!$content) $error .= '本文がありません。<br>';
    if (!$error) {
      $pdo = db_connect();
      $st = $pdo->prepare("UPDATE post SET title=?, content=? WEHRE no=?");
      $st->execute(array($_POST['title'], $_POST['content'], $_POST['no']));
      header('Location: blog_index.php');
      exit();
    } else {
        $post_no = strip_tags($_GET['no']);
    }
  }
  require 't_update.php';
?>