<?php
    $gets = filter_var_array($_GET);
    require_once("const.php");
    require_once("function.php");
<<<<<<< HEAD
    if($gets['name'] == 'post') {
        delete_post($gets);
    }
    if($gets['name'] == 'comment') {
        delete_comment($gets);
    }
=======
    delete($gets);
>>>>>>> 24f8e77fff239596cdab28f379b90393436c6aea
    require 't_delete.php';
?>