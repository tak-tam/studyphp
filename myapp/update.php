<?php
  $function = new Blog_function();
  $no = $error = $title = $content = $name = '';
  $posts = filter_var_array($_POST);
  $gets = filter_var_array($_GET);
  if(@$posts['submit']){
      //var_dump($_POST);
    $no = strip_tags($posts['no']);
    $title = $posts['title'];
    $content = $posts['content'];
    $name = $posts['name'];
    //投稿の入力チェック
    $error = $function->post_inputCheck($title, $content);
    if (!$error) {
      if($posts['name'] == 'post') {
        $function->update_post($title,$content,$no);
      }
      if($posts['name'] == 'comment') {
        $function->updatte_comment($title,$content,$no);
      }
      header('Location: blog_index.php');
      exit();
    }
  } else{
      $no = strip_tags($gets['no']);
      $name = strip_tags($gets['name']);
  }
  require 't_update.php';
?>