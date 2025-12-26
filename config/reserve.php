<?php

session_start();

require_once "database.php";
require_once "../classes/seance.php";
require_once "../classes/coach.php";
require_once "../classes/checker.php";

try{

    $coach_id = $_GET['coach'];
    $seance_id = $_GET['seance'];
    $user_id = $_SESSION['id'];
    if(isset($seance_id)&&isset($user_id)&&isset($coach_id)){

        $con = new connect();
        $pdo = $con->connecting();
        $sql = new checker($pdo);
        $seance = $sql->getSeanceById($seance_id);
        $seance->setStatus("reserved");
        $sql->updateSeanceStatus($seance_id,"reserved");
        $sql->createReservation($coach_id,$user_id,$seance_id);
        header("location: ../pages/sportif_dashboard.php");
    }
    else{
        header("location: ../pages/coach_profile.php");
    }
    exit();

}catch (Throwable $e){
    echo $e->getMessage();
}






