<?php
    $gets = filter_var_array($_GET);
    require_once("const.php");
    require_once("function.php");
    delete($gets);
    require 't_delete.php';
?>