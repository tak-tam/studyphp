<?php
session_start();
    // echo var_dump($_SESSION);
  if(!isset($_SESSION["EMAIL"])) {
    header("Location: t_login.php");
  }