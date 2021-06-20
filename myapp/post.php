<?php
  require_once("const.php");
  require_once("function.php");
  $error = $title = $content = '';
  //filter_var_array — 複数の変数を受け取り、オプションでそれらをフィルタリングする(スーパーグローバル変数は変更可能な変数なので使用しない方がいい)
  $posts = filter_var_array($_POST);
  if (@$posts['submit']) {
    $title = $posts['title'];
    $content = $posts['content'];
    //記事投稿の入力チェック
    $error = post_inputCheck($title, $content);
    //投稿内容をdbに登録する処理
    if (!$error) {
      $pdo = db_connect();
      $sql = "INSERT INTO post(title,content) VALUES('$title','$content')";
      $st = $pdo->prepare($sql);
      $st->execute();
      header('Location: blog_index.php');
      exit();
    }
  }
  require 't_post.php';
?>