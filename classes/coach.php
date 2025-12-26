<?php

require_once __DIR__ . "/utilisateur.php";
class coach extends utilisateur
{
    protected $id;
    protected $discipline;
    protected $experience;
    protected $description;

    public function __construct($discipline, $exp, $description, $mail, $nom,$phone,$role)
    {
        parent::__construct( $nom, $phone, $role, $mail);

        $this->discipline = $discipline;
        $this->experience = $exp;
        $this->description = $description;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getID()
    {
        return $this->id;
    }


    public function getExp()
    {
        return $this->experience;
    }

    public function getDiscipline()
    {
        return $this->discipline;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setExp($ex)
    {
        $this->experience = $ex;
    }

    public function setDiscipline($d)
    {
        $this->discipline = $d;
    }

    public function setDescription($d)
    {
        $this->description = $d;
    }

    public function __toString()
    {
        return $this->email . "<br>" . $this->discipline . "<br>" . $this->description . "<br>" . $this->experience . "<br>";
    }

    public  function signMeCoach()
    {
        $user_id = $this->signMe();
        $stmt = $this->connecting()->prepare("insert into coaches (coach_id,exp_years,bio,discipline) values (?,?,?,?)");
//       $stmt->bindpar("sssss",$this->nom,$this->email,$this->password,$this->phone,$this->role);
        $stmt->execute(array($user_id,$this->experience,$this->description,$this->discipline));
    }


}