<?php

class connect
{
    public function connecting()
    {
        $host = "localhost";
        $user = "root";
        $pw = "281102";
        $db = "coachconnect";
        try {
            $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
            return new PDO($dsn, $user, $pw);
        } catch
        (PDOException $e) {
            echo "error!" . $e->getMessage();
            die();
        }

    }
}



//for testing purpose
//$amine = new connect();
//$amine->connecting();




