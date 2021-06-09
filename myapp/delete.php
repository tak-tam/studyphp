<?php
    try {

        $pdo = new PDO("mysql:dbname=blog;host=mysql;char=utf8", "root", "root");
        $st = $pdo->query("SELECT * FROM post");
        $posts = $st->fetchAll();
        $st = $pdo->prepare("DELETE FROM post WHERE no=?");
        var_dump($_GET);
        $st->execute(array($_GET['no']));
    } catch(PDOException $e) {
        var_dump($e);
    }

    require 't_delete.php';
?>