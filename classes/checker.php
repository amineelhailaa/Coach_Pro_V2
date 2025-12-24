<?php

require_once __DIR__ . "/utilisateur.php"; //dir means when another file require this class ( checker ) it will access it with the path relatif to checker file not to the file usin checker class

class checker
{
    private PDO $pdo;
    private Seance $seance;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    function findEmail($email)
    {
        $query = 'select * from users where users.email = ?';
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($email));
        if($row = $statement->fetch(2)){

            $user = new utilisateur($row['nom'],$row['phone'],$row['role'],$row['email']);
            $user->setPasswordText($row['password']);
            return $user ;
        }
        else {
            return null;
        }


    }
    public function getIdByEmail($email)
    {
        $query = 'select user_id from users where users.email = ?';
        $statement = $this->pdo->prepare($query);
         $statement->execute(array($email));
        return $statement->fetch(2)['user_id'];
    }



    public function createSeance(Seance $seance,$coach_id)
    {
        $this->seance =  $seance;
        $statement= $this->pdo->prepare("insert into seance (coach_id,date_seance,start,duree,status) values (?,?,?,?,?)");
        return $statement->execute(array($coach_id,$seance->getDate(),$seance->getHeure(),$seance->getDuree(),$seance->getStatus() ));
    }


    public function getUserNameById($id_coach)
    {
        $query = "select * from users where id = ? ";
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($id_coach));
        if($row=$statement->fetch(2)){
           return new utilisateur($row['nom'],null,null,null);
    } else{
            return false;
        }

    }

}