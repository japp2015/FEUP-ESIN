<?php
    include_once('../database/connection.php');  
    session_start();
    if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
        die("Não autorizado.");
    }
    $personnel_username=$_POST['add_personnel'];
    $id_occurrence=$_GET['occurrence'];
    AddWorksPersonnel($personnel_username,$id_occurrence);
    header('Location: ../pages/single_occurrence.php?id=' . $id_occurrence);

?>  