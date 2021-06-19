<?php
  require_once("const.php");
  require_once("function.php");
  $error = $title = $content = '';
  //filter_var_array — 複数の変数を受け取り、オプションでそれらをフィルタリングする(スーパーグローバル変数は変更可能な変数なので使用しない方がいい)
  $posts = filter_var_array($_POST);
  if (@$posts['submit']) {
    $title = $posts['title'];
    $content = $posts['content'];
    if (!$title) $error .= 'タイトルがありません。<br>';
    if (mb_strlen($title) > 80) $error .= 'タイトルが長すぎます。<br>';
    if (!$content) $error .= '本文がありません。<br>';
    if (!$error) {
      $pdo = db_connect();
      $st = $pdo->query("INSERT INTO post(title,content) VALUES('$title','$content')");
      header('Location: blog_index.php');
      exit();
    }
  }
  require 't_post.php';
?>