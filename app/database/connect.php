<?php
    $driver = 'mysql';
    $host = 'localhost';
    $data = 'dinamic-site';
    $name = 'root';
    $pass = 'mysql';
    $charset = 'utf8';
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

    try {
        $connect = new PDO("$driver:host=$host; dbname=$data; charset=$charset", $name, $pass, $options);
    } catch (PDOException $i) {
        die($i -> getMessage());
    }