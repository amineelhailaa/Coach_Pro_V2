<?php
require_once '../classes/coach.php';
require_once "../classes/sportif.php";
require_once "../classes/utilisateur.php";




$nom = $_POST['nom'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$role = intval($_POST['role']);
$discipline = $_POST['sport'];
$description = $_POST['bio'];
$exp = $_POST['exp'];
$status = 1;


if ($role) {
    $user = new coach($discipline, $exp, $description, $email, $nom, $phone, $role); //role must be 0 or 1 in form;
    $user->setPassword($password);
    $user->signMeCoach();
} else {
    $role = 0;
    $user = new sportif($nom, $phone, $role, $email, $status);
    $user->setPassword($password);
    $user->signMeSportif();
}