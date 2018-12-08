<?php
    include_once('database/connection.php');  
    session_start();
    if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
        die("Não autorizado.");
    }
    $username = $_SESSION['username'];
    $id_occurrence=$_GET['id_occurrence'];   
    $title=$_POST['title'];
    $text=$_POST['text'];
    $date_hour=date("Y-m-d h:i");
    AddUpdate($title, $text, $username, $id_occurrence, $date_hour);
    header('Location: single_occurrence.php?id=' . $id_occurrence ); 
    
?>  