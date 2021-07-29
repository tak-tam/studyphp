<?php
    require_once("function.php");
    $gets = filter_var_array($_GET);
    $function = new BlogFunction();
    if($gets['name'] == 'post') {
        $function->delete_post($gets);
    }
    if($gets['name'] == 'comment') {
        $function->delete_comment($gets);
    }
    require 't_delete.php';
?>