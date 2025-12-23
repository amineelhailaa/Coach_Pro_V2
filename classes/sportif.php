<?php
require_once __DIR__ . "/utilisateur.php";

class sportif extends utilisateur {
    protected $status;
    public function __construct($nom, $phone, $role, $mail,$status){
        parent::__construct( $nom, $phone, $role, $mail);
        $this->email = $mail;
        $this->nom = $nom;
        $this->phone = $phone;
        $this->role = $role;
        $this->status = $this->checkStatus($status);


    }


    private function checkStatus($d)
    {
        if(!empty($d)){
            return "active";
        }
        else {
            return "banned";
        }
    }


    public function setStatus($s)
    {
        $this->status = $this->checkStatus($s);
    }

    public function getStatus()
    {
        return $this->status;
    }
    public  function signMeSportif()
    {
        $user_id = $this->signMe();
        $stmt = $this->connecting()->prepare("insert into sportifs (sportif_id,status) values (?,?)");
//       $stmt->bindpar("sssss",$this->nom,$this->email,$this->password,$this->phone,$this->role);
        $stmt->execute(array($user_id,$this->status));
    }
}