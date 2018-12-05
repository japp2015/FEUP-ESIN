<?php
    include_once('database/connection.php');  
    session_start();
      
    $personnel_username=$_POST['add_personnel'];
    $id_occurrence=$_GET['occurrence'];
    AddWorksPersonnel($personnel_username,$id_occurrence);
    header('Location: single_occurrence.php?id=' . $id_occurrence);

?>  