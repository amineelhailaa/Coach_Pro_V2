<?php

$host = "localhost";
$user = "root";
$pw = "281102";
$db = "coachconnect";
try {
    $dsn = "mysql:host=$host; dbname = $db";
    $pdo = new PDO($dsn, $user, $pw);
    echo "connected";
}catch (PDOException $e){
    echo "error!".$e->getMessage();
    die();
}