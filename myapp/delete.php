<?php
    $gets = filter_var_array($_GET);
    require_once("const.php");
    require_once("function.php");
    if($gets['name'] == 'post') {
        delete_post($gets);
    }
    if($gets['name'] == 'comment') {
        delete_comment($gets);
    }
    require 't_delete.php';
?>