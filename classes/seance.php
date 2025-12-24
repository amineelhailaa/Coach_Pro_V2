<?php



class Seance{
    private $coachName;
    private $date;
    private $heure;
    private $duree;
    private $status;

    public function __construct($c,$d,$h,$dr,$s)
    {
        $this->coachName = $c;
        $this->date = $d;
        $this->heure = $h;
        $this->duree = $dr;
        $this->status = $s;
    }


    public function getCoachName()
    {
        return $this->coachName;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getHeure()
    {
        return $this->heure;
    }

    public function getDuree()
    {
        return $this->duree;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus( $status)
    {
        $this->status = $status;
    }




}