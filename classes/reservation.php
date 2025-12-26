<?php



class reservation {
    private $reservation_id;
    private $coach_id;
    private $sportif_id;
    private $seance_id;
    private $status;
    private $date_reserved;

    public function __construct($reservation_id,$coachid,$sportifid,$seanceid,$status,$date_reserved)
    {
        $this->reservation_id = $reservation_id;
        $this->coach_id = $coachid;
        $this->sportif_id = $sportifid;
        $this->seance_id = $seanceid;
        $this->status = $status;
        $this->date_reserved = $date_reserved;
    }

    /**
     * @return mixed
     */
    public function getCoachId()
    {
        return $this->coach_id;
    }

    /**
     * @param mixed $coach_id
     */
    public function setCoachId($coach_id): void
    {
        $this->coach_id = $coach_id;
    }

    /**
     * @return mixed
     */
    public function getSportifId()
    {
        return $this->sportif_id;
    }

    /**
     * @param mixed $sportif_id
     */
    public function setSportifId($sportif_id): void
    {
        $this->sportif_id = $sportif_id;
    }

    /**
     * @return mixed
     */
    public function getDateReserved()
    {
        return $this->date_reserved;
    }

    /**
     * @param mixed $date_reserved
     */
    public function setDateReserved($date_reserved): void
    {
        $this->date_reserved = $date_reserved;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getSeanceId()
    {
        return $this->seance_id;
    }

    /**
     * @param mixed $seance_id
     */
    public function setSeanceId($seance_id): void
    {
        $this->seance_id = $seance_id;
    }

    /**
     * @return mixed
     */
    public function getReservationId()
    {
        return $this->reservation_id;
    }

    /**
     * @param mixed $reservation_id
     */
    public function setReservationId($reservation_id): void
    {
        $this->reservation_id = $reservation_id;
    }
}



