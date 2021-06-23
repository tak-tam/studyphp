<?php
  require_once("const.php");
  require_once("function.php");
  $post_no = $error = $title = $content = $name = '';
  $posts = filter_var_array($_POST);
  $gets = filter_var_array($_GET);
  if(@$posts['submit']){
      //var_dump($_POST);
    $post_no = strip_tags($posts['no']);
    $title = $posts['title'];
    $content = $posts['content'];
    $name = $posts['name'];
    //投稿の入力チェック
    $error = post_inputCheck($title, $content);
    if (!$error) {
      update($posts,$title,$content,$post_no);
      header('Location: blog_index.php');
      exit();
    }
  } else{
      $post_no = strip_tags($gets['no']);
      $name = strip_tags($gets['name']);
  }
  require 't_update.php';
?>