<?php
    include_once('database/connection.php');  
    session_start();
    if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
        die("Não autorizado.");
    }

    $id_occurrence=$_GET['id'];
    $nif=$_POST['nif'];
    $type="Culpado";
    
    AddReference($nif,  $id_occurrence, $type);

    if (!isset($_GET['known'])) {

        $name=$_POST['name'];
        $gender=$_POST['gender'];
        $birthdate=$_POST['birthdate'];
        $naturality=$_POST['naturality'];
        $adress=$_POST['adress'];
        $description=$_POST['description'];
        $height=$_POST['height'];
        $weight=$_POST['weight'];

        AddPerson($nif, $name, $gender, $birthdate, $naturality, $adress, $description, $height, $weight);
    }

    header("Location: single_occurrence.php?id=$id_occurrence"); 
?>  