<?php
    include_once('database/connection.php'); 
    
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