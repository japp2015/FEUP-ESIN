<?php
    include_once('database/connection.php'); 
    session_start();
    if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
        die("Não autorizado.");
    }
    $gender=$_POST['gender'];
    $name=$_POST['name'];
    $adress=$_POST['adress'];
    $physical=$_POST['physical_description'];
    $local=$_POST['local'];
    $date=$_POST['date'];
    $station=$_POST['station'];
    AddMissingPerson($gender, $name, $adress, $physical, $local, $date, $station);
    header('Location: public.php');
?>