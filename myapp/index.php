<?php
    try {

        echo (new PDO(
            'mysql:host=mysql;dbname=sample;charset=utf8mb4',
            'root',
            'root',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        ))
        ->query('select concat(\'MySQL Version :\', version()) v')
        ->fetch()['v'];

    } catch (PDOException $e) {
        echo $e->getMessage();
    }