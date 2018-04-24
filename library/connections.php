<?php

// Database Connections

function acmeConnect() {
    $server = 'localhost';
    $dbname = 'acme';
    $username = 'iClient';
    $password = 'ngpuuNG5pOEd4hiy';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $acmeLink = new PDO($dsn, $username, $password, $options);
        return $acmeLink;
    } catch (Exception $ex) {
        header('location: ../view/500.php');
    }
}
//acmeConnect();