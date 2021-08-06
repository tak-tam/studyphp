<?php
    session_start();
    $_SESSION = array();
    session_destroy();
    require_once("redirect_login.php");