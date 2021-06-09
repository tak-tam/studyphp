<?php
  $pdo = new PDO("mysql:dbname=blog;host=mysql;char=utf8", "root", "root");
  $st = $pdo->query("SELECT * FROM post ORDER BY no DESC");
  $posts = $st->fetchAll();
  for ($i = 0; $i < count($posts); $i++) {
    $st = $pdo->query("SELECT * FROM comment WHERE post_no={$posts[$i]['no']} ORDER BY no DESC");
    $posts[$i]['comments'] = $st->fetchAll();
  }
  require 't_index.php';
?>