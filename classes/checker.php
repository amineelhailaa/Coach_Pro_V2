<?php

require_once __DIR__ . "/utilisateur.php"; //dir means when another file require this class ( checker ) it will access it with the path relatif to checker file not to the file usin checker class
require_once __DIR__."/reservation.php";

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
        $statement= $this->pdo->prepare("insert into seances  (coach_id,date_seance,start,duree,status) values (?,?,?,?,?)");
        return $statement->execute(array($coach_id,$seance->getDate(),$seance->getHeure(),$seance->getDuree(),$seance->getStatus() ));
    }

    public function upcomingSession($userId)
    {
        $query = "select count(*) from sportifs s join reservation r on s.sportif_id=r.sportif_id where r.sportif_id=? and  r.date_reserved >= curdate();";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($userId));
        $row = $stmt->fetch(2);
        return $row['count(*)'];
    }
    public function doneSession($userId)
    {
        $query = "select count(*) from sportifs s join reservation r on s.sportif_id=r.sportif_id where r.sportif_id=? and  r.date_reserved < curdate();";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($userId));
        $row = $stmt->fetch(2);
        return $row['count(*)'];
    }


    public function getUserNameById($id_coach)
    {
        $query = "select * from users where user_id = ? ";
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($id_coach));
        if($row=$statement->fetch(2)){
           return new utilisateur($row['nom'],$row['phone'],$row['role'],$row['email']);
    } else{
            return false;
        }

    }


    public function getCoachById($id_coach)
    {
        $query = "select * from coaches c inner join users u on c.coach_id = u.user_id where user_id = ? ";
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($id_coach));
        if($row=$statement->fetch(2)){
            return new coach($row['discipline'],$row['exp_years'],$row['bio'],$row['email'],$row['nom'],$row['phone'],$row['role']);
        } else{
            return false;
        }

    }



        public function getReservationS($id) //need to show seances per coach not all seances mate ????
    {
        $query = "select * from reservation join users on user_id = sportif_id where sportif_id = $id ";
        return $this->extracted($query);

    }

    public function getReservationC($id) //need to show seances per coach not all seances mate ????
    {
        $query = "select * from reservation join users on user_id = sportif_id where coach_id = $id and reservation.status='in progress' ";
        return $this->extracted($query);

    }




    public function getSeances($id) //need to show seances per coach not all seances mate ????
    {
        $query = "select * from seances where coach_id=$id";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $array=[];
        while($row = $statement->fetch(2)){
            $seance = new Seance($row['coach_id'],$row['date_seance'],$row['start'],$row['duree'],$row['status']);
            $array[]=$seance;
        }
        return $array;

    }
    public function getSeanceById($id) //id of the seance
    {
        $query = "select * from seances where id=?";
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($id));
        $row = $statement->fetch(2);
        $seance = new Seance($row['coach_id'],$row['date_seance'],$row['start'],$row['duree'],$row['status']);
        return $seance;
    }
    public function updateSeanceStatus($id,$status)
    {
        $query = "update seances set status=? where id=?";
        $statement = $this->pdo->prepare($query);
        return $statement->execute(array($status,$id));
    }

    public function updateReservationStatus($status,$id)
    {
        $query = "update reservation join seances on reservation.seance_id=seances.id set reservation.status = ?  where seances.id=?";
        $statement = $this->pdo->prepare($query);
        return $statement->execute(array($status,$id));
    }





    public function createReservation($coach_id,$user_id,$seance_id)
    {
        $statement= $this->pdo->prepare("insert into reservation  (coach_id,sportif_id,seance_id,status) values (?,?,?,?)");
        $statement->execute(array($coach_id,$user_id,$seance_id,"in progress"));

    }


    public function getSeancesByStatut($id,$status): array //need to show seances per coach not all seances mate ????
    {
        $query = "select * from seances where coach_id=? and status=? ";
        $statement = $this->pdo->prepare($query);
        $statement->execute(array($id,$status));
        $array=[];
        while($row = $statement->fetch(2)){
            $seance = new Seance($row['coach_id'],$row['date_seance'],$row['start'],$row['duree'],$row['status']);
            $seance->setId($row['id']);
            $array[]=$seance;
        }
        return $array;

    }





    public function getAllCoaches()
    {
        $query = "select * from coaches inner join users on coaches.coach_id = users.user_id";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $array=[];
        while($row = $statement->fetch(2)){
            $coach = new coach($row['discipline'],$row['exp_years'],$row['bio'],$row['email'],$row['nom'],$row['phone'],$row['role']);
            $coach->setId(intval($row['coach_id']));
            $array[]= $coach;
        }
        return $array;
    }

    /**
     * @param string $query
     * @return array
     */
    public function extracted(string $query): array
    {
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $array = [];
        while ($row = $statement->fetch(2)) {
            $reservation = new reservation($row['id'], $row['coach_id'], $row['sportif_id'], $row['seance_id'], $row['status'], $row['date_reserved']);
            $user = new utilisateur($row['nom'], $row['phone'], null, null);
            $statement->closeCursor();
            $seance = $this->getSeanceById($row['seance_id']);
            $array[] = [
                'reservation' => $reservation,
                'user' => $user,
                'seance' => $seance
            ];
        }
        return $array;
    }
}

//for testing functions
