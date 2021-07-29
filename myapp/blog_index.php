<?php
  require_once("function.php");
  $blogFunction = new BlogFunction();
  //sqlはそのまま実行するよりprepareを使用した方が安全
  $sql = "SELECT * FROM post ORDER BY no DESC";
  $pdo = $blogFunction->getPdo();
  $st = $pdo->prepare($sql);
  $st->execute();
  $posts = $st->fetchAll();
  for ($i = 0; $i < count($posts); $i++) {
    $sql = "SELECT * FROM comment WHERE post_no={$posts[$i]['no']} ORDER BY no DESC";
    $st = $pdo->prepare($sql);
    $st->execute();
    $posts[$i]['comments'] = $st->fetchAll();
  }
  require 't_index.php';
?>