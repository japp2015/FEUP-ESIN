<?php
    include_once('database/connection.php');  
    session_start();
    $username = $_SESSION['username'];
    $user = getUserByUsername($username);
    $station = getUserStation($username);
    $station = $station['id'];
          
    $occ_type=$_POST['occ_type'];
    $chief=$_POST['chief'];
    $location=$_POST['location'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $state=$_POST['state'];
    $date=date("Y-m-d");

    if ($user['position']=="Diretor Nacional"){
        $station=$_POST['station'];
    }

    if (!isset($chief)){
        AddOccurrence1($occ_type, $title, $state, $date, $location, $description, $station);
        
        header('Location: main.php'); 
    } elseif (isset($chief)){
        AddOccurrence2($occ_type, $title, $chief, $state, $date, $location, $description, $station);
        header('Location: main.php'); 
    }
    
?>  