<?php
    include_once('database/connection.php');  
    session_start();
    if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
        die("Não autorizado.");
    }   
    $state=$_POST['change_state'];
    $occurrence=$_GET['id'];
    UpdateState($state,$occurrence);
    header('Location: single_occurrence.php?id=' . $occurrence); 
    