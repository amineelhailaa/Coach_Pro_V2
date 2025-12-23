<?php
//require_once "../config/database.php";
require_once __DIR__ . '/../config/database.php';

class utilisateur extends connect
{
    protected $nom;
    protected $phone;
    protected $role;
    protected $email;
    private $password;

    public function __construct( $nom, $phone, $role, $mail)
    {
        //function run by default when creating an instance.
        $this->nom = $nom;
        $this->phone = $phone;
        $this->setRole($role);
        $this->email = $mail;
    }


    //for setting and updating.
    public function setPassword($pw)
    {
        $this->password = password_hash($pw,PASSWORD_DEFAULT);
    }

    public function setName($n)
    {
        $this->nom = $n;
    }

    public function setPhone($p)
    {
        $this->phone = $p;
    }

    public function setEmail($mail)
    {
        $this->email = $mail;
    }


    public function setRole ($r){
        $this->role= $r == 1 ? 'coach' : 'sportif';
    }


    //for getting and accessing.
    public function getEmail()
    {
        return $this->email;
    }


    public function getName(){
        return $this->nom;
    }
    public function getPhone()
    {
        return $this->phone;
    }

    public function getRole()
    {
       return $this->role;
    }
    public function getPassword()
    {
        return $this->password;
    }


    protected function signMe()
    {
       $con = $this->connecting();
        $stmt=$con->prepare("insert into users(nom,email,password,phone,role) values (?,?,?,?,?)");
//       $stmt->bindpar("sssss",$this->nom,$this->email,$this->password,$this->phone,$this->role);
         $stmt->execute(array($this->nom,$this->email,$this->password,$this->phone,$this->role));
        return $con->lastInsertId();
    }



}