<?php
    include_once('../database/connection.php'); 
    session_start();
    if (isset($_POST['gender'])&&isset($_POST['name'])&&isset($_POST['adress'])&&isset($_POST['physical_description'])&&isset($_POST['local'])&&isset($_POST['date'])&&isset($_POST['station'])) {
        $gender=$_POST['gender'];
        $name=$_POST['name'];
        $adress=$_POST['adress'];
        $physical=$_POST['physical_description'];
        $local=$_POST['local'];
        $date=$_POST['date'];
        $station=$_POST['station'];
        AddMissingPerson($gender, $name, $adress, $physical, $local, $date, $station);
        header('Location: ../pages/public.php');
    }
    else {
        $error='Preencha todos os parametros!';
        header('Location: ../pages/missing_person_submition.php?error=' . $error);
    }
?>    